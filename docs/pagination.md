# Pagination

A lightweight, performance-focused pagination component for Laravel applications with per-page selection support.

## Basic Usage

```blade
<x-jen::pagination :rows="$users" />
```

## Properties

| Property        | Type                 | Default             | Description                              |
| --------------- | -------------------- | ------------------- | ---------------------------------------- |
| `rows`          | `ArrayAccess\|array` | _required_          | The paginated data collection            |
| `id`            | `?string`            | `null`              | Optional ID for the component            |
| `perPageValues` | `?array`             | `[10, 20, 50, 100]` | Available options for per-page selection |

## Examples

### Basic Example

```blade
<x-jen::pagination :rows="$users" />
```

### With Custom Per-Page Values

```blade
<x-jen::pagination
    :rows="$products"
    :per-page-values="[5, 15, 25, 50]" />
```

### With Wire Model

```blade
<x-jen::pagination
    :rows="$orders"
    wire:model.live="perPage"
    class="mt-4" />
```

### With Custom ID

```blade
<x-jen::pagination
    :rows="$customers"
    id="customer-pagination"
    :per-page-values="[10, 25, 50]" />
```

## Key Features

-   ✅ **Per-Page Selection**: Built-in dropdown for changing items per page
-   ✅ **Laravel Pagination Integration**: Works seamlessly with Laravel's paginator
-   ✅ **Livewire Ready**: Full support for wire:model.live binding
-   ✅ **Length Aware Detection**: Automatically handles different paginator types
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::pagination
    :rows="$items"
    class="bg-base-100 p-4 rounded-lg shadow-md" />
```

## Livewire Integration

Perfect for use with Livewire components:

```php
class UsersList extends Component
{
    public int $perPage = 10;

    public function render()
    {
        return view('livewire.users-list', [
            'users' => User::paginate($this->perPage),
        ]);
    }
}
```

```blade
<div>
    {{-- Your table content --}}
    @foreach($users as $user)
        {{-- User row --}}
    @endforeach

    {{-- Pagination with Livewire --}}
    <x-jen::pagination
        :rows="$users"
        wire:model.live="perPage" />
</div>
```

## Conditional Display

The pagination automatically shows/hides based on data availability:

```blade
{{-- Will only show if data is available and wire:model is set --}}
<x-jen::pagination
    :rows="$filteredResults"
    wire:model.live="itemsPerPage" />
```

## Dependencies

-   None (standalone component)

## Performance Features

-   **Template Method Caching**: Method calls are cached once per render
-   **Lightweight UUID**: Uses `Str::random()` instead of complex hashing
-   **Laravel Native Patterns**: Leverages built-in attribute merging
-   **Conditional Rendering**: Smart display logic reduces unnecessary DOM elements
