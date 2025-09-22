# Pin

A lightweight, performance-focused PIN input component for Laravel applications with advanced copy-paste support and validation.

## Basic Usage

```blade
<x-jen::pin :size="4" wire:model="pin" />
```

## Properties

| Property         | Type      | Default                     | Description                               |
| ---------------- | --------- | --------------------------- | ----------------------------------------- |
| `size`           | `int`     | Required                    | Number of PIN input fields                |
| `id`             | `?string` | `null`                      | Custom ID for the component               |
| `numeric`        | `?bool`   | `false`                     | Enable numeric-only input with mask       |
| `hide`           | `?bool`   | `false`                     | Hide input text with security characters  |
| `hideType`       | `?string` | `"disc"`                    | Type of security character (disc, circle) |
| `noGap`          | `?bool`   | `false`                     | Use joined layout without gaps            |
| `errorField`     | `?string` | `null`                      | Custom field name for validation errors   |
| `errorClass`     | `?string` | `'text-error text-xs pt-2'` | CSS classes for error display             |
| `omitError`      | `?bool`   | `false`                     | Skip error display                        |
| `firstErrorOnly` | `?bool`   | `false`                     | Show only the first validation error      |

## Examples

### Basic PIN Input

```blade
<x-jen::pin :size="4" wire:model="pin" />
```

### Numeric PIN with Hide

```blade
<x-jen::pin
    :size="6"
    wire:model="securePin"
    :numeric="true"
    :hide="true" />
```

### Joined Layout (No Gap)

```blade
<x-jen::pin
    :size="4"
    wire:model="pin"
    :noGap="true"
    class="w-fit" />
```

### Custom Error Handling

```blade
<x-jen::pin
    :size="4"
    wire:model="pin"
    error-field="pin_code"
    error-class="text-red-500 text-sm mt-2"
    :first-error-only="true" />
```

### With Alpine.js Events

```blade
<div x-data="{
    pinComplete: false,
    handleComplete(event) {
        this.pinComplete = true;
        console.log('PIN completed:', event.detail);
    },
    handleIncomplete(event) {
        this.pinComplete = false;
        console.log('PIN incomplete:', event.detail);
    }
}">
    <x-jen::pin
        :size="4"
        wire:model="pin"
        @completed="handleComplete"
        @incomplete="handleIncomplete" />

    <div x-show="pinComplete" class="text-green-500 mt-2">
        ✓ PIN Complete!
    </div>
</div>
```

## Key Features

-   ✅ **Copy & Paste Support**: Automatically fills all fields from clipboard
-   ✅ **Keyboard Navigation**: Auto-focus next/previous fields with arrow keys and backspace
-   ✅ **Alpine.js Events**: Dispatches 'completed' and 'incomplete' events
-   ✅ **Text Security**: Hide input with customizable security characters
-   ✅ **Numeric Mode**: Input mask for numeric-only entry
-   ✅ **Flexible Layout**: Joined or gapped input layouts
-   ✅ **Error Validation**: Laravel validation integration with customizable display
-   ✅ **Livewire Ready**: Built-in wire:model support with auto-discovery
-   ✅ **Auto Discovery**: Works automatically without manual registration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::pin
    :size="4"
    wire:model="pin"
    class="space-x-4"
    input-class="border-2 border-primary" />
```

## Events

The component dispatches Alpine.js events:

-   `completed`: When all PIN fields are filled
-   `incomplete`: When PIN is not complete

```blade
<x-jen::pin
    :size="4"
    wire:model="pin"
    @completed="$wire.validatePin($event.detail)"
    @incomplete="$wire.resetValidation()" />
```

## Dependencies

-   None (standalone component)

## Security Features

The component supports text security for sensitive PIN entry:

```blade
{{-- Hide with default disc character --}}
<x-jen::pin :size="4" wire:model="pin" :hide="true" />

{{-- Hide with custom character type --}}
<x-jen::pin :size="4" wire:model="pin" :hide="true" hide-type="circle" />
```

## Validation

Integrates seamlessly with Laravel validation:

```php
// In your Livewire component or controller
public function rules()
{
    return [
        'pin' => ['required', 'digits:4'],
        'secure_pin' => ['required', 'digits:6', 'numeric'],
    ];
}
```

```blade
{{-- Will automatically show validation errors --}}
<x-jen::pin :size="4" wire:model="pin" />
<x-jen::pin :size="6" wire:model="secure_pin" />
```
