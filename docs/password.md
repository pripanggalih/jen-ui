# Password

A lightweight, performance-focused password input component for Laravel applications with built-in visibility toggle functionality.

## Basic Usage

```blade
<x-jen::password label="Password" wire:model="password" />
```

## Properties

| Property               | Type      | Default          | Description                                   |
| ---------------------- | --------- | ---------------- | --------------------------------------------- |
| `id`                   | `?string` | `null`           | HTML id attribute for the input               |
| `label`                | `?string` | `null`           | Label text for the input                      |
| `icon`                 | `?string` | `null`           | Left icon name (conflicts with left toggle)   |
| `iconRight`            | `?string` | `null`           | Right icon name (conflicts with right toggle) |
| `hint`                 | `?string` | `null`           | Hint text displayed below input               |
| `hintClass`            | `?string` | `fieldset-label` | CSS class for hint text                       |
| `prefix`               | `?string` | `null`           | Text prefix inside input                      |
| `suffix`               | `?string` | `null`           | Text suffix inside input                      |
| `inline`               | `?bool`   | `false`          | Use floating label style                      |
| `clearable`            | `?bool`   | `false`          | Show clear button                             |
| `passwordIcon`         | `?string` | `o-eye-slash`    | Icon when password is hidden                  |
| `passwordVisibleIcon`  | `?string` | `o-eye`          | Icon when password is visible                 |
| `passwordIconTabindex` | `?bool`   | `false`          | Allow toggle button to be tabbed              |
| `right`                | `?bool`   | `false`          | Place password toggle on right side           |
| `onlyPassword`         | `?bool`   | `false`          | Disable visibility toggle (password only)     |
| `prepend`              | `mixed`   | `null`           | Content to prepend (slot)                     |
| `append`               | `mixed`   | `null`           | Content to append (slot)                      |
| `errorField`           | `?string` | `null`           | Custom error field name                       |
| `errorClass`           | `?string` | `text-error`     | CSS class for error messages                  |
| `omitError`            | `?bool`   | `false`          | Hide error messages                           |
| `firstErrorOnly`       | `?bool`   | `false`          | Show only first error message                 |

## Examples

### Basic Password Input

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    placeholder="Enter your password" />
```

### Password with Confirmation

```blade
<div class="grid grid-cols-2 gap-4">
    <x-jen::password
        label="Password"
        wire:model="password" />

    <x-jen::password
        label="Confirm Password"
        wire:model="password_confirmation" />
</div>
```

### Right-side Toggle

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    right="true" />
```

### With Left Icon

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    icon="o-key"
    right="true" />
```

### Password Only (No Toggle)

```blade
<x-jen::password
    label="Security Code"
    wire:model="code"
    onlyPassword="true" />
```

### With Prefix/Suffix

```blade
<x-jen::password
    label="API Key"
    wire:model="api_key"
    prefix="key_"
    suffix="_prod" />
```

### Clearable Password

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    clearable="true" />
```

### Inline Label Style

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    inline="true" />
```

### With Hint

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    hint="Must be at least 8 characters long" />
```

### With Prepend/Append Slots

```blade
<x-jen::password label="Password" wire:model="password">
    <x-slot:prepend>
        <span class="btn btn-sm">🔒</span>
    </x-slot:prepend>

    <x-slot:append>
        <button class="btn btn-sm btn-primary">Check</button>
    </x-slot:append>
</x-jen::password>
```

### Custom Validation

```blade
<x-jen::password
    label="Password"
    wire:model="password"
    errorField="user.password"
    errorClass="text-red-500 text-sm" />
```

## Key Features

-   ✅ **Password Visibility Toggle**: Built-in show/hide functionality with Alpine.js
-   ✅ **Flexible Icon Placement**: Support for left/right icons with smart conflict detection
-   ✅ **Error Handling**: Automatic validation error display with Livewire integration
-   ✅ **Clearable Input**: Optional clear button functionality
-   ✅ **Prepend/Append Slots**: Support for custom content before and after input
-   ✅ **Inline Labels**: Modern floating label style option
-   ✅ **Livewire Ready**: Built-in wire:loading support and model binding
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Toggle Placement Rules

The password visibility toggle follows smart placement rules:

-   **Left Placement**: Default when no `icon` and no `right` property
-   **Right Placement**: When `right="true"` and no `iconRight`
-   **No Toggle**: When `onlyPassword="true"`

### Icon Conflicts

The component prevents conflicts between icons and toggle placement:

```blade
{{-- ❌ This will throw an exception --}}
<x-jen::password icon="o-key" />

{{-- ✅ Use right placement with left icon --}}
<x-jen::password icon="o-key" right="true" />

{{-- ✅ Or disable toggle completely --}}
<x-jen::password icon="o-key" onlyPassword="true" />
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::password
    label="Custom Styled"
    wire:model="password"
    class="input-lg border-2 border-primary" />
```

## Dependencies

-   `x-jen::icon` - For toggle and decorative icons
-   `x-jen::button` - For password visibility toggle button
-   Alpine.js - For toggle state management
-   Livewire - For model binding and error handling

## JavaScript Requirements

The component uses Alpine.js for toggle functionality. Ensure Alpine.js is loaded:

```blade
@vite(['resources/js/app.js'])
{{-- or --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```
