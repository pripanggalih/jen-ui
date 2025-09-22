# DatePicker

A lightweight, performance-focused date picker component for Laravel applications with Flatpickr integration.

```

## Basic Usage

```blade
<x-jen::datepicker label="Select Date" wire:model="date" />
```

## Properties

| Property         | Type      | Default            | Description                                  |
| ---------------- | --------- | ------------------ | -------------------------------------------- |
| `id`             | `?string` | `null`             | HTML element ID                              |
| `label`          | `?string` | `null`             | Input label text                             |
| `icon`           | `?string` | `null`             | Left icon name                               |
| `iconRight`      | `?string` | `null`             | Right icon name                              |
| `hint`           | `?string` | `null`             | Hint text displayed below input              |
| `hintClass`      | `?string` | `'fieldset-label'` | CSS class for hint text                      |
| `inline`         | `?bool`   | `false`            | Use floating label instead of standard label |
| `config`         | `?array`  | `[]`               | Flatpickr configuration options              |
| `prepend`        | `mixed`   | `null`             | Slot for content before input                |
| `append`         | `mixed`   | `null`             | Slot for content after input                 |
| `errorField`     | `?string` | `null`             | Custom error field name (defaults to model)  |
| `errorClass`     | `?string` | `'text-error'`     | CSS class for error messages                 |
| `omitError`      | `?bool`   | `false`            | Skip error message display                   |
| `firstErrorOnly` | `?bool`   | `false`            | Display only first error message             |

## Examples

### Basic Date Picker

```blade
<x-jen::datepicker label="Birth Date" wire:model="birthDate" />
```

### With Icons

```blade
<x-jen::datepicker
    label="Event Date"
    icon="o-calendar-days"
    iconRight="o-clock"
    wire:model="eventDate" />
```

### Date Range Picker

```blade
<x-jen::datepicker
    label="Date Range"
    wire:model="dateRange"
    :config="[
        'mode' => 'range',
        'dateFormat' => 'Y-m-d'
    ]" />
```

### DateTime Picker

```blade
<x-jen::datepicker
    label="Appointment Time"
    wire:model="appointmentTime"
    :config="[
        'enableTime' => true,
        'dateFormat' => 'Y-m-d H:i',
        'time_24hr' => true
    ]" />
```

### Inline Label

```blade
<x-jen::datepicker
    label="Due Date"
    inline
    wire:model="dueDate" />
```

### With Custom Validation

```blade
<x-jen::datepicker
    label="Valid Until"
    wire:model="validUntil"
    errorField="custom_date_field"
    errorClass="text-red-500"
    firstErrorOnly />
```

### With Hint

```blade
<x-jen::datepicker
    label="Deadline"
    hint="Select project deadline date"
    wire:model="deadline" />
```

### Readonly

```blade
<x-jen::datepicker
    label="Created At"
    wire:model="createdAt"
    readonly />
```

### Disabled

```blade
<x-jen::datepicker
    label="System Date"
    wire:model="systemDate"
    disabled />
```

### With Prepend/Append

```blade
<x-jen::datepicker
    label="Booking Date"
    wire:model="bookingDate">

    <x-jen::slot:prepend>
        <div class="join-item btn btn-outline">
            From
        </div>
    </x-slot:prepend>

    <x-jen::slot:append>
        <div class="join-item btn btn-outline">
            To
        </div>
    </x-slot:append>
</x-jen::datepicker>
```

### Advanced Configuration

```blade
<x-jen::datepicker
    label="Advanced Date"
    wire:model="advancedDate"
    :config="[
        'dateFormat' => 'd/m/Y',
        'altFormat' => 'F j, Y',
        'minDate' => 'today',
        'maxDate' => '+30 days',
        'disable' => ['2025-12-25', '2025-01-01'], // Disable specific dates
        'locale' => 'id', // Indonesian locale
        'plugins' => [
            'monthSelect' => ['shorthand' => true],
            'weekSelect' => []
        ]
    ]" />
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::datepicker
    label="Styled Date"
    class="input-primary"
    wire:model="styledDate" />
```

## Flatpickr Configuration

The `config` array accepts all Flatpickr options:

```php
[
    'dateFormat' => 'Y-m-d',        // Date format
    'altFormat' => 'F j, Y',        // Alternative display format
    'mode' => 'single',             // single, multiple, range
    'enableTime' => false,          // Enable time selection
    'time_24hr' => true,           // 24 hour time format
    'minDate' => 'today',          // Minimum selectable date
    'maxDate' => '+1 year',        // Maximum selectable date
    'disable' => [],               // Disabled dates array
    'locale' => 'default',         // Locale for internationalization
    'plugins' => []                // Flatpickr plugins
]
```

## JavaScript Events

The component emits standard Flatpickr events:

```javascript
// Listen for date changes
document.addEventListener("change", function (e) {
    if (e.target.matches('[wire\\:model*="date"]')) {
        console.log("Date changed:", e.target.value);
    }
});
```

## API Compatibility


```blade
<x-jen::mary-datepicker label="Date" wire:model="date" />

<!-- jen-ui -->
<x-jen::datepicker label="Date" wire:model="date" />
```

## Dependencies

-   `x-icon` component (automatically installed)
-   Flatpickr JavaScript library (include via CDN or npm)

## CDN Installation

Add Flatpickr via CDN to your layout:

```html
<!-- CSS -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"
/>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Optional: Plugins and Themes -->
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/material_blue.css"
/>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
```
