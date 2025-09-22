# Icon

A lightweight, performance-focused icon component for Laravel applications. Supports Heroicons and custom SVG icons with optional labels.

```

## Basic Usage

```blade
<x-jen::icon name="home" />
```

## Properties

| Property | Type      | Default | Description                                    |
| -------- | --------- | ------- | ---------------------------------------------- |
| `name`   | `string`  | -       | **Required.** Icon name (e.g., 'home', 'user') |
| `id`     | `?string` | `null`  | Optional ID for the icon                       |
| `label`  | `?string` | `null`  | Optional text label to display next to icon    |

## Examples

### Basic Icon

```blade
<x-jen::icon name="home" />
<x-jen::icon name="user" />
<x-jen::icon name="cog" />
```

### Icon with Label

```blade
<x-jen::icon name="home" label="Dashboard" />
<x-jen::icon name="user" label="Profile" />
<x-jen::icon name="cog" label="Settings" />
```

### Custom Sizing

```blade
<x-jen::icon name="home" class="w-4 h-4" />
<x-jen::icon name="home" class="w-8 h-8" />
<x-jen::icon name="home" class="w-12 h-12" />
```

### With Custom Styling

```blade
<x-jen::icon name="home" class="text-blue-500 w-6 h-6" />
<x-jen::icon name="heart" class="text-red-500 w-5 h-5" />
<x-jen::icon name="star" class="text-yellow-400 w-6 h-6" />
```

### Icon Name Formats

The component automatically handles different icon name formats:

```blade
{{-- Heroicon format (automatic) --}}
<x-jen::icon name="home" /> {{-- becomes heroicon-home --}}

{{-- Custom format with dots --}}
<x-jen::icon name="outline.home" /> {{-- becomes outline-home --}}
```

### Interactive Icons

```blade
<x-jen::icon name="heart"
    class="w-6 h-6 text-gray-400 hover:text-red-500 cursor-pointer transition-colors"
    @click="toggleFavorite" />
```

## Styling

The component uses Tailwind CSS classes and can be fully customized:

```blade
<x-jen::icon name="home" class="w-8 h-8 text-blue-600 drop-shadow-md" />
```

### Default Behavior

-   **Default size**: `w-5 h-5` (when no width/height classes are provided)
-   **Default display**: `inline flex-shrink-0`
-   **Label spacing**: `gap-1` between icon and label

## API Compatibility


```blade
<x-jen::jen::icon name="home" label="Dashboard" />

<!-- jen-ui -->
<x-jen::icon name="home" label="Dashboard" />
```

## Dependencies

-   **blade-ui-kit/blade-icons** (provides `x-svg` component)

## Advanced Usage

### Conditional Icons

```blade
@if ($user->isOnline())
    <x-jen::icon name="status-online" class="text-green-500" />
@else
    <x-jen::icon name="status-offline" class="text-gray-400" />
@endif
```

### Icon with Alpine.js

```blade
<x-jen::icon name="chevron-down"
    class="w-4 h-4 transition-transform duration-200"
    :class="open ? 'rotate-180' : ''" />
```

### Dynamic Icons

```blade
<x-jen::icon :name="$notification->icon"
    :class="$notification->color . ' w-5 h-5'" />
```
