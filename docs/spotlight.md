# Spotlight

A lightweight, performance-focused search modal component for Laravel applications with keyboard shortcuts and real-time search functionality.

## Basic Usage

```blade
<x-jen::spotlight />
```

## Properties

| Property         | Type      | Default            | Description                                       |
| ---------------- | --------- | ------------------ | ------------------------------------------------- |
| `id`             | `?string` | `null`             | Unique identifier for the spotlight instance      |
| `shortcut`       | `?string` | `"meta.g"`         | Keyboard shortcut to open spotlight (e.g., Cmd+G) |
| `searchText`     | `?string` | `"Search ..."`     | Placeholder text for the search input             |
| `noResultsText`  | `?string` | `"Nothing found."` | Text shown when no search results are found       |
| `url`            | `?string` | `null`             | Custom search endpoint URL                        |
| `fallbackAvatar` | `?string` | `null`             | Fallback image URL when avatar fails to load      |
| `append`         | `mixed`   | `null`             | Slot content to append after search input         |

## Examples

### Basic Spotlight

```blade
<x-jen::spotlight />
```

### Custom Shortcut and Text

```blade
<x-jen::spotlight
    shortcut="ctrl.k"
    searchText="Type to search..."
    noResultsText="No matches found." />
```

### With Custom Search URL

```blade
<x-jen::spotlight
    url="{{ route('custom.search') }}"
    fallbackAvatar="{{ asset('images/default-avatar.png') }}" />
```

### With Append Slot

```blade
<x-jen::spotlight>
    <x-slot name="append">
        <button class="btn btn-ghost btn-sm" @click="close()">
            <x-jen::icon name="o-x-mark" />
        </button>
    </x-slot>
</x-jen::spotlight>
```

### Custom Styling

```blade
<x-jen::spotlight
    class="custom-spotlight"
    shortcut="meta.slash" />
```

## Key Features

-   ✅ **Keyboard Shortcuts**: Configurable keyboard shortcuts (default: Cmd+G / Ctrl+G)
-   ✅ **Real-time Search**: Debounced search with progress indicator
-   ✅ **Result Display**: Support for icons, avatars, names, and descriptions
-   ✅ **Navigation**: Arrow keys navigation through results
-   ✅ **Custom Endpoint**: Configurable search API endpoint
-   ✅ **Livewire Ready**: Built-in wire:navigate support and wire:key
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Search Endpoint

The spotlight component expects search results in the following JSON format:

```json
[
    {
        "name": "Dashboard",
        "description": "Main application dashboard",
        "link": "/dashboard",
        "icon": "<svg>...</svg>",
        "avatar": null
    },
    {
        "name": "John Doe",
        "description": "User profile",
        "link": "/users/1",
        "icon": null,
        "avatar": "https://example.com/avatar.jpg"
    }
]
```

### Custom Search Implementation

You can create a custom search endpoint:

```php
Route::get('/custom-search', function (Request $request) {
    $search = $request->get('search');

    $results = collect([
        [
            'name' => 'Dashboard',
            'description' => 'Main dashboard',
            'link' => route('dashboard'),
            'icon' => '<x-jen::icon name="o-home" class="w-6 h-6" />',
            'avatar' => null,
        ],
        [
            'name' => 'Settings',
            'description' => 'Application settings',
            'link' => route('settings'),
            'icon' => '<x-jen::icon name="o-cog-6-tooth" class="w-6 h-6" />',
            'avatar' => null,
        ]
    ])->filter(function ($item) use ($search) {
        return str_contains(strtolower($item['name']), strtolower($search)) ||
               str_contains(strtolower($item['description']), strtolower($search));
    });

    return response()->json($results->values());
})->name('custom.search');
```

## Events

The spotlight component listens to the following custom events:

-   `mary-search.window` - Updates search query programmatically
-   `mary-search-open.window` - Opens spotlight modal programmatically

### Trigger Events

```javascript
// Open spotlight programmatically
window.dispatchEvent(new CustomEvent("mary-search-open"));

// Update search query
window.dispatchEvent(
    new CustomEvent("mary-search", {
        detail: "search-term",
    })
);
```

## Alpine.js Data

The component exposes the following Alpine.js properties and methods:

### Properties

-   `value` - Current search input value
-   `results` - Array of search results
-   `open` - Modal open state (persisted)
-   `elapsed` - Search progress timer
-   `searchedWithNoResults` - Boolean for no results state

### Methods

-   `show()` - Open the spotlight modal
-   `close()` - Close the spotlight modal
-   `focus()` - Focus the search input
-   `search()` - Execute search request
-   `updateQuery(query)` - Update search with custom query

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::spotlight
    class="custom-backdrop"
    searchText="Search anything..." />
```

### CSS Classes Used

-   `.jen-spotlight-element` - Applied to result items and no-results div
-   `.jen-hideable` - Applied to result content for responsive hiding

## Dependencies

-   `x-jen::modal` - Modal component for the spotlight interface
-   `x-jen::icon` - Icon component for search and result icons
-   Alpine.js - For interactive functionality
-   Tailwind CSS - For styling

## Performance Features

-   **Debounced Search**: 250ms debounce to prevent excessive API calls
-   **Request Cancellation**: AbortController cancels previous requests
-   **Progress Indicator**: Visual feedback during search operations
-   **Template Caching**: Method calls cached in blade template for performance
-   **Persistence**: Modal state persisted across page loads
