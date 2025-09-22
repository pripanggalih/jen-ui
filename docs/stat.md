# Stat

A lightweight, performance-focused statistic display component for Laravel applications. Perfect for dashboards and analytics displays.

## Basic Usage

```blade
<x-jen::stat value="1,234" title="Total Users" />
```

## Properties

| Property        | Type      | Default | Description                                  |
| --------------- | --------- | ------- | -------------------------------------------- |
| `id`            | `?string` | `null`  | Optional ID for the component                |
| `value`         | `?string` | `null`  | Main value to display (uses slot if not set) |
| `icon`          | `?string` | `null`  | Icon name to display                         |
| `color`         | `?string` | `''`    | CSS classes for icon color styling           |
| `title`         | `?string` | `null`  | Small title displayed above the value        |
| `description`   | `?string` | `null`  | Description displayed below the value        |
| `tooltip`       | `?string` | `null`  | Tooltip text (top position by default)       |
| `tooltipLeft`   | `?string` | `null`  | Tooltip text positioned on the left          |
| `tooltipRight`  | `?string` | `null`  | Tooltip text positioned on the right         |
| `tooltipBottom` | `?string` | `null`  | Tooltip text positioned at the bottom        |

## Examples

### Basic Stat

```blade
<x-jen::stat value="42" title="Active Users" />
```

### With Icon and Color

```blade
<x-jen::stat
    value="$12,345"
    title="Revenue"
    icon="currency-dollar"
    color="text-success" />
```

### With Description

```blade
<x-jen::stat
    value="98.5%"
    title="Uptime"
    description="Last 30 days"
    icon="server"
    color="text-info" />
```

### Using Slot for Complex Value

```blade
<x-jen::stat title="Growth Rate">
    <span class="text-success">+15.3%</span>
    <span class="text-xs">↗</span>
</x-jen::stat>
```

### With Tooltips

```blade
{{-- Top tooltip (default) --}}
<x-jen::stat
    value="156"
    title="Orders"
    tooltip="Orders completed today" />

{{-- Positioned tooltips --}}
<x-jen::stat
    value="89%"
    title="Satisfaction"
    tooltip-right="Customer satisfaction rating" />

<x-jen::stat
    value="2.4s"
    title="Response Time"
    tooltip-left="Average API response time" />
```

### Dashboard Grid Layout

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <x-jen::stat
        value="1,234"
        title="Total Users"
        icon="users"
        color="text-primary" />

    <x-jen::stat
        value="$45,678"
        title="Revenue"
        icon="currency-dollar"
        color="text-success" />

    <x-jen::stat
        value="89%"
        title="Conversion"
        icon="chart-bar"
        color="text-info" />

    <x-jen::stat
        value="4.8/5"
        title="Rating"
        icon="star"
        color="text-warning" />
</div>
```

## Key Features

-   ✅ **Flexible Value Display**: Use property or slot for complex content
-   ✅ **Icon Support**: Display icons with customizable colors
-   ✅ **Multiple Tooltip Positions**: Top, left, right, and bottom tooltips
-   ✅ **Responsive Design**: Adapts to different screen sizes
-   ✅ **Livewire Ready**: Built-in wire:key support for dynamic updates
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::stat
    value="999+"
    title="Notifications"
    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white border-0" />
```

### Color Classes Examples

```blade
{{-- Icon colors --}}
<x-jen::stat icon="heart" color="text-red-500" />
<x-jen::stat icon="check" color="text-green-500" />
<x-jen::stat icon="warning" color="text-yellow-500" />
<x-jen::stat icon="info" color="text-blue-500" />
```

## Dependencies

-   `x-jen::icon` (for icon display when icon property is used)

## Responsive Behavior

-   **Mobile**: Single column layout with proper spacing
-   **Tablet**: 2-column grid recommended
-   **Desktop**: 3-4 column grid for dashboard layouts
-   **RTL Support**: Built-in support for right-to-left languages

## Accessibility

-   Semantic HTML structure
-   Proper ARIA attributes through tooltips
-   Screen reader friendly content hierarchy
