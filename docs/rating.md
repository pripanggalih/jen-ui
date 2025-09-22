# Rating

A lightweight, performance-focused star rating component for Laravel applications with Livewire support.

## Basic Usage

```blade
<x-jen::rating wire:model="rating" />
```

## Properties

| Property | Type      | Default | Description                         |
| -------- | --------- | ------- | ----------------------------------- |
| `id`     | `?string` | `null`  | HTML id attribute for the component |
| `total`  | `int`     | `5`     | Total number of stars to display    |

## Examples

### Basic Rating

```blade
<x-jen::rating wire:model="rating" />
```

### Custom Total Stars

```blade
<x-jen::rating wire:model="rating" :total="10" />
```

### With Size Classes

```blade
{{-- Small rating --}}
<x-jen::rating wire:model="rating" class="rating-sm" />

{{-- Medium rating --}}
<x-jen::rating wire:model="rating" class="rating-md" />

{{-- Large rating --}}
<x-jen::rating wire:model="rating" class="rating-lg" />
```

### With Custom ID

```blade
<x-jen::rating
    id="product-rating"
    wire:model="productRating"
    :total="5" />
```

### In Livewire Component

```php
class ProductReview extends Component
{
    public int $rating = 0;

    public function render()
    {
        return view('livewire.product-review');
    }
}
```

```blade
<div>
    <label class="form-control">
        <span class="label-text">Rate this product:</span>
        <x-jen::rating wire:model.live="rating" :total="5" />
    </label>

    @if($rating > 0)
        <p>You rated: {{ $rating }} stars</p>
    @endif
</div>
```

### Conditional Usage

```blade
@if ($showRating)
    <x-jen::rating
        wire:model="userRating"
        :total="5"
        class="rating-lg" />
@endif
```

## Key Features

-   ✅ **Radio Input Based**: Uses native radio inputs for proper form handling
-   ✅ **Livewire Ready**: Built-in wire:model support with reactive updates
-   ✅ **DaisyUI Integration**: Works seamlessly with DaisyUI star masks
-   ✅ **Size Variants**: Supports rating-sm, rating-md, rating-lg classes
-   ✅ **No Rating Option**: Includes hidden input for clearing rating (value 0)
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses DaisyUI rating classes and can be customized:

```blade
{{-- Different sizes --}}
<x-jen::rating wire:model="rating" class="rating-sm" />
<x-jen::rating wire:model="rating" class="rating-md" />
<x-jen::rating wire:model="rating" class="rating-lg" />

{{-- Different colors --}}
<x-jen::rating wire:model="rating" class="rating-warning" />
<x-jen::rating wire:model="rating" class="rating-error" />
<x-jen::rating wire:model="rating" class="rating-success" />

{{-- With custom spacing --}}
<x-jen::rating wire:model="rating" class="gap-2" />
```

## Dependencies

-   None (standalone component)

## Form Integration

The rating component works seamlessly with Laravel forms:

```blade
<form wire:submit="saveReview">
    <div class="form-control">
        <label class="label">
            <span class="label-text">Overall Rating</span>
        </label>
        <x-jen::rating wire:model="review.rating" :total="5" />
    </div>

    <div class="form-control">
        <label class="label">
            <span class="label-text">Service Rating</span>
        </label>
        <x-jen::rating wire:model="review.service" :total="5" />
    </div>

    <button type="submit" class="btn btn-primary">
        Submit Review
    </button>
</form>
```

## Accessibility

The component is built with accessibility in mind:

-   Uses native radio inputs for keyboard navigation
-   Proper name attributes for form grouping
-   Screen reader friendly structure
-   Focus management for keyboard users
