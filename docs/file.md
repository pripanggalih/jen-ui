# File

Komponen file upload yang ringan dan berfokus pada performa dengan dukungan image cropping untuk aplikasi Laravel.

```

## Basic Usage

```blade
<x-jen::file wire:model="avatar" />
```

## Properties

| Property          | Type      | Default          | Description                        |
| ----------------- | --------- | ---------------- | ---------------------------------- |
| `id`              | `?string` | `null`           | ID unik untuk elemen               |
| `label`           | `?string` | `null`           | Label untuk field                  |
| `hint`            | `?string` | `null`           | Teks bantuan untuk field           |
| `hintClass`       | `?string` | `fieldset-label` | CSS class untuk hint               |
| `hideProgress`    | `?bool`   | `false`          | Sembunyikan progress bar upload    |
| `cropAfterChange` | `?bool`   | `false`          | Otomatis crop setelah file dipilih |
| `changeText`      | `?string` | `"Change"`       | Teks tombol ganti file             |
| `cropTitleText`   | `?string` | `"Crop image"`   | Judul modal crop                   |
| `cropCancelText`  | `?string` | `"Cancel"`       | Teks tombol cancel crop            |
| `cropSaveText`    | `?string` | `"Crop"`         | Teks tombol save crop              |
| `cropConfig`      | `?array`  | `[]`             | Konfigurasi Cropper.js             |
| `cropMimeType`    | `?string` | `"image/png"`    | MIME type untuk hasil crop         |
| `errorField`      | `?string` | `null`           | Field name untuk validation error  |
| `errorClass`      | `?string` | `text-error`     | CSS class untuk error message      |
| `omitError`       | `?bool`   | `false`          | Skip tampilan error message        |
| `firstErrorOnly`  | `?bool`   | `false`          | Tampilkan hanya error pertama      |

## Examples

### Basic File Upload

```blade
<x-jen::file
    wire:model="document"
    label="Upload Document"
    hint="PDF, DOC, atau DOCX maksimal 5MB" />
```

### Image Upload dengan Cropping

```blade
<x-jen::file
    wire:model="avatar"
    label="Profile Avatar"
    cropAfterChange="true"
    :cropConfig="['aspectRatio' => 1, 'autoCropArea' => 0.8]">
    <img src="{{ $user->avatar_url }}" class="w-20 h-20 rounded-full" />
</x-jen::file>
```

### Custom Preview Slot

```blade
<x-jen::file wire:model="banner" label="Banner Image">
    <div class="border-2 border-dashed border-gray-300 p-8 text-center">
        @if ($banner)
            <img src="{{ $banner->temporaryUrl() }}" class="max-w-full h-32 mx-auto" />
        @else
            <div class="text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Click to upload banner
            </div>
        @endif
    </div>
</x-jen::file>
```

### Multiple Files

```blade
<x-jen::file
    wire:model="attachments"
    label="Attachments"
    multiple
    accept=".pdf,.doc,.docx" />
```

### Required Field dengan Validation

```blade
<x-jen::file
    wire:model="resume"
    label="Resume"
    required
    errorField="resume"
    hint="Upload your latest resume (PDF format)" />

@error('resume')
    <div class="text-error mt-1">{{ $message }}</div>
@enderror
```

### Advanced Cropping Configuration

```blade
<x-jen::file
    wire:model="profilePhoto"
    label="Profile Photo"
    cropAfterChange="true"
    :cropConfig="[
        'aspectRatio' => 1,
        'viewMode' => 1,
        'dragMode' => 'move',
        'autoCropArea' => 0.9,
        'cropBoxResizable' => false,
        'minContainerWidth' => 400,
        'minContainerHeight' => 400
    ]"
    cropMimeType="image/jpeg">

    @if ($profilePhoto)
        <img src="{{ $profilePhoto->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover" />
    @else
        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
    @endif
</x-jen::file>
```

## Styling

Komponen menggunakan Tailwind CSS dan dapat dikustomisasi:

```blade
<x-jen::file
    wire:model="file"
    class="border-2 border-blue-200 rounded-lg p-4" />
```

## API Compatibility


```blade
<x-jen::mary-file wire:model="file" label="Upload File" />

<!-- jen-ui -->
<x-jen::file wire:model="file" label="Upload File" />
```

## Livewire Integration

### Component Property

```php
class EditProfile extends Component
{
    public $avatar;

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024', // 1MB max
        ]);
    }

    public function save()
    {
        $this->avatar->store('avatars');
    }
}
```

### Progress Tracking

```blade
<x-jen::file
    wire:model="largeFile"
    x-on:livewire-upload-start="uploading = true"
    x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-error="uploading = false" />
```

## Dependencies

-   `x-button` (untuk crop modal actions)
-   Cropper.js (untuk image cropping functionality)

## JavaScript Requirements

Untuk fitur cropping, pastikan Cropper.js tersedia:

```html
<!-- Via CDN -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css"
/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<!-- Atau via npm -->
npm install cropperjs
```
