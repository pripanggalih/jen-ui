# Menu

Komponen menu ringan dan fokus performa untuk aplikasi Laravel.

## Basic Usage

```blade
<x-jen::menu title="Basic Example">
    <li>Item 1</li>
    <li>Item 2</li>
</x-jen::menu>
```

## Properties

| Property          | Type      | Default         | Description                                  |
| ----------------- | --------- | --------------- | -------------------------------------------- |
| `id`              | `?string` | `null`          | ID unik opsional untuk menu                  |
| `title`           | `?string` | `null`          | Judul menu (ditampilkan di atas)             |
| `icon`            | `?string` | `null`          | Nama ikon opsional (menggunakan x-jen::icon) |
| `iconClasses`     | `?string` | `'w-4 h-4'`     | Kelas Tailwind untuk ikon                    |
| `separator`       | `?bool`   | `false`         | Tampilkan garis pemisah setelah judul        |
| `activateByRoute` | `?bool`   | `false`         | (Disiapkan untuk highlight by route)         |
| `activeBgColor`   | `?string` | `'bg-base-300'` | Kelas background saat aktif                  |

## Examples

### Basic Example

```blade
<x-jen::menu title="Simple Menu">
    <li>Dashboard</li>
    <li>Settings</li>
</x-jen::menu>
```

### With Properties

```blade
<x-jen::menu
    title="Menu with Icon"
    icon="home"
    iconClasses="w-5 h-5 text-primary"
    separator="true"
    class="rounded-lg shadow"
>
    <li>Home</li>
    <li>Profile</li>
</x-jen::menu>
```

### Conditional Usage

```blade
@if ($showMenu)
    <x-jen::menu title="Conditional Menu" />
@endif
```

## Key Features

-   ✅ **Judul & Ikon**: Mendukung judul dan ikon opsional
-   ✅ **Separator**: Garis pemisah opsional
-   ✅ **Livewire Ready**: wire:key otomatis
-   ✅ **Auto Discovery**: Tidak perlu registrasi manual
-   ✅ **Dynamic Prefix**: Dukungan prefix dinamis untuk dependensi

## Styling

Komponen menggunakan kelas Tailwind CSS dan dapat dikustomisasi:

```blade
<x-jen::menu title="Custom Styled" class="bg-primary text-white p-4" />
```

## Dependencies

-   `x-jen::icon` (jika menggunakan ikon)
