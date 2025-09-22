@php
    // Cache method calls for performance
    $isVertical = $isVertical();
    $stepsColor = $getStepsColor();
    $stepperClasses = $getStepperClasses();
    $forcedClasses = $getForcedClasses();
@endphp

<div wire:key="{{ $uuid }}" x-data="{
    steps: [],
    current: @entangle($attributes->wire('model')),
    init() {
        // Fix weird issue when navigating back
        document.addEventListener('livewire:navigating', () => {
            document.querySelectorAll('.step').forEach(el => el.remove());
        });
    }
}">

    {{-- STEP LABELS --}}
    <ul class="{{ $stepperClasses }}">
        <template x-for="(step, index) in steps" :key="index">
            <li class="step"
                :data-content="!step.icon ? step.dataContent || (index + 1) : ''"
                :class="(index + 1 <= current) && '{{ $stepsColor }} ' + step.classes">
                <template x-if="step.icon">
                    <span x-html="step.icon" class="step-icon"></span>
                </template>
                <span x-html="step.text"></span>
            </li>
        </template>
    </ul>

    {{-- STEP PANELS --}}
    <div {{ $attributes->whereDoesntStartWith('wire') }}>
        {{ $slot }}
    </div>

    {{-- Force Tailwind compile steps color --}}
    <span class="{{ $forcedClasses }}"></span>
</div>
