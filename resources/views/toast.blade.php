@php
    // Cache position classes for performance
    $toastClasses = 'toast !whitespace-normal rounded-md fixed cursor-pointer z-[999]';
    $alertClasses = 'alert gap-2';
@endphp

<div>
    @persist('jen-toaster')
        <div x-cloak
            x-data="{ show: false, timer: '', toast: '' }"
            @jen-toast.window="
                        clearTimeout(timer);
                        toast = $event.detail.toast
                        setTimeout(() => show = true, 100);
                        timer = setTimeout(() => show = false, $event.detail.toast.timeout);
                        ">
            <div class="{{ $toastClasses }}"
                :class="toast.position || '{{ $position }}'"
                x-show="show"
                x-classes="alert alert-success alert-warning alert-error alert-info top-10 end-10 toast toast-top toast-bottom toast-center toast-end toast-middle toast-start"
                @click="show = false">
                <div class="{{ $alertClasses }}" :class="toast.css">
                    <div x-html="toast.icon" class="hidden sm:inline-block"></div>
                    <div class="grid">
                        <div x-html="toast.title" class="font-bold"></div>
                        <div x-html="toast.description" class="text-xs"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            window.toast = function(payload) {
                window.dispatchEvent(new CustomEvent('jen-toast', {
                    detail: payload
                }))
            }

            document.addEventListener('livewire:init', () => {
                Livewire.hook('request', ({
                    fail
                }) => {
                    fail(({
                        status,
                        content,
                        preventDefault
                    }) => {
                        try {
                            let result = JSON.parse(content);

                            if (result?.toast && typeof window.toast === "function") {
                                window.toast(result);
                            }

                            if ((result?.prevent_default ?? false) === true) {
                                preventDefault();
                            }
                        } catch (e) {
                            console.log(e)
                        }
                    })
                })
            })
        </script>
    @endpersist
</div>
