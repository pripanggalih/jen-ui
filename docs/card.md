# Card

A lightweight, performance-focused card component for Laravel applications with support for titles, subtitles, figures, menus, actions, and progress indicators.

```

## Basic Usage

```blade
<x-jen::card title="Basic Card">
    This is the card content.
</x-jen::card>
```

## Properties

| Property            | Type      | Default | Description                               |
| ------------------- | --------- | ------- | ----------------------------------------- |
| `id`                | `?string` | `null`  | ID untuk card                             |
| `title`             | `?string` | `null`  | Judul card                                |
| `subtitle`          | `?string` | `null`  | Subjudul card                             |
| `separator`         | `?bool`   | `false` | Menampilkan pemisah horizontal            |
| `shadow`            | `?bool`   | `false` | Menampilkan shadow effect                 |
| `progressIndicator` | `?string` | `null`  | Progress indicator untuk Livewire loading |
| `menu`              | `mixed`   | `null`  | Slot untuk menu di header                 |
| `actions`           | `mixed`   | `null`  | Slot untuk actions di footer              |
| `figure`            | `mixed`   | `null`  | Slot untuk figure/gambar                  |
| `bodyClass`         | `?string` | `null`  | Class tambahan untuk body card            |

## Examples

### Basic Card

```blade
<x-jen::card title="Simple Card">
    <p>This is a simple card with just a title and content.</p>
</x-jen::card>
```

### Card with Subtitle and Shadow

```blade
<x-jen::card
    title="Card with Subtitle"
    subtitle="This is a subtitle"
    shadow="true">
    <p>Card content goes here.</p>
</x-jen::card>
```

### Card with Figure

```blade
<x-jen::card title="Card with Image">
    <x-jen::slot name="figure">
        <img src="/path/to/image.jpg" alt="Card image" class="w-full h-48 object-cover">
    </x-jen::slot>
    <p>Card content with an image figure.</p>
</x-jen::card>
```

### Card with Menu and Actions

```blade
<x-jen::card
    title="Complete Card"
    subtitle="With all features"
    separator="true"
    shadow="true">

    <x-jen::slot name="menu">
        <x-jen::button icon="ellipsis-vertical" class="btn-ghost btn-sm" />
    </x-jen::slot>

    <p>This card has both menu and actions.</p>

    <x-jen::slot name="actions">
        <x-jen::button label="Cancel" class="btn-ghost" />
        <x-jen::button label="Save" class="btn-primary" />
    </x-jen::slot>
</x-jen::card>
```

### Card with Progress Indicator

```blade
<x-jen::card
    title="Loading Card"
    separator="true"
    progress-indicator="saveData"
    wire:loading.class="opacity-50">

    <p>This card shows progress when wire:loading is active.</p>

    <x-jen::slot name="actions">
        <x-jen::button label="Save Data" wire:click="saveData" />
    </x-jen::slot>
</x-jen::card>
```

### Card with Custom Body Class

```blade
<x-jen::card
    title="Custom Styled Card"
    body-class="bg-gray-50 p-6 rounded"
    shadow="true">
    <p>This card has custom styling for the body section.</p>
</x-jen::card>
```

### Conditional Card Structure

```blade
@if ($showCard)
    <x-jen::card
        :title="$cardTitle"
        :subtitle="$cardSubtitle"
        :separator="$hasSeparator"
        :shadow="$withShadow"
        class="max-w-md mx-auto">

        @if ($hasMenu)
            <x-jen::slot name="menu">
                <x-jen::button icon="cog-6-tooth" class="btn-ghost btn-sm" />
            </x-jen::slot>
        @endif

        <div class="space-y-4">
            {{ $cardContent }}
        </div>

        @if ($hasActions)
            <x-jen::slot name="actions">
                @foreach ($cardActions as $action)
                    <x-jen::button :label="$action['label']" :class="$action['class']" />
                @endforeach
            </x-jen::slot>
        @endif
    </x-jen::card>
@endif
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::card
    title="Custom Styled Card"
    shadow="true"
    class="max-w-lg mx-auto border-2 border-primary">

    <x-jen::slot name="figure">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-32"></div>
    </x-jen::slot>

    <div class="text-center">
        <p>Custom styled card with gradient figure.</p>
    </div>
</x-jen::card>
```

## API Compatibility


```blade
<x-jen::jen::card title="Example" separator="true" shadow="true">
    Card content
</x-jen::card>

<!-- jen-ui -->
<x-jen::card title="Example" separator="true" shadow="true">
    Card content
</x-jen::card>
```

## Dependencies

-   None (standalone component)

## Advanced Usage

### Dynamic Progress Indicator

```blade
<x-jen::card
    title="Upload Progress"
    separator="true"
    :progress-indicator="$uploadInProgress ? 'upload' : null">

    @if ($uploadInProgress)
        <div class="text-center">
            <p>Uploading files...</p>
            <div class="mt-4">
                <progress class="progress progress-primary w-full" :value="$uploadProgress" max="100"></progress>
            </div>
        </div>
    @else
        <p>Ready to upload files.</p>
    @endif

    <x-jen::slot name="actions">
        <x-jen::button
            label="Upload"
            wire:click="startUpload"
            :disabled="$uploadInProgress" />
    </x-jen::slot>
</x-jen::card>
```

### Responsive Card Layout

```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($items as $item)
        <x-jen::card
            :title="$item->title"
            :subtitle="$item->subtitle"
            shadow="true"
            class="h-full">

            <x-jen::slot name="figure">
                <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
            </x-jen::slot>

            <p class="flex-1">{{ $item->description }}</p>

            <x-jen::slot name="actions">
                <x-jen::button label="View Details" wire:click="viewItem({{ $item->id }})" />
            </x-jen::slot>
        </x-jen::card>
    @endforeach
</div>
```
