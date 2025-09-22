<?php

namespace Jen\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;
use function Laravel\Prompts\select;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\warning;
use function Laravel\Prompts\error;

class JenInstallCommand extends Command
{
    protected $signature = 'jen:install
                            {--force : Force reinstallation}
                            {--skip-livewire : Skip Livewire installation}
                            {--skip-npm : Skip npm/yarn installation}';

    protected $description = 'Install Jen-UI dependencies and setup';

    protected array $installedSteps = [];
    protected array $modifiedFiles = [];

    protected $ds = DIRECTORY_SEPARATOR;

    public function handle(): int
    {
        try {
            $this->info("💎 Jen-UI installer");

            // Check if already installed
            if (!$this->option('force') && $this->isAlreadyInstalled()) {
                if (!confirm('Jen-UI seems to be already installed. Continue anyway?', false)) {
                    info('Installation cancelled.');
                    return self::SUCCESS;
                }
            }

            // Laravel 12+
            $this->checkForLaravelVersion();

            // Prerequisites check
            $this->checkPrerequisites();

            // Choose package manager
            $packageManagerCommand = $this->option('skip-npm') ? null : $this->askForPackageInstaller();

            // Install Livewire
            if (!$this->option('skip-livewire')) {
                $this->installLivewire();
            } else {
                info('⏭️ Skipping Livewire installation');
            }

            // Setup Tailwind and DaisyUI
            if ($packageManagerCommand) {
                $this->setupTailwindDaisy($packageManagerCommand);
            } else {
                info('⏭️ Skipping npm/yarn installation');
            }

            // Show component info and detect starter kits
            $this->showComponentInfo();

            // Rename components if Jetstream or Breeze detected
            $this->renameComponents();

            $this->info("\n");
            $this->info("✅ Installation completed successfully!");
            $this->showNextSteps();

            return self::SUCCESS;
        } catch (\Exception $e) {
            error('❌ Installation failed: ' . $e->getMessage());

            if (!empty($this->modifiedFiles)) {
                warning('📋 Modified files (you might want to restore from backup):');
                foreach ($this->modifiedFiles as $file) {
                    $this->line("  - {$file}");
                }
            }

            return self::FAILURE;
        }
    }

    public function installLivewire(): void
    {
        info('📦 Installing Livewire...');

        if (!$this->checkComposerCommand()) {
            throw new \RuntimeException('Composer is not available. Please install Composer first.');
        }

        try {
            $process = Process::run("composer require livewire/livewire", function (string $type, string $output) {
                echo $output;
            });

            if (!$process->successful()) {
                throw new \RuntimeException('Failed to install Livewire: ' . $process->errorOutput());
            }

            $this->installedSteps[] = 'livewire';
            info('✅ Livewire installed successfully');
        } catch (\Exception $e) {
            throw new \RuntimeException('Error installing Livewire: ' . $e->getMessage());
        }
    }





    public function setupTailwindDaisy(string $packageManagerCommand): void
    {
        /**
         * Install daisyUI + Tailwind
         */
        info('📦 Installing daisyUI + Tailwind...');

        try {
            $process = Process::run("$packageManagerCommand daisyui tailwindcss @tailwindcss/vite", function (string $type, string $output) {
                echo $output;
            });

            if (!$process->successful()) {
                throw new \RuntimeException('Failed to install Tailwind packages: ' . $process->errorOutput());
            }

            info('✅ Tailwind packages installed successfully');
        } catch (\Exception $e) {
            throw new \RuntimeException('Error installing Tailwind packages: ' . $e->getMessage());
        }

        /**
         * Setup app.css
         */
        $this->setupAppCSS();
        $this->installedSteps[] = 'tailwind';
    }

    protected function setupAppCSS(): void
    {
        $cssPath = resource_path('css/app.css');

        if (!File::exists($cssPath)) {
            throw new \RuntimeException("CSS file not found at: {$cssPath}");
        }

        // Check if already modified
        $css = File::get($cssPath);
        if (str_contains($css, 'Jen-UI installer')) {
            if (!$this->option('force')) {
                warning('⚠️ CSS file already contains Jen-UI configuration. Use --force to overwrite.');
                return;
            }

            // Backup existing file
            $backupPath = $cssPath . '.jen-backup-' . date('Y-m-d-H-i-s');
            File::copy($cssPath, $backupPath);
            warning("📋 Backed up existing CSS to: {$backupPath}");
        }

        $jenCSS = $this->getJenUICSS();
        $newCSS = str($css)->append($jenCSS);

        try {
            File::put($cssPath, $newCSS);
            $this->modifiedFiles[] = $cssPath;
            info('✅ CSS configuration updated');
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to update CSS file: {$e->getMessage()}");
        }
    }

    protected function getJenUICSS(): string
    {
        return <<<EOT
            \n\n
            /**
                The lines above are intact.
                The lines below were added by Jen-UI installer.
            */

            /** daisyUI */
            @plugin "daisyui" {
                themes: light --default, dark --prefersdark;
            }

            /* Jen-UI Components */
            @source "../../app/View/Components/**/*.php";

            /* Theme toggle */
            @custom-variant dark (&:where(.dark, .dark *));

            /**
            * Paginator - Traditional style
            * Because Laravel defaults does not match well the design of daisyUI.
            */

            .jen-table-pagination span[aria-current="page"] > span {
                @apply bg-primary text-base-100
            }

            .jen-table-pagination button {
                @apply cursor-pointer
            }
            EOT;
    }

    public function askForPackageInstaller(): string
    {
        $os = PHP_OS;
        $findCommand = stripos($os, 'WIN') === 0 ? 'where' : 'which';

        $options = [];

        // Check for available package managers
        $packageManagers = [
            'bun i -D' => 'bun',
            'pnpm i -D' => 'pnpm',
            'yarn add -D' => 'yarn',
            'npm install --save-dev' => 'npm',
        ];

        foreach ($packageManagers as $command => $name) {
            try {
                $result = Process::run($findCommand . ' ' . $name)->output();
                if (!empty(trim($result))) {
                    $options[$command] = $name;
                }
            } catch (\Exception $e) {
                // Skip if command not found
                continue;
            }
        }

        if (empty($options)) {
            throw new \RuntimeException("No package manager found. Please install one of: npm, yarn, pnpm, or bun");
        }

        if (count($options) === 1) {
            $selected = array_keys($options)[0];
            info("📦 Using {$options[$selected]} (auto-detected)");
            return $selected;
        }

        return select(
            label: 'Install with ...',
            options: $options
        );
    }

    public function checkForLaravelVersion(): void
    {
        if (version_compare(app()->version(), '12.0', '<')) {
            throw new \RuntimeException("❌ Laravel 12 or above required. Current version: " . app()->version());
        }
        info('✅ Laravel version check passed');
    }

    protected function isAlreadyInstalled(): bool
    {
        $cssPath = resource_path('css/app.css');

        if (!File::exists($cssPath)) {
            return false;
        }

        $css = File::get($cssPath);
        return str_contains($css, 'Jen-UI installer');
    }

    protected function checkPrerequisites(): void
    {
        info('🔍 Checking prerequisites...');

        // Check if resources/css directory exists
        $cssDir = resource_path('css');
        if (!File::exists($cssDir)) {
            throw new \RuntimeException("CSS directory not found: {$cssDir}");
        }

        // Check if app.css exists
        $cssPath = resource_path('css/app.css');
        if (!File::exists($cssPath)) {
            throw new \RuntimeException("app.css not found at: {$cssPath}");
        }

        // Check if CSS file is writable
        if (!is_writable($cssPath)) {
            throw new \RuntimeException("app.css is not writable: {$cssPath}");
        }

        info('✅ Prerequisites check passed');
    }

    protected function checkComposerCommand(): bool
    {
        $os = PHP_OS;
        $findCommand = stripos($os, 'WIN') === 0 ? 'where' : 'which';
        $composer = Process::run($findCommand . ' composer')->output();

        return !empty(trim($composer));
    }

    protected function showNextSteps(): void
    {
        info("💎 Next steps:");
        info(" * Run: php artisan jen:add button");
        info(" * Use: <x-button>Click me</x-button>");
        info(" * Icons tersedia langsung via: <x-heroicon-o-home /> atau <x-heroicon-s-home />");
        info(" * Dokumentasi icons: https://heroicons.com");
        info("");

        if (!empty($this->installedSteps)) {
            info("📦 Installed components:");
            foreach ($this->installedSteps as $step) {
                info(" ✓ {$step}");
            }
        }
    }

    /**
     * If Jetstream or Breeze are detected we add a global prefix to Jen-UI components,
     * in order to avoid name collision with existing components.
     */
    public function renameComponents(): void
    {
        $composerPath = base_path('composer.json');

        if (!File::exists($composerPath)) {
            warning('⚠️ composer.json not found, skipping package detection');
            return;
        }

        try {
            $composerJson = File::get($composerPath);

            collect(['jetstream', 'breeze', 'livewire/flux'])->each(function (string $target) use ($composerJson) {
                if (str($composerJson)->contains($target)) {
                    warning('---------------------------------------------');
                    warning("🚨 `{$target}` was detected. 🚨");
                    warning('---------------------------------------------');
                    warning("Consider using prefixed components to avoid name collision.");
                    warning(" * Example: <x-jen-button>, <x-jen-card> ...");
                    warning('---------------------------------------------');
                }
            });
        } catch (\Exception $e) {
            warning("⚠️ Could not read composer.json: {$e->getMessage()}");
        }
    }

    /**
     * Show available components info and detect starter kit conflicts.
     */
    public function showComponentInfo(): void
    {
        $composerPath = base_path('composer.json');

        if (!File::exists($composerPath)) {
            info("Ready to add components with: php artisan jen:add <component>");
            info("Available components: button, card, input, alert, modal");
            return;
        }

        try {
            $composerJson = File::get($composerPath);
            $hasKit = str($composerJson)->contains('jetstream') ||
                str($composerJson)->contains('breeze') ||
                str($composerJson)->contains('livewire/flux');

            if ($hasKit) {
                warning('---------------------------------------------');
                warning('🚨 Starter kit detected. Skipping demo components. 🚨');
                warning('---------------------------------------------');
                return;
            }

            info("Ready to add components with: php artisan jen:add <component>");
            info("Available components: button, card, input, alert, modal");
        } catch (\Exception $e) {
            warning("⚠️ Could not read composer.json: {$e->getMessage()}");
            info("Ready to add components with: php artisan jen:add <component>");
            info("Available components: button, card, input, alert, modal");
        }
    }
}
