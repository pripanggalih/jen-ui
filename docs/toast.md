# Toast

Sistem notifikasi toast yang ringan dan modern untuk aplikasi Laravel dengan dukungan Livewire penuh.

## Basic Usage

```blade
<x-jen::toast />
```

## Properties

| Property   | Type     | Default               | Description                              |
| ---------- | -------- | --------------------- | ---------------------------------------- |
| `position` | `string` | `toast-top toast-end` | Posisi toast (menggunakan class DaisyUI) |

## Toast Trait Usage

### Menggunakan Trait dalam Livewire Component

```php
<?php

namespace App\Livewire;

use Jen\Traits\Toast;
use Livewire\Component;

class UserForm extends Component
{
    use Toast;

    public function save()
    {
        // Save user logic...

        $this->success('Success!', 'User berhasil disimpan.');
    }
}
```

### Method yang Tersedia

#### toast()

Method utama untuk membuat toast kustom:

```php
$this->toast(
    type: 'info',
    title: 'Custom Toast',
    description: 'Deskripsi toast kustom',
    position: 'toast-bottom toast-center',
    icon: 'o-information-circle',
    css: 'alert-info',
    timeout: 5000,
    redirectTo: '/dashboard'
);
```

#### success()

Toast untuk pesan sukses:

```php
$this->success(
    title: 'Berhasil!',
    description: 'Data berhasil disimpan',
    timeout: 3000
);
```

#### warning()

Toast untuk peringatan:

```php
$this->warning(
    title: 'Peringatan!',
    description: 'Data mungkin tidak valid'
);
```

#### error()

Toast untuk error:

```php
$this->error(
    title: 'Error!',
    description: 'Terjadi kesalahan saat menyimpan data'
);
```

#### info()

Toast untuk informasi:

```php
$this->info(
    title: 'Info',
    description: 'Proses sedang berjalan'
);
```

## Exception Usage

### Menggunakan ToastException

```php
<?php

namespace App\Http\Controllers;

use Jen\Exceptions\ToastException;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validation logic...

        if ($validationFailed) {
            throw ToastException::error(
                title: 'Validation Failed',
                description: 'Please check your input data'
            );
        }

        // Success logic...
        throw ToastException::success(
            title: 'Success!',
            description: 'User created successfully'
        );
    }
}
```

### Static Method ToastException

```php
// Info toast
throw ToastException::info('Information', 'This is an info message');

// Success toast
throw ToastException::success('Success!', 'Operation completed successfully');

// Warning toast
throw ToastException::warning('Warning!', 'Please check your input');

// Error toast
throw ToastException::error('Error!', 'Something went wrong');
```

### Mengizinkan Default Behavior

```php
throw ToastException::error('Error!', 'Something went wrong')
    ->permitDefault(); // Tidak akan prevent default behavior
```

## Examples

### Basic Toast Setup

```blade
<!-- Di layout utama aplikasi -->
<x-jen::toast />
```

### Custom Position

```blade
<x-jen::toast position="toast-bottom toast-center" />
```

### Dalam Livewire Component

```php
<?php

namespace App\Livewire;

use Jen\Traits\Toast;
use Livewire\Component;

class ProductForm extends Component
{
    use Toast;

    public $name;
    public $price;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0'
        ]);

        try {
            Product::create([
                'name' => $this->name,
                'price' => $this->price
            ]);

            $this->success(
                title: 'Product Created!',
                description: 'Product has been saved successfully',
                redirectTo: '/products'
            );

        } catch (\Exception $e) {
            $this->error(
                title: 'Error!',
                description: 'Failed to save product: ' . $e->getMessage()
            );
        }
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
```

### JavaScript Manual Toast

```javascript
// Trigger toast dari JavaScript
window.toast({
    toast: {
        type: "success",
        title: "Success!",
        description: "Operation completed",
        position: "toast-top toast-end",
        css: "alert-success",
        timeout: 3000,
    },
});
```

## Key Features

-   ✅ **Trait Based**: Mudah digunakan dalam Livewire components
-   ✅ **Exception Support**: ToastException untuk error handling yang elegan
-   ✅ **Multiple Types**: Success, warning, error, info, dan custom
-   ✅ **Flexible Positioning**: Semua posisi DaisyUI toast didukung
-   ✅ **Auto Dismiss**: Timer otomatis dengan timeout yang dapat dikonfigurasi
-   ✅ **Livewire Ready**: Terintegrasi penuh dengan Livewire hooks
-   ✅ **Auto Discovery**: Bekerja otomatis tanpa registrasi manual
-   ✅ **Dynamic Prefix**: Mendukung konfigurasi prefix kustom
-   ✅ **Icon Support**: Menggunakan jen::icon untuk konsistensi

## Styling

Komponen menggunakan class Tailwind CSS dan DaisyUI:

```blade
<!-- Toast positions tersedia -->
toast-top toast-end      <!-- Default -->
toast-top toast-start
toast-top toast-center
toast-bottom toast-end
toast-bottom toast-start
toast-bottom toast-center
toast-middle toast-end
toast-middle toast-start
toast-middle toast-center
```

## Dependencies

-   `x-jen::icon` (untuk icon toast)
-   Alpine.js (untuk interaksi frontend)
-   DaisyUI (untuk styling toast dan alert)

## Session Flash Integration

Toast trait secara otomatis menyimpan data toast ke session flash:

```php
// Setelah redirect, data masih tersedia di session
session('jen.toast.title');     // Toast title
session('jen.toast.description'); // Toast description
```

## Browser Support

-   Modern browsers dengan dukungan ES6+
-   Alpine.js v3+ compatibility
-   Livewire v3+ integration
