<x-app-layout>
    <div class="py-12">

            <div class="max-w-7xl mx-auto px-6 lg:px-8 mb-4">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 flex flex-col md:flex-row justify-between ">
                        <p>Welcome to <strong>CV - MARKET</strong> ! </p>
                        @guest
                        <p>If you wish to upload your CV, please <a href="{{route('login')}}" class="text-indigo-600">
                                login</a>
                            or <a href="{{route('register')}}" class="text-indigo-600"> register</a>.</p>
                        @endguest
                        @auth
                            <x-link class="mt-2 flex justify-center" href="{{route('cv.create')}}"> {{__('Lets add a new CV')}} </x-link>
                        @endauth
                    </div>
                </div>
            </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($cvs->isNotEmpty())
                        <div class="overflow-x-auto relative">

                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        {{__('Submitter')}}
                                    </th>
                                    <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                        {{__('Residence')}}
                                    </th>
                                    <th scope="col" class="py-3 px-6 hidden md:table-cell">
                                        {{__('Last updated')}}
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
                                            {{$cv->user->full_name}}
                                        </th>
                                        <td class="py-4 px-6 hidden md:table-cell">
                                            {{$cv->user->profile->city . ', ' . $cv->user->profile->country}}
                                        </td>
                                        <td class="py-4 px-6 hidden md:table-cell">
                                            {{$cv->updated_at->diffForHumans()}}
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

                        </div>
                    @else
                        <svg width="96" height="96" fill="none" class="mx-auto mb-6 text-gray-900"><path d="M36 28.024A18.05 18.05 0 0025.022 39M59.999 28.024A18.05 18.05 0 0170.975 39" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><ellipse cx="37.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse><ellipse cx="58.5" cy="43.5" rx="4.5" ry="7.5" fill="currentColor"></ellipse><path d="M24.673 75.42a9.003 9.003 0 008.879 5.563m-8.88-5.562A8.973 8.973 0 0124 72c0-7.97 9-18 9-18s9 10.03 9 18a9 9 0 01-8.448 8.983m-8.88-5.562C16.919 68.817 12 58.983 12 48c0-19.882 16.118-36 36-36s36 16.118 36 36-16.118 36-36 36a35.877 35.877 0 01-14.448-3.017" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M41.997 71.75A14.94 14.94 0 0148 70.5c2.399 0 4.658.56 6.661 1.556a3 3 0 003.999-4.066 12 12 0 00-10.662-6.49 11.955 11.955 0 00-7.974 3.032c1.11 2.37 1.917 4.876 1.972 7.217z" fill="currentColor"></path></svg>
                    <p class="text-center font-bold">No CVs yet!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
