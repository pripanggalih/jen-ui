# Signature

A lightweight, performance-focused signature component for Laravel applications that enables digital signature capture using HTML5 canvas.

## Basic Usage

```blade
<x-jen::signature wire:model="signature" />
```

## Properties

| Property         | Type      | Default                         | Description                                  |
| ---------------- | --------- | ------------------------------- | -------------------------------------------- |
| `id`             | `?string` | `null`                          | Custom ID for the component                  |
| `height`         | `?string` | `'250'`                         | Height of the signature canvas in pixels     |
| `clearText`      | `?string` | `'Clear'`                       | Text for the clear button                    |
| `hint`           | `?string` | `null`                          | Help text shown below the component          |
| `hintClass`      | `?string` | `'fieldset-label text-xs pt-1'` | CSS classes for hint text styling            |
| `config`         | `?array`  | `[]`                            | Configuration array for SignaturePad library |
| `clearBtnStyle`  | `?string` | `null`                          | Custom CSS classes for clear button          |
| `errorClass`     | `?string` | `'text-error text-xs pt-1'`     | CSS classes for error message styling        |
| `errorField`     | `?string` | `null`                          | Custom field name for error validation       |
| `omitError`      | `?bool`   | `false`                         | Hide validation error messages               |
| `firstErrorOnly` | `?bool`   | `false`                         | Show only the first validation error         |

## Examples

### Basic Example

```blade
<x-jen::signature wire:model="signature" />
```

### With Custom Height and Clear Text

```blade
<x-jen::signature
    wire:model="signature"
    height="300"
    clearText="Reset" />
```

### With Hint and Validation

```blade
<x-jen::signature
    wire:model="userSignature"
    hint="Please sign in the box above"
    errorField="userSignature" />
```

### With Custom Configuration

```blade
<x-jen::signature
    wire:model="signature"
    :config="[
        'penColor' => 'rgb(0, 0, 255)',
        'minWidth' => 0.5,
        'maxWidth' => 2.5,
        'throttle' => 16,
        'minDistance' => 5
    ]" />
```

### With Custom Styling

```blade
<x-jen::signature
    wire:model="signature"
    clearBtnStyle="btn-error btn-outline"
    class="border-2 border-primary"
    hintClass="text-primary text-sm" />
```

## Livewire Integration

The component works seamlessly with Livewire models:

```php
class SignatureForm extends Component
{
    public string $signature = '';

    public function save()
    {
        $this->validate([
            'signature' => 'required|string'
        ]);

        // Save signature (base64 data URL)
        auth()->user()->update([
            'signature' => $this->signature
        ]);
    }
}
```

## Key Features

-   ✅ **Canvas-based Drawing**: High-quality signature capture using HTML5 canvas
-   ✅ **Touch Support**: Works on mobile devices with touch input
-   ✅ **High DPI Ready**: Automatically adjusts for high resolution displays
-   ✅ **Livewire Integration**: Built-in wire:model support for reactive data binding
-   ✅ **Validation Ready**: Full Laravel validation support with error display
-   ✅ **Configurable**: Supports SignaturePad.js configuration options
-   ✅ **Auto Discovery**: Works automatically without manual registration
-   ✅ **Dynamic Prefix**: Supports custom prefix configuration

## Advanced Configuration

The component accepts a `config` array that is passed directly to SignaturePad.js:

```blade
<x-jen::signature
    wire:model="signature"
    :config="[
        'penColor' => 'rgb(66, 133, 244)',
        'backgroundColor' => 'rgb(255, 255, 255)',
        'minWidth' => 0.5,
        'maxWidth' => 2.5,
        'throttle' => 16,
        'minDistance' => 5,
        'velocityFilterWeight' => 0.7,
        'dotSize' => 0
    ]" />
```

## JavaScript Library Requirement

This component requires the SignaturePad.js library. Include it in your layout:

```blade
<!-- In your layout head -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
```

Or install via npm:

```bash
npm install signature_pad
```

## Styling

The component uses Tailwind CSS classes and can be customized:

```blade
<x-jen::signature
    wire:model="signature"
    class="border-primary shadow-lg"
    clearBtnStyle="btn-primary btn-sm" />
```

## Dependencies

-   `x-jen::button` (for clear button functionality)
-   SignaturePad.js library (must be included separately)
-   Alpine.js (for reactivity)

## Data Format

The signature data is stored as a base64-encoded data URL:

```
data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAA...
```

This can be directly displayed in an image tag or saved to storage.
