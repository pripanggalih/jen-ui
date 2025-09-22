# Textarea

A lightweight, performance-focused textarea component for Laravel applications with form validation and multiple display modes.

## Basic Usage

```blade
<x-jen::textarea label="Biography" wire:model="bio" placeholder="Enter your biography..." />
```

## Properties

| Property         | Type      | Default            | Description                                |
| ---------------- | --------- | ------------------ | ------------------------------------------ |
| `id`             | `?string` | `null`             | The textarea id attribute                  |
| `label`          | `?string` | `null`             | Label text to display                      |
| `hint`           | `?string` | `null`             | Hint text to show below the textarea       |
| `hintClass`      | `?string` | `'fieldset-label'` | CSS class for hint text                    |
| `inline`         | `?bool`   | `false`            | Whether to use inline/floating label style |
| `errorField`     | `?string` | `null`             | Custom field name for error validation     |
| `errorClass`     | `?string` | `'text-error'`     | CSS class for error messages               |
| `omitError`      | `?bool`   | `false`            | Whether to hide error messages             |
| `firstErrorOnly` | `?bool`   | `false`            | Show only the first validation error       |

## Examples

### Basic Textarea

```blade
<x-jen::textarea
    label="Biography"
    wire:model="bio"
    placeholder="Tell us about yourself..."
    rows="5" />
```

### With Hint Text

```blade
<x-jen::textarea
    label="Biography"
    wire:model="bio"
    placeholder="Here ..."
    hint="Max 1000 chars"
    rows="5" />
```

### Inline Label Style

```blade
<x-jen::textarea
    label="Biography"
    wire:model="bio"
    placeholder="Inline style"
    rows="5"
    inline />
```

### Required Field

```blade
<x-jen::textarea
    label="Required Description"
    wire:model="description"
    placeholder="This field is required..."
    rows="4"
    required />
```

### Readonly Textarea

```blade
<x-jen::textarea
    label="Read Only Content"
    wire:model="content"
    placeholder="Cannot be edited"
    rows="3"
    readonly />
```

### Custom Error Handling

```blade
<x-jen::textarea
    label="Custom Error Field"
    wire:model="bio"
    error-field="user.biography"
    error-class="text-red-600"
    first-error-only />
```

### With Custom Styling

```blade
<x-jen::textarea
    label="Styled Textarea"
    wire:model="styled_content"
    placeholder="Custom styled textarea..."
    rows="6"
    class="bg-gray-50 border-blue-300 focus:border-blue-500" />
```

## Key Features

-   ✅ **Form Validation**: Built-in Laravel validation support with error display
-   ✅ **Flexible Labels**: Standard or inline/floating label styles
-   ✅ **Hint Text**: Optional helper text below the textarea
-   ✅ **Required Fields**: Visual indicator for required fields
-   ✅ **Readonly Support**: Special styling for readonly textareas
-   ✅ **Error Customization**: Customizable error field names and styling
-   ✅ **Livewire Ready**: Full wire:model support with proper wire:key
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Model Arrays**: Supports wire:model with arrays like `wire:model="emails.0"`

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::textarea
    label="Custom Styled"
    wire:model="content"
    class="bg-primary text-white border-accent"
    hint-class="text-secondary"
    error-class="text-warning" />
```

## Form Integration

Perfect for use in forms with validation:

```blade
<form wire:submit="save">
    <x-jen::textarea
        label="Product Description"
        wire:model="product.description"
        placeholder="Describe your product..."
        rows="4"
        required />

    <x-jen::textarea
        label="Additional Notes"
        wire:model="product.notes"
        placeholder="Any additional information..."
        hint="Optional field"
        rows="3" />

    <button type="submit" class="btn btn-primary">Save Product</button>
</form>
```

## Dependencies

-   None (standalone component)

## Validation

The component automatically integrates with Laravel's validation system:

```php
// In your Livewire component or controller
public function rules()
{
    return [
        'bio' => 'required|string|max:1000',
        'description' => 'required|string|min:10',
    ];
}
```

The textarea will automatically show validation errors and apply error styling when validation fails.
