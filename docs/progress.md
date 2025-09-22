# Progress

A lightweight, performance-focused progress bar component for Laravel applications.

## Basic Usage

```blade
<x-jen::progress value="50" max="100" />
```

## Properties

| Property        | Type      | Default | Description                                |
| --------------- | --------- | ------- | ------------------------------------------ |
| `id`            | `?string` | `null`  | HTML id attribute for the progress element |
| `value`         | `?float`  | `0`     | Current progress value                     |
| `max`           | `?float`  | `100`   | Maximum progress value                     |
| `indeterminate` | `?bool`   | `false` | Show indeterminate progress (no value/max) |

## Examples

### Basic Progress

```blade
<x-jen::progress value="25" max="100" />
```

### Indeterminate Progress

```blade
<x-jen::progress indeterminate="true" />
```

### Custom Styling

```blade
<x-jen::progress
    value="75"
    max="100"
    class="progress-primary w-56" />
```

### With Custom Max Value

```blade
<x-jen::progress value="3" max="5" />
```

### Zero Progress

```blade
<x-jen::progress value="0" max="100" />
```

### Full Progress

```blade
<x-jen::progress value="100" max="100" />
```

### With ID for JavaScript

```blade
<x-jen::progress
    id="upload-progress"
    value="0"
    max="100"
    class="progress-success" />
```

## Key Features

-   ✅ **Standard HTML Progress**: Uses native HTML5 `<progress>` element
-   ✅ **Indeterminate Mode**: Support for indeterminate progress indicators
-   ✅ **Flexible Values**: Custom value and max properties
-   ✅ **Livewire Ready**: Built-in wire:loading support with unique keys
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::progress
    value="60"
    max="100"
    class="progress-accent w-64 h-4" />
```

### Common Styling Patterns

```blade
{{-- Primary color --}}
<x-jen::progress value="30" class="progress-primary" />

{{-- Success color --}}
<x-jen::progress value="100" class="progress-success" />

{{-- Warning color --}}
<x-jen::progress value="75" class="progress-warning" />

{{-- Error color --}}
<x-jen::progress value="20" class="progress-error" />

{{-- Custom size --}}
<x-jen::progress value="50" class="w-96 h-6" />
```

## Conditional Usage

```blade
@if ($uploadInProgress)
    <x-jen::progress
        value="{{ $uploadPercentage }}"
        max="100"
        class="progress-info w-full" />
@endif
```

## Dynamic Values with Livewire

```blade
<x-jen::progress
    wire:loading.attr="indeterminate"
    wire:target="processData"
    value="{{ $processingProgress }}"
    max="100" />
```

## Dependencies

None - This is a standalone component.

## Browser Support

Uses the native HTML5 `<progress>` element, supported in all modern browsers:

-   Chrome 8+
-   Firefox 6+
-   Safari 6+
-   Edge (all versions)
-   IE 10+
