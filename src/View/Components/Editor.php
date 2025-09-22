<?php

namespace Jen\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Editor extends Component
{
	public string $uuid;

	public string $uploadUrl;

	public function __construct(
		public ?string $id = null,
		public ?string $label = null,
		public ?string $hint = null,
		public ?string $hintClass = 'fieldset-label',
		public ?string $disk = 'public',
		public ?string $folder = 'editor',
		public ?bool $gplLicense = false,
		public ?array $config = [],

		// Validations
		public ?string $errorField = null,
		public ?string $errorClass = 'text-error',
		public ?bool $omitError = false,
		public ?bool $firstErrorOnly = false,
	) {
		$this->uuid = 'editor-' . Str::random(8) . ($id ? "-{$id}" : '');

		// Try to use jen.upload route first, then fallback to mary.upload for compatibility
		try {
			$this->uploadUrl = route('jen.upload', absolute: false);
		} catch (\Exception $e) {
			try {
				$this->uploadUrl = route('mary.upload', absolute: false);
			} catch (\Exception $e) {
				// Final fallback to direct URL
				$this->uploadUrl = '/jen-ui/editor/upload';
			}
		}
	}

	public function modelName(): ?string
	{
		return $this->attributes->whereStartsWith('wire:model')->first();
	}

	public function errorFieldName(): ?string
	{
		return $this->errorField ?? $this->modelName();
	}

	public function hasLabel(): bool
	{
		return (bool) $this->label;
	}

	public function hasHint(): bool
	{
		return (bool) $this->hint;
	}

	public function shouldShowError(): bool
	{
		if ($this->omitError) {
			return false;
		}

		return (bool) $this->errorFieldName();
	}

	public function isRequired(): bool
	{
		return (bool) $this->attributes->get('required');
	}

	public function isDisabled(): bool
	{
		return (bool) $this->attributes->get('disabled');
	}

	public function isReadonly(): bool
	{
		return (bool) $this->attributes->get('readonly');
	}

	public function getSetupConfig(): string
	{
		$setup = array_merge([
			'menubar' => false,
			'automatic_uploads' => true,
			'quickbars_insert_toolbar' => false,
			'branding' => false,
			'relative_urls' => false,
			'remove_script_host' => false,
			'height' => 300,
			'toolbar' => 'undo redo | align bullist numlist | outdent indent | quickimage quicktable',
			'quickbars_selection_toolbar' => 'bold italic underline strikethrough | forecolor backcolor | link blockquote removeformat | blocks',
		], $this->config);

		$setup['plugins'] = str('advlist autolink lists link image table quickbars ')->append($this->config['plugins'] ?? '');

		return str(json_encode($setup))->trim('{}')->replace('"', "'")->toString();
	}

	public function getUploadUrl(): string
	{
		return $this->uploadUrl . '?disk=' . $this->disk . '&folder=' . $this->folder . '&_token=' . csrf_token();
	}

	public function getContentStyle(): string
	{
		if ($this->isDisabled()) {
			return 'body { opacity: 50% }';
		}

		return 'img { max-width: 100%; height: auto; }';
	}

	public function render(): View|Closure|string
	{
		return view('jen::editor');
	}
}
