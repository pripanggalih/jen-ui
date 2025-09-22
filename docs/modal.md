# Modal

A lightweight, performance-focused modal dialog component for Laravel applications with full Livewire support and Alpine.js integration.

## Basic Usage

```blade
<x-jen::modal wire:model="showModal" title="Basic Modal">
    <p>This is a basic modal content.</p>
</x-jen::modal>
```

## Properties

| Property           | Type      | Default | Description                          |
| ------------------ | --------- | ------- | ------------------------------------ |
| `id`               | `?string` | `''`    | HTML ID for the modal element        |
| `title`            | `?string` | `null`  | Modal title text                     |
| `subtitle`         | `?string` | `null`  | Modal subtitle text                  |
| `boxClass`         | `?string` | `null`  | Additional CSS classes for modal box |
| `separator`        | `?bool`   | `false` | Show separator line under header     |
| `persistent`       | `?bool`   | `false` | Prevent modal from being closed      |
| `withoutTrapFocus` | `?bool`   | `false` | Disable focus trapping               |
| `actions`          | `?string` | `null`  | Actions slot content                 |

## Examples

### Basic Modal with Livewire

```blade
<x-jen::modal wire:model="showBasicModal" title="Basic Modal">
    <p>Modal content goes here.</p>
</x-jen::modal>
```

### Modal with Header and Actions

```blade
<x-jen::modal wire:model="showActionModal"
    title="Confirm Action"
    subtitle="This action cannot be undone"
    separator>

    <p>Are you sure you want to proceed with this action?</p>

    <x-slot:actions>
        <x-jen::button label="Cancel" @click="$wire.showActionModal = false" />
        <x-jen::button label="Confirm" class="btn-primary" wire:click="confirmAction" />
    </x-slot:actions>
</x-jen::modal>
```

### Persistent Modal

```blade
<x-jen::modal wire:model="showPersistentModal"
    title="Important Notice"
    persistent>

    <p>This modal cannot be closed by clicking outside or pressing ESC.</p>

    <x-slot:actions>
        <x-jen::button label="I Understand" @click="$wire.showPersistentModal = false" />
    </x-slot:actions>
</x-jen::modal>
```

### Modal with Custom Styling

```blade
<x-jen::modal wire:model="showCustomModal"
    title="Custom Modal"
    box-class="w-11/12 max-w-5xl">

    <div class="grid grid-cols-2 gap-4">
        <div>Left content</div>
        <div>Right content</div>
    </div>
</x-jen::modal>
```

### Modal with ID (Non-Livewire)

```blade
<x-jen::modal id="my-modal" title="Static Modal">
    <p>This modal is controlled via JavaScript or Alpine.js directly.</p>

    <x-slot:actions>
        <button onclick="my-modal.close()" class="btn">Close</button>
    </x-slot:actions>
</x-jen::modal>

<!-- Open modal with JavaScript -->
<button onclick="my-modal.showModal()" class="btn btn-primary">Open Modal</button>
```

### Without Focus Trap

```blade
<x-jen::modal wire:model="showNoTrapModal"
    title="No Focus Trap"
    without-trap-focus>

    <p>This modal won't trap focus, useful for specific accessibility needs.</p>
</x-jen::modal>
```

## Key Features

-   ✅ **Livewire Ready**: Full wire:model support for reactive state management
-   ✅ **Alpine.js Integration**: Smooth animations and state management
-   ✅ **Focus Management**: Automatic focus trapping (can be disabled)
-   ✅ **Keyboard Support**: ESC key to close (unless persistent)
-   ✅ **Backdrop Click**: Click outside to close (unless persistent)
-   ✅ **Persistent Mode**: Prevent accidental closing for critical actions
-   ✅ **Flexible Actions**: Custom action buttons via slot
-   ✅ **Header Support**: Title, subtitle with optional separator
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses daisyUI modal classes and can be customized:

```blade
<x-jen::modal wire:model="showStyledModal"
    title="Styled Modal"
    box-class="bg-gradient-to-r from-purple-500 to-pink-500 text-white"
    class="backdrop-blur-sm">

    <p>Custom styled modal content.</p>
</x-jen::modal>
```

## Dependencies

-   `x-jen::button` (for close button)
-   `x-jen::header` (for title/subtitle display)

## Livewire Integration

The modal works seamlessly with Livewire:

```php
// In your Livewire component
class MyComponent extends Component
{
    public bool $showModal = false;

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}
```

```blade
{{-- In your view --}}
<x-jen::button label="Open Modal" wire:click="openModal" />

<x-jen::modal wire:model="showModal" title="Livewire Modal">
    <p>Modal controlled by Livewire component.</p>

    <x-slot:actions>
        <x-jen::button label="Close" wire:click="closeModal" />
    </x-slot:actions>
</x-jen::modal>
```

## Events

The modal dispatches custom events:

-   `open`: Fired when modal opens
-   `close`: Fired when modal closes

```blade
<x-jen::modal wire:model="showModal"
    @open="console.log('Modal opened')"
    @close="console.log('Modal closed')">
    Modal content
</x-jen::modal>
```
