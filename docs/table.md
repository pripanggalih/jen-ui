# Table

A powerful, lightweight table component for Laravel applications with advanced features like sorting, pagination, row selection, and expandable rows.

## Basic Usage

```blade
<x-jen::table :headers="$headers" :rows="$rows" />
```

## Properties

| Property              | Type                 | Default               | Description                                                                                    |
| --------------------- | -------------------- | --------------------- | ---------------------------------------------------------------------------------------------- |
| `headers`             | `array`              | `[]`                  | Array of header definitions with keys: `key`, `label`, `class`, `sortable`, `hidden`, `format` |
| `rows`                | `array\|ArrayAccess` | `[]`                  | Collection or array of data rows                                                               |
| `id`                  | `?string`            | `null`                | Optional ID for the table component                                                            |
| `striped`             | `?bool`              | `false`               | Enable zebra striping for table rows                                                           |
| `noHeaders`           | `?bool`              | `false`               | Hide table headers                                                                             |
| `selectable`          | `?bool`              | `false`               | Enable row selection with checkboxes                                                           |
| `selectableKey`       | `?string`            | `'id'`                | Key to use for row selection                                                                   |
| `expandable`          | `?bool`              | `false`               | Enable expandable rows                                                                         |
| `expandableKey`       | `?string`            | `'id'`                | Key to use for row expansion                                                                   |
| `expandableCondition` | `mixed`              | `null`                | Condition to show expand icon                                                                  |
| `link`                | `?string`            | `null`                | URL pattern for row linking                                                                    |
| `withPagination`      | `?bool`              | `false`               | Enable pagination                                                                              |
| `perPage`             | `?string`            | `null`                | Wire model for items per page                                                                  |
| `perPageValues`       | `?array`             | `[10, 20, 50, 100]`   | Available per page options                                                                     |
| `sortBy`              | `?array`             | `[]`                  | Current sort configuration                                                                     |
| `rowDecoration`       | `?array`             | `[]`                  | Row CSS class conditions                                                                       |
| `cellDecoration`      | `?array`             | `[]`                  | Cell CSS class conditions                                                                      |
| `showEmptyText`       | `?bool`              | `false`               | Show empty message when no rows                                                                |
| `emptyText`           | `mixed`              | `'No records found.'` | Empty message text                                                                             |
| `containerClass`      | `string`             | `'overflow-x-auto'`   | Container CSS classes                                                                          |
| `noHover`             | `?bool`              | `false`               | Disable row hover effects                                                                      |

## Slots

| Slot        | Description            |
| ----------- | ---------------------- |
| `actions`   | Actions column content |
| `tr`        | Custom row template    |
| `cell`      | Custom cell template   |
| `expansion` | Expandable row content |
| `empty`     | Custom empty state     |
| `footer`    | Table footer content   |

## Examples

### Basic Table

```blade
@php
$headers = [
    ['key' => 'id', 'label' => 'ID'],
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'email', 'label' => 'Email']
];

$users = [
    ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com']
];
@endphp

<x-jen::table :headers="$headers" :rows="$users" />
```

### Sortable Table

```blade
@php
$headers = [
    ['key' => 'name', 'label' => 'Name', 'sortable' => true],
    ['key' => 'email', 'label' => 'Email', 'sortable' => true],
    ['key' => 'created_at', 'label' => 'Created', 'sortable' => false]
];
@endphp

<x-jen::table
    :headers="$headers"
    :rows="$users"
    :sort-by="['column' => 'name', 'direction' => 'asc']" />
```

### Selectable Table

```blade
<x-jen::table
    :headers="$headers"
    :rows="$users"
    selectable
    selectable-key="id"
    wire:model="selected" />
```

### Table with Actions

```blade
<x-jen::table :headers="$headers" :rows="$users">
    @scope('actions', $user)
        <div class="flex gap-2">
            <x-jen::button icon="o-pencil" size="sm" />
            <x-jen::button icon="o-trash" size="sm" />
        </div>
    @endscope
</x-jen::table>
```

### Custom Cell Content

```blade
<x-jen::table :headers="$headers" :rows="$users">
    @scope('cell_name', $user)
        <div class="flex items-center gap-3">
            <x-jen::avatar :image="$user['avatar']" size="sm" />
            <span class="font-bold">{{ $user['name'] }}</span>
        </div>
    @endscope

    @scope('cell_status', $user)
        <x-jen::badge
            :label="$user['status']"
            :class="$user['status'] == 'active' ? 'badge-success' : 'badge-error'" />
    @endscope
</x-jen::table>
```

### Expandable Rows

```blade
<x-jen::table
    :headers="$headers"
    :rows="$users"
    expandable
    expandable-key="id"
    expandable-condition="has_details">

    @scope('expansion', $user)
        <div class="p-4 bg-base-200 rounded-lg">
            <h4 class="font-bold mb-2">Additional Details</h4>
            <p>Phone: {{ $user['phone'] }}</p>
            <p>Address: {{ $user['address'] }}</p>
        </div>
    @endscope
</x-jen::table>
```

### Table with Pagination

```blade
<x-jen::table
    :headers="$headers"
    :rows="$users"
    with-pagination
    per-page="perPage"
    :per-page-values="[5, 10, 25]" />
```

### Formatted Cells

```blade
@php
$headers = [
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'salary', 'label' => 'Salary', 'format' => ['currency', '2', '$']],
    ['key' => 'created_at', 'label' => 'Created', 'format' => ['date', 'Y-m-d']]
];
@endphp

<x-jen::table :headers="$headers" :rows="$users" />
```

### Row and Cell Styling

```blade
@php
$rowDecoration = [
    'bg-red-50' => fn($user) => $user['status'] === 'inactive',
    'bg-green-50' => fn($user) => $user['status'] === 'active'
];

$cellDecoration = [
    'name' => [
        'font-bold' => fn($user) => $user['is_admin']
    ]
];
@endphp

<x-jen::table
    :headers="$headers"
    :rows="$users"
    :row-decoration="$rowDecoration"
    :cell-decoration="$cellDecoration" />
```

### Table with Links

```blade
<x-jen::table
    :headers="$headers"
    :rows="$users"
    link="/users/{id}/edit" />
```

## Key Features

-   ✅ **Sortable Columns**: Click headers to sort data
-   ✅ **Row Selection**: Multi-select with checkboxes
-   ✅ **Expandable Rows**: Show/hide additional content
-   ✅ **Pagination Support**: Built-in pagination integration
-   ✅ **Custom Cell Content**: Use @scope for custom rendering
-   ✅ **Row Linking**: Navigate to details/edit pages
-   ✅ **Conditional Styling**: Dynamic CSS classes
-   ✅ **Format Support**: Currency, date, and custom formatting
-   ✅ **Livewire Ready**: Built-in wire:key and event dispatching
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS with DaisyUI table classes:

```blade
<x-jen::table
    :headers="$headers"
    :rows="$users"
    striped
    class="table-compact"
    container-class="overflow-x-auto border rounded-lg" />
```

## Dependencies

-   `x-jen::icon` (for sort indicators and expand icons)
-   `x-jen::pagination` (when using withPagination)

## Events

The table dispatches several events for interaction:

-   `row-selection`: When individual row is selected/deselected
-   `row-selection-all`: When all rows are selected/deselected
-   `row-click`: When row is clicked (if @row-click attribute is present)

## Livewire Integration

```php
class UserTable extends Component
{
    public array $selected = [];
    public array $sortBy = ['column' => 'name', 'direction' => 'asc'];
    public int $perPage = 10;

    protected $listeners = ['row-selection', 'row-selection-all'];

    public function rowSelection($row, $selected)
    {
        // Handle individual row selection
    }

    public function rowSelectionAll($selected)
    {
        // Handle select all
    }
}
```
