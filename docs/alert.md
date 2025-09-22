# Alert

A lightweight, performance-focused alert component for Laravel applications with dismissible functionality and customizable styling.

## Basic Usage

```blade
<x-jen::alert title="Success!" description="Your changes have been saved." />
```

## Properties

| Property      | Type      | Default | Description                                        |
| ------------- | --------- | ------- | -------------------------------------------------- |
| `id`          | `?string` | `null`  | Custom ID for the alert element                    |
| `title`       | `?string` | `null`  | The title of the alert, displayed in bold          |
| `icon`        | `?string` | `null`  | The icon displayed at the beginning of the alert   |
| `description` | `?string` | `null`  | A short description under the title                |
| `shadow`      | `?bool`   | `false` | Whether to apply a shadow effect to the alert      |
| `dismissible` | `?bool`   | `false` | Whether the alert can be dismissed by the user     |
| `actions`     | `mixed`   | `null`  | Slot for actionable elements like buttons or links |

## Examples

### Basic Alert

```blade
<x-jen::alert title="Information" description="This is an informational message." />
```

### Alert with Icon

```blade
<x-jen::alert
    title="Success!"
    description="Operation completed successfully."
    icon="o-check-circle"
    class="alert-success" />
```

### Dismissible Alert

```blade
<x-jen::alert
    title="Warning"
    description="Please review your settings."
    icon="o-exclamation-triangle"
    :dismissible="true"
    class="alert-warning" />
```

### Alert with Shadow

```blade
<x-jen::alert
    title="Error"
    description="Something went wrong."
    icon="o-x-circle"
    :shadow="true"
    class="alert-error" />
```

### Alert with Actions

```blade
<x-jen::alert title="Confirmation Required" description="Do you want to proceed?">
    <x-jen::slot:actions>
        <x-jen::button label="Cancel" class="btn-sm" />
        <x-jen::button label="Proceed" class="btn-sm btn-primary" />
    </x-slot:actions>
</x-jen::alert>
```

### Alert with Slot Content

```blade
<x-jen::alert class="alert-info">
    <strong>Custom Content:</strong> You can use the default slot instead of title/description for more complex content.
</x-jen::alert>
```

### Custom Styled Alert

```blade
<x-jen::alert
    title="Custom Alert"
    description="With custom styling"
    icon="o-information-circle"
    :shadow="true"
    :dismissible="true"
    class="alert-info bg-blue-50 border-blue-200" />
```

## Styling

The component uses Tailwind CSS classes and DaisyUI alert classes. Common alert variants:

```blade
<!-- Success Alert -->
<x-jen::alert title="Success" class="alert-success" />

<!-- Warning Alert -->
<x-jen::alert title="Warning" class="alert-warning" />

<!-- Error Alert -->
<x-jen::alert title="Error" class="alert-error" />

<!-- Info Alert -->
<x-jen::alert title="Information" class="alert-info" />
```

## API Compatibility

```blade
<x-jen::jen::alert title="Success!" description="Operation completed." />

<!-- jen-ui -->
<x-jen::alert title="Success!" description="Operation completed." />
```

## Dependencies

-   `x-icon` (for alert icons)
-   `x-button` (for dismissible close button)

## Alpine.js Integration

The alert component uses Alpine.js for dismissible functionality:

-   `x-data="{ show: true }"` - Initial state
-   `x-show="show"` - Show/hide functionality
-   `@click="show = false"` - Dismiss action

Make sure Alpine.js is included in your project for dismissible alerts to work properly.

## Advanced Usage

### Conditional Alerts

```blade
@if ($errors->any())
    <x-jen::alert
        title="Validation Error"
        description="Please check the form fields below."
        icon="o-exclamation-triangle"
        :dismissible="true"
        class="alert-error mb-4" />
@endif
```

### Dynamic Alerts with Livewire

```blade
@if (session('success'))
    <x-jen::alert
        title="Success!"
        :description="session('success')"
        icon="o-check-circle"
        :dismissible="true"
        class="alert-success" />
@endif
```

### Alert with Custom Actions

```blade
<x-jen::alert title="Update Available" description="A new version is available.">
    <x-jen::slot:actions>
        <x-jen::button label="Update Now"
            class="btn-sm btn-primary"
            wire:click="updateApp" />
        <x-jen::button label="Later"
            class="btn-sm btn-ghost"
            @click="show = false" />
    </x-slot:actions>
</x-jen::alert>
```
