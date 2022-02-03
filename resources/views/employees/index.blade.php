<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('titles.employees') }}
        </h2>
    </x-slot>

    <x-crud-datatable :records="$employees"
                      :fields="['id','name','created_at','updated_at']"
                      :config="['entity'=>'employee','actions'=>true]"></x-crud-datatable>
</x-app-layout>
