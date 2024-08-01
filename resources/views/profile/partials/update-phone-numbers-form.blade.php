<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Phone Numbers') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's registered phone numbers.") }}
        </p>
    </header>
        <form class="space-y-6" action="{{ route('phone-numbers.store') }}" method="post">
            @csrf
            <div>
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input x-data x-mask="+9 (999) 999-9999" type="tel" id="phone_number" name="number" required />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>
            <x-primary-button>{{ __('Add Phone Number') }}</x-primary-button>
        </form>
        @foreach (auth()->user()->phoneNumbers as $phoneNumber)
            <form class="flex items-center gap-3" action="{{ route('phone-numbers.destroy', $phoneNumber) }}" method="post">
                @csrf
                @method('DELETE')
                <p class="text-gray-600 dark:text-gray-100">{{ $phoneNumber->number }}</p>
                <x-secondary-button type="submit">{{ __('Remove') }}</x-secondary-button>
            </form>
        @endforeach
</section>
