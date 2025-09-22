# ImageLibrary

Komponen perpustakaan gambar yang ringan dan berfokus pada performa untuk aplikasi Laravel. Komponen ini menyediakan upload multi-gambar dengan fitur crop, drag-and-drop reordering, dan preview.

## Instalasi

```bash
```

## Penggunaan Dasar

```blade
<x-jen::image-library
    wire:model="images"
    wire:library="media"
    label="Upload Images" />
```

## Properti

| Properti         | Tipe         | Default        | Deskripsi                       |
| ---------------- | ------------ | -------------- | ------------------------------- |
| `id`             | `?string`    | `null`         | ID unik untuk komponen          |
| `label`          | `?string`    | `null`         | Label untuk field               |
| `hint`           | `?string`    | `null`         | Teks bantuan di bawah komponen  |
| `hideErrors`     | `?bool`      | `false`        | Sembunyikan pesan error         |
| `hideProgress`   | `?bool`      | `false`        | Sembunyikan progress bar        |
| `changeText`     | `?string`    | `"Change"`     | Teks untuk tombol ubah gambar   |
| `cropText`       | `?string`    | `"Crop"`       | Teks untuk tombol crop          |
| `removeText`     | `?string`    | `"Remove"`     | Teks untuk tombol hapus         |
| `cropTitleText`  | `?string`    | `"Crop image"` | Judul modal crop                |
| `cropCancelText` | `?string`    | `"Cancel"`     | Teks tombol batal crop          |
| `cropSaveText`   | `?string`    | `"Crop"`       | Teks tombol simpan crop         |
| `addFilesText`   | `?string`    | `"Add images"` | Teks tombol tambah files        |
| `cropConfig`     | `?array`     | `[]`           | Konfigurasi cropper.js          |
| `preview`        | `Collection` | `Collection()` | Collection gambar untuk preview |

## Contoh

### Penggunaan Dasar

```blade
<x-jen::image-library
    wire:model="photos"
    wire:library="gallery"
    label="Photo Gallery" />
```

### Dengan Konfigurasi Lengkap

```blade
<x-jen::image-library
    wire:model="productImages"
    wire:library="products"
    label="Product Images"
    hint="Upload up to 10 images in JPG or PNG format"
    change-text="Ubah Gambar"
    crop-text="Potong"
    remove-text="Hapus"
    add-files-text="Tambah Gambar"
    :crop-config="[
        'aspectRatio' => 16/9,
        'autoCropArea' => 0.8,
        'viewMode' => 2
    ]"
    accept="image/jpeg,image/png,image/webp"
    class="mb-6" />
```

### Dengan Preview Existing Images

```blade
@php
    $existingImages = collect([
        ['uuid' => 'img1', 'url' => '/storage/images/image1.jpg'],
        ['uuid' => 'img2', 'url' => '/storage/images/image2.jpg'],
    ]);
@endphp

<x-jen::image-library
    wire:model="newImages"
    wire:library="portfolio"
    label="Portfolio Images"
    :preview="$existingImages" />
```

### Tanpa Progress Bar

```blade
<x-jen::image-library
    wire:model="avatars"
    wire:library="user_avatars"
    label="User Avatars"
    hide-progress />
```

## Styling

Komponen menggunakan class Tailwind CSS dan dapat dikustomisasi:

```blade
<x-jen::image-library
    wire:model="images"
    wire:library="custom"
    label="Custom Styled Library"
    class="border-2 border-primary rounded-lg p-4" />
```

## Fitur

### ✅ Upload Multi-gambar

-   Mendukung upload multiple files sekaligus
-   Drag and drop files support
-   Progress bar untuk upload

### ✅ Image Cropping

-   Built-in cropper.js integration
-   Konfigurasi crop yang fleksibel
-   Preview hasil crop langsung

### ✅ Drag & Drop Reordering

-   Sortable.js integration
-   Reorder gambar dengan drag and drop
-   Auto-save urutan gambar

### ✅ Preview & Management

-   Preview gambar existing
-   Tombol hapus per gambar
-   Tooltip informatif

### ✅ Validation Support

-   Error messages per field
-   File type validation
-   Laravel validation integration

## Cropper Configuration

Anda dapat mengkustomisasi behavior cropper dengan `cropConfig`:

```blade
<x-jen::image-library
    wire:model="images"
    wire:library="crops"
    :crop-config="[
        'aspectRatio' => 1, // Square crop
        'autoCropArea' => 0.9,
        'viewMode' => 1,
        'dragMode' => 'move',
        'guides' => true,
        'highlight' => false,
        'background' => false,
        'rotatable' => true,
        'scalable' => true,
        'zoomable' => true
    ]" />
```

## Livewire Integration

### Component Properties

```php
class MediaManager extends Component
{
    public array $images = [];
    public Collection $existingImages;

    public function mount()
    {
        $this->existingImages = collect([
            ['uuid' => '123', 'url' => '/storage/images/example.jpg']
        ]);
    }

    public function removeMedia($uuid, $model, $library, $url)
    {
        // Handle media removal logic
    }

    public function refreshMediaOrder($order, $library)
    {
        // Handle reordering logic
    }

    public function refreshMediaSources($model, $library)
    {
        // Refresh media sources after upload/crop
    }
}
```

### Template Usage

```blade
<x-jen::image-library
    wire:model="images"
    wire:library="media_library"
    label="Media Library"
    :preview="$existingImages" />
```

## API Compatibility


```blade
<x-jen::jen::image-library
    wire:model="images"
    wire:library="gallery"
    label="Gallery" />

<!-- jen-ui -->
<x-jen::image-library
    wire:model="images"
    wire:library="gallery"
    label="Gallery" />
```

## Dependencies

-   `x-button` - untuk tombol aksi (remove, crop)
-   `x-icon` - untuk ikon di tombol dan UI
-   **External**: Cropper.js, Sortable.js (harus di-include secara manual)

## JavaScript Dependencies

Pastikan untuk menyertakan library JavaScript yang diperlukan:

```html
<!-- Cropper.js -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

<!-- Sortable.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
```

## Browser Support

-   Chrome 60+
-   Firefox 55+
-   Safari 12+
-   Edge 79+

## Troubleshooting

### Upload tidak berfungsi

-   Pastikan Livewire configured dengan benar
-   Cek max file size di php.ini
-   Periksa storage permissions

### Cropper tidak muncul

-   Pastikan Cropper.js sudah di-load
-   Cek JavaScript console untuk error
-   Verifikasi DOM structure

### Drag & drop reordering tidak berfungsi

-   Pastikan Sortable.js sudah di-load
-   Implement method `refreshMediaOrder` di component
-   Cek data-id attribute pada preview items
