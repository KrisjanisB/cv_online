<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="grid md:grid-cols-2 md:gap-6 mb-6 ">
                    <div class="relative">
                        <h1 class="text-xl mb-5 after:absolute after:bg-indigo-300 after:left-0 after:bottom-0 after:w-1/5 after:h-0.5 pb-2">
                            Curriculum Vitae</h1>
                    </div>

                    <div class="ml-auto">
                        @if($cv->user_is_owner)

                            @if($cv->is_published)
                                <form action="{{route('cv.update-published', $cv)}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <x-button type="submit" class="ml-4">
                                        {{ __('Unpublish') }}
                                    </x-button>
                                </form>
                            @else
                                <x-link class="ml-4" href="{{route('cv.edit', $cv)}}">
                                    {{ __('Edit') }}
                                </x-link>
                                <form action="{{route('cv.update-published', $cv)}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <x-button type="submit" class="ml-4">
                                        {{ __('Publish') }}
                                    </x-button>
                                </form>

                                <form action="{{route('cv.delete', $cv)}}" class="inline-block" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-button class="ml-4 bg-red-700 hover:bg-red-800" type="submit">
                                        {{ __('Delete') }}
                                    </x-button>
                                </form>

                            @endif
                        @endif
                        @if($cv->is_published)
                            <x-link href="{{route('print', $cv)}}" class="ml-4">
                                {{ __('Print') }}
                            </x-link>
                        @endif


                    </div>

                </div>

                <div class="overflow-x-auto relative">
                    <table class="w-full text-sm text-left text-gray-500 ">
                        <tbody>
                        <tr class="bg-white ">
                            <th scope="row" align="left"
                                class="px-6 font-bold text-gray-900  ">
                                {{$user->full_name}}
                            </th>
                        </tr>
                        <tr class="bg-white" align="left">
                            <th scope="row"
                                class="px-6 font-bold text-gray-900  ">
                                {{$user->profile->phone}}
                            </th>
                        </tr>
                        <tr class="bg-white" align="left">
                            <th scope="row"
                                class="px-6 font-bold text-gray-900  ">
                                {{$user->email}}
                            </th>
                        </tr>
                        <tr class="bg-white" align="left">
                            <th scope="row"
                                class="px-6 font-bold text-gray-900  ">
                                {{$user->profile->full_address}}
                            </th>
                        </tr>
                        </tbody>

                    </table>

                    @if($cv->education->isNotEmpty())
                        <hr class="border-b border-gray-200 dark:border-gray-600 mx-6 my-6">
                        <table class="text-sm text-left text-gray-500 ">
                            <tbody>
                            <thead class="text-xs text-gray-900 uppercase ">
                            <tr align="left">
                                <th scope="col" class="py-3 px-6">
                                    {{__('Education')}}
                                </th>
                            </tr>
                            </thead>
                            @foreach($cv->education as $key => $education)
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{$education->formated_date}}
                                    </th>
                                </tr>
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{__('Level')}}
                                    </th>
                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$education->degree}}

                                    </td>
                                </tr>
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{__('Institution, faculty, etc.')}}
                                    </th>

                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$education->institution . ', ' . $education->faculty}}
                                    </td>

                                </tr>
                                @if($education->speciality)
                                    <tr class="bg-white " align="left">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800  ">
                                            {{__('Specialization')}}
                                        </th>

                                        <td
                                            class="px-6 font-medium text-gray-600  ">
                                            {{$education->speciality}}

                                        </td>
                                    </tr>
                                @endif
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  whitespace-nowrap ">
                                        {{__('Description, achievements, etc.')}}
                                    </th>

                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$education->description}}

                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                @endforeach

                                </tbody>

                        </table>
                    @endif
                    @if($cv->work->isNotEmpty())
                        <hr class="border-b border-gray-200 dark:border-gray-600 mx-6 my-6">
                        <table class=" text-sm text-left text-gray-500 ">
                            <tbody>
                            <thead class="text-xs text-gray-900 uppercase ">
                            <tr align="left">
                                <th scope="col" class="py-3 px-6">
                                    {{__('Work experience')}}
                                </th>
                            </tr>
                            </thead>
                            @foreach($cv->work as $key => $work)
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{$work->formated_date}}
                                    </th>
                                </tr>
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{__('Employer')}}
                                    </th>
                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$work->employer}}

                                    </td>
                                </tr>
                                <tr class="bg-white " align="left">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{__('Position')}}
                                    </th>
                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$work->position}}
                                    </td>

                                </tr>
                                <tr class="bg-white " align="left">
                                    <th
                                        class="px-6 font-semibold text-gray-800 whitespace-nowrap   ">
                                        {{__('Description, achievements, etc.')}}
                                    </th>
                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$work->description}}

                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                @endforeach

                                </tbody>

                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
