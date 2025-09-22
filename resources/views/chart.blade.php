@php
    // Cache method calls for performance
    $containerClasses = $getContainerClasses();
    $baseAttributes = $getBaseAttributes();
@endphp

<div {{ $attributes->class($containerClasses)->merge($baseAttributes) }} x-data="{
    settings: @entangle($attributes->wire('model')),
    init() {
        new Chart($refs.chart, this.settings);
    }
}">
    <canvas x-ref="chart"></canvas>
</div>
