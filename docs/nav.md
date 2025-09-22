# Nav

A lightweight, performance-focused navigation component for Laravel applications.

## Basic Usage

```blade
<x-jen::nav>
    <x-slot:brand>
        <div class="text-lg font-bold">My App</div>
    </x-slot:brand>

    <x-slot:actions>
        <button class="btn btn-primary">Login</button>
    </x-slot:actions>
</x-jen::nav>
```

## Properties

| Property    | Type    | Default | Description                                 |
| ----------- | ------- | ------- | ------------------------------------------- |
| `sticky`    | `?bool` | `false` | Makes the navigation bar stick to top       |
| `fullWidth` | `?bool` | `false` | Removes max-width constraint for full width |
| `brand`     | `mixed` | `null`  | Slot content for brand/logo area            |
| `actions`   | `mixed` | `null`  | Slot content for action buttons/menu items  |

## Examples

### Basic Navigation

```blade
<x-jen::nav>
    <x-slot:brand>
        <a href="/" class="text-xl font-bold text-primary">
            MyApp
        </a>
    </x-slot:brand>

    <x-slot:actions>
        <a href="/about" class="btn btn-ghost">About</a>
        <a href="/contact" class="btn btn-ghost">Contact</a>
    </x-slot:actions>
</x-jen::nav>
```

### Sticky Navigation

```blade
<x-jen::nav sticky>
    <x-slot:brand>
        <div class="flex items-center gap-2">
            <img src="/logo.png" alt="Logo" class="w-8 h-8">
            <span class="text-lg font-semibold">Brand</span>
        </div>
    </x-slot:brand>

    <x-slot:actions>
        <div class="flex items-center gap-2">
            <button class="btn btn-ghost">Menu</button>
            <button class="btn btn-primary">Get Started</button>
        </div>
    </x-slot:actions>
</x-jen::nav>
```

### Full Width Navigation

```blade
<x-jen::nav fullWidth class="bg-primary text-primary-content">
    <x-slot:brand>
        <h1 class="text-xl font-bold">Dashboard</h1>
    </x-slot:brand>

    <x-slot:actions>
        <div class="flex items-center gap-4">
            <span>Welcome, John!</span>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="/avatar.jpg" alt="Profile">
                    </div>
                </label>
                <ul tabindex="0" class="menu dropdown-content z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a>Profile</a></li>
                    <li><a>Settings</a></li>
                    <li><a>Logout</a></li>
                </ul>
            </div>
        </div>
    </x-slot:actions>
</x-jen::nav>
```

### Conditional Usage

```blade
@if ($showNavigation)
    <x-jen::nav sticky="{{ $isSticky }}" fullWidth="{{ $isWide }}">
        <x-slot:brand>
            {{ $brandContent }}
        </x-slot:brand>

        <x-slot:actions>
            {{ $navigationActions }}
        </x-slot:actions>
    </x-jen::nav>
@endif
```

### Complex Navigation with Search

```blade
<x-jen::nav sticky class="shadow-lg">
    <x-slot:brand>
        <div class="flex items-center gap-3">
            <img src="/logo.svg" alt="Logo" class="w-10 h-10">
            <div>
                <div class="text-lg font-bold">MyApp</div>
                <div class="text-xs text-base-content/70">v2.0</div>
            </div>
        </div>
    </x-slot:brand>

    <x-slot:actions>
        <div class="flex items-center gap-4">
            {{-- Search Input --}}
            <div class="form-control">
                <input type="text" placeholder="Search..." class="input input-bordered w-24 md:w-auto" />
            </div>

            {{-- Navigation Links --}}
            <div class="hidden md:flex items-center gap-2">
                <a href="/dashboard" class="btn btn-ghost">Dashboard</a>
                <a href="/products" class="btn btn-ghost">Products</a>
                <a href="/orders" class="btn btn-ghost">Orders</a>
            </div>

            {{-- User Menu --}}
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5v-5a7.5 7.5 0 1 0-15 0v5h5z" />
                        </svg>
                        <span class="badge badge-sm indicator-item">8</span>
                    </div>
                </div>
                <div tabindex="0" class="card card-compact dropdown-content bg-base-100 z-[1] w-52 shadow">
                    <div class="card-body">
                        <span class="text-lg font-bold">8 Notifications</span>
                        <span class="text-info">New messages available</span>
                        <div class="card-actions">
                            <button class="btn btn-primary btn-block">View all</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:actions>
</x-jen::nav>
```

## Key Features

-   ✅ **Sticky Navigation**: Optional sticky positioning with `sticky="true"`
-   ✅ **Responsive Layout**: Flexible brand and actions sections
-   ✅ **Full Width Support**: Removes container constraints when needed
-   ✅ **Slot-based Content**: Flexible brand and actions slots with attribute inheritance
-   ✅ **Livewire Ready**: Built-in wire:loading support with unique wire:key
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::nav
    sticky
    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-xl">
    <x-slot:brand>
        <div class="text-white font-bold text-lg">Custom Nav</div>
    </x-slot:brand>

    <x-slot:actions>
        <button class="btn btn-outline btn-white">Action</button>
    </x-slot:actions>
</x-jen::nav>
```

## Dependencies

-   None (standalone component)

## Migration from Mary UI

Direct replacement from Mary UI - all properties and functionality remain the same:

```blade
{{-- Mary UI --}}
<x-mary::nav sticky fullWidth>
    <!-- content -->
</x-mary::nav>

{{-- Jen UI (drop-in replacement) --}}
<x-jen::nav sticky fullWidth>
    <!-- same content -->
</x-jen::nav>
```
