@php
    // Cache method calls in template for performance
    $hasTitle = $hasTitle();
    $hasDescription = $hasDescription();
    $alertClasses = $getAlertClasses();
    $iconClasses = $getIconClasses();
@endphp

<div>
    @if ($errors->any())
        <div wire:key="{{ $uuid }}" {{ $attributes->class($alertClasses) }}>
            <div class="grid gap-3">
                <div class="flex gap-2">
                    @if ($hasTitle)
                        <x-dynamic-component :component="$jenPrefix . '::icon'"
                            :name="$icon"
                            :class="$iconClasses" />
                    @endif
                    <div>
                        @if ($hasTitle)
                            <div class="text-lg font-bold">{{ $title }}</div>
                        @endif

                        @if ($hasDescription)
                            <div class="font-semibold">{{ $description }}</div>
                        @endif
                    </div>
                </div>
                <div>
                    <ul class="ms-5 list-disc space-y-2 pb-3 sm:ms-12">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>
