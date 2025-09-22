# Avatar

A lightweight, performance-focused avatar component for displaying user profile images with optional titles and fallback handling.

```

## Basic Usage

```blade
<x-jen::avatar image="https://example.com/avatar.jpg" alt="User Avatar" />
```

## Properties

| Property        | Type      | Default | Description                                    |
| --------------- | --------- | ------- | ---------------------------------------------- |
| `id`            | `?string` | `null`  | HTML ID attribute for the component            |
| `image`         | `?string` | `''`    | URL of the avatar image                        |
| `alt`           | `?string` | `''`    | HTML alt attribute for the image               |
| `placeholder`   | `?string` | `''`    | Text displayed when no image is provided       |
| `fallbackImage` | `?string` | `null`  | Fallback image URL if main image fails to load |
| `title`         | `?string` | `null`  | Title text displayed beside the avatar         |
| `subtitle`      | `?string` | `null`  | Subtitle text displayed beside the avatar      |

## Examples

### Basic Avatar with Image

```blade
<x-jen::avatar
    image="https://example.com/user.jpg"
    alt="John Doe" />
```

### Avatar with Placeholder

```blade
<x-jen::avatar
    placeholder="JD"
    alt="John Doe" />
```

### Avatar with Title and Subtitle

```blade
<x-jen::avatar
    image="https://example.com/user.jpg"
    alt="John Doe"
    title="John Doe"
    subtitle="Software Developer" />
```

### Avatar with Fallback Image

```blade
<x-jen::avatar
    image="https://might-fail.com/user.jpg"
    fallback-image="https://example.com/default-avatar.jpg"
    alt="User Avatar" />
```

### Custom Styling

```blade
<x-jen::avatar
    image="https://example.com/user.jpg"
    alt="John Doe"
    class="w-12 h-12"
    title="John Doe"
    subtitle="Administrator" />
```

## Slots

The component also supports slots for more complex title and subtitle content:

```blade
<x-jen::avatar image="https://example.com/user.jpg">
    <x-jen::slot:title class="text-primary font-bold">
        John Doe
    </x-slot:title>
    <x-jen::slot:subtitle class="text-secondary">
        Senior Developer at Company
    </x-slot:subtitle>
</x-jen::avatar>
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::avatar
    image="https://example.com/user.jpg"
    title="John Doe"
    subtitle="Developer"
    class="w-16 h-16 shadow-lg" />
```

### Default Classes

-   **Container**: `flex items-center gap-3`
-   **Avatar**: `avatar` (with `avatar-placeholder` when no image)
-   **Image**: `w-7 rounded-full` (with `bg-neutral text-neutral-content` for placeholder)
-   **Title**: `font-semibold font-lg`
-   **Subtitle**: `text-sm text-base-content/50`

## API Compatibility


```blade
<x-jen::mary-avatar image="user.jpg" title="John Doe" />

<!-- jen-ui -->
<x-jen::avatar image="user.jpg" title="John Doe" />
```

## Dependencies

None - This is a standalone component.

## Use Cases

-   User profile displays
-   Comment author avatars
-   Team member listings
-   Contact directories
-   Chat interfaces
-   User menus and dropdowns
