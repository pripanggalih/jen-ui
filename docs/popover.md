# Popover

A lightweight, performance-focused popover component for Laravel applications with hover-triggered content display.

## Basic Usage

```blade
<x-jen::popover>
    <x-slot:trigger>
        <button class="btn btn-primary">Hover me</button>
    </x-slot:trigger>
    <x-slot:content>
        <p>This is popover content!</p>
    </x-slot:content>
</x-jen::popover>
```

## Properties

| Property   | Type      | Default    | Description                             |
| ---------- | --------- | ---------- | --------------------------------------- |
| `id`       | `?string` | `null`     | Unique identifier for the popover       |
| `position` | `?string` | `"bottom"` | Position of popover relative to trigger |
| `offset`   | `?string` | `"10"`     | Distance offset from trigger element    |
| `trigger`  | `mixed`   | `null`     | Slot content for the trigger element    |
| `content`  | `mixed`   | `null`     | Slot content for the popover content    |

## Examples

### Basic Popover

```blade
<x-jen::popover>
    <x-slot:trigger>
        <span class="underline cursor-pointer">Hover for info</span>
    </x-slot:trigger>
    <x-slot:content>
        <div class="max-w-xs">
            <h3 class="font-bold">Information</h3>
            <p class="text-sm">This is helpful tooltip content that appears on hover.</p>
        </div>
    </x-slot:content>
</x-jen::popover>
```

### Different Positions

```blade
<!-- Top position -->
<x-jen::popover position="top">
    <x-slot:trigger>
        <button class="btn">Top Popover</button>
    </x-slot:trigger>
    <x-slot:content>
        <p>Content appears above</p>
    </x-slot:content>
</x-jen::popover>

<!-- Right position -->
<x-jen::popover position="right" offset="15">
    <x-slot:trigger>
        <button class="btn">Right Popover</button>
    </x-slot:trigger>
    <x-slot:content>
        <p>Content appears to the right</p>
    </x-slot:content>
</x-jen::popover>
```

### Custom Styling

```blade
<x-jen::popover>
    <x-slot:trigger>
        <div class="avatar">
            <div class="w-12 rounded-full">
                <img src="/avatar.jpg" alt="User" />
            </div>
        </div>
    </x-slot:trigger>
    <x-slot:content class="bg-primary text-primary-content">
        <div class="p-2">
            <h4 class="font-bold">John Doe</h4>
            <p class="text-sm">Software Developer</p>
            <p class="text-xs opacity-75">Online now</p>
        </div>
    </x-slot:content>
</x-jen::popover>
```

### With Custom ID

```blade
<x-jen::popover id="user-info" position="left">
    <x-slot:trigger>
        <button class="btn btn-info">User Info</button>
    </x-slot:trigger>
    <x-slot:content>
        <div class="w-64">
            <div class="flex items-center gap-3">
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="/user.jpg" alt="User" />
                    </div>
                </div>
                <div>
                    <h5 class="font-semibold">Jane Smith</h5>
                    <p class="text-sm text-base-content/70">Product Manager</p>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-base-content/10">
                <p class="text-sm">Member since January 2024</p>
                <div class="flex gap-2 mt-2">
                    <button class="btn btn-xs">View Profile</button>
                    <button class="btn btn-xs btn-outline">Message</button>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-jen::popover>
```

## Key Features

-   ✅ **Hover Interaction**: Shows on mouseover, hides on mouseout with smart timing
-   ✅ **Flexible Positioning**: Support for top, bottom, left, right positions
-   ✅ **Custom Offset**: Adjustable distance from trigger element
-   ✅ **Smooth Transitions**: Built-in Alpine.js transitions
-   ✅ **Livewire Ready**: Built-in wire:key for proper component tracking
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Positioning Options

The `position` prop accepts the following values:

-   `"top"` - Popover appears above the trigger
-   `"bottom"` (default) - Popover appears below the trigger
-   `"left"` - Popover appears to the left of the trigger
-   `"right"` - Popover appears to the right of the trigger

## Styling

The component uses Tailwind CSS and daisyUI classes:

```blade
<!-- Custom trigger styling -->
<x-jen::popover>
    <x-slot:trigger class="btn btn-ghost btn-circle">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
    </x-slot:trigger>
    <x-slot:content class="bg-neutral text-neutral-content">
        <p>Custom styled popover content</p>
    </x-slot:content>
</x-jen::popover>
```

## Dependencies

-   Alpine.js (for x-data, x-show, x-anchor, x-transition)
-   None (standalone component)

## JavaScript Behavior

The component uses Alpine.js for:

-   **Show/Hide Logic**: Manages popover visibility state
-   **Timer Management**: 300ms delay before hiding to prevent flickering
-   **Anchor Positioning**: Uses Alpine's x-anchor directive for precise positioning
-   **Smooth Transitions**: Built-in transition animations
