# DateTime

Komponen input tanggal dan waktu yang ringan dan fokus pada performa untuk aplikasi Laravel.

## Instalasi

```bash
```

## Penggunaan Dasar

```blade
<x-jen::datetime label="Pilih Tanggal" />
```

## Properti

| Property         | Type      | Default            | Description                             |
| ---------------- | --------- | ------------------ | --------------------------------------- |
| `id`             | `?string` | `null`             | ID untuk elemen input                   |
| `label`          | `?string` | `null`             | Label untuk input                       |
| `icon`           | `?string` | `null`             | Ikon di sisi kiri input                 |
| `iconRight`      | `?string` | `null`             | Ikon di sisi kanan input                |
| `hint`           | `?string` | `null`             | Teks bantuan di bawah input             |
| `hintClass`      | `?string` | `'fieldset-label'` | Class CSS untuk teks bantuan            |
| `inline`         | `?bool`   | `false`            | Apakah label menggunakan style floating |
| `prepend`        | `mixed`   | `null`             | Konten yang ditambahkan sebelum input   |
| `append`         | `mixed`   | `null`             | Konten yang ditambahkan setelah input   |
| `errorField`     | `?string` | `null`             | Nama field untuk validasi error         |
| `errorClass`     | `?string` | `'text-error'`     | Class CSS untuk pesan error             |
| `omitError`      | `?bool`   | `false`            | Sembunyikan pesan error                 |
| `firstErrorOnly` | `?bool`   | `false`            | Tampilkan hanya error pertama           |

## Contoh

### Contoh Dasar

```blade
<x-jen::datetime label="Tanggal Lahir" />
```

### Dengan Ikon dan Hint

```blade
<x-jen::datetime
    label="Tanggal Meeting"
    icon="calendar"
    hint="Pilih tanggal yang tersedia"
    wire:model="meetingDate" />
```

### Label Floating

```blade
<x-jen::datetime
    label="Tanggal Mulai"
    icon="calendar"
    inline="true"
    wire:model="startDate" />
```

### Dengan Validasi

```blade
<x-jen::datetime
    label="Tanggal Berakhir"
    icon="calendar"
    required
    wire:model="endDate"
    error-field="endDate" />

@error('endDate')
    <span class="text-error">{{ $message }}</span>
@enderror
```

### Dengan Prepend dan Append

```blade
<x-jen::datetime
    label="Periode"
    wire:model="period">
    <x-jen::slot:prepend>
        <span class="btn btn-outline">Dari</span>
    </x-slot:prepend>
    <x-jen::slot:append>
        <span class="btn btn-outline">Sampai</span>
    </x-slot:append>
</x-jen::datetime>
```

### Input DateTime (Date + Time)

```blade
<x-jen::datetime
    label="Waktu Appointment"
    icon="clock"
    type="datetime-local"
    wire:model="appointmentDateTime" />
```

### Readonly State

```blade
<x-jen::datetime
    label="Created At"
    readonly
    wire:model="createdAt" />
```

## Styling

Komponen ini menggunakan kelas Tailwind CSS dan dapat dikustomisasi dengan:

```blade
<x-jen::datetime
    label="Custom Styled"
    class="input-lg input-primary"
    hint-class="text-info text-sm" />
```

## Kompatibilitas API


```blade
<x-jen::jen::datetime label="Tanggal" />

<!-- jen-ui -->
<x-jen::datetime label="Tanggal" />
```

## Performa

-   ✅ **Laravel native attribute merge** untuk performa optimal
-   ✅ **Tidak ada caching berlebihan** - komputasi langsung untuk operasi sederhana
-   ✅ **Optimasi template** melalui caching pemanggilan method
-   ✅ **UUID generation ringan** dengan `Str::random()`

## Dependencies

-   `x-icon` (untuk ikon kiri dan kanan)

## Tips Penggunaan

### 1. **Input Types yang Didukung**

```blade
{{-- Date input --}}
<x-jen::datetime type="date" />

{{-- DateTime input --}}
<x-jen::datetime type="datetime-local" />

{{-- Time input --}}
<x-jen::datetime type="time" />

{{-- Month input --}}
<x-jen::datetime type="month" />

{{-- Week input --}}
<x-jen::datetime type="week" />
```

### 2. **Livewire Integration**

```blade
<x-jen::datetime
    label="Event Date"
    wire:model.live="eventDate"
    wire:change="updateSchedule" />
```

### 3. **Custom Error Handling**

```blade
<x-jen::datetime
    label="Due Date"
    wire:model="dueDate"
    error-field="custom_due_date"
    first-error-only="true" />
```

### 4. **Responsive Design**

```blade
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <x-jen::datetime label="Start Date" wire:model="startDate" />
    <x-jen::datetime label="End Date" wire:model="endDate" />
</div>
```
