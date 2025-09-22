# Dynamic Prefix Support

## Overview

Jen-UI supports dynamic prefix configuration. This allows users to customize the component prefix while maintaining internal component references.

## Implementation

### Service Provider

```php
// JenServiceProvider.php - Automatically shares prefix to all views
view()->composer('jen::*', function ($view) use ($prefix) {
    $view->with('jenPrefix', $prefix);
});
```

### Template Usage

```blade
{{-- Instead of hardcoded prefix --}}
<x-jen::icon :name="$icon" />

{{-- Use dynamic prefix --}}
<x-dynamic-component :component="$jenPrefix . '::icon'" :name="$icon" />
```

## Configuration

```php
// config/jen.php
return [
    'prefix' => 'ui', // Changed from default 'jen'
];
```

Now all components work with custom prefix:

-   `<x-ui::button>`
-   `<x-ui::input>`
-   `<x-ui::icon>`

And internal references are automatically updated!

## Status

✅ **Fully Implemented Templates:**

-   alert.blade.php (icon, button)
-   breadcrumbs.blade.php (icon, separator icon)
-   button.blade.php (icon, iconRight)
-   carousel.blade.php (left button, right button)
-   choices-offline.blade.php (5 icon references)
-   choices.blade.php (4 icon references)
-   colorpicker.blade.php (icon, iconRight)
-   datepicker.blade.php (icon, iconRight)
-   datetime.blade.php (icon, iconRight)
-   drawer.blade.php (button)
-   dropdown.blade.php (icon)
-   errors.blade.php (icon)
-   header.blade.php (icon)
-   image-library.blade.php (2 buttons, 1 icon)
-   input.blade.php (icon, iconRight, clear icon)

✅ **Complete Coverage:**

-   **32+ dynamic component references** across 15 templates
-   **Zero hardcoded jen:: references** remaining
-   **100% prefix flexibility** for all internal components

## Philosophy

**Best Practice & Not Over-robust:**

-   ✅ Simple view composer approach
-   ✅ Minimal code changes needed
-   ✅ Works automatically with config changes
-   ✅ No complex helper classes or services
-   ❌ Not trying to solve every edge case
-   ❌ Focus on practical common use cases
