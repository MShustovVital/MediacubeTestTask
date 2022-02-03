<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
			{{__('titles.add')}} {{__('titles.employee')}}
		</h2>
	</x-slot>

	<div>
		<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
			<div class="mt-5 md:mt-0 md:col-span-2">
				<form method="post" action="{{ route('employees.store') }}">
					@csrf
					<div class="shadow overflow-hidden sm:rounded-md">
						<div class="px-4 py-5 bg-white sm:p-6">
							<label for="name" class="block font-medium text-sm text-gray-700">Имя</label>
							<input type="text" name="name" id="name"
								   class="form-input rounded-md shadow-sm mt-1 block w-full"
								   value="{{ old('name', '') }}"/>
							@error('name')
							<p class="text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div class="px-4 py-5 bg-white sm:p-6">
							<label for="surname" class="block font-medium text-sm text-gray-700">{{__('titles.surname')}}</label>
							<input type="text" name="surname" id="surname"
								   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
							@error('surname')
							<p class="text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div class="px-4 py-5 bg-white sm:p-6">
							<label for="patronymic" class="block font-medium text-sm text-gray-700">{{__('titles.patronymic')}}</label>
							<input type="text" name="patronymic" id="patronymic"
								   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
							@error('patronymic')
							<p class="text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{__('titles.salary')}}</label>
                            <input type="number" min="0" name="salary" id="salary"
                                   class="form-input rounded-md shadow-sm mt-1 block w-full"/>
                            @error('salary')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="password_confirmation" class="mb-6 block font-medium text-sm text-gray-700">{{__('titles.departments')}}</label>
                            @foreach($departments as $department)
                                <div class="form-check">
                                    <label for="password_confirmation" class="block font-medium text-sm text-gray-700">{{$department->name}}</label>
                                    <input class="form-check-input appearance-none h-4 w-4 border border-gray-300
                                    rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600
                                    focus:outline-none transition duration-200 my-1 align-top bg-no-repeat bg-center bg-contain float-left
                                    cursor-pointer" type="checkbox" value="{{$department->id}}" name="departments[]">
                                </div>
                            @endforeach
                            @error('departments')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

						<div class="px-4 py-5 bg-white sm:p-6">

							<label for="roles" class="block text-sm font-medium text-gray-700">
                                {{__('titles.gender')}}
							</label>

							<select id="gender_id" name="gender_id" autocomplete="country"
									class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">

								@foreach($genders as $gender)
									<option
										value="{{ $gender->id }}">{{ $gender->name }}</option>
								@endforeach
							</select>
							@error('gender_id')
							<p class="text-sm text-red-600">{{ $message }}</p>
							@enderror
						</div>

						<div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
							<button type="submit"
									class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                {{__('titles.add')}}
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</x-app-layout>
