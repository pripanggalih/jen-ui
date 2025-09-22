# Input

Lightweight, performance-focused input component for Laravel applications with full feature support including validation, masks, and styling.

## Basic Usage

```blade
<x-jen::input label="Username" placeholder="Enter your name..." />
```

## Properties

| Property         | Type      | Default            | Description                     |
| ---------------- | --------- | ------------------ | ------------------------------- |
| `id`             | `?string` | `null`             | ID for the input element        |
| `label`          | `?string` | `null`             | Input label                     |
| `icon`           | `?string` | `null`             | Left side icon                  |
| `iconRight`      | `?string` | `null`             | Right side icon                 |
| `hint`           | `?string` | `null`             | Helper text below input         |
| `hintClass`      | `?string` | `'fieldset-label'` | CSS class for hint              |
| `prefix`         | `?string` | `null`             | Prefix text inside input        |
| `suffix`         | `?string` | `null`             | Suffix text inside input        |
| `inline`         | `?bool`   | `false`            | Floating label mode             |
| `clearable`      | `?bool`   | `false`            | Show clear button               |
| `money`          | `?bool`   | `false`            | Money format with mask          |
| `locale`         | `?string` | `'en-US'`          | Locale for money format         |
| `prepend`        | `mixed`   | `null`             | Slot for prepend content        |
| `append`         | `mixed`   | `null`             | Slot for append content         |
| `errorField`     | `?string` | `null`             | Field name for validation error |
| `errorClass`     | `?string` | `'text-error'`     | CSS class for error             |
| `omitError`      | `?bool`   | `false`            | Hide error display              |
| `firstErrorOnly` | `?bool`   | `false`            | Show only first error           |

## Examples

### Basic Input

```blade
<x-jen::input label="Email" type="email" placeholder="email@contoh.com" />
```

### Input dengan Icon

```blade
<x-jen::input
    label="Pencarian"
    icon="o-magnifying-glass"
    placeholder="Cari produk..."
    clearable />
```

### Input dengan Prefix/Suffix

```blade
<x-jen::input
    label="Website"
    prefix="https://"
    suffix=".com"
    placeholder="domain" />
```

### Input Uang

```blade
<x-jen::input
    label="Harga"
    money
    locale="id-ID"
    placeholder="0" />
```

### Input dengan Livewire

```blade
<x-jen::input
    label="Nama"
    wire:model.live="name"
    placeholder="Masukkan nama..."
    hint="Nama akan disimpan otomatis" />
```

### Input dengan Prepend/Append

```blade
<x-jen::input label="Budget">
    <x-slot:prepend>
        <button class="btn btn-secondary">Min</button>
    </x-slot:prepend>

    <x-slot:append>
        <button class="btn btn-secondary">Max</button>
    </x-slot:append>
</x-jen::input>
```

### Floating Label

```blade
<x-jen::input
    label="Email"
    inline
    type="email"
    placeholder="Masukkan email..." />
```

### Input dengan Validasi Custom

```blade
<x-jen::input
    label="Username"
    wire:model="username"
    error-field="username"
    first-error-only
    hint="Username harus unik" />
```

### Penggunaan Kondisional

```blade
@if ($showInput)
    <x-jen::input
        label="Input Kondisional"
        placeholder="Hanya tampil jika kondisi terpenuhi"
        icon="o-information-circle" />
@endif
```

## Styling

This component uses Tailwind CSS and can be customized:

```blade
<x-jen::input
    label="Custom Style"
    class="input-bordered input-lg bg-primary text-white"
    placeholder="Custom styled input" />
```

## Features

## Key Features

-   ✅ **Smart Labels**: Standard & floating label modes
-   ✅ **Rich Icons**: Left & right icon support
-   ✅ **Enhanced Input**: Prefix, suffix, and clear functionality
-   ✅ **Money Format**: Built-in currency formatting
-   ✅ **Extensible Slots**: Prepend & append custom content
-   ✅ **Validation Ready**: Error display and hint support
-   ✅ **Livewire Native**: Full wire:model compatibility
-   ✅ **State Aware**: Readonly, disabled, and focus states
-   ✅ **Responsive**: Mobile-first design approach

## Dependencies

-   `x-jen::icon` (for displaying icons)
