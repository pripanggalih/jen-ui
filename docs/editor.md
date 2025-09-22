# Editor

A lightweight, performance-focused rich text editor component for Laravel applications using TinyMCE.


The component includes built-in file upload functio## Dependencies

- **TinyMCE**: Rich text editor library (loaded via CDN)
- **Alpine.js**: For reactive data binding
- **Laravel Livewire**: For wire:model functionality

## Notes

- ✅ **Zero manual setup required** - everything is auto-configured
- ✅ **Smart duplicate detection** - won't create duplicate routes on re-install
- ✅ **Automatic use statement injection** - adds required imports to web.php
- The editor automatically handles Livewire model changes
- Dark mode support is built-in and automatic
- The component is wire:ignore to prevent Livewire interference with TinyMCE*automatic setup**:

- **Drag & Drop**: Users can drag images directly into the editor
- **File Picker**: Click the image button to open file picker
- **Automatic Upload**: Files are automatically uploaded via AJAX
- **Storage Integration**: Uses Laravel's storage system with configurable disk and folder

### Upload Configuration

The upload route supports configurable storage options:

```blade
<x-jen::editor
    wire:model="content"
    label="Content"
    disk="uploads"          {{-- Custom storage disk --}}
    folder="blog/images"    {{-- Custom upload folder --}}
/>
````

### Upload Endpoint

The automatically installed route is available at:

-   **URL**: `POST /jen-ui/editor/upload`
-   **Route Name**: `jen.upload`
-   **Middleware**: `['web', 'csrf']`
-   **Response**: `{ "location": "/storage/path/to/uploaded/file.jpg" }`dd editor

````

**✨ Automatic Setup**: The command automatically installs:
- ✅ Editor component files
- ✅ Upload route (`POST /jen-ui/editor/upload`)
- ✅ Required use statements in `routes/web.php`
- ✅ No manual configuration needed!

## Basic Usage

```blade
<x-jen::editor wire:model="content" label="Content" />
````

## Properties

| Property         | Type      | Default          | Description                              |
| ---------------- | --------- | ---------------- | ---------------------------------------- |
| `id`             | `?string` | `null`           | The input ID attribute                   |
| `label`          | `?string` | `null`           | The fieldset legend label text           |
| `hint`           | `?string` | `null`           | Help text displayed below the editor     |
| `hintClass`      | `?string` | `fieldset-label` | CSS class for hint text styling          |
| `disk`           | `?string` | `public`         | Storage disk for file uploads            |
| `folder`         | `?string` | `editor`         | Upload folder path                       |
| `gplLicense`     | `?bool`   | `false`          | Use GPL license for TinyMCE              |
| `config`         | `?array`  | `[]`             | Additional TinyMCE configuration options |
| `errorField`     | `?string` | `null`           | Field name for validation errors         |
| `errorClass`     | `?string` | `text-error`     | CSS class for error message styling      |
| `omitError`      | `?bool`   | `false`          | Skip error message display               |
| `firstErrorOnly` | `?bool`   | `false`          | Show only the first validation error     |

## Examples

### Basic Editor

```blade
<x-jen::editor wire:model="article.content" label="Article Content" />
```

### With Custom Configuration

```blade
<x-jen::editor
    wire:model="description"
    label="Description"
    :config="[
        'height' => 400,
        'toolbar' => 'undo redo | bold italic | bullist numlist | link image',
        'plugins' => 'link image lists'
    ]" />
```

### With File Upload Settings

```blade
<x-jen::editor
    wire:model="post.body"
    label="Post Content"
    disk="uploads"
    folder="blog/images"
    hint="You can upload images directly by dragging and dropping" />
```

### With Validation

```blade
<x-jen::editor
    wire:model="form.content"
    label="Content"
    error-field="form.content"
    required
    hint="Content is required and must be at least 100 characters" />
```

### GPL License (Free Commercial Use)

```blade
<x-jen::editor
    wire:model="content"
    label="Content"
    :gpl-license="true" />
```

### Read-only Mode

```blade
<x-jen::editor
    wire:model="content"
    label="Preview"
    readonly />
```

### Disabled State

```blade
<x-jen::editor
    wire:model="content"
    label="Content"
    disabled />
```

## Styling

The editor supports both light and dark themes automatically based on the HTML document class:

```blade
<x-jen::editor
    wire:model="content"
    label="Content"
    class="border-2 border-primary rounded-lg" />
```

## Advanced Configuration

You can customize TinyMCE extensively through the `config` array:

```blade
<x-jen::editor
    wire:model="content"
    label="Advanced Editor"
    :config="[
        'height' => 500,
        'menubar' => true,
        'toolbar' => 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        'content_style' => 'body { font-family: Arial, sans-serif; font-size: 14px }',
        'plugins' => 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount'
    ]" />
```

## File Upload

The component includes built-in file upload functionality:

-   **Drag & Drop**: Users can drag images directly into the editor
-   **File Picker**: Click the image button to open file picker
-   **Automatic Upload**: Files are automatically uploaded via AJAX
-   **Storage Integration**: Uses Laravel's storage system with configurable disk and folder

### Upload Requirements


```json
{
    "location": "/storage/uploads/image.jpg"
}
```

## API Compatibility


```blade
<x-jen::mary-editor wire:model="content" label="Content" />

<!-- jen-ui -->
<x-jen::editor wire:model="content" label="Content" />
```

## Dependencies

-   **TinyMCE**: Rich text editor library
-   **Alpine.js**: For reactive data binding
-   **Laravel Livewire**: For wire:model functionality

## Notes

-   The editor automatically handles Livewire model changes
-   Dark mode support is built-in and automatic
-   File uploads require appropriate server-side handling
-   The component is wire:ignore to prevent Livewire interference with TinyMCE
