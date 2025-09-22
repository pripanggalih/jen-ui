# Tab

Komponen tab yang ringan dan fokus pada performa untuk aplikasi Laravel. Digunakan bersama dengan komponen `x-jen::tabs` untuk membuat interface tabbed yang interaktif.

## Penggunaan Dasar

```blade
<x-jen::tabs wire:model="activeTab">
    <x-jen::tab name="users-tab" label="Users">
        <div>Content untuk tab Users</div>
    </x-jen::tab>
    <x-jen::tab name="settings-tab" label="Settings">
        <div>Content untuk tab Settings</div>
    </x-jen::tab>
</x-jen::tabs>
```

## Properti

| Properti   | Tipe      | Default | Deskripsi                             |
| ---------- | --------- | ------- | ------------------------------------- |
| `id`       | `?string` | `null`  | ID unik untuk tab                     |
| `name`     | `?string` | `null`  | Nama tab yang digunakan untuk kontrol |
| `label`    | `?string` | `null`  | Label yang ditampilkan pada tab       |
| `icon`     | `?string` | `null`  | Nama icon untuk tab                   |
| `disabled` | `bool`    | `false` | Apakah tab ini dinonaktifkan          |
| `hidden`   | `bool`    | `false` | Apakah tab ini disembunyikan          |

## Contoh Penggunaan

### Tab dengan Label Sederhana

```blade
<x-jen::tabs wire:model="myTab">
    <x-jen::tab name="home-tab" label="Home">
        <div>Welcome to home page</div>
    </x-jen::tab>
    <x-jen::tab name="about-tab" label="About">
        <div>About us content</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tab dengan Icon

```blade
<x-jen::tabs wire:model="myTab">
    <x-jen::tab name="dashboard-tab" label="Dashboard" icon="o-home">
        <div>Dashboard content</div>
    </x-jen::tab>
    <x-jen::tab name="profile-tab" label="Profile" icon="user">
        <div>Profile content</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tab dengan Slot Label Kustom (Sesuai Contoh User)

```blade
<x-jen::tabs wire:model="myTab">
    <x-jen::tab name="users-tab">
        <x-slot:label>
            Users
            <x-jen::badge value="3" class="badge-primary badge-sm" />
        </x-slot:label>
        <div>Users</div>
    </x-jen::tab>
    <x-jen::tab name="tricks-tab" label="Tricks">
        <div>Tricks</div>
    </x-jen::tab>
    <x-jen::tab name="musics-tab" label="Musics">
        <div>Musics</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Tab dengan State Disabled dan Hidden

```blade
<x-jen::tabs wire:model="myTab">
    <x-jen::tab name="active-tab" label="Active">
        <div>Active tab content</div>
    </x-jen::tab>
    <x-jen::tab name="disabled-tab" label="Disabled" disabled="true">
        <div>Content ini tidak bisa diakses</div>
    </x-jen::tab>
    <x-jen::tab name="hidden-tab" label="Hidden" hidden="true">
        <div>Tab tersembunyi</div>
    </x-jen::tab>
</x-jen::tabs>
```

### Penggunaan Dengan Livewire

```php
// Component Livewire
class TabDemo extends Component
{
    public string $myTab = 'users-tab';

    public function render()
    {
        return view('livewire.tab-demo');
    }
}
```

```blade
{{-- livewire.tab-demo --}}
<div>
    <p>Tab aktif: {{ $myTab }}</p>

    <x-jen::tabs wire:model="myTab">
        <x-jen::tab name="users-tab" label="Users">
            <div>List pengguna disini</div>
        </x-jen::tab>
        <x-jen::tab name="tricks-tab" label="Tricks">
            <div>Tips dan trik</div>
        </x-jen::tab>
        <x-jen::tab name="musics-tab" label="Musics">
            <div>Playlist musik</div>
        </x-jen::tab>
    </x-jen::tabs>
</div>
```

## Key Features

-   ✅ **Alpine.js Integration**: Seamless state management with Alpine.js
-   ✅ **Icon Support**: Built-in icon integration with jen-ui icon component
-   ✅ **Disabled State**: Support for disabled tabs with proper styling
-   ✅ **Hidden Tabs**: Ability to hide tabs from navigation while keeping content
-   ✅ **Livewire Ready**: Built-in wire:key support for dynamic updates
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Cleanup Handling**: Automatic tab removal on Livewire morph

## Styling

The component uses daisyUI tab classes and can be customized:

```blade
<x-jen::tab name="custom" label="Custom Style" class="bg-primary text-white">
    <p>Custom styled tab content.</p>
</x-jen::tab>
```

## Dependencies

-   `x-jen::icon` (when using icons)
-   Alpine.js (for interactivity)
-   daisyUI (for styling)

## Technical Notes

-   Tab state is managed through Alpine.js `selected` and `tabs` data
-   Each tab automatically registers itself to the tabs array on initialization
-   Livewire morphing cleanup is handled automatically to prevent memory leaks
-   UUIDs are generated for wire:key support using lightweight random string generation
-   The `tabLabel()` method maintains 100% compatibility with Mary UI for seamless migration
