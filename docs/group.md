# Group

A lightweight, performance-focused radio button group component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::group
    label="Choose Option"
    :options="[
        ['id' => 1, 'name' => 'Option 1'],
        ['id' => 2, 'name' => 'Option 2'],
    ]"
    wire:model="selectedOption" />
```

## Properties

| Property         | Type                | Default            | Description                         |
| ---------------- | ------------------- | ------------------ | ----------------------------------- |
| `id`             | `?string`           | `null`             | Component ID                        |
| `label`          | `?string`           | `null`             | Label text for the group            |
| `hint`           | `?string`           | `null`             | Hint text displayed below the group |
| `hintClass`      | `?string`           | `'fieldset-label'` | CSS class for hint text             |
| `optionValue`    | `?string`           | `'id'`             | Key name for option value           |
| `optionLabel`    | `?string`           | `'name'`           | Key name for option label           |
| `options`        | `Collection\|array` | `new Collection()` | Array/Collection of options         |
| `errorField`     | `?string`           | `null`             | Field name for error validation     |
| `errorClass`     | `?string`           | `'text-error'`     | CSS class for error messages        |
| `omitError`      | `?bool`             | `false`            | Whether to hide error messages      |
| `firstErrorOnly` | `?bool`             | `false`            | Show only the first error message   |

## Examples

### Basic Example

```blade
<x-jen::group
    label="Select Gender"
    :options="[
        ['id' => 'male', 'name' => 'Male'],
        ['id' => 'female', 'name' => 'Female'],
    ]"
    wire:model="gender" />
```

### With Custom Keys

```blade
<x-jen::group
    label="Choose Category"
    option-value="slug"
    option-label="title"
    :options="[
        ['slug' => 'tech', 'title' => 'Technology'],
        ['slug' => 'design', 'title' => 'Design'],
    ]"
    wire:model="category" />
```

### With Disabled Options

```blade
<x-jen::group
    label="Select Plan"
    :options="[
        ['id' => 'free', 'name' => 'Free Plan'],
        ['id' => 'pro', 'name' => 'Pro Plan', 'disabled' => true],
        ['id' => 'enterprise', 'name' => 'Enterprise Plan'],
    ]"
    wire:model="plan" />
```

### Required Field

```blade
<x-jen::group
    label="Choose Priority"
    :options="$priorities"
    wire:model="priority"
    required />
```

### With Hint Text

```blade
<x-jen::group
    label="Newsletter Frequency"
    hint="Choose how often you want to receive updates"
    :options="[
        ['id' => 'daily', 'name' => 'Daily'],
        ['id' => 'weekly', 'name' => 'Weekly'],
        ['id' => 'monthly', 'name' => 'Monthly'],
    ]"
    wire:model="frequency" />
```

### With Validation

```blade
<x-jen::group
    label="Account Type"
    :options="$accountTypes"
    wire:model="accountType"
    error-field="account_type"
    required />
```

### Custom Error Handling

```blade
<x-jen::group
    label="Payment Method"
    :options="$paymentMethods"
    wire:model="paymentMethod"
    error-class="text-red-500 text-sm"
    first-error-only />
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::group
    label="Theme"
    :options="$themes"
    wire:model="theme"
    class="mb-6" />
```

## API Compatibility


```blade
<x-jen::jen::group label="Example" :options="$options" wire:model="value" />

<!-- jen-ui -->
<x-jen::group label="Example" :options="$options" wire:model="value" />
```

## Dependencies

-   None (standalone component)

## Form Integration

The Group component works seamlessly with Livewire forms:

```php
// In your Livewire component
public $selectedOption = null;
public $options = [
    ['id' => 1, 'name' => 'Option 1'],
    ['id' => 2, 'name' => 'Option 2'],
    ['id' => 3, 'name' => 'Option 3'],
];

public function save()
{
    $this->validate([
        'selectedOption' => 'required',
    ]);

    // Process the selected option
}
```

```blade
<form wire:submit="save">
    <x-jen::group
        label="Choose an option"
        :options="$options"
        wire:model="selectedOption"
        required />

    <x-jen::button type="submit" label="Save" />
</form>
```

## Advanced Usage

### Dynamic Options from Eloquent Models

```php
// In your Livewire component
public $categories;

public function mount()
{
    $this->categories = Category::select('id', 'name')->get();
}
```

```blade
<x-jen::group
    label="Select Category"
    :options="$categories"
    wire:model="selectedCategory" />
```

### Collection with Custom Accessors

```php
$users = User::all()->map(function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->full_name, // Using accessor
        'disabled' => !$user->is_active,
    ];
});
```

```blade
<x-jen::group
    label="Assign To User"
    :options="$users"
    wire:model="assignedUser" />
```
