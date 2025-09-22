# ProgressRadial

A lightweight, performance-focused radial progress indicator component for Laravel applications.

## Basic Usage

```blade
<x-jen::progress-radial :value="75" />
```

## Properties

| Property | Type      | Default | Description                                     |
| -------- | --------- | ------- | ----------------------------------------------- |
| `id`     | `?string` | `null`  | HTML ID attribute for the progress element      |
| `value`  | `?float`  | `0`     | Progress value (typically 0-100 for percentage) |
| `unit`   | `?string` | `'%'`   | Unit to display after the value                 |

## Examples

### Basic Example

```blade
<x-jen::progress-radial :value="50" />
```

### Custom Value and Unit

```blade
<x-jen::progress-radial :value="8" unit="GB" />
```

### With Custom ID and Styling

```blade
<x-jen::progress-radial
    id="disk-usage"
    :value="85"
    unit="%"
    class="text-primary w-24 h-24" />
```

### Dynamic Progress

```blade
<x-jen::progress-radial
    :value="$completionPercentage"
    class="text-success" />
```

### Different Sizes

```blade
{{-- Small --}}
<x-jen::progress-radial :value="25" class="w-16 h-16" />

{{-- Medium --}}
<x-jen::progress-radial :value="50" class="w-20 h-20" />

{{-- Large --}}
<x-jen::progress-radial :value="75" class="w-32 h-32" />
```

### Custom Colors

```blade
{{-- Success --}}
<x-jen::progress-radial :value="100" class="text-success" />

{{-- Warning --}}
<x-jen::progress-radial :value="65" class="text-warning" />

{{-- Error --}}
<x-jen::progress-radial :value="25" class="text-error" />
```

## Key Features

-   ✅ **Simple API**: Easy to use with just value and optional unit
-   ✅ **CSS Custom Properties**: Uses `--value` for efficient styling
-   ✅ **Accessibility**: Built-in `role="progressbar"` for screen readers
-   ✅ **Livewire Ready**: Includes wire:key for proper reactivity
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses DaisyUI's `radial-progress` class and can be customized:

```blade
<x-jen::progress-radial
    :value="80"
    class="text-primary bg-primary-content border-4 border-primary" />
```

## CSS Custom Properties

The component automatically sets the `--value` CSS custom property:

```css
.radial-progress {
    --value: 75; /* Automatically set based on value prop */
}
```

## Dependencies

-   None (standalone component)

## Migration from Mary UI

Direct replacement - no changes needed:

```blade
{{-- Mary UI --}}
<x-mary::progress-radial :value="75" />

{{-- jen-ui --}}
<x-jen::progress-radial :value="75" />
```
