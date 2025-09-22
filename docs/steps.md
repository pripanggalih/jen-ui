# Steps

A lightweight, performance-focused step progress indicator component for Laravel applications with Alpine.js integration.

## Basic Usage

```blade
<x-jen::steps wire:model="currentStep">
    <x-jen::step name="personal" text="Personal Info" />
    <x-jen::step name="account" text="Account Setup" />
    <x-jen::step name="confirmation" text="Confirmation" />
</x-jen::steps>
```

## Properties

| Property         | Type      | Default          | Description                            |
| ---------------- | --------- | ---------------- | -------------------------------------- |
| `id`             | `?string` | `null`           | Unique identifier for the component    |
| `vertical`       | `bool`    | `false`          | Whether to display steps vertically    |
| `stepsColor`     | `?string` | `'step-neutral'` | Color theme for active steps           |
| `stepperClasses` | `?string` | `null`           | Additional CSS classes for the stepper |

## Examples

### Basic Horizontal Steps

```blade
<div x-data="{ step: 1 }">
    <x-jen::steps wire:model="step">
        <x-jen::step name="personal" text="Personal Info" />
        <x-jen::step name="account" text="Account Setup" />
        <x-jen::step name="confirmation" text="Confirmation" />
    </x-jen::steps>
</div>
```

### Vertical Steps with Custom Color

```blade
<x-jen::steps
    wire:model="currentStep"
    vertical="true"
    steps-color="step-primary"
    stepper-classes="w-full">
    <x-jen::step name="info" text="Basic Information" />
    <x-jen::step name="details" text="Additional Details" />
    <x-jen::step name="review" text="Review & Submit" />
</x-jen::steps>
```

### Steps with Icons

```blade
<x-jen::steps wire:model="wizardStep">
    <x-jen::step
        name="profile"
        text="Profile Setup"
        icon='<svg class="w-4 h-4">...</svg>' />
    <x-jen::step
        name="preferences"
        text="Preferences"
        icon='<svg class="w-4 h-4">...</svg>' />
    <x-jen::step
        name="complete"
        text="Complete"
        icon='<svg class="w-4 h-4">...</svg>' />
</x-jen::steps>
```

### Livewire Integration

```php
// In your Livewire component
class WizardComponent extends Component
{
    public $currentStep = 1;
    public $totalSteps = 3;

    public function nextStep()
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }
}
```

```blade
{{-- In your Livewire view --}}
<div>
    <x-jen::steps wire:model="currentStep">
        <x-jen::step name="step1" text="Step 1" />
        <x-jen::step name="step2" text="Step 2" />
        <x-jen::step name="step3" text="Step 3" />
    </x-jen::steps>

    <div class="mt-6">
        @if($currentStep > 1)
            <button wire:click="previousStep" class="btn btn-outline">Previous</button>
        @endif

        @if($currentStep < $totalSteps)
            <button wire:click="nextStep" class="btn btn-primary">Next</button>
        @endif
    </div>
</div>
```

## Key Features

-   ✅ **Alpine.js Integration**: Built-in reactive state management with x-data
-   ✅ **Livewire Ready**: Wire model binding for real-time step tracking
-   ✅ **Icon Support**: Custom icons or automatic numbering for each step
-   ✅ **Vertical Layout**: Optional vertical orientation for different layouts
-   ✅ **Color Themes**: Predefined Tailwind step color variants
-   ✅ **Navigation Handling**: Automatic cleanup on Livewire navigation
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Styling

The component uses DaisyUI step classes and can be customized:

```blade
<x-jen::steps
    wire:model="currentStep"
    steps-color="step-success"
    stepper-classes="steps-vertical lg:steps-horizontal"
    class="w-full max-w-4xl mx-auto">
    <!-- Steps content -->
</x-jen::steps>
```

## Available Step Colors

-   `step-neutral` (default)
-   `step-primary`
-   `step-secondary`
-   `step-accent`
-   `step-info`
-   `step-success`
-   `step-warning`
-   `step-error`

## Dependencies

-   DaisyUI steps component classes
-   Alpine.js for reactive functionality
-   Livewire for wire:model binding

## Alpine.js Data Structure

The component exposes the following Alpine.js reactive data:

```javascript
{
    steps: [], // Array of step objects populated by x-jen::step components
    current: @entangle($attributes->wire('model')), // Current active step
    init() {
        // Initialization logic for navigation cleanup
    }
}
```

Each step object contains:

-   `text`: Step label text
-   `icon`: Optional SVG icon HTML
-   `dataContent`: Custom data content attribute
-   `classes`: Additional CSS classes for the step
