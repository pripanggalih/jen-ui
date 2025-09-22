# TimelineItem

A lightweight, performance-focused timeline item component for Laravel applications. Perfect for creating chronological sequences, process steps, or activity feeds.

## Basic Usage

```blade
<x-jen::timeline-item title="Project Started" />
```

## Properties

| Property      | Type      | Default | Description                          |
| ------------- | --------- | ------- | ------------------------------------ |
| `title`       | `string`  | -       | Main title text (required)           |
| `id`          | `?string` | `null`  | Optional ID for the timeline item    |
| `subtitle`    | `?string` | `null`  | Subtitle text below the title        |
| `description` | `?string` | `null`  | Detailed description content         |
| `icon`        | `?string` | `null`  | Icon name to display in the bullet   |
| `pending`     | `?bool`   | `false` | Whether the item is pending/inactive |
| `first`       | `?bool`   | `false` | Whether this is the first item       |
| `last`        | `?bool`   | `false` | Whether this is the last item        |

## Examples

### Basic Timeline

```blade
<x-jen::timeline-item
    title="Task Completed"
    subtitle="2 hours ago" />
```

### With Icon and Description

```blade
<x-jen::timeline-item
    title="Deployment Successful"
    subtitle="Production"
    description="Application deployed to production environment with zero downtime."
    icon="o-check-circle" />
```

### Timeline Sequence

```blade
<div class="timeline">
    <x-jen::timeline-item
        title="Project Initialized"
        subtitle="January 1, 2025"
        description="Repository created and initial setup completed."
        icon="o-play"
        :first="true" />

    <x-jen::timeline-item
        title="Development Phase"
        subtitle="January 15, 2025"
        description="Core features implemented and tested."
        icon="o-code-bracket" />

    <x-jen::timeline-item
        title="Testing Phase"
        subtitle="February 1, 2025"
        description="Quality assurance testing in progress."
        icon="o-bug-ant-slash"
        :pending="true" />

    <x-jen::timeline-item
        title="Production Release"
        subtitle="TBD"
        description="Final deployment to production environment."
        icon="o-rocket-launch"
        :pending="true"
        :last="true" />
</div>
```

### Pending States

```blade
<x-jen::timeline-item
    title="Awaiting Review"
    subtitle="Pending approval"
    description="Code review requested from team lead."
    icon="o-clock"
    :pending="true" />
```

## Key Features

-   ✅ **Visual Timeline**: Clear chronological representation with connecting lines
-   ✅ **Pending States**: Visual distinction for incomplete or pending items
-   ✅ **Icon Support**: Optional icons in timeline bullets for better visual context
-   ✅ **First/Last Handling**: Proper styling for timeline boundaries
-   ✅ **Livewire Ready**: Built-in wire:loading support and unique keys
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses Tailwind CSS classes for timeline styling:

```blade
<x-jen::timeline-item
    title="Custom Styled Item"
    subtitle="With custom classes"
    class="bg-base-200 p-4 rounded-lg" />
```

## Timeline States

### Active vs Pending

-   **Active** (default): Primary color styling, indicating completed or current items
-   **Pending**: Muted styling for future or incomplete items

### Position Markers

-   **First**: Removes top padding for proper alignment
-   **Last**: Removes connecting line and adjusts spacing

## Dependencies

-   `x-jen::icon` (when using icons)

## Real-world Examples

### Order Tracking

```blade
<div class="max-w-md mx-auto">
    <x-jen::timeline-item
        title="Order Placed"
        subtitle="March 15, 2025 - 10:30 AM"
        description="Your order has been successfully placed and payment confirmed."
        icon="o-shopping-cart"
        :first="true" />

    <x-jen::timeline-item
        title="Processing"
        subtitle="March 15, 2025 - 11:00 AM"
        description="Order is being prepared for shipment."
        icon="o-cog-6-tooth" />

    <x-jen::timeline-item
        title="Shipped"
        subtitle="March 16, 2025 - 9:00 AM"
        description="Package dispatched via Express Delivery. Tracking: EX123456789"
        icon="o-truck" />

    <x-jen::timeline-item
        title="Out for Delivery"
        subtitle="Expected: March 17, 2025"
        description="Package is out for delivery and will arrive today."
        icon="o-map-pin"
        :pending="true"
        :last="true" />
</div>
```

### Project Milestones

```blade
<div class="space-y-0">
    <x-jen::timeline-item
        title="Planning Phase Complete"
        subtitle="Week 1"
        description="Requirements gathered and project scope defined."
        icon="o-document-text"
        :first="true" />

    <x-jen::timeline-item
        title="Design Phase"
        subtitle="Week 2-3"
        description="UI/UX design and system architecture completed."
        icon="o-paint-brush" />

    <x-jen::timeline-item
        title="Development Sprint"
        subtitle="Week 4-8"
        description="Core functionality implementation in progress."
        icon="o-code-bracket"
        :pending="true"
        :last="true" />
</div>
```
