# ListItem

A lightweight, performance-focused list item component for Laravel applications. Perfect for displaying lists of data with avatars, primary and secondary values, and optional actions.

```

## Basic Usage

```blade
<x-jen::list-item :item="$user" />
```

## Properties

| Property         | Type            | Default  | Description                                         |
| ---------------- | --------------- | -------- | --------------------------------------------------- |
| `item`           | `object\|array` | required | Data item to display                                |
| `id`             | `?string`       | `null`   | Unique identifier for the component                 |
| `avatar`         | `string`        | `avatar` | Field name for avatar image or custom slot          |
| `value`          | `string`        | `name`   | Field name for primary value or custom slot         |
| `subValue`       | `?string`       | `''`     | Field name for secondary value or custom slot       |
| `noSeparator`    | `?bool`         | `false`  | Hide the separator line below the item              |
| `noHover`        | `?bool`         | `false`  | Disable hover effect                                |
| `link`           | `?string`       | `null`   | URL to make the item clickable                      |
| `fallbackAvatar` | `?string`       | `null`   | Fallback avatar URL if primary avatar fails to load |
| `actions`        | `mixed`         | `null`   | Slot for action buttons or content                  |

## Examples

### Basic List Item

```blade
<x-jen::list-item
    :item="$user"
    value="name"
    sub-value="email" />
```

### With Custom Avatar Field

```blade
<x-jen::list-item
    :item="$product"
    avatar="image"
    value="title"
    sub-value="description" />
```

### With Link Navigation

```blade
<x-jen::list-item
    :item="$user"
    :link="route('users.show', $user->id)"
    value="name"
    sub-value="email" />
```

### With Fallback Avatar

```blade
<x-jen::list-item
    :item="$user"
    value="name"
    sub-value="email"
    fallback-avatar="/images/default-avatar.png" />
```

### With Actions Slot

```blade
<x-jen::list-item :item="$user" value="name" sub-value="email">
    <x-jen::slot:actions>
        <x-jen::button size="sm" icon="o-pencil" />
        <x-jen::button size="sm" icon="o-trash" color="error" />
    </x-slot:actions>
</x-jen::list-item>
```

### Custom Avatar Slot

```blade
<x-jen::list-item :item="$user" value="name" sub-value="email">
    <x-jen::slot:avatar>
        <div class="avatar online">
            <div class="w-11 rounded-full">
                <img src="{{ $user->avatar }}" />
            </div>
        </div>
    </x-slot:avatar>
</x-jen::list-item>
```

### Custom Value and SubValue Slots

```blade
<x-jen::list-item :item="$order">
    <x-jen::slot:value>
        <span class="font-bold">Order #{{ $order->number }}</span>
    </x-slot:value>

    <x-jen::slot:subValue>
        <span class="text-success">{{ $order->status }}</span> •
        <span class="text-sm">{{ $order->created_at->diffForHumans() }}</span>
    </x-slot:subValue>
</x-jen::list-item>
```

### Without Separator and Hover

```blade
<x-jen::list-item
    :item="$item"
    no-separator
    no-hover
    value="title" />
```

### Complete Example with All Features

```blade
<x-jen::list-item
    :item="$user"
    :id="'user-' . $user->id"
    :link="route('users.show', $user)"
    value="full_name"
    sub-value="email"
    avatar="profile_photo"
    fallback-avatar="/images/default-user.png"
    class="border-l-4 border-primary">

    <x-jen::slot:actions>
        <x-jen::button
            size="sm"
            icon="o-eye"
            :link="route('users.show', $user)" />
        <x-jen::button
            size="sm"
            icon="o-pencil"
            :link="route('users.edit', $user)" />
    </x-slot:actions>
</x-jen::list-item>
```

### List of Items

```blade
<div class="card bg-base-100 shadow-lg">
    <div class="card-body p-0">
        @foreach($users as $user)
            <x-jen::list-item
                :item="$user"
                :link="route('users.show', $user)"
                value="name"
                sub-value="email">

                <x-jen::slot:actions>
                    <x-jen::badge :value="$user->role" />
                </x-slot:actions>
            </x-jen::list-item>
        @endforeach
    </div>
</div>
```

## Styling

The component uses Tailwind CSS classes and can be customized with additional classes:

```blade
<x-jen::list-item
    :item="$user"
    value="name"
    class="bg-primary/10 border-l-4 border-primary" />
```

## API Compatibility


```blade
<x-jen::jen::list-item :item="$user" value="name" />

<!-- jen-ui -->
<x-jen::list-item :item="$user" value="name" />
```

## Dependencies

-   None (standalone component)

## Advanced Usage

### Dynamic Field Names

```blade
@php
    $config = [
        'avatar_field' => 'profile_image',
        'name_field' => 'display_name',
        'desc_field' => 'bio'
    ];
@endphp

<x-jen::list-item
    :item="$user"
    :avatar="$config['avatar_field']"
    :value="$config['name_field']"
    :sub-value="$config['desc_field']" />
```

### Conditional Actions

```blade
<x-jen::list-item :item="$user" value="name" sub-value="email">
    <x-jen::slot:actions>
        @can('view', $user)
            <x-jen::button size="sm" icon="o-eye" :link="route('users.show', $user)" />
        @endcan

        @can('update', $user)
            <x-jen::button size="sm" icon="o-pencil" :link="route('users.edit', $user)" />
        @endcan

        @can('delete', $user)
            <x-jen::button
                size="sm"
                icon="o-trash"
                color="error"
                onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                wire:click="delete({{ $user->id }})" />
        @endcan
    </x-slot:actions>
</x-jen::list-item>
```
