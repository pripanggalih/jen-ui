# MenuTitle

A lightweight, performance-focused menu title component for Laravel applications. Perfect for creating organized menu sections with optional icons.

## Basic Usage

```blade
<x-jen::menu-title title="Navigation" />
```

## Properties

| Property      | Type      | Default | Description                          |
| ------------- | --------- | ------- | ------------------------------------ |
| `id`          | `?string` | `null`  | HTML ID attribute for the menu title |
| `title`       | `?string` | `null`  | Text content for the menu title      |
| `icon`        | `?string` | `null`  | Icon name to display                 |
| `iconClasses` | `?string` | `null`  | Additional CSS classes for the icon  |

## Examples

### Basic Menu Title

```blade
<x-jen::menu-title title="Main Menu" />
```

### With Icon

```blade
<x-jen::menu-title
    title="Dashboard"
    icon="o-home" />
```

### With Icon and Custom Styling

```blade
<x-jen::menu-title
    title="Settings"
    icon="o-cog-6-tooth"
    iconClasses="text-blue-500 w-5 h-5"
    class="text-gray-600" />
```

### With ID

```blade
<x-jen::menu-title
    id="main-section"
    title="Main Section"
    icon="o-folder" />
```

## Key Features

-   ✅ **Semantic HTML**: Uses proper `<li>` element for menu structure
-   ✅ **Icon Support**: Optional icon with customizable styling
-   ✅ **Flexible Styling**: Easily customizable with CSS classes
-   ✅ **Livewire Ready**: Built-in wire:key support
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses DaisyUI's `menu-title` class and can be customized:

```blade
<x-jen::menu-title
    title="Custom Styled"
    class="text-primary font-bold" />
```

## Dependencies

-   `x-jen::icon` (when using icons)

## Menu Structure

Typically used within a menu component:

```blade
<ul class="menu">
    <x-jen::menu-title title="Main" icon="o-home" />
    <x-jen::menu-item title="Dashboard" link="/dashboard" />
    <x-jen::menu-item title="Profile" link="/profile" />

    <x-jen::menu-title title="Settings" icon="o-cog-6-tooth" />
    <x-jen::menu-item title="Preferences" link="/preferences" />
    <x-jen::menu-item title="Account" link="/account" />
</ul>
```
