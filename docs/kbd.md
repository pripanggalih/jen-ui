# Kbd

A lightweight, performance-focused keyboard key component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::kbd>Ctrl</x-jen::kbd>
```

## Properties

| Property | Type      | Default | Description                     |
| -------- | --------- | ------- | ------------------------------- |
| `id`     | `?string` | `null`  | Optional ID for the kbd element |

## Examples

### Basic Example

```blade
<x-jen::kbd>Enter</x-jen::kbd>
```

### With Custom ID

```blade
<x-jen::kbd id="custom-key">Space</x-jen::kbd>
```

### Custom Styling

```blade
<x-jen::kbd class="kbd-lg bg-primary text-white">
    Ctrl + C
</x-jen::kbd>
```

### Keyboard Shortcuts Display

```blade
<div class="flex items-center gap-2">
    <span>Save document:</span>
    <div class="flex gap-1">
        <x-jen::kbd>Ctrl</x-jen::kbd>
        <span>+</span>
        <x-jen::kbd>S</x-jen::kbd>
    </div>
</div>
```

### Multiple Key Combinations

```blade
<div class="space-y-2">
    <div class="flex items-center gap-2">
        <span>Copy:</span>
        <div class="flex gap-1">
            <x-jen::kbd>Ctrl</x-jen::kbd>
            <span>+</span>
            <x-jen::kbd>C</x-jen::kbd>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <span>Paste:</span>
        <div class="flex gap-1">
            <x-jen::kbd>Ctrl</x-jen::kbd>
            <span>+</span>
            <x-jen::kbd>V</x-jen::kbd>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <span>Undo:</span>
        <div class="flex gap-1">
            <x-jen::kbd>Ctrl</x-jen::kbd>
            <span>+</span>
            <x-jen::kbd>Z</x-jen::kbd>
        </div>
    </div>
</div>
```

### Conditional Usage

```blade
@if ($showShortcuts)
    <div class="kbd-shortcuts">
        Press <x-jen::kbd>?</x-jen::kbd> for help
    </div>
@endif
```

## Styling

The component uses daisyUI's `kbd` class and can be customized with:

```blade
<x-jen::kbd class="kbd-sm bg-secondary">Tab</x-jen::kbd>
<x-jen::kbd class="kbd-md bg-accent">Enter</x-jen::kbd>
<x-jen::kbd class="kbd-lg bg-primary">Space</x-jen::kbd>
```

### Available daisyUI Classes

-   `kbd-sm` - Small size
-   `kbd-md` - Medium size (default)
-   `kbd-lg` - Large size

## API Compatibility


```blade
<x-jen::jen::kbd>Ctrl</x-jen::kbd>

<!-- jen-ui -->
<x-jen::kbd>Ctrl</x-jen::kbd>
```

## Dependencies

-   None (standalone component)

## Use Cases

Perfect for:

-   Displaying keyboard shortcuts in documentation
-   Help tooltips showing key combinations
-   User interface elements that reference keyboard keys
-   Accessibility instructions
-   Tutorial and onboarding flows
