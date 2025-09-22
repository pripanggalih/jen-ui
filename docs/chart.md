# Chart

A lightweight, performance-focused chart component for Laravel applications using Chart.js.

```

## Basic Usage

```blade
<x-jen::chart wire:model="chartData" />
```

## Properties

| Property | Type      | Default | Description                                     |
| -------- | --------- | ------- | ----------------------------------------------- |
| `id`     | `?string` | `null`  | Optional ID for the chart component for styling |

## Examples

### Basic Bar Chart

```blade
<div wire:model="chartData">
    <x-jen::chart wire:model="chartData" />
</div>
```

```php
// In your Livewire component
public $chartData = [
    'type' => 'bar',
    'data' => [
        'labels' => ['January', 'February', 'March', 'April'],
        'datasets' => [[
            'label' => 'Sales',
            'data' => [65, 59, 80, 81],
            'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
            'borderColor' => 'rgb(59, 130, 246)',
            'borderWidth' => 1
        ]]
    ],
    'options' => [
        'responsive' => true,
        'scales' => [
            'y' => [
                'beginAtZero' => true
            ]
        ]
    ]
];
```

### Line Chart with Custom Styling

```blade
<x-jen::chart
    wire:model="lineChartData"
    id="sales-chart"
    class="bg-white p-4 rounded-lg shadow-lg" />
```

```php
public $lineChartData = [
    'type' => 'line',
    'data' => [
        'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
        'datasets' => [[
            'label' => 'Revenue',
            'data' => [1200, 1900, 3000, 5000, 2300],
            'borderColor' => 'rgb(34, 197, 94)',
            'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
            'tension' => 0.4
        ]]
    ],
    'options' => [
        'responsive' => true,
        'plugins' => [
            'title' => [
                'display' => true,
                'text' => 'Monthly Revenue'
            ]
        ]
    ]
];
```

### Pie Chart

```blade
<x-jen::chart wire:model="pieChartData" />
```

```php
public $pieChartData = [
    'type' => 'pie',
    'data' => [
        'labels' => ['Desktop', 'Mobile', 'Tablet'],
        'datasets' => [[
            'data' => [45, 35, 20],
            'backgroundColor' => [
                'rgb(239, 68, 68)',
                'rgb(59, 130, 246)',
                'rgb(34, 197, 94)'
            ]
        ]]
    ],
    'options' => [
        'responsive' => true,
        'plugins' => [
            'legend' => [
                'position' => 'bottom'
            ]
        ]
    ]
];
```

### Dynamic Chart Updates

```blade
<div>
    <button wire:click="updateChart" class="btn btn-primary">Update Data</button>
    <x-jen::chart wire:model="dynamicChartData" class="mt-4" />
</div>
```

```php
public $dynamicChartData = [
    'type' => 'bar',
    'data' => [
        'labels' => ['A', 'B', 'C', 'D'],
        'datasets' => [[
            'label' => 'Dynamic Data',
            'data' => [10, 20, 30, 40],
            'backgroundColor' => 'rgba(99, 102, 241, 0.5)'
        ]]
    ]
];

public function updateChart()
{
    $this->dynamicChartData['data']['datasets'][0]['data'] = [
        rand(10, 100),
        rand(10, 100),
        rand(10, 100),
        rand(10, 100)
    ];
}
```

## Chart.js Requirements

Make sure to include Chart.js in your project. Add this to your layout:

```blade
<!-- In your layout file -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

Or install via NPM:

```bash
npm install chart.js
```

Then import in your app.js:

```javascript
import Chart from "chart.js/auto";
window.Chart = Chart;
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::chart
    wire:model="chartData"
    class="bg-base-100 shadow-lg rounded-box p-6" />
```

## API Compatibility


```blade
<x-jen::jen::chart wire:model="chartData" />

<!-- jen-ui -->
<x-jen::chart wire:model="chartData" />
```

## Dependencies

-   Chart.js (JavaScript library)
-   Alpine.js (included with Livewire)
-   Livewire (for data binding)

## Chart Types Supported

All Chart.js chart types are supported:

-   Line charts
-   Bar charts
-   Pie charts
-   Doughnut charts
-   Radar charts
-   Polar area charts
-   Bubble charts
-   Scatter plots

## Configuration Options

The chart component accepts all Chart.js configuration options through the wire:model data. See the [Chart.js documentation](https://www.chartjs.org/docs/latest/) for complete configuration reference.
