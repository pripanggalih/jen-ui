# ThemeToggle

A lightweight, performance-focused theme toggle component for switching between light and dark themes in Laravel applications.

## Basic Usage

```blade
<x-jen::theme-toggle />
```

## Properties

| Property     | Type      | Default | Description                             |
| ------------ | --------- | ------- | --------------------------------------- |
| `id`         | `?string` | `null`  | HTML id attribute for the input element |
| `value`      | `?string` | `null`  | Value attribute for the checkbox input  |
| `light`      | `?string` | `Light` | Label text for light theme              |
| `dark`       | `?string` | `Dark`  | Label text for dark theme               |
| `lightTheme` | `?string` | `light` | Theme name for light mode               |
| `darkTheme`  | `?string` | `dark`  | Theme name for dark mode                |
| `lightClass` | `?string` | `light` | CSS class applied in light mode         |
| `darkClass`  | `?string` | `dark`  | CSS class applied in dark mode          |
| `withLabel`  | `?bool`   | `false` | Show theme labels next to the toggle    |

## Examples

### Basic Example

```blade
<x-jen::theme-toggle />
```

### With Custom Theme Names

```blade
<x-jen::theme-toggle
    light-theme="cupcake"
    dark-theme="dracula" />
```

### With Labels

```blade
<x-jen::theme-toggle
    with-label="true"
    light="Light Mode"
    dark="Dark Mode" />
```

### With Custom Classes

```blade
<x-jen::theme-toggle
    light-class="theme-light"
    dark-class="theme-dark"
    class="btn btn-ghost" />
```

### With ID and Value

```blade
<x-jen::theme-toggle
    id="main-theme-toggle"
    value="current-theme" />
```

## Key Features

-   ✅ **Automatic Theme Detection**: Detects system theme preference on first visit
-   ✅ **Persistent Storage**: Remembers user's theme choice using localStorage
-   ✅ **Alpine.js Integration**: Smooth animations and reactive state management
-   ✅ **Event Broadcasting**: Dispatches `theme-changed` and `theme-changed-class` events
-   ✅ **Livewire Ready**: Built-in wire:loading support with unique keys
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses DaisyUI swap classes and can be customized:

```blade
<x-jen::theme-toggle
    class="swap-rotate btn btn-circle btn-ghost" />
```

## Events

### Listening to Theme Changes

```blade
<div x-data x-on:theme-changed.window="console.log('Theme changed to:', $event.detail)">
    <x-jen::theme-toggle />
</div>
```

### Programmatic Theme Toggle

```blade
<button @click="$dispatch('jen-toggle-theme')">
    Toggle Theme Programmatically
</button>

<x-jen::theme-toggle />
```

### Custom Event Handlers

```blade
<x-jen::theme-toggle
    x-on:theme-changed.window="handleThemeChange($event.detail)"
    x-on:theme-changed-class.window="handleClassChange($event.detail)" />

<script>
function handleThemeChange(theme) {
    console.log('New theme:', theme);
    // Your custom logic here
}

function handleClassChange(className) {
    console.log('New class:', className);
    // Your custom logic here
}
</script>
```

## Advanced Usage

### Multiple Theme Toggles

```blade
{{-- Main theme toggle --}}
<x-jen::theme-toggle id="main-toggle" />

{{-- Header theme toggle --}}
<x-jen::theme-toggle
    id="header-toggle"
    class="btn btn-sm btn-circle" />

{{-- Mobile theme toggle --}}
<x-jen::theme-toggle
    id="mobile-toggle"
    with-label="true"
    class="swap-rotate btn btn-ghost btn-sm" />
```

### Integration with DaisyUI Themes

```blade
{{-- Using DaisyUI theme names --}}
<x-jen::theme-toggle
    light-theme="corporate"
    dark-theme="business"
    light-class="theme-corporate"
    dark-class="theme-business" />

{{-- Cupcake and Dracula themes --}}
<x-jen::theme-toggle
    light-theme="cupcake"
    dark-theme="dracula"
    light="🧁"
    dark="🧛"
    with-label="true" />
```

## Dependencies

-   `x-jen::icon` (for sun/moon icons)

## Browser Support

-   Modern browsers with localStorage support
-   Alpine.js for reactivity
-   CSS custom properties for theme switching

## Accessibility

The component includes proper accessibility features:

-   Uses `<label>` for better click targets
-   Proper `for` attribute linking to input
-   Screen reader friendly with semantic HTML
-   Keyboard navigation support through checkbox input
