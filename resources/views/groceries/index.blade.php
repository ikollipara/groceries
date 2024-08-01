<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Grocery List') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'grocery-added')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Grocery Added.') }}</p>
            @endif
                <p
                    x-data="{ show: false }"
                    x-show="show"
                    x-transition
                    x-cloak
                    x-on:grocery-deleted.window="show = true"
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Item Removed.') }}</p>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                @foreach ($groceries as $grocery)
                <div x-data="{
                    removeItem() {
                        axios.delete('{{ route('groceries.destroy', $grocery) }}')
                            .then(() => this.$dispatch('grocery-deleted', '{{ $grocery->id }}'))
                            .then(() => this.$root.remove())
                            .catch(() => alert('An error occurred. Please try again.'))
                    }
                }" class="text-gray-900 dark:text-gray-100 flex justify-between">
                    <p class="font-bold text-md">{{ __($grocery->item) }}</p>
                    <button x-on:click="removeItem" class="font-bold text-md" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:dark:text-gray-50 hover:text-gray-900">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                @endforeach
                <x-primary-button x-data x-on:click="$dispatch('open-modal', 'createGroceryModal')" type="button">{{ __('Add Grocery') }}</x-primary-button>
            </div>
        </div>
    </div>
    <x-modal name="createGroceryModal">
        @include('groceries.partials.create-grocery-form')
    </x-modal>

</x-app-layout>
