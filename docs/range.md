# Range

A lightweight, performance-focused range slider input component for Laravel applications with validation support.

## Basic Usage

```blade
<x-jen::range wire:model="volume" label="Volume" />
```

## Properties

| Property         | Type      | Default          | Description                                 |
| ---------------- | --------- | ---------------- | ------------------------------------------- |
| `id`             | `?string` | `null`           | HTML id attribute for the range input       |
| `label`          | `?string` | `null`           | Label text displayed above the range        |
| `hint`           | `?string` | `null`           | Hint text displayed below the range         |
| `hintClass`      | `?string` | `fieldset-label` | CSS classes for hint text styling           |
| `min`            | `?int`    | `0`              | Minimum value for the range slider          |
| `max`            | `?int`    | `100`            | Maximum value for the range slider          |
| `errorField`     | `?string` | `null`           | Custom field name for error validation      |
| `errorClass`     | `?string` | `text-error`     | CSS classes for error message styling       |
| `omitError`      | `?bool`   | `false`          | Skip error display even if validation fails |
| `firstErrorOnly` | `?bool`   | `false`          | Show only the first validation error        |

## Examples

### Basic Range

```blade
<x-jen::range
    wire:model="rating"
    label="Rate this product"
    min="1"
    max="5" />
```

### Range with Validation

```blade
<x-jen::range
    wire:model="age"
    label="Age"
    min="18"
    max="100"
    required
    hint="Must be 18 or older"
    errorField="age" />
```

### Custom Styling

```blade
<x-jen::range
    wire:model="volume"
    label="Volume Control"
    min="0"
    max="100"
    class="range-primary"
    hintClass="text-sm text-gray-500" />
```

### Range with Error Handling

```blade
<x-jen::range
    wire:model="temperature"
    label="Temperature (°C)"
    min="-20"
    max="50"
    hint="Safe operating temperature range"
    firstErrorOnly="true"
    errorClass="text-red-600 text-sm" />
```

### Disabled Range

```blade
<x-jen::range
    wire:model="fixedValue"
    label="Fixed Setting"
    min="0"
    max="100"
    disabled
    class="opacity-50" />
```

## Key Features

-   ✅ **Livewire Ready**: Built-in wire:model and wire:key support
-   ✅ **Validation Support**: Full Laravel validation error handling
-   ✅ **Flexible Styling**: Customizable CSS classes for all elements
-   ✅ **Accessibility**: Proper label and fieldset structure
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS and daisyUI classes. You can customize the appearance:

```blade
{{-- Primary theme --}}
<x-jen::range
    wire:model="value1"
    class="range-primary" />

{{-- Secondary theme --}}
<x-jen::range
    wire:model="value2"
    class="range-secondary" />

{{-- Custom styling --}}
<x-jen::range
    wire:model="value3"
    class="range-accent range-lg" />
```

## Validation

The component integrates seamlessly with Laravel validation:

```php
// In your Livewire component
public $rating = 3;

public function rules()
{
    return [
        'rating' => 'required|integer|min:1|max:5'
    ];
}
```

```blade
<x-jen::range
    wire:model="rating"
    label="Rating"
    min="1"
    max="5"
    required />
```

## Dependencies

-   None (standalone component)

## Advanced Usage

### Real-time Updates

```blade
<div>
    <x-jen::range
        wire:model.live="brightness"
        label="Brightness: {{ $brightness }}%"
        min="0"
        max="100" />

    <div class="mt-4 p-4 rounded"
         style="background-color: rgba(255, 255, 255, {{ $brightness / 100 }})">
        Preview
    </div>
</div>
```

### Multiple Ranges

```blade
<div class="space-y-4">
    <x-jen::range
        wire:model="red"
        label="Red: {{ $red }}"
        min="0"
        max="255"
        class="range-error" />

    <x-jen::range
        wire:model="green"
        label="Green: {{ $green }}"
        min="0"
        max="255"
        class="range-success" />

    <x-jen::range
        wire:model="blue"
        label="Blue: {{ $blue }}"
        min="0"
        max="255"
        class="range-info" />
</div>
```
