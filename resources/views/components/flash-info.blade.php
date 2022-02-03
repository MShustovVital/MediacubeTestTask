@if (Session::has('status'))

<div x-data="{ show: true }" x-show="show" x-transition x-transition.opacity x-transition.duration.1000ms
	 x-init="setTimeout(() => {show=false}, 5000)"
	 class="bg-blue-50 border-l-4 border-blue-400 mb-8 p-4">
	<div class="flex">
		<div class="flex-shrink-0">
			<x-heroicon-s-information-circle class="h-5 w-5 text-blue-400" />
		</div>
		<div class="ml-3">
			<p class="text-sm text-blue-700">
				{{ Session::get('status') }}
			</p>
		</div>
		<div class="ml-auto pl-3">
			<div class="-mx-1.5 -my-1.5">
				<button type="button" @click="show=false"
						class="inline-flex bg-blue-50 rounded-md p-1.5 text-blue-500 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-50 focus:ring-blue-600">
					<span class="sr-only">Dismiss</span>
					<x-heroicon-s-x class="h-5 w-5 text-blue-500" />
				</button>
			</div>
		</div>
	</div>
</div>

@endif
