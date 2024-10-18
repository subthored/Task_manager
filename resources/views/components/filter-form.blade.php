<div class="flex">
    {{ html()->modelForm($task, 'GET', route('tasks.index', $task))->id('filterForm')->open() }}
    {{ html()->select('filter[status_id]', ['0' => 'Status'] + $taskStatuses->pluck('name', 'id')->toArray(), $filters['status_id'] ?? null)->class('rounded border-gray-300') }}
    {{ html()->select('filter[created_by_id]', ['0' => 'Author'] + $users->pluck('name', 'id')->toArray(), $filters['created_by_id'] ?? null)->class('rounded border-gray-300') }}
    {{ html()->select('filter[assigned_to_id]', ['0' => 'Executor'] + $users->pluck('name', 'id')->toArray(), $filters['assigned_to_id'] ?? null)->class('rounded border-gray-300') }}
    {{ html()->submit(__('Apply'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded') }}
    {{ html()->reset(__('Reset'))->class('bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded')->attribute('id', 'resetButton') }}
    {{ html()->closeModelForm() }}
</div>
