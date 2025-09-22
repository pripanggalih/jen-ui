# ImageGallery

A lightweight, performance-focused image gallery component with PhotoSwipe lightbox integration for Laravel applications.

```

## Basic Usage

```blade
<x-jen::image-gallery :images="$imageUrls" />
```

## Properties

| Property         | Type      | Default | Description                                               |
| ---------------- | --------- | ------- | --------------------------------------------------------- |
| `images`         | `array`   | `[]`    | Array of image URLs to display in the gallery             |
| `id`             | `?string` | `null`  | Optional ID for the gallery element                       |

## Examples

### Basic Gallery

```blade
@php
$images = [
    'https://picsum.photos/800/600?random=1',
    'https://picsum.photos/800/600?random=2',
    'https://picsum.photos/800/600?random=3',
];
@endphp

<x-jen::image-gallery :images="$images" />
```

### With Custom ID

```blade
<x-jen::image-gallery
    :images="$productImages"
    id="product-gallery" />
```

### Dynamic Images from Model

```blade
@if ($product->images->isNotEmpty())
    <x-jen::image-gallery
        :images="$product->images->pluck('url')->toArray()"
        id="product-{{ $product->id }}-gallery" />
@endif
```

### With Custom Styling

```blade
<x-jen::image-gallery
    :images="$galleryImages"
    class="rounded-lg shadow-lg max-w-4xl mx-auto" />
```

### Empty State Handling

```blade
<x-jen::image-gallery
    :images="$images ?? []"
    class="min-h-48" />
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::image-gallery
    :images="$images"
    class="w-full h-96 bg-gray-100 rounded-lg" />
```

## PhotoSwipe Integration

The component automatically initializes PhotoSwipe lightbox with:

-   **Fade animations** for smooth transitions
-   **Auto-sizing** based on natural image dimensions
-   **Touch gestures** for mobile devices
-   **Keyboard navigation** support
-   **Zoom functionality** with mouse wheel or pinch

### Required Dependencies

Make sure to include PhotoSwipe in your project:

```html
<!-- In your layout head -->
<link
    rel="stylesheet"
    href="https://unpkg.com/photoswipe@5/dist/photoswipe.css"
/>
<script src="https://unpkg.com/photoswipe@5/dist/photoswipe.min.js"></script>
<script src="https://unpkg.com/photoswipe@5/dist/photoswipe-lightbox.min.js"></script>
```

## API Compatibility


```blade
<x-jen::jen::image-gallery :images="$images" />

<!-- jen-ui -->
<x-jen::image-gallery :images="$images" />
```

## Dependencies

-   **PhotoSwipe** (external JavaScript library)
-   **Alpine.js** (for component initialization)

## Advanced Usage

### Lazy Loading with Intersection Observer

```blade
<div x-data="{ show: false }" x-intersect="show = true">
    <div x-show="show" x-transition>
        <x-jen::image-gallery :images="$images" />
    </div>
</div>
```

### With Loading State

```blade
<div wire:loading.remove wire:target="loadImages">
    <x-jen::image-gallery :images="$images" />
</div>
<div wire:loading wire:target="loadImages" class="animate-pulse">
    <div class="bg-gray-200 h-64 rounded-lg"></div>
</div>
```

### Responsive Grid Layout

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach ($imageGroups as $group)
        <x-jen::image-gallery
            :images="$group"
            class="aspect-square" />
    @endforeach
</div>
```
