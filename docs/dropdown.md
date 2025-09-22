# Dropdown

A lightweight, performance-focused dropdown menu component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::dropdown label="Actions">
    <li><a>Profile</a></li>
    <li><a>Settings</a></li>
    <li><a>Logout</a></li>
</x-jen::dropdown>
```

## Properties

| Property    | Type      | Default            | Description                                    |
| ----------- | --------- | ------------------ | ---------------------------------------------- |
| `id`        | `?string` | `null`             | Optional ID for the dropdown                   |
| `label`     | `?string` | `null`             | Label for default trigger button               |
| `icon`      | `?string` | `'o-chevron-down'` | Icon for default trigger button                |
| `right`     | `?bool`   | `false`            | Position dropdown to the right                 |
| `top`       | `?bool`   | `false`            | Position dropdown above trigger                |
| `noXAnchor` | `?bool`   | `false`            | Disable x-anchor positioning (use CSS classes) |
| `trigger`   | `mixed`   | `null`             | Custom trigger slot                            |

## Examples

### Basic Dropdown

```blade
<x-jen::dropdown label="Menu">
    <li><a>Item 1</a></li>
    <li><a>Item 2</a></li>
    <li><a>Item 3</a></li>
</x-jen::dropdown>
```

### With Custom Icon

```blade
<x-jen::dropdown label="Options" icon="o-cog-6-tooth">
    <li><a>Settings</a></li>
    <li><a>Preferences</a></li>
</x-jen::dropdown>
```

### Right Positioned

```blade
<x-jen::dropdown label="User Menu" right>
    <li><a>Profile</a></li>
    <li><a>Settings</a></li>
    <li><a>Logout</a></li>
</x-jen::dropdown>
```

### Top Positioned

```blade
<x-jen::dropdown label="Actions" top>
    <li><a>Edit</a></li>
    <li><a>Delete</a></li>
</x-jen::dropdown>
```

### With Custom Trigger

```blade
<x-jen::dropdown>
    <x-jen::slot:trigger>
        <button class="btn btn-ghost">
            Custom Trigger
            <x-jen::icon name="o-chevron-down" />
        </button>
    </x-slot:trigger>

    <li><a>Action 1</a></li>
    <li><a>Action 2</a></li>
</x-jen::dropdown>
```

### Avatar Dropdown

```blade
<x-jen::dropdown>
    <x-jen::slot:trigger>
        <div class="avatar cursor-pointer">
            <div class="w-10 rounded-full">
                <img src="https://via.placeholder.com/40" alt="Avatar" />
            </div>
        </div>
    </x-slot:trigger>

    <li><a>Profile</a></li>
    <li><a>Settings</a></li>
    <li><hr class="my-2"></li>
    <li><a>Logout</a></li>
</x-jen::dropdown>
```

### Without X-Anchor (CSS Positioning)

```blade
<x-jen::dropdown label="Menu" no-x-anchor right>
    <li><a>Item 1</a></li>
    <li><a>Item 2</a></li>
</x-jen::dropdown>
```

## Styling

The component uses DaisyUI dropdown classes and can be customized:

```blade
<x-jen::dropdown label="Styled Menu"
    class="btn-primary">
    <li><a>Action 1</a></li>
    <li><a>Action 2</a></li>
</x-jen::dropdown>
```

### Menu Item Styling

```blade
<x-jen::dropdown label="Custom Styled">
    <li><a class="text-success">Success Action</a></li>
    <li><a class="text-warning">Warning Action</a></li>
    <li><a class="text-error">Danger Action</a></li>
</x-jen::dropdown>
```

## API Compatibility


```blade
<x-jen::jen::dropdown label="Menu">
    <li><a>Item</a></li>
</x-jen::dropdown>

<!-- jen-ui -->
<x-jen::dropdown label="Menu">
    <li><a>Item</a></li>
</x-jen::dropdown>
```

## Dependencies

-   `x-icon` for default trigger icons
-   Alpine.js for dropdown state management
-   DaisyUI for styling classes

## JavaScript Interaction

The dropdown uses Alpine.js with these data properties:

-   `open` - Boolean state for dropdown visibility
-   `@click.outside` - Closes dropdown when clicking outside
-   `x-anchor` - Dynamic positioning (when not using `noXAnchor`)

## Accessibility

The component includes proper accessibility features:

-   Semantic `<details>` element for native dropdown behavior
-   Keyboard navigation support
-   Proper focus management
-   Screen reader compatibility
