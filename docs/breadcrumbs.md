# Breadcrumbs

A lightweight, performance-focused breadcrumb navigation component for Laravel applications.

```

## Basic Usage

```blade
<x-jen::breadcrumbs :items="[
    ['label' => 'Home', 'link' => '/'],
    ['label' => 'Products', 'link' => '/products'],
    ['label' => 'Laptops']
]" />
```

## Properties

| Property         | Type      | Default                               | Description                                                 |
| ---------------- | --------- | ------------------------------------- | ----------------------------------------------------------- |
| `id`             | `?string` | `null`                                | Optional ID for the breadcrumb component                    |
| `items`          | `array`   | `[]`                                  | Array of breadcrumb items with 'label', 'link', 'icon' keys |
| `separator`      | `string`  | `'o-chevron-right'`                   | Icon name for separator between items                       |
| `linkItemClass`  | `?string` | `"hover:underline text-sm"`           | CSS classes for items with links                            |
| `textItemClass`  | `?string` | `"text-sm"`                           | CSS classes for items without links                         |
| `iconClass`      | `?string` | `"h-4 w-4"`                           | CSS classes for item icons                                  |
| `separatorClass` | `?string` | `"h-3 w-3 mx-1 text-base-content/40"` | CSS classes for separator icons                             |
| `noWireNavigate` | `?bool`   | `false`                               | If true, disables wire:navigate on links                    |

## Item Structure

Each item in the `items` array can have the following keys:

-   `label` - Text to display for the breadcrumb item
-   `link` - Optional URL to navigate to when clicked
-   `icon` - Optional icon name to display before the label
-   `tooltip` - Optional tooltip text
-   `tooltip-left` - Optional left-positioned tooltip
-   `tooltip-right` - Optional right-positioned tooltip
-   `tooltip-bottom` - Optional bottom-positioned tooltip
-   `tooltip-top` - Optional top-positioned tooltip

## Examples

### Basic Breadcrumbs

```blade
<x-jen::breadcrumbs :items="[
    ['label' => 'Home', 'link' => '/'],
    ['label' => 'Current Page']
]" />
```

### With Icons

```blade
<x-jen::breadcrumbs :items="[
    ['label' => 'Home', 'link' => '/', 'icon' => 'o-home'],
    ['label' => 'Users', 'link' => '/users', 'icon' => 'o-users'],
    ['label' => 'Profile', 'icon' => 'o-user']
]" />
```

### With Tooltips

```blade
<x-jen::breadcrumbs :items="[
    ['label' => 'Home', 'link' => '/', 'tooltip' => 'Back to homepage'],
    ['label' => 'Products', 'link' => '/products', 'tooltip-bottom' => 'View all products'],
    ['label' => 'Laptop Details', 'tooltip-left' => 'Current product']
]" />
```

### Custom Styling

```blade
<x-jen::breadcrumbs
    :items="[
        ['label' => 'Home', 'link' => '/'],
        ['label' => 'Products', 'link' => '/products'],
        ['label' => 'Current Product']
    ]"
    separator="o-arrow-right"
    linkItemClass="text-blue-600 hover:text-blue-800 font-medium"
    textItemClass="text-gray-500 font-medium"
    separatorClass="h-4 w-4 mx-2 text-gray-400"
    class="p-4 bg-gray-50 rounded-lg" />
```

### Disable Wire Navigate

```blade
<x-jen::breadcrumbs
    :items="[
        ['label' => 'Home', 'link' => '/'],
        ['label' => 'External', 'link' => 'https://example.com'],
        ['label' => 'Current Page']
    ]"
    :no-wire-navigate="true" />
```

## Responsive Behavior

The breadcrumb component automatically handles responsive display:

-   On small screens: Shows first item, ellipsis (...), and last item when there are more than 2 items
-   On larger screens: Shows all breadcrumb items
-   Middle items are hidden on small screens but visible on `sm:` breakpoint and above

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::breadcrumbs
    :items="$breadcrumbItems"
    class="bg-white border rounded-lg p-3 shadow-sm" />
```

## API Compatibility


```blade
<x-jen::jen::breadcrumbs :items="$items" />

<!-- jen-ui -->
<x-jen::breadcrumbs :items="$items" />
```

## Dependencies

-   `x-icon` (for separator and item icons)
