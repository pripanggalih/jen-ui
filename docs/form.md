# Form

A lightweight, performance-focused form wrapper component for Laravel applications. Provides structured layout for forms with optional action sections and separators.

```

## Basic Usage

```blade
<x-jen::form>
    <input type="text" name="name" class="input input-bordered" placeholder="Name" />
    <input type="email" name="email" class="input input-bordered" placeholder="Email" />
</x-jen::form>
```

## Properties

| Property      | Type    | Default | Description                                       |
| ------------- | ------- | ------- | ------------------------------------------------- |
| `actions`     | `mixed` | `null`  | Slot for form action buttons (submit, cancel etc) |
| `noSeparator` | `?bool` | `false` | Whether to hide the separator before actions      |

## Examples

### Basic Form

```blade
<x-jen::form method="POST" action="/users">
    @csrf
    <div>
        <label class="label">Name</label>
        <input type="text" name="name" class="input input-bordered w-full" />
    </div>

    <div>
        <label class="label">Email</label>
        <input type="email" name="email" class="input input-bordered w-full" />
    </div>
</x-jen::form>
```

### Form with Actions

```blade
<x-jen::form method="POST" action="/users">
    @csrf
    <div>
        <label class="label">Name</label>
        <input type="text" name="name" class="input input-bordered w-full" />
    </div>

    <div>
        <label class="label">Email</label>
        <input type="email" name="email" class="input input-bordered w-full" />
    </div>

    <x-jen::slot:actions>
        <x-jen::button type="submit" label="Save" class="btn-primary" />
        <x-jen::button type="button" label="Cancel" class="btn-outline" />
    </x-slot:actions>
</x-jen::form>
```

### Form without Separator

```blade
<x-jen::form method="POST" action="/users" no-separator>
    @csrf
    <div>
        <label class="label">Name</label>
        <input type="text" name="name" class="input input-bordered w-full" />
    </div>

    <x-jen::slot:actions>
        <x-jen::button type="submit" label="Save" class="btn-primary" />
    </x-slot:actions>
</x-jen::form>
```

### Custom Form Styling

```blade
<x-jen::form
    method="POST"
    action="/users"
    class="bg-base-200 p-6 rounded-lg shadow-lg">

    @csrf
    <div class="form-control">
        <label class="label">
            <span class="label-text">Full Name</span>
        </label>
        <input
            type="text"
            name="name"
            class="input input-bordered focus:input-primary"
            placeholder="Enter your full name" />
    </div>

    <x-jen::slot:actions class="justify-between">
        <x-jen::button type="button" label="Reset" class="btn-ghost" />
        <div class="flex gap-3">
            <x-jen::button type="button" label="Cancel" class="btn-outline" />
            <x-jen::button type="submit" label="Create User" class="btn-primary" />
        </div>
    </x-slot:actions>
</x-jen::form>
```

### Livewire Form

```blade
<x-jen::form wire:submit="save">
    <div>
        <label class="label">Name</label>
        <input
            type="text"
            wire:model="name"
            class="input input-bordered w-full @error('name') input-error @enderror" />
        @error('name')
            <span class="text-error text-sm">{{ $message }}</span>
        @enderror
    </div>

    <x-jen::slot:actions>
        <x-jen::button
            type="submit"
            label="Save"
            class="btn-primary"
            spinner />
    </x-slot:actions>
</x-jen::form>
```

## Styling

The component uses CSS Grid layout with automatic row sizing and consistent gap spacing:

-   Base classes: `grid grid-flow-row auto-rows-min gap-3`
-   Actions section: `flex justify-end gap-3`
-   Separator: `border-t-[length:var(--border)] border-base-content/10 my-3`

### Custom Actions Styling

You can customize the actions container layout:

```blade
<x-jen::form method="POST" action="/users">
    <!-- Form fields -->

    <x-jen::slot:actions class="flex justify-center gap-6">
        <x-jen::button type="submit" label="Save" class="btn-primary" />
        <x-jen::button type="button" label="Cancel" class="btn-outline" />
    </x-slot:actions>
</x-jen::form>
```

## API Compatibility


```blade
<x-jen::jen::form>
    <!-- content -->
    <x-jen::slot:actions>
        <!-- actions -->
    </x-slot:actions>
</x-jen::form>

<!-- jen-ui -->
<x-jen::form>
    <!-- content -->
    <x-jen::slot:actions>
        <!-- actions -->
    </x-slot:actions>
</x-jen::form>
```

## Dependencies

-   None (standalone component)

## Form Structure

The Form component provides:

1. **Grid Layout**: Automatic row flow with consistent spacing
2. **Actions Section**: Optional slot for form buttons
3. **Separator Control**: Configurable HR line before actions
4. **Flexible Styling**: Full Tailwind CSS customization support
5. **Livewire Ready**: Built-in wire:key for proper reactivity
