<?php

namespace Jen\View\Components;

use ArrayAccess;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Table extends Component
{
    public string $uuid;

    public mixed $loop = null;

    public function __construct(
        public array $headers,
        public ArrayAccess|array $rows,
        public ?string $id = null,
        public ?bool $striped = false,
        public ?bool $noHeaders = false,
        public ?bool $selectable = false,
        public ?string $selectableKey = 'id',
        public ?bool $expandable = false,
        public ?string $expandableKey = 'id',
        public mixed $expandableCondition = null,
        public ?string $link = null,
        public ?bool $withPagination = false,
        public ?string $perPage = null,
        public ?array $perPageValues = [10, 20, 50, 100],
        public ?array $sortBy = [],
        public ?array $rowDecoration = [],
        public ?array $cellDecoration = [],
        public ?bool $showEmptyText = false,
        public mixed $emptyText = 'No records found.',
        public string $containerClass = 'overflow-x-auto',
        public ?bool $noHover = false,

        // Slots
        public mixed $actions = null,
        public mixed $tr = null,
        public mixed $cell = null,
        public mixed $expansion = null,
        public mixed $empty = null,
        public mixed $footer = null,

    ) {
        if ($this->selectable && $this->expandable) {
            throw new Exception('You can not combine `expandable` with `selectable`.');
        }

        // Temp - preserve closures from serialization issue
        $rowDecoration = $this->rowDecoration;
        $cellDecoration = $this->cellDecoration;
        $headers = $this->headers;

        // Remove them from serialization, because they are closures
        unset($this->rowDecoration);
        unset($this->cellDecoration);
        unset($this->headers);

        // Generate lightweight UUID with jen prefix
        $this->uuid = 'jen-table-' . Str::random(8) . ($this->id ? "-{$this->id}" : '');

        // Put them back
        $this->rowDecoration = $rowDecoration;
        $this->cellDecoration = $cellDecoration;
        $this->headers = $headers;
    }

    // Get all ids for selectable and expandable features
    public function getAllIds(): array
    {
        if (is_array($this->rows)) {
            return collect($this->rows)->pluck($this->selectableKey)->all();
        }

        return $this->rows->pluck($this->selectableKey)->all();
    }

    // Check if header is sortable
    public function isSortable(mixed $header): bool
    {
        return count($this->sortBy) && ($header['sortable'] ?? true);
    }

    // Check if header is hidden
    public function isHidden(mixed $header): bool
    {
        return $header['hidden'] ?? false;
    }

    // Format header value with different formatting options
    public function format(mixed $row, mixed $field, mixed $header): mixed
    {
        $format = $header['format'] ?? null;

        if (! $format) {
            return $field;
        }

        if (is_callable($format)) {
            return $format($row, $field);
        }

        if ($format[0] == 'currency') {
            return ($format[2] ?? '') . number_format($field, ...str_split($format[1]));
        }

        if ($format[0] == 'date' && $field) {
            return Carbon::parse($field)->translatedFormat($format[1]);
        }

        return $field;
    }

    // Check if link should be shown in cell
    public function hasLink(mixed $header): bool
    {
        return $this->link && empty($header['disableLink']);
    }

    // Check if is currently sorted by this header
    public function isSortedBy(mixed $header): bool
    {
        if (count($this->sortBy) == 0) {
            return false;
        }

        return $this->sortBy['column'] == ($header['sortBy'] ?? $header['key']);
    }

    // Handle header sort direction toggle
    public function getSort(mixed $header): mixed
    {
        if (! $this->isSortable($header)) {
            return false;
        }

        if (count($this->sortBy) == 0) {
            return ['column' => '', 'direction' => ''];
        }

        $direction = $this->isSortedBy($header)
            ? ($this->sortBy['direction'] == 'asc') ? 'desc' : 'asc'
            : 'asc';

        return ['column' => $header['sortBy'] ?? $header['key'], 'direction' => $direction];
    }

    // Build row link with token replacement
    public function redirectLink(mixed $row): string
    {
        $link = $this->link;

        // Transform from `route()` pattern
        $link = Str::of($link)->replace('%5B', '{')->replace('%5D', '}');

        // Extract tokens like {id}, {city.name} ...
        $tokens = Str::of($link)->matchAll('/\{(.*?)\}/');

        // Replace tokens by actual row values
        $tokens->each(function (string $token) use ($row, &$link) {
            $link = Str::of($link)->replace('{' . $token . '}', data_get($row, $token))->toString();
        });

        return $link;
    }

    // Get row CSS classes based on decoration conditions
    public function rowClasses(mixed $row): ?string
    {
        $classes = [];

        foreach ($this->rowDecoration as $class => $condition) {
            if ($condition($row)) {
                $classes[] = $class;
            }
        }

        return Arr::join($classes, ' ');
    }

    // Get cell CSS classes based on decoration conditions
    public function cellClasses(mixed $row, array $header): ?string
    {
        $classes = Str::of($header['class'] ?? '')->explode(' ')->all();

        foreach ($this->cellDecoration[$header['key']] ?? [] as $class => $condition) {
            if ($condition($row)) {
                $classes[] = $class;
            }
        }

        return Arr::join($classes, ' ');
    }

    // Get wire model modifier for selectable feature
    public function selectableModifier(): string
    {
        return is_string($this->getAllIds()[0] ?? null) ? '' : '.number';
    }

    // Get key value for expandable/selectable features
    public function getKeyValue($row, $key): mixed
    {
        $value = data_get($row, $this->$key);

        return is_numeric($value) && ! str($value)->startsWith('0') ? $value : "'$value'";
    }

    public function render(): View|Closure|string
    {
        return view('jen::table');
    }
}
