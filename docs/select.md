# Select

A lightweight, performance-focused select component for Laravel applications with built-in validation and error handling.

## Basic Usage

```blade
<x-jen::select
    :options="$users"
    option-value="id"
    option-label="name"
    wire:model="selectedUser" />
```

## Properties

| Property           | Type                | Default            | Description                              |
| ------------------ | ------------------- | ------------------ | ---------------------------------------- |
| `id`               | `?string`           | `null`             | HTML ID attribute for the select element |
| `label`            | `?string`           | `null`             | Label text for the select field          |
| `icon`             | `?string`           | `null`             | Left icon name                           |
| `iconRight`        | `?string`           | `null`             | Right icon name                          |
| `hint`             | `?string`           | `null`             | Helper text displayed below the field    |
| `hintClass`        | `?string`           | `'fieldset-label'` | CSS class for hint text                  |
| `prefix`           | `?string`           | `null`             | Text prefix inside the select            |
| `suffix`           | `?string`           | `null`             | Text suffix inside the select            |
| `placeholder`      | `?string`           | `null`             | Placeholder option text                  |
| `placeholderValue` | `?string`           | `null`             | Value for placeholder option             |
| `inline`           | `?bool`             | `false`            | Use floating label style                 |
| `optionValue`      | `?string`           | `'id'`             | Key for option values                    |
| `optionLabel`      | `?string`           | `'name'`           | Key for option labels                    |
| `options`          | `Collection\|array` | `new Collection()` | Options data collection or array         |
| `prepend`          | `mixed`             | `null`             | Slot for prepended content               |
| `append`           | `mixed`             | `null`             | Slot for appended content                |
| `errorField`       | `?string`           | `null`             | Field name for validation errors         |
| `errorClass`       | `?string`           | `'text-error'`     | CSS class for error messages             |
| `omitError`        | `?bool`             | `false`            | Hide error messages                      |
| `firstErrorOnly`   | `?bool`             | `false`            | Show only first validation error         |

## Examples

### Basic Select

```blade
<x-jen::select
    label="Choose User"
    :options="$users"
    option-value="id"
    option-label="name"
    placeholder="Select a user..."
    wire:model="userId" />
```

### With Icons

```blade
<x-jen::select
    label="Status"
    icon="check-circle"
    :options="$statuses"
    wire:model="status" />
```

### Inline (Floating) Label

```blade
<x-jen::select
    label="Category"
    inline
    :options="$categories"
    wire:model="categoryId" />
```

### With Validation

```blade
<x-jen::select
    label="Required Field"
    :options="$options"
    wire:model="requiredField"
    required
    error-field="requiredField" />
```

### With Prepend/Append Slots

```blade
<x-jen::select wire:model="amount">
    <x-slot:prepend>
        <span class="join-item bg-base-200 px-4 flex items-center">$</span>
    </x-slot:prepend>

    <x-slot:append>
        <button class="join-item btn btn-primary">Go</button>
    </x-slot:append>

    :options="$amounts"
</x-jen::select>
```

### With Prefix and Suffix

```blade
<x-jen::select
    label="Price Range"
    prefix="$"
    suffix="USD"
    :options="$priceRanges"
    wire:model="priceRange" />
```

### Custom Option Keys

```blade
<x-jen::select
    label="Country"
    :options="$countries"
    option-value="code"
    option-label="title"
    wire:model="countryCode" />
```

### With Hint Text

```blade
<x-jen::select
    label="Priority Level"
    :options="$priorities"
    hint="Higher numbers indicate higher priority"
    wire:model="priority" />
```

### Readonly State

```blade
<x-jen::select
    label="Status"
    :options="$statuses"
    wire:model="status"
    readonly />
```

### Complex Options with Disabled Items

```blade
@php
$options = [
    ['id' => 1, 'name' => 'Available Option', 'disabled' => false],
    ['id' => 2, 'name' => 'Disabled Option', 'disabled' => true],
    ['id' => 3, 'name' => 'Another Available Option', 'disabled' => false],
];
@endphp

<x-jen::select
    label="Select Option"
    :options="$options"
    wire:model="selectedOption" />
```

### With Custom Error Handling

```blade
<x-jen::select
    label="Important Field"
    :options="$options"
    wire:model="importantField"
    error-class="text-red-500 font-bold"
    first-error-only />
```

## Key Features

-   ✅ **Full API Compatibility**: Drop-in replacement for Mary UI Select
-   ✅ **Advanced Validation**: Built-in error handling with customizable styling
-   ✅ **Flexible Options**: Support for disabled options and custom keys
-   ✅ **Icon Support**: Left and right icons with dynamic prefix
-   ✅ **Livewire Ready**: Full wire:model support with proper wire:key
-   ✅ **Slot Support**: Prepend and append slots for complex layouts
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::select
    label="Custom Styled"
    :options="$options"
    class="select-primary"
    wire:model="value" />
```

## Dependencies

-   `x-jen::icon` (for icon support)

## Livewire Integration

Perfect for Livewire forms with real-time validation:

```php
class ContactForm extends Component
{
    public $category = '';
    public $categories = [
        ['id' => 'general', 'name' => 'General Inquiry'],
        ['id' => 'support', 'name' => 'Technical Support'],
        ['id' => 'sales', 'name' => 'Sales Question'],
    ];

    protected $rules = [
        'category' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.contact-form');
    }
}
```

```blade
<x-jen::select
    label="Category"
    :options="$categories"
    option-value="id"
    option-label="name"
    placeholder="Choose a category..."
    wire:model.live="category"
    required />
```
