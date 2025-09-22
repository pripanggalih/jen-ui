# Collapse

A lightweight, performance-focused collapsible content component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::collapse>
    <x-jen::slot:heading>
        Click to expand
    </x-slot:heading>
    <x-jen::slot:content>
        This is the collapsible content that can be shown or hidden.
    </x-slot:content>
</x-jen::collapse>
```

## Properties

| Property            | Type      | Default | Description                                |
| ------------------- | --------- | ------- | ------------------------------------------ |
| `id`                | `?string` | `null`  | Custom ID for the collapse element         |
| `name`              | `?string` | `null`  | Name for radio button (used in accordions) |
| `collapsePlusMinus` | `?bool`   | `false` | Use plus/minus icon instead of arrow       |
| `separator`         | `?bool`   | `false` | Show separator line in content             |
| `noIcon`            | `?bool`   | `false` | Hide the collapse icon                     |
| `heading`           | `mixed`   | `null`  | Slot for heading content                   |
| `content`           | `mixed`   | `null`  | Slot for collapsible content               |

## Examples

### Basic Collapse

```blade
<x-jen::collapse>
    <x-jen::slot:heading>
        Basic Collapse
    </x-slot:heading>
    <x-jen::slot:content>
        This is the content that will be collapsed.
    </x-slot:content>
</x-jen::collapse>
```

### With Plus/Minus Icon

```blade
<x-jen::collapse collapse-plus-minus>
    <x-jen::slot:heading>
        Plus/Minus Style
    </x-slot:heading>
    <x-jen::slot:content>
        Content with plus/minus icon indicator.
    </x-slot:content>
</x-jen::collapse>
```

### With Separator

```blade
<x-jen::collapse separator>
    <x-jen::slot:heading>
        With Separator
    </x-slot:heading>
    <x-jen::slot:content>
        This content has a separator line at the top.
    </x-slot:content>
</x-jen::collapse>
```

### Without Icon

```blade
<x-jen::collapse no-icon>
    <x-jen::slot:heading>
        No Icon Style
    </x-slot:heading>
    <x-jen::slot:content>
        Clean collapse without any icon indicator.
    </x-slot:content>
</x-jen::collapse>
```

### Livewire Model Binding

```blade
<x-jen::collapse wire:model="isExpanded">
    <x-jen::slot:heading>
        Livewire Controlled
    </x-slot:heading>
    <x-jen::slot:content>
        This collapse state is controlled by Livewire.
    </x-slot:content>
</x-jen::collapse>
```

### Custom Styling

```blade
<x-jen::collapse class="bg-base-200 rounded-lg">
    <x-jen::slot:heading>
        <span class="text-primary font-bold">Custom Styled</span>
    </x-slot:heading>
    <x-jen::slot:content class="text-base-content/70">
        <p>Custom styled content with different colors.</p>
    </x-slot:content>
</x-jen::collapse>
```

## Accordion Usage

When used inside an `<x-jen::accordion>` component, the collapse automatically becomes part of an accordion group:

```blade
<x-jen::accordion>
    <x-jen::collapse name="item1">
        <x-jen::slot:heading>First Item</x-slot:heading>
        <x-jen::slot:content>Content for first item.</x-slot:content>
    </x-jen::collapse>

    <x-jen::collapse name="item2">
        <x-jen::slot:heading>Second Item</x-slot:heading>
        <x-jen::slot:content>Content for second item.</x-slot:content>
    </x-jen::collapse>
</x-jen::accordion>
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::collapse
    class="border-2 border-primary rounded-lg"
    collapse-plus-minus
    separator>
    <x-jen::slot:heading class="text-primary">
        Custom Heading
    </x-slot:heading>
    <x-jen::slot:content class="bg-base-100 p-4">
        Custom content styling
    </x-slot:content>
</x-jen::collapse>
```

## API Compatibility


```blade
<x-jen::jen::collapse collapse-plus-minus separator>
    <x-jen::slot:heading>Title</x-slot:heading>
    <x-jen::slot:content>Content</x-slot:content>
</x-jen::collapse>

<!-- jen-ui -->
<x-jen::collapse collapse-plus-minus separator>
    <x-jen::slot:heading>Title</x-slot:heading>
    <x-jen::slot:content>Content</x-slot:content>
</x-jen::collapse>
```

## Dependencies

-   None (standalone component)
