<div class="flex flex-col mt-4 items-center">
    <div class="-my-2 overflow-x-auto ">
        <div class="py-2 inline-block  sm:px-6 lg:px-8">
            <div class=" overflow-hidden sm:rounded-lg">
                <table class=" divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($fields as $field)
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{$field}}
                            </th>
                        @endforeach
                        @if($actions)
                            <th scope="col"
                                class="text-center px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                    @foreach($records as $record)

                        <tr>
                            @foreach($fields as $field)

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$record->$field}}
                                </td>

                            @endforeach
                            @if($actions)
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                                    <div class="flex flex-row justify-center">

                                        <a href="{{route("$route.edit",[$entity=>$record])}}"
                                           class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            {{__('titles.edit')}}
                                        </a>

                                        <form method="POST" onsubmit="return confirm('Вы уверены?');"
                                              action="{{route("$route.destroy",[$entity=>$record])}}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit"
                                                    class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-100 hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                {{__('titles.delete')}}
                                            </button>
                                        </form>

                                    </div>

                                </td>
                            @endif
                        </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="mt-6">
        {{ $records->links() }}
    </div>
</div>
