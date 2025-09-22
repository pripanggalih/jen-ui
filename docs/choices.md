# Choices

A lightweight, performance-focused select/dropdown component with search, multi-select, and customizable options for Laravel applications.

```

## Basic Usage

```blade
<x-jen::choices
    label="Select Users"
    :options="$users"
    option-label="name"
    option-value="id"
    wire:model="selectedUsers" />
```

## Properties

| Property         | Type                | Default               | Description                          |
| ---------------- | ------------------- | --------------------- | ------------------------------------ |
| `id`             | `?string`           | `null`                | HTML id attribute                    |
| `label`          | `?string`           | `null`                | Field label text                     |
| `hint`           | `?string`           | `null`                | Helper text below the field          |
| `hintClass`      | `?string`           | `'fieldset-label'`    | CSS class for hint text              |
| `icon`           | `?string`           | `null`                | Left icon name                       |
| `iconRight`      | `?string`           | `null`                | Right icon name                      |
| `inline`         | `?bool`             | `false`               | Use floating label layout            |
| `clearable`      | `?bool`             | `false`               | Show clear button                    |
| `prefix`         | `?string`           | `null`                | Text prefix inside input             |
| `suffix`         | `?string`           | `null`                | Text suffix inside input             |
| `searchable`     | `?bool`             | `false`               | Enable search functionality          |
| `single`         | `?bool`             | `false`               | Single selection mode                |
| `compact`        | `?bool`             | `false`               | Show count instead of selected items |
| `compactText`    | `?string`           | `'selected'`          | Text shown in compact mode           |
| `allowAll`       | `?bool`             | `false`               | Show select/remove all option        |
| `debounce`       | `?string`           | `'250ms'`             | Search debounce duration             |
| `minChars`       | `?int`              | `0`                   | Minimum characters to trigger search |
| `allowAllText`   | `?string`           | `'Select all'`        | Select all button text               |
| `removeAllText`  | `?string`           | `'Remove all'`        | Remove all button text               |
| `searchFunction` | `?string`           | `'search'`            | Livewire method for search           |
| `optionValue`    | `?string`           | `'id'`                | Property used for option values      |
| `optionLabel`    | `?string`           | `'name'`              | Property used for option labels      |
| `optionSubLabel` | `?string`           | `''`                  | Property used for option sub-labels  |
| `optionAvatar`   | `?string`           | `'avatar'`            | Property used for option avatars     |
| `valuesAsString` | `?bool`             | `false`               | Force values to be strings           |
| `height`         | `?string`           | `'max-h-64'`          | Max height of dropdown               |
| `options`        | `Collection\|array` | `new Collection()`    | Array/collection of options          |
| `noResultText`   | `?string`           | `'No results found.'` | Text when no results                 |
| `errorField`     | `?string`           | `null`                | Field name for error display         |
| `errorClass`     | `?string`           | `'text-error'`        | CSS class for errors                 |
| `omitError`      | `?bool`             | `false`               | Hide error messages                  |
| `firstErrorOnly` | `?bool`             | `false`               | Show only first error                |
| `item`           | `mixed`             | `null`                | Custom item slot                     |
| `selection`      | `mixed`             | `null`                | Custom selection slot                |
| `prepend`        | `mixed`             | `null`                | Prepend slot                         |
| `append`         | `mixed`             | `null`                | Append slot                          |

## Examples

### Basic Single Selection

```blade
<x-jen::choices
    label="Choose Country"
    :options="$countries"
    option-label="name"
    option-value="code"
    wire:model="country"
    single />
```

### Multi-Select with Search

```blade
<x-jen::choices
    label="Select Tags"
    :options="$tags"
    option-label="name"
    option-value="id"
    wire:model="selectedTags"
    searchable
    clearable />
```

### With Custom Search Function

```blade
{{-- In your Livewire component --}}
public function searchUsers($query)
{
    $this->users = User::where('name', 'like', "%{$query}%")->get();
}

{{-- In your blade template --}}
<x-jen::choices
    label="Search Users"
    :options="$users"
    option-label="name"
    option-value="id"
    wire:model="selectedUsers"
    searchable
    search-function="searchUsers"
    min-chars="2" />
```

### Compact Mode with Select All

```blade
<x-jen::choices
    label="Select Multiple"
    :options="$options"
    wire:model="selected"
    compact
    compact-text="items"
    allow-all
    allow-all-text="Select All Items"
    remove-all-text="Clear All" />
```

### With Avatar and Sub-labels

```blade
<x-jen::choices
    label="Select User"
    :options="$users"
    option-label="name"
    option-sub-label="email"
    option-avatar="avatar"
    option-value="id"
    wire:model="userId"
    single />
```

### With Custom Item Slot

```blade
<x-jen::choices
    label="Custom Options"
    :options="$products"
    wire:model="selectedProducts">

    <x-jen::slot:item let:option>
        <div class="p-3">
            <div class="flex items-center gap-3">
                <img src="{{ $option['image'] }}" class="w-10 h-10 rounded" />
                <div>
                    <div class="font-medium">{{ $option['name'] }}</div>
                    <div class="text-sm text-green-600">${{ $option['price'] }}</div>
                </div>
            </div>
        </div>
    </x-slot:item>
</x-jen::choices>
```

### With Prepend/Append

```blade
<x-jen::choices
    label="Price Range"
    :options="$priceRanges"
    wire:model="priceRange"
    single>

    <x-jen::slot:prepend>
        <span class="join-item bg-base-200 px-4 flex items-center">$</span>
    </x-slot:prepend>

    <x-jen::slot:append>
        <button class="join-item btn btn-primary">Apply</button>
    </x-slot:append>
</x-jen::choices>
```

### Validation and Errors

```blade
<x-jen::choices
    label="Required Selection"
    :options="$options"
    wire:model="required_field"
    error-field="required_field"
    required
    hint="Please select at least one option" />
```

## Styling

The component uses Tailwind CSS and daisyUI classes. Customize with:

```blade
<x-jen::choices
    label="Custom Styled"
    :options="$options"
    wire:model="selected"
    class="border-primary focus:border-primary-focus"
    height="max-h-40" />
```

## API Compatibility


```blade
<x-jen::jen::choices label="Select" :options="$options" wire:model="selected" />

<!-- jen-ui -->
<x-jen::choices label="Select" :options="$options" wire:model="selected" />
```

## Dependencies

-   `x-icon` - For icons (clear, left/right icons)

## Livewire Integration

### Basic Wire Model

```blade
<x-jen::choices
    :options="$users"
    wire:model="selectedUser" />
```

### Live Search

```php
// In your Livewire component
public $searchTerm = '';
public $users = [];

public function search($value)
{
    $this->searchTerm = $value;
    $this->users = User::where('name', 'like', "%{$value}%")
                      ->limit(50)
                      ->get();
}
```

```blade
<x-jen::choices
    :options="$users"
    wire:model="selectedUsers"
    searchable
    search-function="search" />
```

### Real-time Updates

```php
public function updatedSelectedUsers()
{
    // React to selection changes
    $this->calculateTotal();
}
```

## Advanced Configuration

### Custom Option Structure

```php
$customOptions = [
    ['value' => 1, 'title' => 'Option 1', 'description' => 'First option'],
    ['value' => 2, 'title' => 'Option 2', 'description' => 'Second option'],
];
```

```blade
<x-jen::choices
    :options="$customOptions"
    option-value="value"
    option-label="title"
    option-sub-label="description"
    wire:model="selected" />
```

### Dynamic Options Loading

```php
public function loadMoreOptions()
{
    $this->options = $this->options->merge(
        collect(range(1, 20))->map(fn($i) => ['id' => $i, 'name' => "Option {$i}"])
    );
}
```
