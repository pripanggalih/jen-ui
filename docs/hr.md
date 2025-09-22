# Hr

A lightweight, performance-focused horizontal rule component for Laravel applications with loading progress indicator.

```

## Basic Usage

```blade
<x-jen::hr />
```

## Properties

| Property | Type      | Default | Description                                                    |
| -------- | --------- | ------- | -------------------------------------------------------------- |
| `id`     | `?string` | `null`  | Element ID for the hr component                                |
| `target` | `?string` | `null`  | Livewire target for progress loading (use "1" for auto-detect) |

## Examples

### Basic Hr

```blade
<x-jen::hr />
```

### Hr with Custom ID

```blade
<x-jen::hr id="section-divider" />
```

### Hr with Livewire Loading Progress

```blade
{{-- Show loading progress for specific target --}}
<x-jen::hr target="saveUser" />

{{-- Auto-detect target from wire: attributes --}}
<x-jen::hr target="1" wire:target="saveUser" />
```

### Hr with Custom Styling

```blade
<x-jen::hr class="my-8 border-primary/20" />
```

### Complete Example with Form

```blade
<div>
    <h2>User Information</h2>

    <form wire:submit.prevent="saveUser">
        <input type="text" wire:model="name" placeholder="Name">
        <button type="submit">Save User</button>
    </form>

    {{-- Hr shows progress when saveUser method is running --}}
    <x-jen::hr target="saveUser" />

    <h2>Additional Settings</h2>
    <p>Other content goes here...</p>
</div>
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::hr class="border-t-primary/30 my-10" />
```

### Default Classes

-   Container: `h-[2px] border-t-[length:var(--border)] border-t-base-content/10 my-5`
-   Progress: `progress progress-primary hidden h-[1px]`

## Loading Indicator

The hr component includes a built-in progress bar that automatically shows when Livewire is loading:

-   Hidden by default with `hidden` class
-   Shows with `!h-[length:var(--border)] !block` when loading
-   Uses `wire:loading.class` directive
-   Targets specific Livewire actions with `wire:target`

## Target Options

### Specific Method Target

```blade
<x-jen::hr target="methodName" />
```

### Auto-detect from Attributes

```blade
<x-jen::hr target="1" wire:target="methodName" />
```

This automatically extracts the target from `wire:target` attribute.

## API Compatibility


```blade
<x-jen::jen::hr target="saveUser" />

<!-- jen-ui -->
<x-jen::hr target="saveUser" />
```

## Dependencies

None (standalone component)

## Advanced Usage

### Multiple Loading States

```blade
<div>
    <button wire:click="action1">Action 1</button>
    <x-jen::hr target="action1" />

    <button wire:click="action2">Action 2</button>
    <x-jen::hr target="action2" />

    <button wire:click="action3">Action 3</button>
    <x-jen::hr target="action3" />
</div>
```

### Section Dividers

```blade
<div class="max-w-2xl mx-auto">
    <section>
        <h2>Profile Information</h2>
        <p>Update your profile details...</p>
    </section>

    <x-jen::hr class="my-8" />

    <section>
        <h2>Security Settings</h2>
        <p>Change your password and security preferences...</p>
    </section>

    <x-jen::hr class="my-8" />

    <section>
        <h2>Notifications</h2>
        <p>Manage your notification preferences...</p>
    </section>
</div>
```
