# Code

A lightweight, performance-focused code editor component with syntax highlighting for Laravel applications powered by ACE Editor.

```

## Basic Usage

```blade
<x-jen::code wire:model="code" />
```

## Properties

| Property      | Type      | Default                  | Description                                  |
| ------------- | --------- | ------------------------ | -------------------------------------------- |
| `id`          | `?string` | `null`                   | HTML ID attribute for the editor             |
| `label`       | `?string` | `null`                   | Label text displayed above the editor        |
| `hint`        | `string`  | `''`                     | Hint text displayed below the editor         |
| `language`    | `string`  | `'javascript'`           | Programming language for syntax highlighting |
| `lightTheme`  | `?string` | `'github_light_default'` | ACE theme for light mode                     |
| `darkTheme`   | `?string` | `'github_dark'`          | ACE theme for dark mode                      |
| `lightClass`  | `?string` | `'light'`                | CSS class name for light theme detection     |
| `darkClass`   | `?string` | `'dark'`                 | CSS class name for dark theme detection      |
| `height`      | `string`  | `'200px'`                | Height of the editor                         |
| `lineHeight`  | `string`  | `'2'`                    | Line height multiplier                       |
| `printMargin` | `bool`    | `false`                  | Show/hide print margin indicator             |

## Examples

### Basic Code Editor

```blade
<x-jen::code wire:model="userCode" />
```

### With Label and Language

```blade
<x-jen::code
    wire:model="pythonCode"
    label="Python Script"
    language="python" />
```

### Custom Styling and Height

```blade
<x-jen::code
    wire:model="cssCode"
    label="Custom CSS"
    language="css"
    height="300px"
    class="border-2 border-primary" />
```

### With Hint and Print Margin

```blade
<x-jen::code
    wire:model="code"
    label="Code Editor"
    hint="Write your code here. It will be automatically saved."
    language="php"
    :print-margin="true" />
```

### Dark/Light Theme Customization

```blade
<x-jen::code
    wire:model="code"
    light-theme="monokai"
    dark-theme="terminal"
    light-class="light-mode"
    dark-class="dark-mode" />
```

## Available Languages

The component supports all ACE Editor languages including:

-   `javascript`
-   `php`
-   `python`
-   `css`
-   `html`
-   `json`
-   `sql`
-   `xml`
-   `yaml`
-   `markdown`
-   And many more...

## Available Themes

### Light Themes

-   `github_light_default`
-   `chrome`
-   `clouds`
-   `crimson_editor`
-   `dawn`
-   `dreamweaver`
-   `eclipse`
-   `github`
-   `iplastic`
-   `katzenmilch`
-   `kuroir`
-   `solarized_light`
-   `textmate`
-   `tomorrow`
-   `xcode`

### Dark Themes

-   `github_dark`
-   `ambiance`
-   `chaos`
-   `clouds_midnight`
-   `cobalt`
-   `dracula`
-   `gob`
-   `gruvbox`
-   `idle_fingers`
-   `kr_theme`
-   `merbivore`
-   `merbivore_soft`
-   `mono_industrial`
-   `monokai`
-   `pastel_on_dark`
-   `solarized_dark`
-   `terminal`
-   `tomorrow_night`
-   `tomorrow_night_blue`
-   `tomorrow_night_bright`
-   `tomorrow_night_eighties`
-   `twilight`
-   `vibrant_ink`

## Validation

The component automatically integrates with Laravel validation:

```blade
<x-jen::code
    wire:model="code"
    label="Required Code"
    class="mb-4" />

@error('code')
    <div class="text-error text-xs mt-2">{{ $message }}</div>
@enderror
```

## Livewire Integration

### Basic Usage with Livewire

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class CodeEditor extends Component
{
    public string $code = '';
    public string $language = 'javascript';

    public function save()
    {
        $this->validate([
            'code' => 'required|min:10'
        ]);

        // Save code logic here
    }

    public function render()
    {
        return view('livewire.code-editor');
    }
}
```

```blade
<div>
    <x-jen::code
        wire:model.live="code"
        :language="$language"
        label="Code Editor"
        hint="Write your code here" />

    <button wire:click="save" class="btn btn-primary mt-4">
        Save Code
    </button>
</div>
```

### Dynamic Language Switching

```php
public string $selectedLanguage = 'javascript';
public array $availableLanguages = [
    'javascript' => 'JavaScript',
    'php' => 'PHP',
    'python' => 'Python',
    'css' => 'CSS',
    'html' => 'HTML'
];
```

```blade
<select wire:model.live="selectedLanguage" class="select select-bordered mb-4">
    @foreach($availableLanguages as $lang => $name)
        <option value="{{ $lang }}">{{ $name }}</option>
    @endforeach
</select>

<x-jen::code
    wire:model="code"
    :language="$selectedLanguage"
    label="Dynamic Code Editor" />
```

## Styling

The component uses Tailwind CSS classes and can be customized with:

```blade
<x-jen::code
    wire:model="code"
    label="Custom Styled Editor"
    class="border-2 border-accent rounded-lg" />
```

## API Compatibility


```blade
<x-jen::jen::code wire:model="code" label="Code Editor" />

<!-- jen-ui -->
<x-jen::code wire:model="code" label="Code Editor" />
```

## Dependencies

-   ACE Editor (loaded via CDN or local assets)
-   Alpine.js (for component reactivity)
-   None (standalone component)

## CDN Requirements

Make sure to include ACE Editor in your layout:

```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.8/ace.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.32.8/ext-language_tools.min.js"></script>
```

Or install locally:

```bash
npm install ace-builds
```
