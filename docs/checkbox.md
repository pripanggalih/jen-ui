# Checkbox

Komponen checkbox yang ringan dan fokus performa untuk aplikasi Laravel.

```

## Basic Usage

```blade
<x-jen::checkbox label="Basic Checkbox" />
```

## Properties

| Property         | Type      | Default            | Description                            |
| ---------------- | --------- | ------------------ | -------------------------------------- |
| `id`             | `?string` | `null`             | ID unik untuk checkbox                 |
| `label`          | `?string` | `null`             | Label teks untuk checkbox              |
| `right`          | `?bool`   | `false`            | Posisi label di sebelah kanan checkbox |
| `hint`           | `?string` | `null`             | Teks hint tambahan di bawah label      |
| `hintClass`      | `?string` | `'fieldset-label'` | Class CSS untuk styling hint text      |
| `errorField`     | `?string` | `null`             | Nama field untuk error handling        |
| `errorClass`     | `?string` | `'text-error'`     | Class CSS untuk styling error message  |
| `omitError`      | `?bool`   | `false`            | Skip menampilkan error message         |
| `firstErrorOnly` | `?bool`   | `false`            | Hanya tampilkan error pertama          |

## Examples

### Basic Example

```blade
<x-jen::checkbox label="I agree to terms and conditions" />
```

### With Wire Model

```blade
<x-jen::checkbox
    wire:model="agreed"
    label="Subscribe to newsletter" />
```

### With Hint Text

```blade
<x-jen::checkbox
    label="Enable notifications"
    hint="You will receive email notifications for important updates" />
```

### Right Aligned Label

```blade
<x-jen::checkbox
    label="Remember me"
    :right="true" />
```

### Required Field

```blade
<x-jen::checkbox
    label="Accept privacy policy"
    required />
```

### With Custom Classes

```blade
<x-jen::checkbox
    label="Custom Styled Checkbox"
    class="checkbox-primary checkbox-lg"
    hintClass="text-xs text-gray-500" />
```

### Form Validation

```blade
<x-jen::checkbox
    wire:model="terms_accepted"
    label="I accept the terms and conditions"
    hint="Please read our terms carefully"
    errorField="terms_accepted"
    required />
```

## Styling

Komponen ini menggunakan kelas Tailwind CSS dan dapat dikustomisasi dengan:

```blade
<x-jen::checkbox
    label="Custom Checkbox"
    class="checkbox-success checkbox-sm" />
```

## API Compatibility


```blade
<x-jen::jen::checkbox label="Example" />

<!-- jen-ui -->
<x-jen::checkbox label="Example" />
```

## Dependencies

-   None (standalone component)

## Livewire Integration

Checkbox bekerja sempurna dengan Livewire:

```php
// Component Livewire
class SettingsForm extends Component
{
    public bool $notifications = false;
    public bool $newsletter = false;

    public function save()
    {
        // Handle form submission
    }

    public function render()
    {
        return view('livewire.settings-form');
    }
}
```

```blade
<!-- View -->
<form wire:submit.prevent="save">
    <x-jen::checkbox
        wire:model="notifications"
        label="Enable notifications" />

    <x-jen::checkbox
        wire:model="newsletter"
        label="Subscribe to newsletter"
        hint="Get the latest updates and offers" />

    <button type="submit" class="btn btn-primary">
        Save Settings
    </button>
</form>
```

## Error Handling

Komponen secara otomatis menampilkan error validation:

```php
// Validation rules
public function rules()
{
    return [
        'terms_accepted' => 'required|accepted',
        'privacy_policy' => 'required|accepted',
    ];
}
```

```blade
<x-jen::checkbox
    wire:model="terms_accepted"
    label="I accept the terms and conditions"
    errorField="terms_accepted" />

<x-jen::checkbox
    wire:model="privacy_policy"
    label="I accept the privacy policy"
    errorField="privacy_policy"
    firstErrorOnly />
```
