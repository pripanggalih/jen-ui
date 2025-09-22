# Accordion

A lightweight, performance-focused accordion container component for Laravel applications that manages accordion item collections.

```

## Basic Usage

```blade
<x-jen::accordion wire:model="selectedItem">
    <x-jen::collapse title="Section 1">
        <p>Content for section 1</p>
    </x-jen::collapse>
    <x-jen::collapse title="Section 2">
        <p>Content for section 2</p>
    </x-jen::collapse>
</x-jen::accordion>
```

## Properties

| Property | Type      | Default | Description                                                      |
| -------- | --------- | ------- | ---------------------------------------------------------------- |
| `id`     | `?string` | `null`  | Unique identifier for the accordion                              |
| `noJoin` | `?bool`   | `false` | Disable join styling (removes `join join-vertical w-full` class) |

## Examples

### Basic Accordion

```blade
<x-jen::accordion wire:model="activeSection">
    <x-jen::collapse title="About Us">
        <p>Learn more about our company and mission.</p>
    </x-jen::collapse>
    <x-jen::collapse title="Services">
        <p>Discover the services we offer to our clients.</p>
    </x-jen::collapse>
    <x-jen::collapse title="Contact">
        <p>Get in touch with our team.</p>
    </x-jen::collapse>
</x-jen::accordion>
```

### Without Join Styling

```blade
<x-jen::accordion wire:model="selectedItem" no-join>
    <x-jen::collapse title="Custom Styled Section">
        <p>This accordion doesn't use the default join styling.</p>
    </x-jen::collapse>
</x-jen::accordion>
```

### With Custom ID

```blade
<x-jen::accordion wire:model="faqSection" id="main-faq">
    <x-jen::collapse title="Frequently Asked Questions">
        <p>Common questions and answers.</p>
    </x-jen::collapse>
</x-jen::accordion>
```

### Conditional Usage

```blade
@if ($showAccordion)
    <x-jen::accordion wire:model="currentSection">
        @foreach ($sections as $section)
            <x-jen::collapse :title="$section->title">
                {{ $section->content }}
            </x-jen::collapse>
        @endforeach
    </x-jen::accordion>
@endif
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::accordion
    wire:model="selectedItem"
    class="border border-gray-200 rounded-lg shadow-sm">
    <!-- accordion items -->
</x-jen::accordion>
```

## Livewire Integration

The accordion component is designed to work with Livewire's wire:model for state management:

```php
class AccordionDemo extends Component
{
    public $selectedItem = 0;

    public function render()
    {
        return view('livewire.accordion-demo');
    }
}
```

```blade
<div>
    <x-jen::accordion wire:model="selectedItem">
        <x-jen::collapse title="Section 1">
            <p>Content 1</p>
        </x-jen::collapse>
        <x-jen::collapse title="Section 2">
            <p>Content 2</p>
        </x-jen::collapse>
    </x-jen::accordion>

    <p class="mt-4">Selected: {{ $selectedItem }}</p>
</div>
```

## API Compatibility


```blade
<x-jen::jen::accordion wire:model="selectedItem">
    <!-- content -->
</x-jen::accordion>

<!-- jen-ui -->
<x-jen::accordion wire:model="selectedItem">
    <!-- content -->
</x-jen::accordion>
```

## Dependencies

-   None (standalone component)
-   Works best with collapse/accordion-item components for content

## Alpine.js Integration

The component uses Alpine.js for reactive state management with Livewire entanglement:

```blade
<x-jen::accordion wire:model="activeSection">
    <!-- Alpine.js automatically manages the accordion state -->
</x-jen::accordion>
```

## Accessibility

The accordion container provides proper structure for accessible accordion implementations when used with semantic collapse components.
