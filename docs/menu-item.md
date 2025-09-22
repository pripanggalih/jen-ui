# MenuItem

A lightweight, performance-focused menu item component for Laravel applications, perfect for navigation menus, sidebars, and dropdowns.

## Basic Usage

```blade
<x-jen::menu-item title="Dashboard" />
```

## Properties

| Property         | Type      | Default | Description                                |
| ---------------- | --------- | ------- | ------------------------------------------ |
| `id`             | `?string` | `null`  | Unique identifier for the menu item        |
| `title`          | `?string` | `null`  | Display text for the menu item             |
| `icon`           | `?string` | `null`  | Icon name to display                       |
| `iconClasses`    | `?string` | `null`  | Additional CSS classes for the icon        |
| `spinner`        | `?string` | `null`  | Show spinner during wire actions           |
| `link`           | `?string` | `null`  | URL to navigate to                         |
| `route`          | `?string` | `null`  | Named route for active state detection     |
| `external`       | `?bool`   | `false` | Open link in new tab                       |
| `noWireNavigate` | `?bool`   | `false` | Disable wire:navigate for this item        |
| `badge`          | `?string` | `null`  | Badge text to display                      |
| `badgeClasses`   | `?string` | `null`  | Additional CSS classes for the badge       |
| `active`         | `?bool`   | `false` | Force active state                         |
| `separator`      | `?bool`   | `false` | Show as separator item                     |
| `hidden`         | `?bool`   | `false` | Hide the menu item                         |
| `disabled`       | `?bool`   | `false` | Disable the menu item                      |
| `exact`          | `?bool`   | `false` | Require exact route match for active state |

## Examples

### Basic Menu Item

```blade
<x-jen::menu-item title="Home" />
```

### With Icon and Link

```blade
<x-jen::menu-item
    title="Dashboard"
    icon="o-home"
    link="/dashboard" />
```

### With Badge

```blade
<x-jen::menu-item
    title="Messages"
    icon="o-envelope"
    badge="5"
    badgeClasses="bg-red-500 text-white"
    link="/messages" />
```

### External Link

```blade
<x-jen::menu-item
    title="Documentation"
    icon="o-book-open"
    link="https://jen-ui.com/docs"
    external="true" />
```

### With Livewire Action

```blade
<x-jen::menu-item
    title="Sync Data"
    icon="o-arrow-path"
    spinner="true"
    wire:click="syncData" />
```

### Active State Detection

```blade
{{-- By route name --}}
<x-jen::menu-item
    title="Users"
    icon="o-users"
    route="users.*"
    link="/users" />

{{-- Exact route matching --}}
<x-jen::menu-item
    title="Settings"
    icon="o-cog"
    link="/settings"
    exact="true" />

{{-- Force active state --}}
<x-jen::menu-item
    title="Current Page"
    active="true" />
```

### Disabled and Hidden Items

```blade
{{-- Disabled item --}}
<x-jen::menu-item
    title="Coming Soon"
    disabled="true" />

{{-- Conditionally hidden --}}
<x-jen::menu-item
    title="Admin Panel"
    icon="o-shield-check"
    link="/admin"
    :hidden="!auth()->user()->isAdmin()" />
```

### Custom Styling

```blade
<x-jen::menu-item
    title="Important"
    icon="o-exclamation-triangle"
    iconClasses="text-red-500"
    class="font-semibold text-red-600" />
```

### Using Slot Content

```blade
<x-jen::menu-item link="/profile">
    <div class="flex items-center space-x-2">
        <img src="{{ auth()->user()->avatar }}" class="w-6 h-6 rounded-full">
        <span>{{ auth()->user()->name }}</span>
    </div>
</x-jen::menu-item>
```

## Key Features

-   ✅ **Active State Detection**: Automatic active state based on current route
-   ✅ **Livewire Integration**: Built-in spinner support for wire actions
-   ✅ **External Links**: Support for external URLs with proper target handling
-   ✅ **Icon Support**: Flexible icon system with custom classes
-   ✅ **Badge System**: Display badges with customizable styling
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration
-   ✅ **Accessibility**: Proper ARIA attributes and keyboard navigation

## Menu Context Awareness

The component uses Laravel's `@aware` directive to inherit configuration from parent menu components:

-   `activateByRoute`: Enable automatic active state detection
-   `activeBgColor`: Background color for active menu items

```blade
{{-- Parent menu sets context --}}
<ul class="menu"
    x-data="{ activateByRoute: true, activeBgColor: 'bg-primary text-primary-content' }">

    {{-- Child items inherit the context --}}
    <x-jen::menu-item title="Home" link="/" />
    <x-jen::menu-item title="About" link="/about" />
</ul>
```

## Styling

The component uses Tailwind CSS classes and DaisyUI menu system:

```blade
{{-- Custom menu styling --}}
<x-jen::menu-item
    title="Custom Style"
    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg"
    iconClasses="text-yellow-300"
    badgeClasses="bg-red-500 text-white animate-pulse" />
```

## Dependencies

-   `x-jen::icon` - For icon display
-   Laravel Livewire - For wire:navigate and spinner functionality
-   DaisyUI - For menu styling classes

## Migration from Mary UI

Direct replacement from Mary UI:

```blade
{{-- Mary UI --}}
<x-mary-menu-item title="Dashboard" icon="o-home" link="/dashboard" />

{{-- Jen UI - Same API! --}}
<x-jen::menu-item title="Dashboard" icon="o-home" link="/dashboard" />
```

All properties and functionality remain exactly the same!
