<x-filament-forms::field-wrapper
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
    class="filament-navigation"
>
    <div wire:key="navigation-items-wrapper">
        <div
            class="space-y-2"
            x-data="navigationSortableContainer({
                statePath: @js($getStatePath())
            })"
            data-sortable-container
        >
            @if(is_iterable($getState()) && !empty($getState()))
                @foreach($getState() as $uuid => $item)
                    <x-filament-navigation::nav-item :statePath="$getStatePath() . '.' . $uuid" :item="$item" />
                @endforeach
            @else
                <div @class([
                        'w-full bg-white rounded-lg border border-gray-300 px-3 py-2 text-left',
                        'dark:bg-gray-700 dark:border-gray-600',
                    ])>
                    {{__('filament-navigation::filament-navigation.items.empty')}}
                </div>
            @endif
        </div>
    </div>

    <div class="flex justify-end">
        <x-filament::button wire:click="createItem" type="button" size="sm">
            {{__('filament-navigation::filament-navigation.items.add-item')}}
        </x-filament::button>
    </div>
</x-filament-forms::field-wrapper>
