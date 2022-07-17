<x-app-layout>
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
                            @auth()
                                <x-button class="ml-4">
                                    {{ __('Edit') }}
                                </x-button>
                                @if($cv->is_published)
                                    <x-button class="ml-4">
                                        {{ __('Unpublish') }}
                                    </x-button>
                                @endif
                            @endauth
                            <x-button class="ml-4">
                                {{ __('Print') }}
                            </x-button>
                        </div>
                    </div>

                    <div class="overflow-x-auto relative">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <tbody>
                            <tr class="bg-white ">
                                <th scope="row"
                                    class="px-6 font-bold text-gray-900  ">
                                    {{$user->full_name}}
                                </th>
                            </tr>
                            <tr class="bg-white ">
                                <th scope="row"
                                    class="px-6 font-bold text-gray-900  ">
                                    {{$user->email}}
                                </th>
                            </tr>
                            <tr class="bg-white ">
                                <th scope="row"
                                    class="px-6 font-bold text-gray-900  ">
                                    {{$user->profile->full_address}}
                                </th>
                            </tr>
                            </tbody>

                        </table>
                        <hr class="border-b border-gray-200 dark:border-gray-600 mx-6 my-6">
                        <table class="w-full text-sm text-left text-gray-500 ">
                            <tbody>
                            <thead class="text-xs text-gray-900 uppercase ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Education
                                </th>
                            </tr>
                            </thead>
                            @foreach($cv->education as $key => $education)
                                <tr class="bg-white ">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        {{$education->formated_date}}
                                    </th>
                                </tr>
                                <tr class="bg-white ">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        Level
                                    </th>
                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$education->degree}}

                                    </td>
                                </tr>
                                <tr class="bg-white ">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        Institution, faculty, etc.
                                    </th>

                                    <td
                                        class="px-6 font-medium text-gray-600  ">
                                        {{$education->institution . ', ' . $education->faculty}}
                                    </td>

                                </tr>
                                @if($education->speciality)
                                    <tr class="bg-white ">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800  ">
                                            Specialization
                                        </th>

                                        <td
                                            class="px-6 font-medium text-gray-600  ">
                                            {{$education->speciality}}

                                        </td>
                                    </tr>
                                @endif
                                <tr class="bg-white ">
                                    <th scope="row"
                                        class="px-6 font-semibold text-gray-800  ">
                                        Description, achievements, etc.
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
                        @if($cv->work_experiance->isNotEmpty())
                            <hr class="border-b border-gray-200 dark:border-gray-600 mx-6 my-6">
                            <table class="w-full text-sm text-left text-gray-500 ">
                                <tbody>
                                <thead class="text-xs text-gray-900 uppercase ">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Work experience
                                    </th>
                                </tr>
                                </thead>
                                @foreach($cv->work_experiance as $key => $work)
                                    <tr class="bg-white ">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800  ">
                                            {{$work->formated_date}}
                                        </th>
                                    </tr>
                                    <tr class="bg-white ">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800  ">
                                            Employer
                                        </th>
                                        <td
                                            class="px-6 font-medium text-gray-600  ">
                                            {{$work->employer}}

                                        </td>
                                    </tr>
                                    <tr class="bg-white ">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800  ">
                                            Position
                                        </th>
                                        <td
                                            class="px-6 font-medium text-gray-600  ">
                                            {{$work->position}}
                                        </td>

                                    </tr>
                                    <tr class="bg-white ">
                                        <th scope="row"
                                            class="px-6 font-semibold text-gray-800   ">
                                            Description, achievements, etc.
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
</x-app-layout>
