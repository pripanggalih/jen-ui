# Header

Komponen header yang ringan dan fokus performa untuk aplikasi Laravel dengan dukungan anchor, icon, separator, dan progress indicator.

```

## Basic Usage

```blade
<x-jen::header title="Welcome to Dashboard" />
```

## Properties

| Property                 | Type      | Default            | Description                               |
| ------------------------ | --------- | ------------------ | ----------------------------------------- |
| `title`                  | `?string` | `null`             | Judul utama header                        |
| `subtitle`               | `?string` | `null`             | Subjudul di bawah title                   |
| `separator`              | `?bool`   | `false`            | Menampilkan garis pemisah horizontal      |
| `progressIndicator`      | `?string` | `null`             | Target wire untuk progress indicator      |
| `progressIndicatorClass` | `string`  | `progress-primary` | Class CSS untuk progress bar              |
| `withAnchor`             | `?bool`   | `false`            | Membuat title sebagai anchor link         |
| `size`                   | `?string` | `text-2xl`         | Ukuran teks title                         |
| `icon`                   | `?string` | `null`             | Nama icon untuk ditampilkan sebelum title |
| `iconClasses`            | `?string` | `null`             | Class CSS tambahan untuk icon             |
| `middle`                 | `mixed`   | `null`             | Slot untuk konten di bagian tengah        |
| `actions`                | `mixed`   | `null`             | Slot untuk aksi di bagian kanan           |

## Examples

### Basic Header

```blade
<x-jen::header title="Dashboard" />
```

### Header dengan Subtitle dan Icon

```blade
<x-jen::header
    title="User Management"
    subtitle="Manage your application users"
    icon="heroicon-o-users"
    iconClasses="w-8 h-8 text-primary" />
```

### Header dengan Separator

```blade
<x-jen::header
    title="Settings"
    subtitle="Configure your application"
    separator="true" />
```

### Header dengan Anchor Link

```blade
<x-jen::header
    title="Getting Started"
    subtitle="Learn the basics"
    withAnchor="true" />
```

### Header dengan Progress Indicator

```blade
<x-jen::header
    title="Loading Data"
    separator="true"
    progressIndicator="loadData"
    progressIndicatorClass="progress-success" />
```

### Header dengan Actions

```blade
<x-jen::header title="Products">
    <x-jen::slot:actions>
        <x-jen::button label="Add Product" class="btn-primary" />
        <x-jen::button label="Export" class="btn-outline" />
    </x-slot:actions>
</x-jen::header>
```

### Header dengan Middle Content

```blade
<x-jen::header title="Analytics Dashboard">
    <x-jen::slot:middle>
        <select class="select select-bordered w-full max-w-xs">
            <option>Last 7 days</option>
            <option>Last 30 days</option>
            <option>Last 90 days</option>
        </select>
    </x-slot:middle>

    <x-jen::slot:actions>
        <x-jen::button label="Refresh" class="btn-ghost" />
    </x-slot:actions>
</x-jen::header>
```

### Header Lengkap dengan Semua Features

```blade
<x-jen::header
    title="Complete Header Example"
    subtitle="Showing all available features"
    icon="heroicon-o-star"
    iconClasses="w-6 h-6 text-yellow-500"
    size="text-3xl"
    separator="true"
    withAnchor="true"
    progressIndicator="saveData"
    progressIndicatorClass="progress-info"
    class="bg-base-200 p-6 rounded-lg">

    <x-jen::slot:middle>
        <div class="badge badge-primary">New</div>
    </x-slot:middle>

    <x-jen::slot:actions>
        <x-jen::button label="Edit" class="btn-sm btn-outline" />
        <x-jen::button label="Save" class="btn-sm btn-primary" />
    </x-slot:actions>
</x-jen::header>
```

## Styling

Komponen menggunakan class Tailwind CSS dan dapat dikustomisasi:

```blade
<x-jen::header
    title="Custom Styled Header"
    class="bg-gradient-to-r from-blue-500 to-purple-600 text-white p-8 rounded-xl shadow-lg" />
```

## Responsive Design

Header secara otomatis responsif:

-   Pada mobile: Actions dan middle content akan menyesuaikan layout
-   Pada desktop: Layout horizontal dengan spacing yang optimal

## API Compatibility


```blade
<x-jen::mary-header title="Example" subtitle="Test" />

<!-- jen-ui -->
<x-jen::header title="Example" subtitle="Test" />
```

## Dependencies

-   `x-icon` (untuk menampilkan icon)

## Advanced Usage

### Dengan Wire Target Spesifik

```blade
<x-jen::header
    title="Data Processing"
    separator="true"
    progressIndicator="processData,validateData,saveData" />
```

### Dengan Anchor Navigation

```blade
<x-jen::header title="Table of Contents" withAnchor="true" />

{{-- Anchor akan di-generate otomatis sebagai: #table-of-contents --}}
<a href="#table-of-contents">Go to Table of Contents</a>
```

### Dengan Custom Size

```blade
<x-jen::header title="Large Header" size="text-4xl" />
<x-jen::header title="Small Header" size="text-lg" />
```
