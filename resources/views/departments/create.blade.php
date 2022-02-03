<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('titles.add')}} {{__('titles.department')}}
		</h2>
	</x-slot>

	<div>
		<div class="max-w-6xl min-h-full mx-auto py-10 sm:px-6 lg:px-8">
			<div class="mt-5 md:mt-0 md:col-span-2">
				<form method="post" class="min-h-screen" action="{{ route('departments.store') }}">
					@csrf
					<div class="shadow overflow-hidden sm:rounded-md">
						<div class="px-4 py-5 bg-white sm:p-6">
							<label for="name" class="block font-medium text-sm text-gray-700">{{__('titles.name')}}</label>
							<input type="text" name="name" maxlength="255" id="value"
								   class="form-input rounded-md shadow-sm mt-1 block w-full"
							/>
							@error('name')
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
