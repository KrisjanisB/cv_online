@props(['user' => $user, 'cv' => $cv ?? null])

<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors"/>


<form method="POST" action="{{request()->routeIs('cv.edit') ? route('cv.update', $cv): route('cv.store')}}">
    @csrf
    @if(request()->routeIs('cv.edit'))
        @method('PUT')
    @endif
    <div class="grid md:grid-cols-2 md:gap-6 mb-6 ">
        <div class="relative">
            <h1 class="text-xl mb-5 after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2">
                Curriculum Vitae</h1>
        </div>
        <div class="ml-auto">
            <x-button class="ml-4">
                {{ __('Save') }}
            </x-button>
        </div>
    </div>

    <div class="grid md:grid-cols-2 md:gap-6 border-b-2 pb-7 mb-6 border-gray-100 ">

        <div>
            <!-- Name -->
            <div class="mt-2">
                <x-label for="name" :value="__('Name')"/>
                <div class="relative">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 " >
                        <svg  class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                <x-input id="name" class=" pl-10  block mt-1 w-full " type="text" name="name" :value="$user->name" required :disabled="true"/>
                </div>
            </div>

            <!-- Surname -->
            <div class="mt-2">
                <x-label for="surname" :value="__('Surname')"/>
                <div class="relative ">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                <x-input id="surname" class="pl-10 block mt-1 w-full " type="text" name="surname" :value="$user->surname"
                          :disabled="true"/>
                </div>
            </div>

            <!-- Email -->
            <div class="mt-2">
                <x-label for="email" :value="__('Email')"/>
                <div class="relative ">
                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                <x-input id="email" class="pl-10 block mt-1 w-full " type="email" name="email" :value="$user->email"
                         required :disabled="true"/>
                </div>
            </div>

            <!-- Phone -->
            <div class="mt-2">
                <x-label for="phone" :value="__('Phone')"/>

                <x-input id="phone" class="block mt-1 w-full "  type="tel" name="phone" :value="$user->profile->phone"
                         required />
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
        @elseif(isset($cv->education) && $cv->education->isNotEmpty())
            @foreach ($cv->education as $key => $education)
                <x-cv._education :education="$education" :key="$key"/>
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
        @elseif(isset($cv->work) && $cv->work->isNotEmpty())
            @foreach ($cv->work as $key => $work)
                <x-cv._work :work="$work" :key="$key"/>
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
            {{ __('Save') }}
        </x-button>
    </div>
</form>
