# Markdown

A lightweight, performance-focused markdown editor component for Laravel applications with EasyMDE integration and image upload support.

## Basic Usage

```blade
<x-jen::markdown
    wire:model="content"
    label="Content" />
```

## Properties

| Property         | Type      | Default          | Description                                     |
| ---------------- | --------- | ---------------- | ----------------------------------------------- |
| `id`             | `?string` | `null`           | HTML ID attribute for the textarea element      |
| `label`          | `?string` | `null`           | Label text displayed above the editor           |
| `hint`           | `?string` | `null`           | Hint text displayed below the editor            |
| `hintClass`      | `?string` | `fieldset-label` | CSS class for the hint text                     |
| `disk`           | `?string` | `public`         | Storage disk for uploaded images                |
| `folder`         | `?string` | `markdown`       | Folder path for uploaded images                 |
| `config`         | `?array`  | `[]`             | EasyMDE configuration options                   |
| `errorField`     | `?string` | `null`           | Field name for error validation (auto-detected) |
| `errorClass`     | `?string` | `text-error`     | CSS class for error messages                    |
| `omitError`      | `?bool`   | `false`          | Hide error messages                             |
| `firstErrorOnly` | `?bool`   | `false`          | Show only the first error message               |

## Examples

### Basic Usage

```blade
<x-jen::markdown
    wire:model="article.content"
    label="Article Content"
    hint="Write your article content using Markdown syntax" />
```

### With Custom Configuration

```blade
<x-jen::markdown
    wire:model="content"
    label="Description"
    :config="[
        'spellChecker' => true,
        'autoSave' => ['enabled' => true, 'delay' => 1000],
        'toolbar' => ['bold', 'italic', 'heading', '|', 'link', 'image']
    ]" />
```

### With Custom Storage Settings

```blade
<x-jen::markdown
    wire:model="content"
    label="Content"
    disk="s3"
    folder="uploads/markdown"
    class="min-h-96" />
```

### With Validation

```blade
<x-jen::markdown
    wire:model="content"
    label="Content *"
    required
    error-field="content"
    hint="Markdown syntax is supported" />
```

### Conditional Usage

```blade
@if ($editMode)
    <x-jen::markdown
        wire:model="post.content"
        label="Post Content"
        :config="$editorConfig" />
@endif
```

## Key Features

-   ✅ **EasyMDE Integration**: Full-featured markdown editor with live preview
-   ✅ **Image Upload**: Drag and drop image upload with progress indicator
-   ✅ **Customizable Toolbar**: Configure toolbar buttons and layout
-   ✅ **Storage Flexibility**: Support for different storage disks and folders
-   ✅ **Auto-Save**: Optional auto-save functionality
-   ✅ **Livewire Ready**: Built-in wire:model support with reactive updates
-   ✅ **Validation Support**: Error handling and display
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Toolbar Options

The default toolbar includes:

-   `heading` - Heading levels
-   `bold` - Bold text
-   `italic` - Italic text
-   `strikethrough` - Strikethrough text
-   `code` - Inline code
-   `quote` - Block quotes
-   `unordered-list` - Bullet list
-   `ordered-list` - Numbered list
-   `horizontal-rule` - Horizontal line
-   `link` - Links
-   `upload-image` - Image upload
-   `table` - Tables
-   `preview` - Preview mode
-   `side-by-side` - Side-by-side mode

### Custom Toolbar Example

```blade
<x-jen::markdown
    wire:model="content"
    :config="[
        'toolbar' => [
            'bold', 'italic', '|',
            'heading', 'quote', '|',
            'unordered-list', 'ordered-list', '|',
            'link', 'upload-image', '|',
            'preview'
        ]
    ]" />
```

## Configuration Options

You can customize the EasyMDE editor with various options:

```blade
<x-jen::markdown
    wire:model="content"
    :config="[
        'spellChecker' => false,
        'autoSave' => ['enabled' => true, 'delay' => 1000],
        'uploadImage' => true,
        'imageAccept' => 'image/png, image/jpeg, image/gif',
        'placeholder' => 'Start writing your markdown...',
        'lineWrapping' => true,
        'tabSize' => 4,
        'indentWithTabs' => false,
    ]" />
```

## Image Upload

The component supports image upload with the following features:

-   **Drag and Drop**: Images can be dragged directly into the editor
-   **Upload Progress**: Visual feedback during upload
-   **File Type Validation**: Only image files are accepted
-   **Storage Configuration**: Configurable disk and folder location
-   **CSRF Protection**: Built-in CSRF token handling

### Upload Route

The component uses the `jen.upload` route for image uploads. This route is automatically available when you use the jen-ui package and handles file uploads to your configured storage disk.

**Route Details:**

-   **Endpoint**: `POST /jen-ui/upload`
-   **Middleware**: `web`, `auth`
-   **Parameters**: `disk`, `folder`, `file`
-   **Response**: `{"location": "https://example.com/storage/path/to/file.jpg"}`

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::markdown
    wire:model="content"
    label="Content"
    class="min-h-64 bg-white border-2 border-gray-300" />
```

## Dependencies

-   **EasyMDE**: JavaScript markdown editor library
-   **Alpine.js**: For component interactivity
-   **mary.upload**: Route for image upload functionality

## JavaScript Requirements

Make sure to include EasyMDE in your application:

```html
<!-- In your layout file -->
<link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css" />
<script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
```

Or install via npm:

```bash
npm install easymde
```
