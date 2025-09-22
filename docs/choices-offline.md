# ChoicesOffline

A lightweight, performance-focused multi-select and single-select dropdown component for Laravel applications that works entirely offline.

```

## Basic Usage

```blade
<x-jen::choices-offline
    label="Select Options"
    :options="$options"
    wire:model="selectedValues" />
```

## Properties

| Property         | Type                | Default                           | Description                     |
| ---------------- | ------------------- | --------------------------------- | ------------------------------- |
| `id`             | `?string`           | `null`                            | Component unique identifier     |
| `label`          | `?string`           | `null`                            | Field label text                |
| `hint`           | `?string`           | `null`                            | Hint text displayed below field |
| `hintClass`      | `?string`           | `'fieldset-label'`                | CSS classes for hint text       |
| `icon`           | `?string`           | `null`                            | Left icon name                  |
| `iconRight`      | `?string`           | `null`                            | Right icon name                 |
| `inline`         | `?bool`             | `false`                           | Display label inline            |
| `clearable`      | `?bool`             | `false`                           | Show clear button               |
| `prefix`         | `?string`           | `null`                            | Text prefix                     |
| `suffix`         | `?string`           | `null`                            | Text suffix                     |
| `searchable`     | `?bool`             | `false`                           | Enable search functionality     |
| `single`         | `?bool`             | `false`                           | Single selection mode           |
| `compact`        | `?bool`             | `false`                           | Show compact selection display  |
| `compactText`    | `?string`           | `'selected'`                      | Text for compact mode           |
| `allowAll`       | `?bool`             | `false`                           | Show select/remove all buttons  |
| `debounce`       | `?string`           | `'250ms'`                         | Search debounce delay           |
| `minChars`       | `?int`              | `0`                               | Minimum characters for search   |
| `allowAllText`   | `?string`           | `'Select all'`                    | Select all button text          |
| `removeAllText`  | `?string`           | `'Remove all'`                    | Remove all button text          |
| `optionValue`    | `?string`           | `'id'`                            | Option value field              |
| `optionLabel`    | `?string`           | `'name'`                          | Option label field              |
| `optionSubLabel` | `?string`           | `''`                              | Option sub-label field          |
| `optionAvatar`   | `?string`           | `'avatar'`                        | Option avatar field             |
| `valuesAsString` | `?bool`             | `false`                           | Return values as strings        |
| `height`         | `?string`           | `'max-h-64'`                      | Dropdown max height             |
| `options`        | `Collection\|array` | `new Collection()`                | Available options               |
| `noResultText`   | `?string`           | `'No results found.'`             | No results message              |
| `errorField`     | `?string`           | `null`                            | Validation error field          |
| `errorClass`     | `?string`           | `'text-error label-text-alt p-1'` | Error message CSS classes       |
| `omitError`      | `?bool`             | `false`                           | Hide validation errors          |
| `firstErrorOnly` | `?bool`             | `false`                           | Show only first error           |
| `item`           | `mixed`             | `null`                            | Custom item template slot       |
| `selection`      | `mixed`             | `null`                            | Custom selection template slot  |
| `prepend`        | `mixed`             | `null`                            | Prepend content slot            |
| `append`         | `mixed`             | `null`                            | Append content slot             |

## Examples

### Basic Multi-Select

```blade
<x-jen::choices-offline
    label="Select Countries"
    :options="[
        ['id' => 1, 'name' => 'Indonesia'],
        ['id' => 2, 'name' => 'Malaysia'],
        ['id' => 3, 'name' => 'Singapore']
    ]"
    wire:model="selectedCountries" />
```

### Single Selection with Search

```blade
<x-jen::choices-offline
    label="Choose One"
    :options="$options"
    single
    searchable
    wire:model="selectedOption" />
```

### With Avatar and Sub-Labels

```blade
<x-jen::choices-offline
    label="Select Users"
    :options="[
        [
            'id' => 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'avatar' => '/avatars/john.jpg'
        ]
    ]"
    option-label="name"
    option-sub-label="email"
    option-avatar="avatar"
    wire:model="selectedUsers" />
```

### Compact Mode with Select All

```blade
<x-jen::choices-offline
    label="Select Features"
    :options="$features"
    compact
    allow-all
    compact-text="features selected"
    wire:model="selectedFeatures" />
```

### With Custom Icons and Clearable

```blade
<x-jen::choices-offline
    label="Categories"
    :options="$categories"
    icon="o-folder"
    icon-right="o-chevron-down"
    clearable
    wire:model="selectedCategories" />
```

### With Validation

```blade
<x-jen::choices-offline
    label="Required Selection"
    :options="$options"
    wire:model="selection"
    required
    error-field="selection"
    class="input-bordered" />
```

### With Custom Slots

```blade
<x-jen::choices-offline
    label="Advanced Options"
    :options="$options"
    wire:model="selected">

    <x-jen::slot name="prepend">
        <div class="join-item btn btn-square btn-sm">
            <x-jen::icon name="o-magnifying-glass" class="w-4 h-4" />
        </div>
    </x-jen::slot>

    <x-jen::slot name="append">
        <button class="join-item btn btn-square btn-sm">
            <x-jen::icon name="o-cog-6-tooth" class="w-4 h-4" />
        </button>
    </x-jen::slot>
</x-jen::choices-offline>
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::choices-offline
    label="Custom Styled"
    :options="$options"
    class="select-primary"
    wire:model="selection" />
```

## API Compatibility


```blade
<x-jen::jen::choices-offline label="Example" :options="$options" wire:model="selection" />

<!-- jen-ui -->
<x-jen::choices-offline label="Example" :options="$options" wire:model="selection" />
```

## Dependencies

-   `x-icon` - Used for icons and indicators

## Features

-   **Multi-select and single-select modes** - Configure with `single` property
-   **Search functionality** - Enable with `searchable` property
-   **Compact display** - Show count instead of all selections with `compact`
-   **Select/Remove All** - Mass selection controls with `allowAll`
-   **Custom templates** - Use slots for custom item rendering
-   **Avatar support** - Display user avatars in options
-   **Sub-labels** - Show additional information per option
-   **Validation ready** - Built-in Laravel validation integration
-   **Keyboard navigation** - Full keyboard accessibility support
-   **Livewire optimized** - Efficient wire:model binding and wire:key usage
