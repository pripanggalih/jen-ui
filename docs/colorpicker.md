# Colorpicker

Komponen colorpicker ringan dan fokus pada performa untuk aplikasi Laravel dengan sinkronisasi real-time antara color picker dan input text.

## Instalasi

```bash
```

## Penggunaan Dasar

```blade
<x-jen::colorpicker label="Pilih Warna" wire:model="color" />
```

## Properties

| Property         | Type      | Default            | Description                                          |
| ---------------- | --------- | ------------------ | ---------------------------------------------------- |
| `id`             | `?string` | `null`             | ID unik untuk komponen                               |
| `label`          | `?string` | `null`             | Label untuk input                                    |
| `icon`           | `?string` | `''`               | Icon di sebelah kiri input                           |
| `iconRight`      | `?string` | `null`             | Icon di sebelah kanan input                          |
| `hint`           | `?string` | `null`             | Teks bantuan di bawah input                          |
| `hintClass`      | `?string` | `'fieldset-label'` | Class CSS untuk hint text                            |
| `prefix`         | `?string` | `null`             | Teks prefix di dalam input                           |
| `suffix`         | `?string` | `null`             | Teks suffix di dalam input                           |
| `inline`         | `?bool`   | `false`            | Apakah menggunakan floating label                    |
| `clearable`      | `?bool`   | `false`            | Menampilkan tombol clear (reserved untuk masa depan) |
| `errorField`     | `?string` | `null`             | Field name untuk validasi error                      |
| `errorClass`     | `?string` | `'text-error'`     | Class CSS untuk pesan error                          |
| `omitError`      | `?bool`   | `false`            | Menyembunyikan pesan error                           |
| `firstErrorOnly` | `?bool`   | `false`            | Hanya menampilkan error pertama                      |

## Contoh Penggunaan

### Dasar

```blade
<x-jen::colorpicker
    label="Warna Favorit"
    wire:model="favoriteColor" />
```

### Dengan Icon dan Hint

```blade
<x-jen::colorpicker
    label="Warna Theme"
    icon="o-palette"
    hint="Pilih warna untuk tema aplikasi"
    wire:model="themeColor" />
```

### Dengan Prefix dan Suffix

```blade
<x-jen::colorpicker
    label="Kode Warna"
    prefix="HEX:"
    suffix="COLOR"
    wire:model="colorCode" />
```

### Floating Label (Inline)

```blade
<x-jen::colorpicker
    label="Brand Color"
    inline
    wire:model="brandColor" />
```

### Readonly dan Disabled

```blade
{{-- Readonly --}}
<x-jen::colorpicker
    label="Current Theme"
    wire:model="currentTheme"
    readonly />

{{-- Disabled --}}
<x-jen::colorpicker
    label="Locked Color"
    wire:model="lockedColor"
    disabled />
```

### Dengan Validasi

```blade
<x-jen::colorpicker
    label="Primary Color"
    wire:model="primaryColor"
    error-field="primaryColor"
    hint="Pilih warna primer untuk brand Anda" />
```

### Custom Error Handling

```blade
<x-jen::colorpicker
    label="Secondary Color"
    wire:model="secondaryColor"
    error-field="secondaryColor"
    error-class="text-red-500 font-bold"
    first-error-only />
```

### Dengan Custom Styling

```blade
<x-jen::colorpicker
    label="Custom Color"
    wire:model="customColor"
    class="w-full max-w-md"
    placeholder="Masukkan kode hex..." />
```

## API Compatibility


```blade
<x-jen::jen::colorpicker label="Pilih Warna" wire:model="color" />

<!-- jen-ui -->
<x-jen::colorpicker label="Pilih Warna" wire:model="color" />
```

## Fitur

-   ✅ **Sinkronisasi Real-time** - Color picker dan input text tersinkronisasi otomatis
-   ✅ **Livewire Compatible** - Full support untuk wire:model binding
-   ✅ **Visual Color Picker** - Interface native browser color picker
-   ✅ **Text Input Support** - Manual input kode hex color
-   ✅ **Validation Ready** - Built-in support untuk Laravel validation
-   ✅ **Icon Support** - Icon kiri dan kanan
-   ✅ **Prefix/Suffix** - Text tambahan di dalam input
-   ✅ **Floating Labels** - Label yang bergerak dinamis
-   ✅ **Readonly/Disabled States** - Support untuk state yang tidak bisa diedit
-   ✅ **Error Handling** - Tampilan error yang dapat dikustomisasi

## Dependencies

-   `x-icon` - Untuk menampilkan icon di input

## Contoh Livewire Component

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class ColorSettings extends Component
{
    public string $primaryColor = '#3b82f6';
    public string $secondaryColor = '#10b981';
    public string $accentColor = '#f59e0b';

    public function render()
    {
        return view('livewire.color-settings');
    }
}
```

```blade
{{-- resources/views/livewire/color-settings.blade.php --}}
<div class="space-y-6">
    <x-jen::colorpicker
        label="Primary Color"
        wire:model.live="primaryColor"
        hint="Warna utama untuk interface" />

    <x-jen::colorpicker
        label="Secondary Color"
        wire:model.live="secondaryColor"
        hint="Warna sekunder untuk aksen" />

    <x-jen::colorpicker
        label="Accent Color"
        wire:model.live="accentColor"
        hint="Warna aksen untuk highlight" />
</div>
```

## Tips

1. **Gunakan wire:model.live** untuk update real-time
2. **Kombinasi dengan validation rules** untuk memastikan format hex yang valid
3. **Manfaatkan prefix/suffix** untuk memberikan konteks tambahan
4. **Gunakan hint** untuk memberikan guidance kepada user
5. **Readonly state** cocok untuk menampilkan warna yang sudah terpilih tanpa bisa diedit
