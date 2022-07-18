<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-4">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 flex justify-between bg-white border-b border-gray-200">
                    <p>{{__('Welcome')}}, <strong>{{$user->full_name}}</strong>! </p>
                    @if($cvs->isNotEmpty())
                        <x-link href="{{route('cv.create')}}"> {{__('Lets add a new CV')}} </x-link>
                    @endif
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(!$user->profile)
                        <p> {{__(' Please update your profile before you can continue.')}}</p>
                        <x-profile-update-form/>
                    @else
                        <div class="relative">
                            <h1 class="text-xl mb-5 after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2">{{__('Your CVs')}}</h1>
                        </div>
                        @if($cvs->isNotEmpty())
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        {{__('Last updated')}}
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Elements
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Published
                                    </th>

                                    <th scope="col" class="py-3 px-6">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cvs as $cv )
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" align="left">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{$cv->updated_at->diffForHumans()}}
                                        </th>
                                        <td class="py-4 px-6 hidden md:table-cell ">
                                            Education: {{count($cv->education)}}<br>
                                            Work Experience: {{count($cv->work)}}<br>
                                        </td>
                                        <td class="py-4 px-6 hidden md:table-cell ">
                                            @if($cv->is_published)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                     viewBox="0 0 20 20" fill="green">
                                                    <path fill-rule="evenodd"
                                                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6" align="right">
                                            <x-link href="{{route('public.cv.show', $cv->id)}}"
                                            >View
                                            </x-link>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        @else
                            <p class="text-center mb-4">Now lets add your first CV!</p>
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-20 " fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <x-link href="{{route('cv.create')}}"> Lets go!</x-link>
                            </div>

                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
