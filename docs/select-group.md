# SelectGroup

A lightweight, performance-focused grouped select component for Laravel applications with optgroup support.

## Basic Usage

```blade
<x-jen::select-group
    label="Choose Category"
    :options="$groupedOptions"
    wire:model="selectedCategory" />
```

## Properties

| Property           | Type                | Default            | Description                     |
| ------------------ | ------------------- | ------------------ | ------------------------------- |
| `id`               | `?string`           | `null`             | ID for the select element       |
| `label`            | `?string`           | `null`             | Label text for the select group |
| `icon`             | `?string`           | `null`             | Icon name for left side         |
| `iconRight`        | `?string`           | `null`             | Icon name for right side        |
| `hint`             | `?string`           | `null`             | Hint text displayed below input |
| `hintClass`        | `?string`           | `'fieldset-label'` | CSS class for hint text         |
| `placeholder`      | `?string`           | `null`             | Placeholder text for select     |
| `placeholderValue` | `?string`           | `null`             | Value for placeholder option    |
| `inline`           | `?bool`             | `false`            | Enable floating label mode      |
| `optionValue`      | `?string`           | `'id'`             | Property name for option values |
| `optionLabel`      | `?string`           | `'name'`           | Property name for option labels |
| `options`          | `Collection\|array` | `new Collection()` | Grouped options data            |
| `prepend`          | `mixed`             | `null`             | Slot content for prepend area   |
| `append`           | `mixed`             | `null`             | Slot content for append area    |
| `errorField`       | `?string`           | `null`             | Custom error field name         |
| `errorClass`       | `?string`           | `'text-error'`     | CSS class for error messages    |
| `omitError`        | `?bool`             | `false`            | Skip error message display      |
| `firstErrorOnly`   | `?bool`             | `false`            | Show only first error message   |

## Examples

### Basic Grouped Select

```blade
@php
$categories = [
    'Electronics' => [
        ['id' => 1, 'name' => 'Smartphones'],
        ['id' => 2, 'name' => 'Laptops'],
        ['id' => 3, 'name' => 'Tablets']
    ],
    'Clothing' => [
        ['id' => 4, 'name' => 'Shirts'],
        ['id' => 5, 'name' => 'Pants'],
        ['id' => 6, 'name' => 'Shoes']
    ]
];
@endphp

<x-jen::select-group
    label="Product Category"
    placeholder="Select a category..."
    :options="$categories"
    wire:model="category" />
```

### With Icons and Hint

```blade
<x-jen::select-group
    label="Department"
    icon="o-building-office"
    iconRight="chevron-down"
    hint="Choose your department from the list"
    :options="$departments"
    wire:model="selectedDepartment" />
```

### Floating Label Mode

```blade
<x-jen::select-group
    label="Location"
    inline
    :options="$locations"
    wire:model="location"
    class="mb-4" />
```

### With Prepend/Append Elements

```blade
<x-jen::select-group
    label="Country"
    :options="$countries"
    wire:model="country">

    <x-slot:prepend>
        <span class="join-item bg-base-200 px-3 py-2">
            <x-jen::icon name="flag" class="w-4 h-4" />
        </span>
    </x-slot:prepend>

    <x-slot:append>
        <button class="btn btn-primary join-item">
            Select
        </button>
    </x-slot:append>
</x-jen::select-group>
```

### Custom Option Keys

```blade
@php
$regions = [
    'Asia' => [
        ['code' => 'ID', 'country' => 'Indonesia'],
        ['code' => 'MY', 'country' => 'Malaysia'],
        ['code' => 'SG', 'country' => 'Singapore']
    ],
    'Europe' => [
        ['code' => 'DE', 'country' => 'Germany'],
        ['code' => 'FR', 'country' => 'France'],
        ['code' => 'UK', 'country' => 'United Kingdom']
    ]
];
@endphp

<x-jen::select-group
    label="Country"
    :options="$regions"
    option-value="code"
    option-label="country"
    wire:model="countryCode" />
```

### Validation and Error Handling

```blade
<x-jen::select-group
    label="Required Field"
    :options="$groupedOptions"
    wire:model="requiredField"
    error-field="requiredField"
    first-error-only
    required />
```

### Conditional Usage

```blade
@if ($showDepartmentSelect)
    <x-jen::select-group
        label="Department"
        :options="$departments"
        wire:model="selectedDepartment"
        hint="This field is required for managers" />
@endif
```

## Key Features

-   ✅ **Grouped Options**: Support for optgroup with nested options structure
-   ✅ **Flexible Data Structure**: Customizable option value and label keys
-   ✅ **Icon Support**: Icons on both left and right sides with dynamic prefix
-   ✅ **Floating Labels**: Inline/floating label mode for modern UI
-   ✅ **Prepend/Append**: Slot support for additional elements with join styling
-   ✅ **Error Handling**: Built-in validation error display with customizable messages
-   ✅ **Accessibility**: ARIA attributes and proper form associations
-   ✅ **Livewire Ready**: Built-in wire:key and wire:model support
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS and daisyUI classes. You can customize styling:

```blade
<x-jen::select-group
    label="Styled Select"
    :options="$options"
    wire:model="selection"
    class="select-primary select-lg" />
```

## Dependencies

-   `x-jen::icon` (for icon display with dynamic prefix support)
-   Laravel Blade component system
-   daisyUI fieldset and select components

## Data Structure

The component expects grouped options in this format:

```php
$groupedOptions = [
    'Group 1 Name' => [
        ['id' => 1, 'name' => 'Option 1'],
        ['id' => 2, 'name' => 'Option 2'],
    ],
    'Group 2 Name' => [
        ['id' => 3, 'name' => 'Option 3'],
        ['id' => 4, 'name' => 'Option 4'],
    ],
];
```

You can customize the key names using `option-value` and `option-label` properties to match your data structure.
