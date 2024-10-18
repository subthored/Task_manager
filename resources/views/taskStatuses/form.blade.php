{{ html()->label(__('Name'), 'name')->class('block text-gray-500 mb-3 ') }}
{{ html()->input('text', 'name')->class('shadow-sm block mb-3 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('name')" class="mt-2"/>
