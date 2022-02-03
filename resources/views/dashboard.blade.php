<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Str::ucfirst( __('titles.grid')) }}
        </h2>
    </x-slot>

    <div class="flex flex-col mt-4 items-center">
        <div class="-my-2 overflow-x-auto ">
            <div class="py-2 inline-block  sm:px-6 lg:px-8">
                <div class=" overflow-hidden sm:rounded-lg">
                    <table class="min-w-xl-6 divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            @foreach($departments as $department)
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{$department->name}}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($employees as $employee)
                            <th class="px-6 py-2 text-left text-gray-500">
                            {{$employee->full_name}}
                            @foreach($departments as $department)
                                @if(($employee->departments->contains('name',$department->name)))
                                    <th class="px-6 py-2 text-xs text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </th>
                                @else
                                    <th class="px-6 py-2 text-xs text-gray-500">

                                    </th>
                                    @endif
                                    @endforeach
                                    </tr>
                                    @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <div class="mt-6">
            {{ $employees->links() }}
        </div>
    </div>

</x-app-layout>
