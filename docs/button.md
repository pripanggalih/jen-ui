# Button

A lightweight, performance-focused button component for Laravel applications with support for icons, badges, tooltips, loading states, and link functionality.

## Basic Usage

```blade
<x-jen::button label="Click Me" />
```

## Properties

| Property         | Type      | Default | Description                                   |
| ---------------- | --------- | ------- | --------------------------------------------- |
| `id`             | `?string` | `null`  | Optional ID for the button                    |
| `label`          | `?string` | `null`  | Button text label                             |
| `icon`           | `?string` | `null`  | Left icon name (e.g., 'home', 'user')         |
| `iconRight`      | `?string` | `null`  | Right icon name                               |
| `spinner`        | `?string` | `null`  | Loading spinner target or '1' for auto-detect |
| `link`           | `?string` | `null`  | URL to make button act as a link              |
| `external`       | `?bool`   | `false` | Open link in new tab                          |
| `noWireNavigate` | `?bool`   | `false` | Disable wire:navigate for links               |
| `responsive`     | `?bool`   | `false` | Hide label on small screens                   |
| `badge`          | `?string` | `null`  | Badge text to display                         |
| `badgeClasses`   | `?string` | `null`  | Additional CSS classes for badge              |
| `tooltip`        | `?string` | `null`  | Tooltip text (top position)                   |
| `tooltipLeft`    | `?string` | `null`  | Tooltip text (left position)                  |
| `tooltipRight`   | `?string` | `null`  | Tooltip text (right position)                 |
| `tooltipBottom`  | `?string` | `null`  | Tooltip text (bottom position)                |

## Examples

### Basic Buttons

```blade
<x-jen::button label="Default" />
<x-jen::button label="Primary" class="btn-primary" />
<x-jen::button label="Secondary" class="btn-secondary" />
<x-jen::button label="Success" class="btn-success" />
<x-jen::button label="Warning" class="btn-warning" />
<x-jen::button label="Error" class="btn-error" />
```

### Button Sizes

```blade
<x-jen::button label="Large" class="btn-lg" />
<x-jen::button label="Normal" />
<x-jen::button label="Small" class="btn-sm" />
<x-jen::button label="Tiny" class="btn-xs" />
```

### With Icons

```blade
{{-- Left icon --}}
<x-jen::button label="Save" icon="check" class="btn-primary" />

{{-- Right icon --}}
<x-jen::button label="Next" icon-right="arrow-right" class="btn-secondary" />

{{-- Icon only --}}
<x-jen::button icon="user" class="btn-circle btn-primary" />
<x-jen::button icon="heart" class="btn-square btn-error" />
```

### Loading States

```blade
{{-- Auto-detect wire:click target --}}
<x-jen::button label="Save"
    spinner="1"
    wire:click="save"
    class="btn-primary" />

{{-- Specific target --}}
<x-jen::button label="Process"
    spinner="processData"
    wire:click="processData"
    class="btn-primary" />

{{-- With right icon spinner --}}
<x-jen::button label="Submit"
    icon-right="arrow-right"
    spinner="1"
    wire:click="submit"
    class="btn-primary" />
```

### As Links

```blade
{{-- Internal link --}}
<x-jen::button label="Dashboard" link="/dashboard" class="btn-primary" />

{{-- External link --}}
<x-jen::button label="Documentation"
    link="https://laravel.com"
    external="true"
    class="btn-outline" />

{{-- Without wire:navigate --}}
<x-jen::button label="Legacy Page"
    link="/legacy"
    no-wire-navigate="true"
    class="btn-secondary" />
```

### With Tooltips

```blade
{{-- Top tooltip (default) --}}
<x-jen::button icon="info" tooltip="Information" class="btn-circle" />

{{-- Different positions --}}
<x-jen::button icon="help" tooltip-left="Help" class="btn-circle" />
<x-jen::button icon="settings" tooltip-right="Settings" class="btn-circle" />
<x-jen::button icon="info" tooltip-bottom="Details" class="btn-circle" />
```

### With Badges

```blade
<x-jen::button label="Messages"
    badge="3"
    badge-classes="badge-error"
    class="btn-primary" />

<x-jen::button label="Notifications"
    badge="New"
    badge-classes="badge-success badge-xs"
    class="btn-outline" />
```

### Responsive Buttons

```blade
{{-- Hide label on small screens --}}
<x-jen::button label="Settings"
    icon="cog"
    responsive="true"
    class="btn-primary" />
```

### Using Slots

```blade
<x-jen::button class="btn-primary">
    <strong>Custom</strong> Content
    <x-icon name="star" class="ml-2" />
</x-jen::button>
```

## Advanced Examples

### Form Submit Button

```blade
<x-jen::button label="Save Changes"
    icon="check"
    spinner="1"
    wire:click="saveForm"
    tooltip="Save your changes"
    class="btn-primary" />
```

### Navigation Button

```blade
<x-jen::button label="View Profile"
    icon="user"
    link="{{ route('profile.show', $user) }}"
    class="btn-outline btn-primary" />
```

### Conditional States

```blade
<x-jen::button
    :label="$editing ? 'Save' : 'Edit'"
    :icon="$editing ? 'check' : 'pencil'"
    :spinner="$editing ? '1' : null"
    :wire:click="$editing ? 'save' : 'edit'"
    :class="$editing ? 'btn-success' : 'btn-primary'" />
```

### With Alpine.js

```blade
<x-jen::button label="Toggle Menu"
    icon="menu"
    @click="open = !open"
    :class="{ 'btn-active': open }"
    class="btn-ghost" />
```

## Styling

The component uses daisyUI button classes and can be fully customized:

```blade
<x-jen::button label="Custom Style"
    class="btn-primary btn-lg shadow-lg hover:shadow-xl transition-shadow" />
```

### Available daisyUI Classes

-   **Types**: `btn-primary`, `btn-secondary`, `btn-accent`, `btn-ghost`, `btn-link`
-   **States**: `btn-success`, `btn-warning`, `btn-error`, `btn-info`
-   **Variants**: `btn-outline`, `btn-active`, `btn-disabled`
-   **Sizes**: `btn-lg`, `btn-md`, `btn-sm`, `btn-xs`
-   **Shapes**: `btn-circle`, `btn-square`

## API Compatibility

This component maintains 100% API compatibility with Mary UI. You can directly replace:

```blade
<!-- Mary UI -->
<x-mary::button label="Save" icon="check" spinner="1" />

<!-- jen-ui -->
<x-jen::button label="Save" icon="check" spinner="1" />
```

## Dependencies

-   **x-icon** component (for icon support)

## Livewire Integration

### Loading States

```blade
{{-- Automatic spinner with wire:click --}}
<x-jen::button label="Save"
    spinner="1"
    wire:click="save" />

{{-- Custom loading target --}}
<x-jen::button label="Process"
    spinner="processLongTask"
    wire:click="processLongTask" />
```

### Dynamic Properties

```blade
<x-jen::button
    :label="$isProcessing ? 'Processing...' : 'Start'"
    :spinner="$isProcessing ? '1' : null"
    :disabled="$isProcessing"
    wire:click="process" />
```

## Accessibility

The component includes proper accessibility features:

-   **Button semantics**: Uses `<button>` or `<a>` elements appropriately
-   **Loading states**: Disabled during loading with `wire:loading.attr="disabled"`
-   **Keyboard navigation**: Full keyboard support
-   **Screen readers**: Proper labeling and ARIA attributes

## Best Practices

### 1. Use Appropriate Button Types

```blade
{{-- For actions --}}
<x-jen::button label="Save" wire:click="save" />

{{-- For navigation --}}
<x-jen::button label="View Details" link="/details" />
```

### 2. Loading State Management

```blade
{{-- Good: Auto-detect target --}}
<x-jen::button label="Save" spinner="1" wire:click="save" />

{{-- Better: Specific target for complex actions --}}
<x-jen::button label="Process" spinner="processData" wire:click="processData" />
```

### 3. Consistent Styling

```blade
{{-- Use consistent button variants --}}
<x-jen::button label="Save" class="btn-primary" />
<x-jen::button label="Cancel" class="btn-outline" />
<x-jen::button label="Delete" class="btn-error" />
```

## Common Patterns

### Modal Actions

```blade
<div class="modal-action">
    <x-jen::button label="Cancel" @click="$wire.closeModal()" />
    <x-jen::button label="Confirm"
        spinner="1"
        wire:click="confirm"
        class="btn-primary" />
</div>
```

### Form Buttons

```blade
<div class="flex gap-2">
    <x-jen::button label="Save Draft"
        wire:click="saveDraft"
        class="btn-outline" />
    <x-jen::button label="Publish"
        spinner="1"
        wire:click="publish"
        class="btn-primary" />
</div>
```

### Icon-Only Actions

```blade
<div class="flex gap-1">
    <x-jen::button icon="pencil" tooltip="Edit" class="btn-sm btn-ghost" />
    <x-jen::button icon="trash" tooltip="Delete" class="btn-sm btn-error" />
    <x-jen::button icon="eye" tooltip="View" class="btn-sm btn-info" />
</div>
```

## Key Features

-   ✅ **Dual Purpose**: Works as button or link
-   ✅ **Smart Loading**: Auto-detect spinner targets
-   ✅ **Rich Icons**: Left, right, and icon-only modes
-   ✅ **Interactive**: Tooltips, badges, and hover states
-   ✅ **Accessible**: ARIA compliant and keyboard friendly
-   ✅ **Livewire Ready**: Built-in wire:loading support
-   ✅ **Flexible Styling**: Full Tailwind CSS support
