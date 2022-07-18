@props(['errors' => null, 'old' => null, 'key' => 1, 'work' => null])

<div data-field-id="{{$key}}">
    <div class="relative mb-4">
        <x-label
            class="after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2"
            for="work" :value="__('Work experience')"/>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6 mb-6 border-gray-100 ">
        <div>

            <x-input id="work" class="block mt-2 w-full " type="text" name="work[{{$key}}][position]"
                     :value="old('work.'. $key .'.position', $work ? $work ->position : '')"
                     placeholder="{{__('Position')}}"/>
            @error('work.'. $key .'.position') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror

            <x-input class="block mt-2 w-full " type="text" name="work[{{$key}}][employer]"
                     :value="old('work.'. $key .'.employer', $work ? $work ->employer : '')"

                     placeholder="{{__('Employer')}}"/>
            @error('work.'. $key .'.employer') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror

            <x-input class="block mt-2 w-full l" type="text" name="work[{{$key}}][city]"
                     :value="old('work.'. $key .'.city',  $work ? $work ->city : '')"

                     placeholder="{{__('City')}}"/>
            @error('work.'. $key .'.city') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror

            <x-input class=" block mt-2 w-full  " type="text" name="work[{{$key}}][country]"
                     :value="old('work.'. $key .'.country',  $work ? $work ->country : '')"

                     placeholder="{{__('Country')}}"/>
            @error('work.'. $key .'.country') <small
                class=" block text-red-500 my-1">{{__('Please correct and submit again')}}</small> @enderror

        </div>

        <div>
            <div class="grid md:grid-cols-3 md:gap-6 ">
                <x-input class=" mt-2" type="date" id="start_date" name="work[{{$key}}][start_date]"
                         min="1990-01" value="2022-05"
                         :value="old('work.'. $key .'.start_date',  $work ? $work->start_date->format('Y-m-d') : '')"/>
                <x-input class=" mt-2 " type="date" id="end_date" name="work[{{$key}}][end_date]"
                         min="1990-01" value="2022-05"
                         :value="old('work.'. $key .'.end_date', $work && $work->end_date ? $work->end_date->format('Y-m-d') : '')"/>
                <div class="form-check flex justify-center items-center">
                    <input type="checkbox"
                           class="form-check-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mr-2 is_active"
                           name="work[{{$key}}][is_active]"
                           value="1" {{(isset($work) && $work->is_active == 1 ? 'checked' : '') }} {{old('work.'.$key.'.is_active') == 1 ? 'checked' : ''}} />
                    <x-label class="form-check-label inline-block" :value="__('Present')"/>
                </div>
            </div>
            <div class="my-4">
                <div class="form-check">

                    <input id="is_full_time" type="checkbox"
                           class="form-check-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="education[{{$key}}][is_full_time]"
                           value="1" {{(isset($work) && $work->is_full_time == 1 ? 'checked' : '') }} {{old('work.'.$key.'.is_full_time') == 1 ? 'checked' : ''}} />
                    <x-label class="form-check-label inline-block" for="is_full_time" :value="__('Is Full time')"/>

                </div>
            </div>

            <textarea rows="3" maxlength="500"
                      class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                      placeholder="Description"
                      name="work[{{$key}}][description]">{{old('work.'.$key.'.description',  $work ? $work ->description : '')}}</textarea>

        </div>
    </div>

    <div class="flex flex-row justify-end">
        <x-button
            class="delete-input {{$key != null && isset($work)? '': 'hidden'}} focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            {{ __('Remove') }}
        </x-button>
    </div>

</div>
