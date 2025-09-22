# Tabs

Komponen container untuk membuat interface tabbed yang interaktif dengan Alpine.js. Bekerja bersama dengan komponen `x-jen::tab` untuk menampilkan konten dalam bentuk tab.

## Penggunaan Dasar

```blade
<x-jen::tabs wire:model="activeTab">
    <x-jen::tab name="tab1" label="First Tab">
        Content untuk tab pertama
    </x-jen::tab>
    <x-jen::tab name="tab2" label="Second Tab">
        Content untuk tab kedua
    </x-jen::tab>
</x-jen::tabs>
```

## Properti

| Properti        | Tipe      | Default                                                                           | Deskripsi                       |
| --------------- | --------- | --------------------------------------------------------------------------------- | ------------------------------- |
| `id`            | `?string` | `null`                                                                            | ID unik untuk container tabs    |
| `selected`      | `?string` | `null`                                                                            | Tab yang dipilih secara default |
| `labelClass`    | `string`  | `'font-semibold pb-1'`                                                            | Kelas CSS untuk label tab       |
| `activeClass`   | `string`  | `'border-b-[length:var(--border)] border-b-base-content/50'`                      | Kelas CSS untuk tab yang aktif  |
| `labelDivClass` | `string`  | `'border-b-[length:var(--border)] border-b-base-content/10 flex overflow-x-auto'` | Kelas CSS untuk container label |
| `tabsClass`     | `string`  | `'relative w-full'`                                                               | Kelas CSS untuk container utama |

## Contoh Penggunaan

### Tabs Dasar dengan Livewire

```blade
{{-- Di component Livewire --}}
public string $currentTab = 'home';

{{-- Di template blade --}}
<x-jen::tabs wire:model="currentTab">
    <x-jen::tab name="home" label="Home">
        <div>Welcome to home!</div>
    </x-jen::tab>
    <x-jen::tab name="about" label="About">
        <div>About us information</div>
    </x-jen::tab>
    <x-jen::tab name="contact" label="Contact">
        <div>Contact information</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tabs dengan Tab Terpilih Default

```blade
<x-jen::tabs selected="profile">
    <x-jen::tab name="dashboard" label="Dashboard">
        <div>Dashboard content</div>
    </x-jen::tab>
    <x-jen::tab name="profile" label="Profile">
        <div>Profile akan menjadi tab default</div>
    </x-jen::tab>
    <x-jen::tab name="settings" label="Settings">
        <div>Settings content</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tabs dengan Icon dan Badge (Contoh User)

```blade
<x-jen::tabs wire:model="myTab">
    <x-jen::tab name="users-tab">
        <x-slot:label>
            Users
            <x-jen::badge value="3" class="badge-primary badge-sm" />
        </x-slot:label>
        <div>List pengguna dengan 3 item</div>
    </x-jen::tab>
    <x-jen::tab name="tricks-tab" label="Tricks">
        <div>Tips dan trik</div>
    </x-jen::tab>
    <x-jen::tab name="musics-tab" label="Musics">
        <div>Playlist musik</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tabs dengan Custom Styling

```blade
<x-jen::tabs
    wire:model="styledTab"
    labelClass="font-bold text-lg p-3"
    activeClass="border-b-4 border-primary text-primary"
    labelDivClass="bg-base-200 rounded-t-lg flex overflow-x-auto">

    <x-jen::tab name="custom1" label="Custom 1">
        <div>Tab dengan styling custom</div>
    </x-jen::tab>
    <x-jen::tab name="custom2" label="Custom 2">
        <div>Tab kedua dengan styling yang sama</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tabs dengan State Management

```php
// Di Livewire component
class MyComponent extends Component
{
    public string $activeTab = 'overview';

    public function switchToSettings()
    {
        $this->activeTab = 'settings';
    }

    public function render()
    {
        return view('my-component');
    }
}
```

```blade
{{-- my-component.blade.php --}}
<div>
    <div class="mb-4">
        <p>Tab saat ini: {{ $activeTab }}</p>
        <button wire:click="switchToSettings" class="btn btn-sm">Go to Settings</button>
    </div>

    <x-jen::tabs wire:model="activeTab">
        <x-jen::tab name="overview" label="Overview">
            <div>Dashboard overview content</div>
        </x-jen::tab>
        <x-jen::tab name="analytics" label="Analytics" icon="chart">
            <div>Analytics dan statistik</div>
        </x-jen::tab>
        <x-jen::tab name="settings" label="Settings" icon="cog">
            <div>Pengaturan aplikasi</div>
        </x-jen::tab>
    </x-jen::tabs>
</div>
```

### Tabs dengan Disabled dan Hidden State

```blade
<x-jen::tabs wire:model="complexTab">
    <x-jen::tab name="public" label="Public Content">
        <div>Konten yang bisa diakses semua orang</div>
    </x-jen::tab>

    <x-jen::tab name="premium" label="Premium" disabled="true">
        <div>Konten premium (disabled)</div>
    </x-jen::tab>

    <x-jen::tab name="admin" label="Admin Panel" hidden="true">
        <div>Panel admin (hidden dari navigasi)</div>
    </x-jen::tab>
</x-jen::tabs>
```

## Fitur Utama

-   ✅ **Alpine.js Integration**: State management yang efisien dengan Alpine.js
-   ✅ **Livewire Ready**: Dukungan penuh untuk wire:model dan reactivity
-   ✅ **Responsive Design**: Overflow horizontal untuk banyak tab
-   ✅ **Custom Styling**: Semua aspek visual bisa dikustomisasi
-   ✅ **Dynamic Content**: Tab dapat ditambah/hapus secara dinamis
-   ✅ **Auto Discovery**: Bekerja otomatis tanpa registrasi manual
-   ✅ **Keyboard Navigation**: Mendukung navigasi dengan keyboard
-   ✅ **Mobile Friendly**: Scroll horizontal untuk layar kecil

## State Management

Komponen ini menggunakan Alpine.js untuk mengelola state tab:

-   `tabs[]` - Array yang berisi semua tab yang terdaftar
-   `selected` - String nama tab yang sedang aktif
-   Tab secara otomatis mendaftarkan diri ke array `tabs`
-   Cleanup otomatis saat Livewire morphing

## Styling

Komponen menggunakan DaisyUI dan Tailwind CSS:

```blade
<!-- Custom styling example -->
<x-jen::tabs
    class="bg-white rounded-lg shadow-lg"
    labelClass="px-4 py-2 font-medium hover:bg-gray-100"
    activeClass="border-b-2 border-blue-500 text-blue-600 bg-blue-50">
    <!-- tabs content -->
</x-jen::tabs>
```

## Dependencies

-   `x-jen::tab` (komponen anak wajib)
-   Alpine.js (untuk interaktivitas)
-   DaisyUI/Tailwind CSS (untuk styling)

## Kompatibilitas Mary UI

Komponen ini 100% kompatibel dengan Mary UI:

```blade
<!-- Mary UI -->
<x-mary::tabs wire:model="myTab" labelClass="font-bold">
    <x-mary::tab name="tab1" label="Tab 1">Content</x-mary::tab>
</x-mary::tabs>

<!-- Jen UI (drop-in replacement) -->
<x-jen::tabs wire:model="myTab" labelClass="font-bold">
    <x-jen::tab name="tab1" label="Tab 1">Content</x-jen::tab>
</x-jen::tabs>
```

## Browser Support

-   Modern browsers dengan dukungan Alpine.js
-   Progressive enhancement untuk browser yang tidak mendukung JavaScript
-   Mobile responsive dengan touch support
