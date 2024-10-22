{{ html()->label(__('Имя'), 'name')->class('block text-gray-700 mb-3 ') }}
{{ html()->input('text', 'name')->class('shadow-sm block mb-2 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('name')" class="mt-2"/>

{{ html()->label(__('Описание'), 'description')->class('block text-gray-700 mb-3 ') }}
{{ html()->textarea('description')->class('shadow-sm block mb-3 required: w-1/3 h-32')}}
<x-task-input-error :messages="$errors->get('description')" class="mt-2"/>
