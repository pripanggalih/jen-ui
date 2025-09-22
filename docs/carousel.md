# Carousel

A lightweight, performance-focused carousel component for Laravel applications with slide navigation, autoplay, and touch support.

````

## Basic Usage

```blade
<x-jen::carousel :slides="[
    ['image' => '/images/slide1.jpg', 'title' => 'Slide 1'],
    ['image' => '/images/slide2.jpg', 'title' => 'Slide 2'],
    ['image' => '/images/slide3.jpg', 'title' => 'Slide 3'],
]" />
````

## Properties

| Property            | Type      | Default | Description                             |
| ------------------- | --------- | ------- | --------------------------------------- |
| `slides`            | `array`   | -       | Array of slide data (required)          |
| `id`                | `?string` | `null`  | Unique ID for the carousel              |
| `withoutIndicators` | `?bool`   | `false` | Hide dot indicators at bottom           |
| `withoutArrows`     | `?bool`   | `false` | Hide navigation arrows                  |
| `autoplay`          | `?bool`   | `false` | Enable automatic slide progression      |
| `interval`          | `?int`    | `2000`  | Autoplay interval in milliseconds       |
| `content`           | `mixed`   | `null`  | Custom content slot for slide rendering |

## Slide Data Structure

Each slide in the `slides` array can contain:

```php
[
    'image' => '/path/to/image.jpg',        // Image URL (required)
    'title' => 'Slide Title',              // Optional title
    'description' => 'Slide description',   // Optional description
    'url' => '/link/destination',          // Optional click destination
    'urlText' => 'Read More',              // Optional button text for URL
]
```

## Examples

### Basic Image Carousel

```blade
<x-jen::carousel :slides="[
    ['image' => '/images/hero1.jpg'],
    ['image' => '/images/hero2.jpg'],
    ['image' => '/images/hero3.jpg'],
]" />
```

### Carousel with Titles and Descriptions

```blade
<x-jen::carousel :slides="[
    [
        'image' => '/images/product1.jpg',
        'title' => 'Amazing Product',
        'description' => 'Discover our latest innovation',
        'url' => '/products/1',
        'urlText' => 'Learn More'
    ],
    [
        'image' => '/images/product2.jpg',
        'title' => 'Premium Quality',
        'description' => 'Built with attention to detail',
        'url' => '/products/2',
        'urlText' => 'Shop Now'
    ]
]" />
```

### Autoplay Carousel

```blade
<x-jen::carousel
    :slides="$slides"
    :autoplay="true"
    :interval="3000"
    class="h-96" />
```

### Minimal Carousel (No Indicators/Arrows)

```blade
<x-jen::carousel
    :slides="$slides"
    :without-indicators="true"
    :without-arrows="true" />
```

### Custom Content Carousel

```blade
<x-jen::carousel :slides="$slides">
    <x-jen::slot:content="slide">
        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">{{ $slide['title'] }}</h2>
                <p class="text-lg">{{ $slide['description'] }}</p>
                <button class="btn btn-primary mt-4">{{ $slide['buttonText'] }}</button>
            </div>
        </div>
    </x-slot:content>
</x-jen::carousel>
```

## Key Features

-   ✅ **Touch Ready**: Native swipe support for mobile devices
-   ✅ **Navigation**: Arrow buttons and dot indicators
-   ✅ **Auto Play**: Configurable automatic slide progression
-   ✅ **Interactive**: Click-to-navigate functionality
-   ✅ **Accessible**: ARIA compliant with keyboard support
-   ✅ **Customizable**: Full Tailwind CSS styling support
-   ✅ **Responsive**: Works seamlessly across all screen sizes

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::carousel
    :slides="$slides"
    class="h-80 rounded-lg shadow-xl" />
```

### Custom Arrow Styling

```blade
<x-jen::carousel :slides="$slides">
    <style>
        .carousel-arrow {
            @apply bg-primary text-white border-primary hover:bg-primary-focus;
        }
    </style>
</x-jen::carousel>
```

## API Compatibility

```blade
<x-jen::jen::carousel :slides="$slides" />

<!-- jen-ui -->
<x-jen::carousel :slides="$slides" />
```

## Dependencies

-   `x-button` - For navigation arrows
-   Alpine.js - For interactive functionality (included with Livewire)

## Advanced Usage

### Dynamic Slide Loading

```blade
<x-jen::carousel :slides="$this->getSlides()" />
```

```php
// In your Livewire component
public function getSlides(): array
{
    return collect($this->products)
        ->map(fn($product) => [
            'image' => $product->image_url,
            'title' => $product->name,
            'description' => $product->short_description,
            'url' => route('products.show', $product),
            'urlText' => 'View Product'
        ])
        ->toArray();
}
```

### With Livewire Integration

```blade
<x-jen::carousel
    :slides="$slides"
    wire:key="product-carousel-{{ $productId }}" />
```

This ensures proper Livewire re-rendering when data changes.
