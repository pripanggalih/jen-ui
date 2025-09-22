@php
    // Cache method calls in template for performance
    $position = $getPosition();
    $offset = $getOffset();
    $triggerClasses = $getTriggerClasses();
    $contentClasses = $getContentClasses();
@endphp

<div x-cloak
    x-data="{
        open: false,
        timer: null,
        show() {
            this.open = true
            clearTimeout(this.timer)
        },
        hide() {
            this.timer = setTimeout(() => this.open = false, 300)
        }
    }"
    wire:key="{{ $uuid }}">
    <!-- TRIGGER -->
    <div x-ref="myTrigger"
        @mouseover="show()"
        @mouseout="hide()"
        {{ $trigger->attributes->class([$triggerClasses]) }}>
        {{ $trigger }}
    </div>

    <!-- CONTENT -->
    <div x-show="open"
        x-anchor.{{ $position }}.offset.{{ $offset }}="$refs.myTrigger"
        x-transition
        @mouseover="show()"
        @mouseout="hide()"
        {{ $content->attributes->class([$contentClasses]) }}>
        {{ $content }}
    </div>
</div>
