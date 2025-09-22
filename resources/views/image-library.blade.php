@php
    // Cache method calls for performance
    $hasPreview = $hasPreview();
    $isRequired = $isRequired();
    $acceptedMimes = $getAcceptedMimes();
    $modelName = $modelName();
    $libraryName = $libraryName();
    $cropSetup = $cropSetup();

    // Build CSS classes
    $fieldsetClasses = $getFieldsetClasses();
    $previewAreaClasses = $getPreviewAreaClasses();
    $previewContainerClasses = $getPreviewContainerClasses();
    $previewItemClasses = $getPreviewItemClasses();
    $imageClasses = $getImageClasses();
    $actionsClasses = $getActionsClasses();
    $progressClasses = $getProgressClasses();
    $addButtonClasses = $getAddButtonClasses();
    $mainInputClasses = $getMainInputClasses();
@endphp

<div x-data="{
    progress: 0,
    indeterminate: false,
    cropper: null,
    imageCrop: null,
    croppingId: null,

    init() {
        this.imageCrop = this.$refs.crop?.querySelector('img')

        this.$watch('progress', value => {
            this.indeterminate = value > 99
        })
    },
    get processing() {
        return this.progress > 0 && this.progress < 100
    },
    close() {
        $refs.maryCropModal.close()
        this.cropper?.destroy()
    },
    change() {
        if (this.processing) {
            return
        }

        this.$refs.files.click()
    },
    refreshImage() {

    },
    crop(id) {
        $refs.maryCropModal.showModal()

        this.cropper?.destroy()
        this.croppingId = id.split('-')[1]
        this.imageCrop.src = document.getElementById(id).src

        this.cropper = new Cropper(this.imageCrop, {{ $cropSetup }});
    },
    removeMedia(uuid, url) {
        this.indeterminate = true
        $wire.removeMedia(uuid, '{{ $modelName }}', '{{ $libraryName }}', url).then(() => this.indeterminate = false)
    },
    refreshMediaOrder(order) {
        $wire.refreshMediaOrder(order, '{{ $libraryName }}')
    },
    refreshMediaSources() {
        this.indeterminate = true
        $wire.refreshMediaSources('{{ $modelName }}', '{{ $libraryName }}').then(() => this.indeterminate = false)
    },
    async save() {
        $refs.maryCropModal.close();
        this.progress = 1

        this.cropper.getCroppedCanvas().toBlob((blob) => {
            @this.upload(this.croppingId, blob,
                (uploadedFilename) => { this.refreshMediaSources() },
                (error) => { this.progress = 0; },
                (event) => { this.progress = event.detail.progress; }
            )
        })
    }
}"
    x-on:livewire-upload-progress="progress = $event.detail.progress;"
    x-on:livewire-upload-finish="refreshMediaSources()"
    wire:key="{{ $uuid }}"
    {{ $attributes->whereStartsWith('class') }}>

    <fieldset class="{{ $fieldsetClasses }}">
        {{-- STANDARD LABEL --}}
        @if ($label)
            <legend class="fieldset-legend mb-0.5">
                {{ $label }}

                @if ($isRequired)
                    <span class="text-error">*</span>
                @endif
            </legend>
        @endif

        {{-- PREVIEW AREA --}}
        <div :class="(processing || indeterminate) && 'opacity-50 pointer-events-none'"
            class="{{ implode(' ', $previewAreaClasses) }}">
            <div x-data="{ sortable: null }"
                x-init="sortable = new Sortable($el, { animation: 150, ghostClass: 'bg-base-300', filter: '.ignore-drag', onEnd: (ev) => refreshMediaOrder(sortable.toArray()) })"
                class="{{ $previewContainerClasses }}">

                @foreach ($preview as $key => $image)
                    <div class="{{ $previewItemClasses }}" data-id="{{ $image['uuid'] }}">
                        <div wire:key="preview-{{ $image['uuid'] }}"
                            class="tooltip py-2 pe-10 ps-16"
                            data-tip="{{ $changeText }}">

                            {{-- IMAGE --}}
                            <img src="{{ $image['url'] }}"
                                class="{{ $imageClasses }}"
                                @click="document.getElementById('file-{{ $uuid }}-{{ $key }}').click()"
                                id="image-{{ $modelName . '.' . $key }}-{{ $uuid }}" />

                            {{-- VALIDATION --}}
                            @error($modelName . '.' . $key)
                                <div class="text-error label-text-alt p-1">
                                    {{ $validationMessage($message) }}
                                </div>
                            @enderror

                            {{-- HIDDEN FILE INPUT --}}
                            <input type="file"
                                id="file-{{ $uuid }}-{{ $key }}"
                                wire:model="{{ $modelName . '.' . $key }}"
                                accept="{{ $acceptedMimes }}"
                                class="hidden"
                                @change="progress = 1" />
                        </div>

                        {{-- ACTIONS --}}
                        <div class="{{ $actionsClasses }}">
                            <x-dynamic-component :component="$jenPrefix . '::button'"
                                @click="removeMedia('{{ $image['uuid'] }}', '{{ $image['url'] }}')"
                                @touchend.prevent="removeMedia('{{ $image['uuid'] }}', '{{ $image['url'] }}')"
                                icon="o-x-circle"
                                :tooltip="$removeText"
                                class="btn-sm btn-ghost btn-circle" />
                            <x-dynamic-component :component="$jenPrefix . '::button'"
                                @click="crop('image-{{ $modelName . '.' . $key }}-{{ $uuid }}')"
                                @touchend.prevent="crop('image-{{ $modelName . '.' . $key }}-{{ $uuid }}')"
                                icon="o-scissors"
                                :tooltip="$cropText"
                                class="btn-sm btn-ghost btn-circle" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CROP MODAL --}}
        <div @click.prevent=""
            x-ref="crop"
            wire:ignore>
            <dialog class="modal backdrop-blur-sm"
                x-ref="maryCropModal"
                id="maryCropModal{{ $uuid }}">
                <div class="modal-box">
                    <h3 class="border-b pb-4 text-lg font-bold">{{ $cropTitleText }}</h3>
                    <div class="py-4">
                        <img src="#" crossOrigin="Anonymous" />
                    </div>
                    <div class="modal-action">
                        <button class="btn" @click="close()">{{ $cropCancelText }}</button>
                        <button class="btn btn-primary" @click="save()">{{ $cropSaveText }}</button>
                    </div>
                </div>
            </dialog>
        </div>

        {{-- PROGRESS BAR --}}
        @if (!$hideProgress && $slot->isEmpty())
            <div class="{{ $progressClasses }}">
                <progress x-cloak
                    :class="!processing && 'hidden'"
                    :value="progress"
                    max="100"
                    class="progress progress-primary h-1 w-full"></progress>

                <progress x-cloak
                    :class="!indeterminate && 'hidden'"
                    class="progress progress-primary h-1 w-full"></progress>
            </div>
        @endif

        {{-- ADD FILES --}}
        <div @click="$refs.files.click()"
            class="{{ $addButtonClasses }}"
            :class="(processing || indeterminate) && 'opacity-50 pointer-events-none'">
            <x-dynamic-component :component="$jenPrefix . '::icon'" name="o-plus-circle" />
            <span>{{ $addFilesText }}</span>
        </div>

        {{-- MAIN FILE INPUT --}}
        <input id="{{ $uuid }}"
            type="file"
            x-ref="files"
            class="{{ $mainInputClasses }}"
            wire:model="{{ $modelName }}.*"
            accept="{{ $acceptedMimes }}"
            @change="progress = 1"
            multiple />

        {{-- ERROR --}}
        @if (!$hideErrors)
            @error($libraryName)
                <div class="text-error">{{ $message }}</div>
            @enderror
        @endif

        {{-- HINT --}}
        @if ($hint)
            <div class="fieldset-label">{{ $hint }}</div>
        @endif
    </fieldset>
</div>
