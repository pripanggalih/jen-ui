# Calendar

A lightweight, performance-focused calendar component for Laravel applications powered by VanillaCalendar.

```

## Basic Usage

```blade
<x-jen::calendar />
```

## Properties

| Property           | Type      | Default   | Description                                             |
| ------------------ | --------- | --------- | ------------------------------------------------------- |
| `id`               | `?string` | `null`    | Unique identifier for the calendar instance             |
| `months`           | `?int`    | `1`       | Number of months to display (1 = single, >1 = multiple) |
| `locale`           | `?string` | `'en-EN'` | Language locale for calendar display                    |
| `weekendHighlight` | `?bool`   | `false`   | Whether to highlight weekend days                       |
| `sundayStart`      | `?bool`   | `false`   | Whether to start week on Sunday (false = Monday start)  |
| `config`           | `?array`  | `[]`      | Additional VanillaCalendar configuration options        |
| `events`           | `?array`  | `[]`      | Array of events to display on specific dates            |

## Examples

### Basic Calendar

```blade
<x-jen::calendar />
```

### Multiple Months

```blade
<x-jen::calendar :months="3" />
```

### Localized Calendar

```blade
<x-jen::calendar
    locale="id-ID"
    :weekend-highlight="true"
    :sunday-start="true" />
```

### Calendar with Events

```blade
<x-jen::calendar :events="[
    [
        'date' => '2025-09-20',
        'label' => 'Meeting',
        'description' => 'Team standup meeting',
        'css' => 'event-meeting'
    ],
    [
        'range' => ['2025-09-25', '2025-09-27'],
        'label' => 'Conference',
        'description' => 'Laravel conference',
        'css' => 'event-conference'
    ]
]" />
```

### Advanced Configuration

```blade
<x-jen::calendar
    :months="2"
    locale="id-ID"
    :weekend-highlight="true"
    :config="[
        'settings' => [
            'selection' => [
                'day' => 'multiple-ranged'
            ]
        ]
    ]"
    class="shadow-lg rounded-lg" />
```

## Event Structure

Events can be defined as arrays with the following structure:

### Single Date Event

```php
[
    'date' => '2025-09-20',           // Required: Date in Y-m-d format
    'label' => 'Event Title',        // Required: Event title
    'description' => 'Details...',   // Optional: Event description
    'css' => 'custom-class'          // Optional: CSS class for styling
]
```

### Date Range Event

```php
[
    'range' => ['2025-09-25', '2025-09-27'],  // Required: Start and end dates
    'label' => 'Multi-day Event',            // Required: Event title
    'description' => 'Spanning multiple days', // Optional: Event description
    'css' => 'range-event'                   // Optional: CSS class for styling
]
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::calendar
    :months="2"
    class="bg-white shadow-xl rounded-lg p-4" />
```

You can also style events using CSS classes:

```css
.vanilla-calendar .event-meeting {
    background-color: #3b82f6;
    color: white;
}

.vanilla-calendar .event-conference {
    background-color: #10b981;
    color: white;
}
```

## API Compatibility


```blade
<x-jen::jen::calendar
    :months="2"
    locale="id-ID"
    :events="$events" />

<!-- jen-ui -->
<x-jen::calendar
    :months="2"
    locale="id-ID"
    :events="$events" />
```

## Dependencies

-   **VanillaCalendar** JavaScript library (required for calendar functionality)
-   **Carbon/CarbonPeriod** (for date range processing)
-   None (no jen-ui component dependencies)

## JavaScript Requirements

This component requires VanillaCalendar JavaScript library. Make sure to include it in your project:

```html
<!-- Add to your layout -->
<script src="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/build/vanilla-calendar.min.js"></script>
<link
    href="https://cdn.jsdelivr.net/npm/vanilla-calendar-pro/build/vanilla-calendar.min.css"
    rel="stylesheet"
/>
```

Or install via npm:

```bash
npm install vanilla-calendar-pro
```
