# Tags

A lightweight, performance-focused tag input component for Laravel applications with interactive tag management.

## Basic Usage

```blade
<x-jen::tags label="Tags" wire:model="tags" />
```

## Properties

| Property         | Type      | Default            | Description                                      |
| ---------------- | --------- | ------------------ | ------------------------------------------------ |
| `id`             | `?string` | `null`             | The HTML id attribute for the component          |
| `label`          | `?string` | `null`             | The label text displayed above or inline         |
| `hint`           | `?string` | `null`             | Helper text displayed below the input            |
| `hintClass`      | `?string` | `'fieldset-label'` | CSS class for the hint text                      |
| `icon`           | `?string` | `null`             | Icon displayed on the left side                  |
| `iconRight`      | `?string` | `null`             | Icon displayed on the right side                 |
| `inline`         | `?bool`   | `false`            | Whether to display label inline (floating)       |
| `clearable`      | `?bool`   | `false`            | Show clear all button when tags exist            |
| `prefix`         | `?string` | `null`             | Text prefix displayed before the input           |
| `suffix`         | `?string` | `null`             | Text suffix displayed after the input            |
| `prepend`        | `mixed`   | `null`             | Slot content prepended to the input              |
| `append`         | `mixed`   | `null`             | Slot content appended to the input               |
| `errorField`     | `?string` | `null`             | Custom error field name (defaults to wire:model) |
| `errorClass`     | `?string` | `'text-error'`     | CSS class for error messages                     |
| `omitError`      | `?bool`   | `false`            | Skip displaying validation errors                |
| `firstErrorOnly` | `?bool`   | `false`            | Show only the first validation error             |

## Examples

### Basic Usage

```blade
<x-jen::tags label="Skills" wire:model="skills" />
```

### With Icon and Hint

```blade
<x-jen::tags
    label="Tags"
    wire:model="tags"
    icon="o-home"
    hint="Hit enter or comma to add tags"
    clearable />
```

### Inline Label

```blade
<x-jen::tags
    label="Categories"
    wire:model="categories"
    inline
    placeholder="Add categories..." />
```

### With Prefix and Suffix

```blade
<x-jen::tags
    label="Keywords"
    wire:model="keywords"
    prefix="#"
    suffix="tags" />
```

### With Prepend and Append Slots

```blade
<x-jen::tags label="Social Tags" wire:model="socialTags">
    <x-slot name="prepend">
        <span class="btn btn-primary">@</span>
    </x-slot>

    <x-slot name="append">
        <button class="btn btn-secondary" type="button">
            Add All
        </button>
    </x-slot>
</x-jen::tags>
```

### Read-only and Disabled States

```blade
{{-- Read-only --}}
<x-jen::tags
    label="Read-only Tags"
    wire:model="readOnlyTags"
    readonly />

{{-- Disabled --}}
<x-jen::tags
    label="Disabled Tags"
    wire:model="disabledTags"
    disabled />
```

### With Validation

```blade
<x-jen::tags
    label="Required Tags"
    wire:model="requiredTags"
    required
    error-field="tags" />

@error('tags')
    <span class="text-error">{{ $message }}</span>
@enderror
```

## Key Features

-   ✅ **Interactive Tag Management**: Add tags with Enter or comma, remove with click
-   ✅ **Keyboard Navigation**: Full keyboard support with escape to clear input
-   ✅ **Auto-resize Input**: Input field grows as you type
-   ✅ **Duplicate Prevention**: Automatically prevents adding duplicate tags (case-insensitive)
-   ✅ **Livewire Ready**: Built-in wire:loading support and entangled data binding
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration
-   ✅ **Validation Support**: Full Laravel validation integration
-   ✅ **Accessibility**: Screen reader friendly with proper ARIA attributes

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::tags
    label="Styled Tags"
    wire:model="styledTags"
    class="border-2 border-primary rounded-lg" />
```

## JavaScript Interaction

The component exposes several Alpine.js methods for programmatic interaction:

```javascript
// Access the Alpine component
const tagsComponent = Alpine.$data(document.querySelector('[x-data*="tags"]'));

// Add a tag programmatically
tagsComponent.tag = "new-tag";
tagsComponent.push();

// Clear all tags
tagsComponent.clearAll();

// Check if a tag exists
const hasTag = tagsComponent.hasTag("existing-tag");
```

## Dependencies

-   `x-jen::icon` (for icons)

## Livewire Component Example

```php
class TagsExample extends Component
{
    public array $tags = ['php', 'laravel', 'livewire'];
    public array $skills = [];
    public array $categories = ['web', 'mobile'];

    public function addTag($tag)
    {
        if (!in_array($tag, $this->tags)) {
            $this->tags[] = $tag;
        }
    }

    public function removeTag($index)
    {
        unset($this->tags[$index]);
        $this->tags = array_values($this->tags);
    }

    public function render()
    {
        return view('livewire.tags-example');
    }
}
```

## Advanced Usage

### Custom Tag Styling

```blade
<x-jen::tags
    label="Custom Tags"
    wire:model="customTags"
    class="[&_.jen-tags-element]:bg-primary [&_.jen-tags-element]:text-white" />
```

### With Real-time Validation

```blade
<x-jen::tags
    label="Validated Tags"
    wire:model.live="validatedTags"
    wire:change="validateTags"
    hint="Tags are validated in real-time" />
```
