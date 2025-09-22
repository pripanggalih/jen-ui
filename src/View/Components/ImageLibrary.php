<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class ImageLibrary extends Component
{
	public string $uuid;
	public string $mimes = 'image/png, image/jpeg';

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?bool $hideErrors = false,
		public ?bool $hideProgress = false,
		public ?string $changeText = "Change",
		public ?string $cropText = "Crop",
		public ?string $removeText = "Remove",
		public ?string $cropTitleText = "Crop image",
		public ?string $cropCancelText = "Cancel",
		public ?string $cropSaveText = "Crop",
		public ?string $addFilesText = "Add images",
		public ?array $cropConfig = [],
		public Collection $preview = new Collection(),
	) {
		$this->uuid = 'image-library-' . Str::random(8) . ($id ? "-{$id}" : '');
	}

	public function modelName(): ?string
	{
		return $this->attributes->wire('model');
	}

	public function libraryName(): ?string
	{
		return $this->attributes->wire('library');
	}

	public function validationMessage(string $message): string
	{
		return str($message)->after('field');
	}

	public function cropSetup(): string
	{
		return json_encode(array_merge([
			'autoCropArea' => 1,
			'viewMode' => 1,
			'dragMode' => 'move',
			'checkCrossOrigin' => false,
		], $this->cropConfig));
	}

	public function hasPreview(): bool
	{
		return $this->preview->count() > 0;
	}

	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	public function getAcceptedMimes(): string
	{
		return $this->attributes->get('accept') ?? $this->mimes;
	}

	public function getFieldsetClasses(): string
	{
		return 'fieldset py-0';
	}

	public function getPreviewAreaClasses(): array
	{
		$classes = ['relative'];

		if (!$this->hasPreview()) {
			$classes[] = 'hidden';
		}

		return $classes;
	}

	public function getPreviewContainerClasses(): string
	{
		return 'border-[length:var(--border)] border-base-content/10 border-dotted rounded-lg';
	}

	public function getPreviewItemClasses(): string
	{
		return 'relative border-b-base-content/10 border-b-[length:var(--border)] border-dotted last:border-none cursor-move hover:bg-base-200';
	}

	public function getImageClasses(): string
	{
		return 'h-24 cursor-pointer border-2 border-base-content/10 rounded-lg hover:scale-105 transition-all ease-in-out';
	}

	public function getActionsClasses(): string
	{
		return 'absolute flex flex-col gap-2 top-3 start-3 cursor-pointer p-2 rounded-lg ignore-drag';
	}

	public function getProgressClasses(): string
	{
		return '-mt-2 h-1';
	}

	public function getAddButtonClasses(): string
	{
		return 'btn btn-block';
	}

	public function getMainInputClasses(): string
	{
		return 'file-input file-input-border file-input-primary hidden';
	}

	public function render(): View|Closure|string
	{
		return view('jen::image-library');
	}
}
