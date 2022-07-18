<div class="flex flex-col pt-6 sm:pt-0">

    <div class="w-full  mt-6 py-4 overflow-hidden sm:rounded-lg">
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('store')}}">
            @csrf

            <!-- Phone -->
            <div class="">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" autofocus />
            </div>

            <!-- Country -->
            <div class="mt-4">
                <x-label for="country" :value="__('Country')" />

                <x-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" required  />
            </div>

            <!-- City -->
            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" required  />
            </div>


            <!-- Address -->
            <div class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')"  />
            </div>

            <!-- Zip -->
            <div class="mt-4">
                <x-label for="zip" :value="__('Postal code')" />

                <x-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip')"  />
            </div>


            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
