# Badge

A lightweight, performance-focused badge component for Laravel applications. Perfect for status indicators, labels, notifications, and categorization.

````
## Basic Usage

```blade
<x-jen::badge value="New" />
````

## Properties

| Property | Type      | Default | Description                          |
| -------- | --------- | ------- | ------------------------------------ |
| `id`     | `?string` | `null`  | Optional ID for the badge component  |
| `value`  | `?string` | `null`  | The text content to display in badge |

## Examples

### Basic Badge with Value

```blade
<x-jen::badge value="Success" />
<x-jen::badge value="Error" />
<x-jen::badge value="Warning" />
```

### Badge with Slot Content

```blade
<x-jen::badge>
    Custom Content
</x-jen::badge>

<x-jen::badge>
    <span class="font-bold">Bold Text</span>
</x-jen::badge>
```

### Badge with Custom ID

```blade
<x-jen::badge id="status-badge" value="Active" />
```

### Styled Badges

```blade
<x-jen::badge value="Primary" class="badge-primary" />
<x-jen::badge value="Secondary" class="badge-secondary" />
<x-jen::badge value="Success" class="badge-success" />
<x-jen::badge value="Error" class="badge-error" />
<x-jen::badge value="Warning" class="badge-warning" />
<x-jen::badge value="Info" class="badge-info" />
```

### Badge Sizes

```blade
<x-jen::badge value="XS" class="badge-xs" />
<x-jen::badge value="SM" class="badge-sm" />
<x-jen::badge value="MD" />
<x-jen::badge value="LG" class="badge-lg" />
```

### Badge with Outline Style

```blade
<x-jen::badge value="Outline" class="badge-outline" />
<x-jen::badge value="Primary Outline" class="badge-primary badge-outline" />
```

### Conditional Usage

```blade
@if ($user->isVerified())
    <x-jen::badge value="Verified" class="badge-success" />
@endif

@if ($notifications->count() > 0)
    <x-jen::badge value="{{ $notifications->count() }}" class="badge-error" />
@endif
```

### Inside Other Components

```blade
<!-- In a navigation item -->
<a href="#" class="flex items-center gap-2">
    Messages
    <x-jen::badge value="3" class="badge-error badge-sm" />
</a>

<!-- In a card title -->
<div class="card-title flex items-center gap-2">
    Status
    <x-jen::badge value="Online" class="badge-success badge-sm" />
</div>
```

## Styling

The component uses Tailwind CSS classes and can be customized with DaisyUI badge utilities:

### Colors

-   `badge-primary` - Primary theme color
-   `badge-secondary` - Secondary theme color
-   `badge-accent` - Accent theme color
-   `badge-success` - Success/green color
-   `badge-error` - Error/red color
-   `badge-warning` - Warning/yellow color
-   `badge-info` - Info/blue color

### Sizes

-   `badge-lg` - Large badge
-   `badge-md` - Medium badge (default)
-   `badge-sm` - Small badge
-   `badge-xs` - Extra small badge

### Styles

-   `badge-outline` - Outline style badge

## API Compatibility

```blade
<x-jen::jen::badge value="Example" />

<!-- jen-ui -->
<x-jen::badge value="Example" />
```

## Dependencies

None - this is a standalone component.

## Implementation Details

### Modern Optimizations Applied:

1. **Laravel Native Attribute Merge**: Uses `{{ $attributes->class() }}` for efficient class merging
2. **Direct Computation**: Simple `hasValue()` method without unnecessary caching
3. **Template Method Caching**: Methods calls cached in `@php` blocks for performance
4. **Lightweight UUID**: Uses `Str::random(8)` instead of heavy `md5(serialize())`
5. **Conditional Rendering**: Smart content prioritization - value over slot

### Code Structure:

-   **Clean Class Structure**: Minimal properties, focused methods
-   **Efficient Template**: Cached method calls, conditional content
-   **Wire:key Ready**: Full Livewire compatibility with unique UUID
-   **Extensible**: Easy to add new features while maintaining compatibility
