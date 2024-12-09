@props(['column', 'sortCol', 'sortAsc'])

<div wire:click="sortBy('{{ $column }}')" class="d-flex">
    {{ $slot }}

    @if($sortCol == $column)
        <div  class="text-secondary">
            @if($sortAsc)
                <x-icon.arrow-long-up />
            @else
                <x-icon.arrow-long-down />
            @endif
        </div>
    @else
        <div class="text-secondary">
            <x-icon.arrows-up-down />
        </div>
    @endif
</div>
