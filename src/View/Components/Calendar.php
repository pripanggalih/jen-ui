<?php

namespace Jen\View\Components;

use Carbon\CarbonPeriod;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Calendar extends Component
{
	public string $uuid;

	public function __construct(
		public ?string $id = null,
		public ?int $months = 1,
		public ?string $locale = 'en-EN',
		public ?bool $weekendHighlight = false,
		public ?bool $sundayStart = false,
		public ?array $config = [],
		public ?array $events = [],
	) {
		$this->uuid = 'calendar-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	public function isMultiple(): bool
	{
		return $this->months > 1;
	}

	public function hasEvents(): bool
	{
		return !empty($this->events);
	}

	public function getCalendarConfig(): string
	{
		$baseConfig = [
			'type' => $this->isMultiple() ? 'multiple' : 'default',
			'months' => $this->months,
			'jumpMonths' => $this->months,
			'popups' => $this->getPopups(),
			'settings' => [
				'lang' => $this->locale,
				'visibility' => [
					'daysOutside' => false,
					'weekend' => $this->weekendHighlight,
				],
				'selection' => [
					'day' => false,
				],
				'iso8601' => !$this->sundayStart,
			],
			'CSSClasses' => 'PLACEHOLDER_CSS',
			'actions' => 'x',
		];

		$finalConfig = array_merge($baseConfig, $this->config);
		$jsonConfig = json_encode($finalConfig);

		// Add responsive CSS classes
		return str_replace(
			'"PLACEHOLDER_CSS"',
			'{"grid":"vanilla-calendar-grid flex flex-wrap justify-around","calendar":"vanilla-calendar"}',
			$jsonConfig
		);
	}

	public function getPopups(): array
	{
		if (!$this->hasEvents()) {
			return [];
		}

		$buffer = [];

		return collect($this->events)->flatMap(function ($event) use (&$buffer) {
			$dates = $this->getEventDates($event);

			return collect($dates)->flatMap(function ($date) use ($event, &$buffer) {
				$html = '<div><strong>' . $event['label'] . '</strong></div>' .
					'<div>' . ($event['description'] ?? null) . '</div>' .
					'<hr class="my-3 last:hidden" />';

				$buffer[$date] = ($buffer[$date] ?? '') . $html;

				return [
					$date => [
						'modifier' => $event['css'] ?? null,
						'html' => $buffer[$date]
					],
				];
			});
		})->toArray();
	}

	protected function getEventDates(array $event): array
	{
		if (isset($event['range']) && is_array($event['range']) && count($event['range']) >= 2) {
			$dates = [];
			$period = CarbonPeriod::create($event['range'][0], $event['range'][1]);

			foreach ($period as $date) {
				$dates[] = Carbon::parse($date)->format('Y-m-d');
			}

			return $dates;
		}

		if (isset($event['date'])) {
			return [Carbon::parse($event['date'])->format('Y-m-d')];
		}

		return [];
	}

	public function render(): View|Closure|string
	{
		return view('jen::calendar');
	}
}
