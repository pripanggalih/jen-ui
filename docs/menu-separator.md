# MenuSeparator

A lightweight, performance-focused menu separator component for Laravel applications. Perfect for organizing menu items with visual separators and optional titles.

## Basic Usage

```blade
<x-jen::menu-separator />
```

## Properties

| Property      | Type      | Default | Description                           |
| ------------- | --------- | ------- | ------------------------------------- |
| `id`          | `?string` | `null`  | Unique identifier for the element     |
| `title`       | `?string` | `null`  | Optional title text for the separator |
| `icon`        | `?string` | `null`  | Icon name to display with title       |
| `iconClasses` | `?string` | `null`  | CSS classes for styling the icon      |

## Examples

### Simple Separator

```blade
{{-- Just a horizontal line separator --}}
<x-jen::menu-separator />
```

### Separator with Title

```blade
<x-jen::menu-separator title="Navigation" />
```

### Separator with Icon and Title

```blade
<x-jen::menu-separator
    title="User Settings"
    icon="o-cog-6-tooth" />
```

### Custom Icon Styling

```blade
<x-jen::menu-separator
    title="Admin Panel"
    icon="o-shield-check"
    iconClasses="text-red-500 w-5 h-5" />
```

### Within Menu Context

```blade
<ul class="menu p-4 w-80 bg-base-200">
    <li><a>Home</a></li>
    <li><a>About</a></li>

    <x-jen::menu-separator />

    <li><a>Products</a></li>
    <li><a>Services</a></li>

    <x-jen::menu-separator title="Account" icon="o-user" />

    <li><a>Profile</a></li>
    <li><a>Settings</a></li>
</ul>
```

### Conditional Usage

```blade
@if ($showAdminSection)
    <x-jen::menu-separator
        title="Administration"
        icon="o-key" />
@endif
```

## Key Features

-   ✅ **Visual Separation**: Clean horizontal line separator for menu organization
-   ✅ **Optional Title**: Add section titles to group menu items
-   ✅ **Icon Support**: Display icons alongside titles using jen-ui icon system
-   ✅ **Flexible Styling**: Customize icon appearance with CSS classes
-   ✅ **Livewire Ready**: Built-in wire:key support for dynamic menus
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and follows daisyUI menu conventions:

```blade
<x-jen::menu-separator
    title="Custom Section"
    class="text-primary font-bold" />
```

## Dependencies

-   `x-jen::icon` (for icon display when icon property is provided)

## Common Use Cases

1. **Navigation Menus**: Separate different sections of navigation
2. **Sidebar Organization**: Group related menu items together
3. **Admin Panels**: Organize different functional areas
4. **Mobile Menus**: Create clear visual hierarchy
5. **Context Menus**: Separate action groups
