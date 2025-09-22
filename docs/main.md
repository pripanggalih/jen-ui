# Main

Komponen layout utama yang ringan dan fokus performa untuk aplikasi Laravel dengan dukungan sidebar yang dapat diciutkan, footer opsional, dan responsive design.

```

## Basic Usage

```blade
<x-jen::main>
    <x-jen::slot:content>
        <h1>Konten utama di sini</h1>
        <p>Ini adalah area konten utama aplikasi.</p>
    </x-slot:content>
</x-jen::main>
```

## Properties

| Property       | Type      | Default                   | Description                           |
| -------------- | --------- | ------------------------- | ------------------------------------- |
| `sidebar`      | `mixed`   | `null`                    | Slot untuk konten sidebar             |
| `content`      | `mixed`   | `null`                    | Slot untuk konten utama               |
| `footer`       | `mixed`   | `null`                    | Slot untuk footer (opsional)          |
| `fullWidth`    | `?bool`   | `false`                   | Apakah layout menggunakan lebar penuh |
| `withNav`      | `?bool`   | `false`                   | Mengaktifkan mode dengan navigasi     |
| `collapseText` | `?string` | `'Collapse'`              | Teks untuk tombol collapse sidebar    |
| `collapseIcon` | `?string` | `'o-bars-3-bottom-right'` | Icon untuk tombol collapse sidebar    |
| `collapsible`  | `?bool`   | `false`                   | Apakah sidebar dapat diciutkan        |

## Examples

### Basic Layout

```blade
<x-jen::main>
    <x-jen::slot:content>
        <div class="prose max-w-none">
            <h1>Dashboard</h1>
            <p>Selamat datang di dashboard aplikasi.</p>
        </div>
    </x-slot:content>
</x-jen::main>
```

### With Sidebar

```blade
<x-jen::main>
    <x-jen::slot:sidebar drawer="main-drawer" collapsible="true">
        <x-jen::menu>
            <x-jen::menu-item title="Dashboard" />
            <x-jen::menu-item title="Profile" />
            <x-jen::menu-item title="Settings" />
        </x-jen::menu>
    </x-slot:sidebar>

    <x-jen::slot:content>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Dashboard</h1>
            <label for="main-drawer" class="btn btn-square btn-ghost lg:hidden">
                <x-jen::icon name="bars-3" class="w-6 h-6" />
            </label>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Konten dashboard -->
        </div>
    </x-slot:content>
</x-jen::main>
```

### With Footer

```blade
<x-jen::main>
    <x-jen::slot:content>
        <div class="min-h-screen">
            <h1>Konten Aplikasi</h1>
            <p>Ini adalah konten utama dengan footer.</p>
        </div>
    </x-slot:content>

    <x-jen::slot:footer>
        <div class="py-8 text-center border-t">
            <p class="text-base-content/70">
                © 2025 Aplikasi Anda. Semua hak cipta dilindungi.
            </p>
        </div>
    </x-slot:footer>
</x-jen::main>
```

### Full Width Layout

```blade
<x-jen::main full-width="true">
    <x-jen::slot:content>
        <div class="hero min-h-screen">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <h1 class="text-5xl font-bold">Hello there!</h1>
                    <p class="py-6">Layout lebar penuh tanpa batasan max-width.</p>
                </div>
            </div>
        </div>
    </x-slot:content>
</x-jen::main>
```

### Advanced Layout with Navigation

```blade
<x-jen::main with-nav="true">
    <x-jen::slot:sidebar drawer="nav-drawer" collapsible="true" collapse-text="Tutup">
        <div class="p-4">
            <h2 class="text-xl font-bold mb-4">Menu</h2>
            <x-jen::menu>
                <x-jen::menu-item title="Beranda" icon="home" />
                <x-jen::menu-item title="Produk" icon="cube" />
                <x-jen::menu-item title="Kontak" icon="phone" />
            </x-jen::menu>
        </div>
    </x-slot:sidebar>

    <x-jen::slot:content>
        <div class="container mx-auto">
            <h1 class="text-4xl font-bold mb-8">Selamat Datang</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Konten aplikasi -->
            </div>
        </div>
    </x-slot:content>

    <x-jen::slot:footer>
        <footer class="bg-base-200 py-10">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">Tentang Kami</h3>
                    <p>Deskripsi singkat tentang perusahaan atau aplikasi.</p>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="link">Beranda</a></li>
                        <li><a href="#" class="link">Layanan</a></li>
                        <li><a href="#" class="link">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-4">Kontak</h3>
                    <p>Email: info@example.com</p>
                    <p>Phone: +62 123 456 789</p>
                </div>
            </div>
        </footer>
    </x-slot:footer>
</x-jen::main>
```

## Conditional Usage

```blade
@if (auth()->check())
    <x-jen::main>
        <x-jen::slot:sidebar drawer="auth-drawer" collapsible="true">
            <!-- Menu untuk user yang sudah login -->
        </x-slot:sidebar>

        <x-jen::slot:content>
            <!-- Dashboard content -->
        </x-slot:content>
    </x-jen::main>
@else
    <x-jen::main full-width="true">
        <x-jen::slot:content>
            <!-- Landing page content -->
        </x-slot:content>
    </x-jen::main>
@endif
```

## Styling

Komponen menggunakan kelas Tailwind CSS dan DaisyUI dan dapat dikustomisasi:

```blade
<x-jen::main class="bg-gradient-to-br from-primary to-secondary">
    <x-jen::slot:content class="text-primary-content">
        <h1>Layout dengan styling kustom</h1>
    </x-slot:content>
</x-jen::main>
```

## Sidebar Attributes

Slot sidebar mendukung atribut khusus:

-   `drawer` - ID untuk drawer toggle
-   `collapsible` - Mengaktifkan tombol collapse
-   `collapse-text` - Teks custom untuk tombol collapse
-   `collapse-icon` - Icon custom untuk tombol collapse
-   `right` - Posisi sidebar di sebelah kanan (desktop)
-   `right-mobile` - Posisi sidebar di sebelah kanan (mobile)

```blade
<x-jen::slot:sidebar
    drawer="custom-drawer"
    collapsible="true"
    collapse-text="Sembunyikan"
    collapse-icon="chevron-left"
    right="true">
    <!-- Sidebar content -->
</x-slot:sidebar>
```

## API Compatibility


```blade
<x-jen::jen::main>
    <x-jen::slot:content>Konten</x-slot:content>
</x-jen::main>

<!-- jen-ui -->
<x-jen::main>
    <x-jen::slot:content>Konten</x-slot:content>
</x-jen::main>
```

## Dependencies

-   Route `jen.toggle-sidebar` (otomatis diinstal)
-   Component `x-menu` dan `x-menu-item` (jika menggunakan sidebar collapsible)

## Session Management

Komponen automatically mengelola state sidebar menggunakan Laravel session:

-   Key: `jen-sidebar-collapsed`
-   Values: `'true'` atau `'false'`
-   Default: `'false'`

State ini dipertahankan antar page load untuk pengalaman user yang konsisten.
