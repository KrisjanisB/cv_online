@props(['user' => $user])

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors"/>


<form method="POST" action="{{route('cv.store')}}">
    @csrf
    <div class="grid md:grid-cols-2 md:gap-6 mb-6 ">
        <div class="relative">
            <h1 class="text-xl mb-5 after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2">
                Curriculum Vitae</h1>
        </div>
        <div class="ml-auto">
            <x-button class="ml-4">
                {{ __('Save as Draft') }}
            </x-button>
        </div>
    </div>

    <div class="grid md:grid-cols-2 md:gap-6 border-b-2 pb-7 mb-6 border-gray-100 ">

        <div>
            <!-- Name -->
            <div class="mt-2">
                <x-label for="name" :value="__('Name')"/>

                <x-input id="name" class="block mt-1 w-full " type="text" name="name" :value="$user->name" required/>
            </div>

            <!-- Surname -->
            <div class="mt-2">
                <x-label for="surname" :value="__('Surname')"/>

                <x-input id="surname" class="block mt-1 w-full " type="text" name="surname" :value="$user->surname"
                         required/>
            </div>

            <!-- Email -->
            <div class="mt-2">
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full " type="email" name="email" :value="$user->email"
                         required/>
            </div>

        </div>

        <div>
            <!-- Address -->
            <div class="mt-2">
                <x-label for="address" :value="__('Address')"/>

                <x-input id="address" class="block mt-1 w-full" type="text" name="address"
                         :value="$user->profile->address"/>
            </div>
            <!-- City -->
            <div class="mt-2">
                <x-label for="city" :value="__('City')"/>

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="$user->profile->city"
                         required/>
            </div>

            <!-- City -->
            <div class="mt-2">
                <x-label for="country" :value="__('Country')"/>

                <x-input id="country" class="block mt-1 w-full" type="text" name="country"
                         :value="$user->profile->country" required/>
            </div>

            <!-- Zip -->
            <div class="mt-4">
                <x-label for="zip" :value="__('Postal code')"/>

                <x-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="$user->profile->zip"/>
            </div>
        </div>

    </div>

    <!-- Education -->
    <div data-field-group="education" class="border-gray-100 border-b-2 pb-6 mb-6">
        <h2 class="mb-4">{{__('Please add your education level. Beginning with the latest.')}}</h2>

        @if(request()->old('education'))
            @foreach (request()->old('education') as $key => $education)
                <x-cv._education :errors="$errors" :old="$education" :key="$key"/>
            @endforeach
        @else
            <x-cv._education/>
        @endif
        <x-button type="button" class="add-new-input">
            {{ __('Add new item') }}
        </x-button>
    </div>

    <!-- Work experience -->
    <div data-field-group="work" class=" pb-6 mb-6">
        <h2 class="mb-4">{{__('Please add your previous work experience. Beginning with the latest.')}}</h2>
        @if(request()->old('work'))
            @foreach (request()->old('work') as $key => $work)
                <x-cv._work :errors="$errors" :old="$work" :key="$key"/>
            @endforeach
        @else
            <x-cv._work/>
        @endif
        <x-button type="button" class="add-new-input">
            {{ __('Add new item') }}
        </x-button>

    </div>


    <div class="flex items-center justify-end mt-4">

        <x-button class="ml-4">
            {{ __('Save as Draft') }}
        </x-button>
    </div>
</form>
