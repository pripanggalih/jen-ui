# Swap

A lightweight, performance-focused toggle swap component for Laravel applications with smooth state transitions.

## Basic Usage

```blade
<x-jen::swap wire:model="darkMode" />
```

## Properties

| Property    | Type      | Default     | Description                         |
| ----------- | --------- | ----------- | ----------------------------------- |
| `id`        | `?string` | `null`      | HTML id attribute for the input     |
| `true`      | `?string` | `null`      | Custom content for true state       |
| `false`     | `?string` | `null`      | Custom content for false state      |
| `trueIcon`  | `?string` | `'o-sun'`   | Icon name for true state (default)  |
| `falseIcon` | `?string` | `'o-moon'`  | Icon name for false state (default) |
| `iconSize`  | `?string` | `"h-5 w-5"` | Tailwind classes for icon sizing    |

## Examples

### Basic Dark Mode Toggle

```blade
<x-jen::swap
    wire:model="darkMode"
    trueIcon="o-sun"
    falseIcon="o-moon" />
```

### Custom Content Slots

```blade
<x-jen::swap wire:model="isExpanded">
    <x-slot:true>
        <span class="text-green-500">Expanded</span>
    </x-slot:true>
    <x-slot:false>
        <span class="text-gray-500">Collapsed</span>
    </x-slot:false>
</x-jen::swap>
```

### With Before/After Content

```blade
<x-jen::swap wire:model="showDetails" class="flex items-center gap-2">
    <x-slot:before>
        <span class="text-sm">Show Details:</span>
    </x-slot:before>

    <x-slot:after>
        <span class="text-xs text-gray-500 ml-2">Toggle</span>
    </x-slot:after>
</x-jen::swap>
```

### Custom Icons and Sizing

```blade
<x-jen::swap
    wire:model="isPlaying"
    trueIcon="o-pause"
    falseIcon="o-play"
    iconSize="h-8 w-8"
    class="btn btn-circle" />
```

### With Styling

```blade
<x-jen::swap
    wire:model="isEnabled"
    class="btn btn-outline btn-primary" />
```

### Form Integration

```blade
<form wire:submit="save">
    <div class="form-control">
        <label class="label">
            <span class="label-text">Enable notifications</span>
            <x-jen::swap wire:model="settings.notifications" />
        </label>
    </div>

    <button type="submit" class="btn btn-primary">Save Settings</button>
</form>
```

## Key Features

-   ✅ **Smooth Transitions**: Built-in CSS swap animations for seamless state changes
-   ✅ **Flexible Content**: Supports both icons and custom slot content
-   ✅ **Wire Model Ready**: Perfect integration with Livewire state management
-   ✅ **Accessible**: Proper label associations and keyboard navigation
-   ✅ **Customizable**: Full control over icons, sizing, and styling
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses daisyUI swap classes and can be customized:

```blade
<x-jen::swap
    wire:model="darkMode"
    class="swap-rotate" />  {{-- Add rotation animation --}}

<x-jen::swap
    wire:model="isActive"
    class="swap-flip" />    {{-- Add flip animation --}}
```

## State Management

Perfect for Livewire state management:

```php
class Dashboard extends Component
{
    public bool $darkMode = false;
    public bool $showSidebar = true;

    public function render()
    {
        return view('livewire.dashboard');
    }
}
```

```blade
<div class="{{ $darkMode ? 'dark' : 'light' }}">
    <x-jen::swap wire:model="darkMode" />
    <x-jen::swap wire:model="showSidebar" />
</div>
```

## Dependencies

-   `x-jen::icon` (for default icon rendering)

## Migration from Mary UI

Direct drop-in replacement - no changes needed:

```blade
{{-- Mary UI --}}
<x-mary-swap wire:model="darkMode" />

{{-- Jen UI --}}
<x-jen::swap wire:model="darkMode" />
```

All properties and functionality remain exactly the same.
