<section class="p-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Add Grocery Item') }}
        </h2>
    </header>

    <form action="{{ route('groceries.store') }}" class="mt-6 space-y-6" method="post">
        @csrf

        <div>
            <x-input-label for="grocery_item" :value="__('Grocery Item')" />
            <x-text-input id="grocery_item" name="item" type="text" class="mt-1 block w-full" autocomplete="off" />
            <x-input-error :messages="$errors->createGrocery->get('item')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Add') }}</x-primary-button>
        </div>
    </form>
</section>
