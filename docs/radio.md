# Radio

A lightweight, performance-focused radio button component for Laravel applications with fieldset support.

## Basic Usage

```blade
<x-jen::radio :options="$options" wire:model="selectedOption" />
```

## Properties

| Property         | Type                | Default            | Description                                    |
| ---------------- | ------------------- | ------------------ | ---------------------------------------------- |
| `id`             | `?string`           | `null`             | Unique identifier for the radio component      |
| `label`          | `?string`           | `null`             | Label text displayed as fieldset legend        |
| `hint`           | `?string`           | `null`             | Hint text displayed below radio options        |
| `hintClass`      | `?string`           | `fieldset-label`   | CSS classes for hint text                      |
| `optionValue`    | `?string`           | `id`               | Key to extract value from option object/array  |
| `optionLabel`    | `?string`           | `name`             | Key to extract label from option object/array  |
| `optionHint`     | `?string`           | `hint`             | Key to extract hint from option object/array   |
| `options`        | `Collection\|array` | `new Collection()` | Collection or array of radio options           |
| `inline`         | `?bool`             | `false`            | Display radio options inline on larger screens |
| `errorField`     | `?string`           | `null`             | Custom error field name for validation         |
| `errorClass`     | `?string`           | `text-error`       | CSS classes for error messages                 |
| `omitError`      | `?bool`             | `false`            | Hide error messages                            |
| `firstErrorOnly` | `?bool`             | `false`            | Show only the first error message              |

## Examples

### Basic Example

```blade
@php
    $genders = [
        ['id' => 'male', 'name' => 'Male'],
        ['id' => 'female', 'name' => 'Female'],
        ['id' => 'other', 'name' => 'Other'],
    ];
@endphp

<x-jen::radio
    label="Gender"
    :options="$genders"
    wire:model="gender" />
```

### Inline Layout

```blade
<x-jen::radio
    label="Preferred Contact Method"
    :options="$contactMethods"
    wire:model="contactMethod"
    inline="true" />
```

### With Option Hints

```blade
@php
    $plans = [
        [
            'id' => 'basic',
            'name' => 'Basic Plan',
            'hint' => 'Perfect for small teams'
        ],
        [
            'id' => 'pro',
            'name' => 'Pro Plan',
            'hint' => 'Best for growing businesses'
        ],
        [
            'id' => 'enterprise',
            'name' => 'Enterprise Plan',
            'hint' => 'For large organizations'
        ],
    ];
@endphp

<x-jen::radio
    label="Choose Your Plan"
    :options="$plans"
    wire:model="selectedPlan" />
```

### With Component Hint

```blade
<x-jen::radio
    label="Newsletter Subscription"
    hint="Select your preferred frequency"
    :options="$frequencies"
    wire:model="frequency" />
```

### Disabled Options

```blade
@php
    $options = [
        ['id' => 'option1', 'name' => 'Available Option'],
        ['id' => 'option2', 'name' => 'Disabled Option', 'disabled' => true],
        ['id' => 'option3', 'name' => 'Another Available Option'],
    ];
@endphp

<x-jen::radio
    label="Select Option"
    :options="$options"
    wire:model="selected" />
```

### Custom Error Field

```blade
<x-jen::radio
    label="Terms and Conditions"
    :options="$agreements"
    wire:model="terms"
    errorField="agreement"
    required />
```

### Custom Option Keys

```blade
@php
    $categories = [
        ['value' => 1, 'title' => 'Technology', 'description' => 'All tech-related posts'],
        ['value' => 2, 'title' => 'Lifestyle', 'description' => 'Life and wellness content'],
        ['value' => 3, 'title' => 'Business', 'description' => 'Business and entrepreneurship'],
    ];
@endphp

<x-jen::radio
    label="Content Category"
    :options="$categories"
    optionValue="value"
    optionLabel="title"
    optionHint="description"
    wire:model="category" />
```

## Key Features

-   ✅ **Fieldset Structure**: Proper semantic HTML with fieldset and legend
-   ✅ **Option Hints**: Individual hints for each radio option
-   ✅ **Inline Layout**: Responsive inline display for better space utilization
-   ✅ **Disabled Options**: Support for disabled radio buttons
-   ✅ **Validation Support**: Built-in error handling and display
-   ✅ **Custom Keys**: Flexible option structure with custom value/label/hint keys
-   ✅ **Required Indicator**: Visual asterisk for required fields
-   ✅ **Livewire Ready**: Built-in wire:model support and unique wire:key
-   ✅ **Auto Discovery**: Works automatically without manual registration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::radio
    label="Custom Styled Radio"
    :options="$options"
    wire:model="value"
    class="custom-fieldset"
    hintClass="text-gray-500 text-xs" />
```

## Dependencies

-   None (standalone component)

## Validation

The component automatically displays validation errors from Laravel's error bag:

```php
// In your Livewire component or controller
$this->validate([
    'selectedOption' => 'required|in:option1,option2,option3'
]);
```

```blade
<x-jen::radio
    label="Required Selection"
    :options="$options"
    wire:model="selectedOption"
    required />
```
