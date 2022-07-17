<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(!Auth::user()->profile)
                        Please update your profile before you can continue.
                        <x-profile-update-form/>
                    @else

                        <a href="{{route('cv.create')}}"> Lets add your first CV</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
