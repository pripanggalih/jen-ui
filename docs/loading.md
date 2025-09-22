# Loading

A lightweight, performance-focused loading indicator component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::loading />
```

## Properties

| Property | Type      | Default | Description                                  |
| -------- | --------- | ------- | -------------------------------------------- |
| `id`     | `?string` | `null`  | Optional custom ID for the loading component |

## Examples

### Basic Loading Spinner

```blade
<x-jen::loading />
```

### Loading with Custom ID

```blade
<x-jen::loading id="main-loader" />
```

### Loading with Custom Classes

```blade
<x-jen::loading class="loading-spinner loading-lg" />
```

### Conditional Loading

```blade
@if ($isLoading)
    <x-jen::loading class="loading-dots" />
@endif
```

## Styling

The component uses DaisyUI's loading classes and can be customized with:

```blade
<!-- Different loading styles -->
<x-jen::loading class="loading-spinner" />
<x-jen::loading class="loading-dots" />
<x-jen::loading class="loading-ring" />
<x-jen::loading class="loading-ball" />
<x-jen::loading class="loading-bars" />
<x-jen::loading class="loading-infinity" />

<!-- Different sizes -->
<x-jen::loading class="loading-xs" />
<x-jen::loading class="loading-sm" />
<x-jen::loading class="loading-md" />
<x-jen::loading class="loading-lg" />
```

### Color Variations

```blade
<!-- Themed colors -->
<x-jen::loading class="loading-primary" />
<x-jen::loading class="loading-secondary" />
<x-jen::loading class="loading-accent" />
<x-jen::loading class="loading-neutral" />
<x-jen::loading class="loading-info" />
<x-jen::loading class="loading-success" />
<x-jen::loading class="loading-warning" />
<x-jen::loading class="loading-error" />
```

## Common Use Cases

### Button Loading State

```blade
<button type="submit"
    class="btn btn-primary"
    wire:loading.attr="disabled">

    <span wire:loading.remove>Submit</span>
    <span wire:loading class="flex items-center gap-2">
        <x-jen::loading class="loading-spinner loading-sm" />
        Processing...
    </span>
</button>
```

### Page Loading

```blade
<div wire:loading.delay class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
    <div class="flex flex-col items-center gap-4 rounded-lg bg-base-100 p-8">
        <x-jen::loading class="loading-spinner loading-lg" />
        <p class="text-lg">Loading...</p>
    </div>
</div>
```

### Table Loading

```blade
<div class="overflow-x-auto">
    <table class="table">
        <!-- table headers -->
        <tbody>
            @if ($isLoading)
                <tr>
                    <td colspan="5" class="text-center py-8">
                        <x-jen::loading class="loading-dots loading-lg" />
                    </td>
                </tr>
            @else
                <!-- table rows -->
            @endif
        </tbody>
    </table>
</div>
```

## API Compatibility


```blade
<x-jen::jen::loading />

<!-- jen-ui -->
<x-jen::loading />
```

## Dependencies

-   None (standalone component)

## Technical Details

The Loading component generates a unique `wire:key` for Livewire compatibility and uses Laravel's native attribute merging system for optimal performance. The UUID generation uses `Str::random(8)` instead of expensive `md5(serialize())` operations for better performance.
