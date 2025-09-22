# Toggle

A lightweight, performance-focused toggle (switch) component for Laravel applications with full Livewire support and validation.

## Basic Usage

```blade
<x-jen::toggle label="Enable notifications" />
```

## Properties

| Property         | Type      | Default          | Description                                   |
| ---------------- | --------- | ---------------- | --------------------------------------------- |
| `id`             | `?string` | `null`           | Unique identifier for the toggle element      |
| `label`          | `?string` | `null`           | Label text displayed next to the toggle       |
| `right`          | `?bool`   | `false`          | Position toggle on the right side of label    |
| `hint`           | `?string` | `null`           | Helper text displayed below the label         |
| `hintClass`      | `?string` | `fieldset-label` | CSS class for styling the hint text           |
| `errorField`     | `?string` | `null`           | Field name for error validation (auto-detect) |
| `errorClass`     | `?string` | `text-error`     | CSS class for styling error messages          |
| `omitError`      | `?bool`   | `false`          | Hide error messages completely                |
| `firstErrorOnly` | `?bool`   | `false`          | Show only the first validation error          |

## Examples

### Basic Toggle

```blade
<x-jen::toggle label="Enable dark mode" wire:model="darkMode" />
```

### Right-aligned Toggle

```blade
<x-jen::toggle
    label="Email notifications"
    wire:model="emailNotifications"
    right="true" />
```

### With Hint Text

```blade
<x-jen::toggle
    label="Two-factor authentication"
    hint="Adds an extra layer of security to your account"
    wire:model="twoFactorEnabled" />
```

### Required Toggle

```blade
<x-jen::toggle
    label="Accept terms and conditions"
    wire:model="acceptTerms"
    required />
```

### Custom Styling

```blade
<x-jen::toggle
    label="Custom styled toggle"
    wire:model="customToggle"
    class="toggle-accent"
    hint="This toggle has custom styling" />
```

### Form Validation

```blade
<x-jen::toggle
    label="Subscribe to newsletter"
    wire:model="newsletter"
    error-field="newsletter"
    hint="Receive updates about new features" />
```

### With Custom Error Classes

```blade
<x-jen::toggle
    label="Marketing emails"
    wire:model="marketingEmails"
    error-class="text-red-500 font-semibold"
    hint-class="text-gray-500 text-xs" />
```

## Key Features

-   ✅ **Full Livewire Support**: Built-in wire:model binding with real-time updates
-   ✅ **Validation Ready**: Automatic error display with Laravel validation
-   ✅ **Flexible Layout**: Left or right-aligned toggle positioning
-   ✅ **Hint Text**: Optional helper text below labels
-   ✅ **Custom Styling**: Support for custom CSS classes
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration
-   ✅ **Required Field**: Visual indicator for required toggles
-   ✅ **Error Handling**: Comprehensive error message display options

## Form Usage

Use toggles within forms for boolean settings:

```blade
<form wire:submit="save">
    <div class="space-y-4">
        <x-jen::toggle
            label="Profile visibility"
            wire:model="settings.profileVisible"
            hint="Make your profile visible to other users" />

        <x-jen::toggle
            label="Email notifications"
            wire:model="settings.emailNotifications"
            hint="Receive notifications via email" />

        <x-jen::toggle
            label="Push notifications"
            wire:model="settings.pushNotifications"
            right="true" />
    </div>

    <button type="submit" class="btn btn-primary mt-4">
        Save Settings
    </button>
</form>
```

## Validation Examples

### Simple Required Validation

```php
// In your Livewire component
public function rules()
{
    return [
        'acceptTerms' => 'required|accepted',
        'newsletter' => 'boolean',
    ];
}
```

### Custom Validation Messages

```php
public function messages()
{
    return [
        'acceptTerms.required' => 'You must accept the terms and conditions.',
        'acceptTerms.accepted' => 'Please check the terms and conditions checkbox.',
    ];
}
```

## Styling

The component uses Tailwind CSS classes and DaisyUI toggle styling:

```blade
<!-- Default toggle -->
<x-jen::toggle label="Default" />

<!-- Accent colored toggle -->
<x-jen::toggle label="Accent" class="toggle-accent" />

<!-- Success colored toggle -->
<x-jen::toggle label="Success" class="toggle-success" />

<!-- Warning colored toggle -->
<x-jen::toggle label="Warning" class="toggle-warning" />

<!-- Error colored toggle -->
<x-jen::toggle label="Error" class="toggle-error" />

<!-- Different sizes -->
<x-jen::toggle label="Small" class="toggle-sm" />
<x-jen::toggle label="Large" class="toggle-lg" />
```

## Dependencies

-   None (standalone component)

## Accessibility

The toggle component includes proper accessibility features:

-   Semantic `label` and `fieldset` elements
-   Proper `for` attribute linking
-   ARIA attributes for screen readers
-   Keyboard navigation support
-   Focus indicators
