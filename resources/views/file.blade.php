@php
    // Cache method calls for performance
    $isRequired = $isRequired();
    $hasSlot = $hasSlot();
    $hasErrors = $hasErrors();
    $errorMessages = $getErrorMessages();
    $fileInputClasses = $getFileInputClasses();
    $cropSetupJson = $cropSetup();

    // Build base attributes
    $baseAttributes = [];

    if ($isRequired) {
        $baseAttributes['required'] = true;
    }
@endphp

<div x-data="{
    progress: 0,
    cropper: null,
    justCropped: false,
    fileChanged: false,
    imagePreview: null,
    imageCrop: null,
    originalImageUrl: null,
    cropAfterChange: {{ json_encode($cropAfterChange) }},
    file: @entangle($attributes->wire('model')),
    init() {
        this.imagePreview = this.$refs.preview?.querySelector('img')
        this.imageCrop = this.$refs.crop?.querySelector('img')
        this.originalImageUrl = this.imagePreview?.src

        this.$watch('progress', value => {
            if (value == 100 && this.cropAfterChange && !this.justCropped) {
                this.crop()
            }
        })
    },
    get processing() {
        return this.progress > 0 && this.progress < 100
    },
    close() {
        $refs.jenCrop.close()
        this.cropper?.destroy()
    },
    change() {
        if (this.processing) {
            return
        }

        this.$refs.file.click()
    },
    refreshImage() {
        this.progress = 1
        this.justCropped = false

        if (this.imagePreview?.src) {
            this.imagePreview.src = URL.createObjectURL(this.$refs.file.files[0])
            this.imageCrop.src = this.imagePreview.src
        }
    },
    crop() {
        $refs.jenCrop.showModal()
        this.cropper?.destroy()

        this.cropper = new Cropper(this.imageCrop, {{ $cropSetupJson }});
    },
    revert() {
        $wire.$removeUpload('{{ $attributes->wire('model')->value }}', this.file.split('livewire-file:').pop(), () => {
            this.imagePreview.src = this.originalImageUrl
        })
    },
    async save() {
        $refs.jenCrop.close();

        this.progress = 1
        this.justCropped = true

        this.imagePreview.src = this.cropper.getCroppedCanvas().toDataURL()
        this.imageCrop.src = this.imagePreview.src

        this.cropper.getCroppedCanvas().toBlob((blob) => {
            blob.name = $refs.file.files[0].name
            @this.upload('{{ $attributes->wire('model')->value }}', blob,
                (uploadedFilename) => {},
                (error) => {},
                (event) => { this.progress = event.detail.progress }
            )
        }, '{{ $cropMimeType }}')
    }
}"
    x-on:livewire-upload-progress="progress = $event.detail.progress;"
    wire:key="{{ $uuid }}"
    {{ $attributes->whereStartsWith('class') }}>
    <fieldset class="fieldset py-0">
        {{-- STANDARD LABEL --}}
        @if ($label)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}
                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- PROGRESS BAR  --}}
        @if (!$hideProgress && !$hasSlot)
            <progress x-cloak
                max="100"
                :value="progress"
                :class="!processing && 'hidden'"
                class="progress absolute -mt-2 h-1 w-56"></progress>
        @endif

        {{-- INPUT --}}
        <input id="{{ $uuid }}"
            type="file"
            x-ref="file"
            @change="refreshImage()"
            {{ $attributes->whereDoesntStartWith('class')->class($fileInputClasses)->merge($baseAttributes) }} />

        @if ($hasSlot)
            <!-- PREVIEW AREA -->
            <div x-ref="preview" class="relative flex">
                <div wire:ignore
                    @click="change()"
                    :class="processing && 'opacity-50 pointer-events-none'"
                    class="tooltip cursor-pointer transition-all hover:scale-105"
                    data-tip="{{ $changeText }}">
                    {{ $slot }}
                </div>
                <!-- PROGRESS -->
                <div x-cloak
                    :style="`--value:${progress}; --size:1.5rem; --thickness: 4px;`"
                    :class="!processing && 'hidden'"
                    class="radial-progress text-success bg-neutral absolute start-5 top-5"
                    role="progressbar"></div>
            </div>

            <!-- CROP MODAL -->
            <div @click.prevent=""
                x-ref="crop"
                wire:ignore>
                <dialog id="jenCrop{{ $uuid }}"
                    x-ref="jenCrop"
                    class="modal backdrop-blur-sm">
                    <div class="modal-box">
                        <h3 class="mb-4 border-b pb-4 text-lg font-bold">{{ $cropTitleText }}</h3>
                        <div class="modal-content">
                            <img src="" class="h-auto max-w-full" />
                        </div>
                        <div class="modal-action mt-6 border-t pt-4">
                            <button type="button"
                                class="btn"
                                @click="close()">{{ $cropCancelText }}</button>
                            <button type="button"
                                class="btn btn-primary"
                                @click="save()"
                                :disabled="processing">{{ $cropSaveText }}</button>
                        </div>
                    </div>
                </dialog>
            </div>
        @endif

        {{-- ERROR --}}
        @if ($hasErrors)
            @foreach ($errorMessages as $message)
                @foreach (\Illuminate\Support\Arr::wrap($message) as $line)
                    <div class="{{ $errorClass }}">{{ $line }}</div>
                    @break($firstErrorOnly)
                @endforeach
                @break($firstErrorOnly)
            @endforeach
        @endif

        {{-- MULTIPLE --}}
        @error($modelName() . '.*')
            <div class="text-error">{{ $message }}</div>
        @enderror

        {{-- HINT --}}
        @if ($hint)
            <div class="{{ $hintClass }}">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
