@php
    // Cache method calls for performance
    $isShowable = $isShowable();
    $isLengthAwarePaginator = $isLengthAwarePaginator();
    $currentPerPage = $getCurrentPerPage();
    $selectAttributes = $getSelectAttributes();
@endphp

<div class="mary-table-pagination" wire:key="{{ $uuid }}">
    <div {{ $attributes->class(['mb-4 border-t-[length:var(--border)] border-t-base-content/5']) }}></div>

    <div class="relative w-auto items-center justify-between overflow-y-auto pl-2 pr-2 md:flex md:w-full md:flex-row">
        @if ($isShowable)
            <div class="mb-2 flex flex-row justify-center py-1 md:mb-0 md:justify-start">
                <select {{ $attributes->merge($selectAttributes)->only(['id', 'class', 'wire:model.live']) }}>
                    @foreach ($perPageValues as $option)
                        <option value="{{ $option }}" @selected($currentPerPage === $option)>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="w-full">
            @if ($isLengthAwarePaginator)
                {{ $rows->onEachSide(1)->links(data: ['scrollTo' => false]) }}
            @else
                {{ $rows->links(data: ['scrollTo' => false]) }}
            @endif
        </div>
    </div>
</div>
