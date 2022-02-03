	<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
		<x-flash-info />
		<div class="block mb-8">
			<a href="{{route("$route.create")}}"
			   class="ml-2 inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
				{{__('titles.add')}}
			</a>
		</div>
		<x-datatable :records="$records" :fields="$fields" :config="$config"></x-datatable>
	</div>
