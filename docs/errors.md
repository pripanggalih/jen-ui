# Errors

Komponen untuk menampilkan error messages dari Laravel validation dengan styling yang konsisten dan icon support.

```

## Basic Usage

```blade
<x-jen::errors />
```

## Properties

| Property      | Type      | Default        | Description                                  |
| ------------- | --------- | -------------- | -------------------------------------------- |
| `id`          | `?string` | `null`         | ID unik untuk komponen                       |
| `title`       | `?string` | `null`         | Judul yang ditampilkan di bagian atas error  |
| `description` | `?string` | `null`         | Deskripsi tambahan di bawah title            |
| `icon`        | `?string` | `'o-x-circle'` | Icon yang ditampilkan (hanya jika ada title) |
| `only`        | `?array`  | `[]`           | Array untuk filter error spesifik            |

## Examples

### Basic Usage

```blade
{{-- Menampilkan semua error dari validation --}}
<x-jen::errors />
```

### With Title and Description

```blade
<x-jen::errors
    title="Validation Failed"
    description="Please fix the following errors:" />
```

### Custom Icon

```blade
<x-jen::errors
    title="Form Errors"
    icon="o-exclamation-triangle" />
```

### With Custom Styling

```blade
<x-jen::errors
    title="Registration Errors"
    class="mb-4 shadow-lg" />
```

### Complete Example with Form

```blade
<form method="POST" action="{{ route('users.store') }}">
    @csrf

    {{-- Display validation errors --}}
    <x-jen::errors
        title="Please fix these errors"
        description="All fields are required"
        class="mb-6" />

    <div class="form-control">
        <label class="label">Name</label>
        <input type="text" name="name" class="input input-bordered" />
    </div>

    <div class="form-control">
        <label class="label">Email</label>
        <input type="email" name="email" class="input input-bordered" />
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
```

## Conditional Display

Komponen hanya akan ditampilkan jika ada validation errors:

```blade
{{-- Ini hanya akan muncul jika $errors->any() returns true --}}
<x-jen::errors title="Form has errors" />

{{-- Konten lain akan tetap ditampilkan --}}
<div class="form-content">
    <!-- Form fields -->
</div>
```

## Styling

Komponen menggunakan daisyUI classes dan dapat dikustomisasi:

```blade
<x-jen::errors
    title="Custom Styled Errors"
    class="alert-warning rounded-lg shadow-xl" />
```

## API Compatibility


```blade
<x-jen::jen::errors title="Validation Errors" />

<!-- jen-ui -->
<x-jen::errors title="Validation Errors" />
```

## Dependencies

-   `x-icon` (untuk menampilkan icon)

## Error Bag Integration

Komponen secara otomatis menggunakan Laravel's error bag:

```php
// Controller
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
    ]);

    // Jika validation gagal, errors akan ditampilkan di template
}
```

```blade
{{-- Template akan menampilkan error dari validation di atas --}}
<x-jen::errors title="Please fix these issues" />
```
