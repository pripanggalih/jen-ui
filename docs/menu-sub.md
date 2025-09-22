# MenuSub

A lightweight, performance-focused submenu component for Laravel applications. Perfect for creating collapsible menu sections with icons and nested items.

## Basic Usage

```blade
<x-jen::menu-sub title="Settings" icon="o-cog">
    <x-jen::menu-item title="Profile" link="/profile" />
    <x-jen::menu-item title="Security" link="/security" />
</x-jen::menu-sub>
```

## Properties

| Property      | Type      | Default | Description                            |
| ------------- | --------- | ------- | -------------------------------------- |
| `id`          | `?string` | `null`  | Unique identifier for the submenu      |
| `title`       | `?string` | `null`  | Display title for the submenu          |
| `icon`        | `?string` | `null`  | Icon name to display before the title  |
| `iconClasses` | `?string` | `null`  | Additional CSS classes for the icon    |
| `open`        | `bool`    | `false` | Whether the submenu is initially open  |
| `hidden`      | `?bool`   | `false` | Whether to hide the submenu completely |
| `disabled`    | `?bool`   | `false` | Whether the submenu is disabled        |

## Examples

### Basic Submenu

```blade
<x-jen::menu-sub title="User Management" icon="o-users">
    <x-jen::menu-item title="All Users" link="/admin/users" />
    <x-jen::menu-item title="Add User" link="/admin/users/create" />
    <x-jen::menu-item title="User Roles" link="/admin/roles" />
</x-jen::menu-sub>
```

### Initially Open Submenu

```blade
<x-jen::menu-sub title="Dashboard" icon="o-home" open="true">
    <x-jen::menu-item title="Analytics" link="/dashboard/analytics" />
    <x-jen::menu-item title="Reports" link="/dashboard/reports" />
</x-jen::menu-sub>
```

### With Custom Icon Styling

```blade
<x-jen::menu-sub
    title="Settings"
    icon="o-cog"
    icon-classes="text-blue-500 w-5 h-5">
    <x-jen::menu-item title="General" link="/settings/general" />
    <x-jen::menu-item title="Notifications" link="/settings/notifications" />
</x-jen::menu-sub>
```

### Disabled Submenu

```blade
<x-jen::menu-sub
    title="Beta Features"
    icon="o-beaker"
    disabled="true">
    <x-jen::menu-item title="Feature A" link="/beta/feature-a" />
    <x-jen::menu-item title="Feature B" link="/beta/feature-b" />
</x-jen::menu-sub>
```

### Conditional Display

```blade
@can('admin')
    <x-jen::menu-sub title="Admin Panel" icon="o-shield-check">
        <x-jen::menu-item title="Users" link="/admin/users" />
        <x-jen::menu-item title="System" link="/admin/system" />
    </x-jen::menu-sub>
@endcan
```

## Key Features

-   ✅ **Collapsible**: Click to expand/collapse submenu items
-   ✅ **Icon Support**: Display icons with customizable styling
-   ✅ **Active State Detection**: Automatically detects and highlights active submenus
-   ✅ **Alpine.js Integration**: Smooth toggling with reactive state management
-   ✅ **Livewire Ready**: Built-in wire:key support for dynamic updates
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration
-   ✅ **Accessibility**: Semantic HTML with proper ARIA attributes

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::menu-sub
    title="Custom Styled"
    icon="o-star"
    class="bg-primary text-white">
    <x-jen::menu-item title="Item 1" />
    <x-jen::menu-item title="Item 2" />
</x-jen::menu-sub>
```

## Integration with Menu

Works seamlessly with the main menu component:

```blade
<x-jen::menu>
    <x-jen::menu-item title="Home" link="/" icon="o-home" />

    <x-jen::menu-sub title="Products" icon="o-cube">
        <x-jen::menu-item title="All Products" link="/products" />
        <x-jen::menu-item title="Categories" link="/categories" />
        <x-jen::menu-item title="Inventory" link="/inventory" />
    </x-jen::menu-sub>

    <x-jen::menu-sub title="Orders" icon="o-shopping-cart" open="true">
        <x-jen::menu-item title="All Orders" link="/orders" />
        <x-jen::menu-item title="Pending" link="/orders/pending" />
        <x-jen::menu-item title="Completed" link="/orders/completed" />
    </x-jen::menu-sub>

    <x-jen::menu-item title="Settings" link="/settings" icon="o-cog" />
</x-jen::menu>
```

## Active State Behavior

The submenu automatically detects active states by checking for 'jen-active-menu' or 'mary-active-menu' classes in the slot content. When active items are found, the submenu will:

-   Remain expanded by default
-   Apply the active background color (inherited from parent)
-   Dispatch appropriate events for sidebar integration

## Dependencies

-   `x-jen::icon` (for icon rendering)
-   Alpine.js (for interactive behavior)
-   Parent menu context (for `activeBgColor` awareness)

## Browser Compatibility

-   ✅ Modern browsers with CSS Grid and Alpine.js support
-   ✅ Mobile responsive with touch-friendly interactions
-   ✅ Keyboard navigation support
