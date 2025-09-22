# Step

A lightweight, performance-focused step component for Laravel applications, designed for wizard interfaces and multi-step workflows.

## Basic Usage

```blade
<x-jen::step :step="1" text="First Step">
    <p>Content for the first step</p>
</x-jen::step>
```

## Properties

| Property      | Type      | Default | Description                                 |
| ------------- | --------- | ------- | ------------------------------------------- |
| `step`        | `int`     | -       | The step number (required)                  |
| `text`        | `string`  | -       | The step description text (required)        |
| `id`          | `?string` | `null`  | Optional HTML ID for the step               |
| `icon`        | `?string` | `null`  | Optional icon name to display with the step |
| `stepClasses` | `?string` | `null`  | Additional CSS classes for step styling     |
| `dataContent` | `?string` | `null`  | Optional data content for the step          |

## Examples

### Basic Step Sequence

```blade
<div x-data="{ current: '1', steps: [] }">
    <x-jen::step :step="1" text="Personal Info">
        <div class="space-y-4">
            <input type="text" placeholder="Full Name" class="input input-bordered w-full">
            <input type="email" placeholder="Email" class="input input-bordered w-full">
        </div>
    </x-jen::step>

    <x-jen::step :step="2" text="Account Setup">
        <div class="space-y-4">
            <input type="text" placeholder="Username" class="input input-bordered w-full">
            <input type="password" placeholder="Password" class="input input-bordered w-full">
        </div>
    </x-jen::step>

    <x-jen::step :step="3" text="Confirmation">
        <div class="text-center">
            <p>Please review your information before proceeding.</p>
        </div>
    </x-jen::step>
</div>
```

### With Icons

```blade
<div x-data="{ current: '1', steps: [] }">
    <x-jen::step :step="1" text="Profile" icon="user">
        <p>Set up your profile information</p>
    </x-jen::step>

    <x-jen::step :step="2" text="Settings" icon="cog">
        <p>Configure your account settings</p>
    </x-jen::step>

    <x-jen::step :step="3" text="Complete" icon="check">
        <p>Finish your setup</p>
    </x-jen::step>
</div>
```

### With Custom Styling

```blade
<div x-data="{ current: '1', steps: [] }">
    <x-jen::step
        :step="1"
        text="Important Step"
        stepClasses="bg-warning text-warning-content"
        class="p-6 rounded-lg border">
        <p>This is an important step that requires attention.</p>
    </x-jen::step>
</div>
```

### With Data Content

```blade
<div x-data="{ current: '1', steps: [] }">
    <x-jen::step
        :step="1"
        text="Data Processing"
        dataContent="processing-data"
        icon="database">
        <p>Processing your data...</p>
    </x-jen::step>
</div>
```

## Key Features

-   ✅ **Alpine.js Integration**: Seamless integration with Alpine.js for state management
-   ✅ **Icon Support**: Built-in support for icons using jen-ui icon component
-   ✅ **Flexible Styling**: Custom CSS classes and styling options
-   ✅ **Data Attributes**: Support for custom data content
-   ✅ **Livewire Ready**: Built-in wire:key support for Livewire applications
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Alpine.js Integration

The Step component automatically registers itself with Alpine.js by pushing step data to a `steps` array. This enables advanced wizard functionality:

```javascript
// Alpine.js data structure
{
    current: '1',      // Current active step
    steps: [           // Array of all steps
        {
            step: '1',
            text: 'First Step',
            classes: '',
            icon: '<svg>...</svg>',     // If icon provided
            dataContent: 'some-data'   // If dataContent provided
        }
    ]
}
```

## Navigation Control

You can control step navigation using Alpine.js:

```blade
<div x-data="{ current: '1', steps: [] }">
    <!-- Steps -->
    <x-jen::step :step="1" text="Step 1">Step 1 Content</x-jen::step>
    <x-jen::step :step="2" text="Step 2">Step 2 Content</x-jen::step>
    <x-jen::step :step="3" text="Step 3">Step 3 Content</x-jen::step>

    <!-- Navigation -->
    <div class="flex justify-between mt-6">
        <button @click="current = String(parseInt(current) - 1)"
                x-show="current > '1'"
                class="btn btn-outline">
            Previous
        </button>

        <button @click="current = String(parseInt(current) + 1)"
                x-show="current < '3'"
                class="btn btn-primary">
            Next
        </button>
    </div>
</div>
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::step :step="1" text="Custom Styled Step"
    class="bg-base-200 p-8 rounded-xl shadow-lg border-2 border-primary">
    <p>Custom styled step content</p>
</x-jen::step>
```

## Dependencies

-   `x-jen::icon` (when using icon property)
-   Alpine.js (for step state management)

## Migration from Mary UI

Direct drop-in replacement for Mary UI Step component:

```blade
<!-- Mary UI -->
<x-mary-step :step="1" text="Step 1">Content</x-mary-step>

<!-- jen-ui -->
<x-jen::step :step="1" text="Step 1">Content</x-jen::step>
```

All properties and functionality remain exactly the same.
