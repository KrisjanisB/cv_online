@props(['errors' => null, 'old' => null, 'key' => 1, 'education' => null])


<div data-field-id="{{$key}}">
    <div class="relative mb-4">
        <x-label
            class="after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2"
            for="education" :value="__('Education')"/>
    </div>
    <div class="grid md:grid-cols-2 md:gap-6 mb-6 border-gray-100 ">
        <div>
            <select id="education" name="education[{{ $key }}][degree]"
                    class="block mt-2 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 higher-education-select"
                     required>
                <option selected disabled>{{__('Please Select Appropriate')}}</option>
                @foreach(\App\Models\Education::EDUCATION_LEVELS as $level)
                    <option
                        value="{{$level}}" {{(isset($education) && $education->degree == $level ? 'selected' : '') }} {{old('education.'.$key.'.degree') == $level ? 'selected' : ''}} >{{$level}} </option>
                @endforeach
            </select>

            <x-input class="block mt-2 w-full " type="text" name="education[{{ $key }}][institution]"
                     :value="$education->institution ?? old('education.'. $key .'.institution')"
                     placeholder="Institution"
                     required/>
            @error('education.'. $key .'.institution') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror

            <x-input class="block mt-2 w-full hidden higher-education {{isset($education->faculty) ? '' : 'hidden'}}" type="text" name="education[{{ $key }}][faculty]"
                     :value="$education->faculty ?? old('education.'. $key .'.faculty')" placeholder="Faculty"
                     :disabled="!isset($education->faculty)"/>
            @error('education.'. $key .'.faculty') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror

            <x-input class="block mt-2 w-full higher-education {{isset($education->speciality) ? '' : 'hidden'}}" type="text"
                     name="education[{{ $key }}][speciality]"
                     :value="$education->speciality ?? old('education.'. $key .'.speciality')" placeholder="Speciality"
                     :disabled="!isset($education->speciality)"
                      />
            @error('education.'. $key .'.speciality') <small
                class=" block text-red-500 mt-1">{{__('Please correct and submit again')}}</small> @enderror
        </div>


        <div>
            <div class="grid md:grid-cols-3 md:gap-6">

                <x-input class=" mt-2" type="date" id="start_date" name="education[{{$key}}][start_date]"
                         min="1990-01" max="2022-05"
                         :value="old('education.'. $key .'.start_date', $education ? $education->start_date->format('Y-m-d') : '')"/>
                <x-input class=" mt-2 " type="date" id="end_date" name="education[{{$key}}][end_date]"
                         min="1990-01" max="2022-05"
                         :value="old('education.'. $key .'.end_date', $education ? $education->start_date->format('Y-m-d') : '')"/>
                <div class="form-check flex justify-center items-center">
                    <input type="checkbox"
                           class="form-check-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mr-5 is_active"
                           name="education[{{$key}}][is_active]"
                           value="1" {{(isset($education) && $education->is_active == 1 ? 'checked' : '') }} {{old('education.'.$key.'.is_active') == 1 ? 'checked' : ''}} />
                    <x-label class="form-check-label inline-block" :value="__('Still learning?')"/>

                </div>
            </div>
            <div class="my-4">
                <div class="form-check">
                    <input type="checkbox"
                           class="form-check-input rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="education[{{$key}}][is_finished]"
                           value="1" {{(isset($education) && $education->is_finished == 1 ? 'checked' : '') }} {{old('education.'.$key.'.is_finished') == 1 ? 'checked' : ''}} />
                    <x-label class="form-check-label inline-block" :value="__('Is completed')"/>

                </div>

            </div>
            <textarea
                rows="3" maxlength="500"
                class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Description"
                type="text" name="education[{{ $key }}][description]"

                required>{{old('education.'. $key .'.description', $education ? $education->description : '')}}</textarea>
            @error('education.'. $key .'.description') <small class=" block text-red-500 mt-1">
                {{__('Please correct and submit again')}}</small> @enderror


        </div>
    </div>
    <div class="flex flex-row justify-end ">
        <x-button
            class="delete-input {{$key >= 0 && isset($education) ? '': 'hidden'}}  focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            {{ __('Remove') }}
        </x-button>
    </div>

</div>

