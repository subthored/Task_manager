{{ html()->label(__('Имя'), 'name')->class('block text-gray-700 mb-3 ') }}
{{ html()->input('text', 'name')->class('shadow-sm block mb-3 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('name')" class="mt-2"/>

{{ html()->label(__('Описание'), 'description')->class('block text-gray-700 mb-3') }}
{{ html()->textarea('description')->class('  shadow-sm block mb-3 required: w-1/3 h-32')  }}

{{ html()->label(__('Статус'), 'status_id')->class('block text-gray-700 mb-3') }}
{{ html()->select('status_id', ['0' => ''] + $taskStatuses->pluck('name', 'id')->toArray())
    ->class(' shadow-sm block mb-3 required: w-1/3') }}
<x-task-input-error :messages="$errors->get('status_id')" class="mt-2"/>

{{ html()->label(__('Исполнитель'), 'executor')->class('block text-gray-700 mb-3') }}
{{ html()->select('assigned_to_id', ['' => ''] + $users->pluck('name', 'id')->toArray())
    ->class(' shadow-sm block mb-3 required: w-1/3') }}

<div class="w-1/3 flex flex-col">
    <div class="flex justify-between items-center mb-3">
        {{ html()->label(__('Метки'), 'points')->class('block text-gray-700') }}
        <button class="plus-button" id="labelCreateButton">✚</button>
    </div>
</div>
{{ html()->select('labels', $labels->pluck('name', 'id')->toArray())->multiple()
    ->class('shadow-sm block mb-3 required: w-1/3 h-40') }}
