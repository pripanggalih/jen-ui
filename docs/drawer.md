# Drawer

A lightweight, performance-focused sliding drawer component for Laravel applications with Alpine.js integration and Livewire support.

```

## Basic Usage

```blade
<x-jen::drawer wire:model="showDrawer" title="Navigation">
    <p>Drawer content goes here</p>
</x-jen::drawer>
```

## Properties

| Property           | Type      | Default | Description                                    |
| ------------------ | --------- | ------- | ---------------------------------------------- |
| `id`               | `?string` | `null`  | Unique identifier for the drawer               |
| `right`            | `?bool`   | `false` | Position drawer on the right side              |
| `title`            | `?string` | `null`  | Title displayed in drawer header               |
| `subtitle`         | `?string` | `null`  | Subtitle displayed below title                 |
| `separator`        | `?bool`   | `false` | Show separator line between header and content |
| `withCloseButton`  | `?bool`   | `false` | Display close button in header                 |
| `closeOnEscape`    | `?bool`   | `false` | Allow closing drawer with Escape key           |
| `withoutTrapFocus` | `?bool`   | `false` | Disable focus trapping within drawer           |
| `actions`          | `?string` | `null`  | Slot for action buttons in footer              |

## Examples

### Basic Drawer

```blade
<x-jen::drawer wire:model="isOpen" title="Settings">
    <div class="space-y-4">
        <h3>User Preferences</h3>
        <p>Configure your application settings here.</p>
    </div>
</x-jen::drawer>
```

### Right-Positioned Drawer

```blade
<x-jen::drawer
    wire:model="showMenu"
    title="Navigation"
    subtitle="Site Menu"
    right
    separator>

    <nav class="space-y-2">
        <a href="/dashboard" class="block p-2 hover:bg-gray-100">Dashboard</a>
        <a href="/profile" class="block p-2 hover:bg-gray-100">Profile</a>
        <a href="/settings" class="block p-2 hover:bg-gray-100">Settings</a>
    </nav>
</x-jen::drawer>
```

### Drawer with Close Button and Actions

```blade
<x-jen::drawer
    wire:model="showForm"
    title="Create User"
    subtitle="Add new user to system"
    separator
    with-close-button
    close-on-escape>

    <form wire:submit="save" class="space-y-4">
        <input type="text" wire:model="name" placeholder="Name" class="input input-bordered w-full" />
        <input type="email" wire:model="email" placeholder="Email" class="input input-bordered w-full" />
    </form>

    <x-jen::slot:actions>
        <x-jen::button label="Cancel" wire:click="$set('showForm', false)" />
        <x-jen::button label="Save User" wire:click="save" class="btn-primary" />
    </x-slot:actions>
</x-jen::drawer>
```

### Programmatic Control

```php
// In your Livewire component
class UserManager extends Component
{
    public bool $showDrawer = false;
    public bool $showRightDrawer = false;

    public function openDrawer()
    {
        $this->showDrawer = true;
    }

    public function closeDrawer()
    {
        $this->showDrawer = false;
        $this->dispatch('drawer-closed');
    }
}
```

```blade
{{-- Buttons to control drawer --}}
<x-jen::button label="Open Left Drawer" wire:click="$set('showDrawer', true)" />
<x-jen::button label="Open Right Drawer" wire:click="$set('showRightDrawer', true)" />

{{-- Drawer components --}}
<x-jen::drawer wire:model="showDrawer" title="Left Drawer">
    <p>Content slides from left</p>
</x-jen::drawer>

<x-jen::drawer wire:model="showRightDrawer" title="Right Drawer" right>
    <p>Content slides from right</p>
</x-jen::drawer>
```

### With Focus Management

```blade
<x-jen::drawer
    wire:model="showModal"
    title="Focus Trapped"
    separator
    with-close-button>

    {{-- Focus will be trapped within this drawer --}}
    <div class="space-y-4">
        <input type="text" placeholder="First input" class="input input-bordered w-full" />
        <textarea placeholder="Message" class="textarea textarea-bordered w-full"></textarea>
        <x-jen::button label="Submit" class="btn-primary" />
    </div>
</x-jen::drawer>

<x-jen::drawer
    wire:model="showNoTrap"
    title="No Focus Trap"
    without-trap-focus>

    {{-- Focus can move outside this drawer --}}
    <p>Focus is not trapped in this drawer.</p>
</x-jen::drawer>
```

## Styling

The drawer uses daisyUI's drawer classes and can be customized:

```blade
<x-jen::drawer
    wire:model="showCustom"
    title="Custom Styled"
    class="w-80 bg-gradient-to-b from-blue-500 to-purple-600 text-white">

    <div class="text-white">
        Custom styled drawer content
    </div>
</x-jen::drawer>
```

## Events

The drawer dispatches Alpine.js events that you can listen to:

```blade
<div x-data @open="console.log('Drawer opened')" @close="console.log('Drawer closed')">
    <x-jen::drawer wire:model="showDrawer" title="Event Example">
        <p>This drawer dispatches open/close events</p>
    </x-jen::drawer>
</div>
```

## API Compatibility


```blade
<x-jen::jen::drawer wire:model="showDrawer" title="Example" />

<!-- jen-ui -->
<x-jen::drawer wire:model="showDrawer" title="Example" />
```

## Dependencies

-   `x-card` - Used for drawer content structure
-   `x-button` - Used for close button (if `withCloseButton` is true)

## Alpine.js Integration

The drawer uses Alpine.js for:

-   State management (open/close)
-   Focus trapping (if enabled)
-   Escape key handling (if enabled)
-   Event dispatching (open/close events)

Make sure Alpine.js is loaded in your application for full functionality.

## Accessibility

-   ✅ **Focus trapping** keeps focus within drawer when open
-   ✅ **Escape key support** for keyboard navigation
-   ✅ **Proper ARIA attributes** via daisyUI drawer classes
-   ✅ **Overlay click** closes drawer for intuitive UX
