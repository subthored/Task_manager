@props(['headers', 'routes', 'items', 'fields'])

<table {{ $attributes->merge(['class' => 'mt-5 w-full']) }}>
    <thead class="border-b-2 border-solid border-black text-left">
    <tr>
        @foreach($headers as $header)
            <th>
                {{ $header }}
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    @foreach($items as $item)
        <tr class="border-b border-dashed text-left">
            @foreach($fields as $value)
                <td>
                    @switch($value)
                        @case('created_at')
                            {{$item->$value->format('d.m.Y')}}
                            @break
                        @case('action')
                            @foreach($routes as $key=>$route)
                                <x-table.action-link :item="$item" :route="$route" :name="$key"/>
                            @endforeach
                            @break
                        @case('name')
                            @if($item instanceof \App\Models\Task)
                                <a class="text-blue-600 hover:text-blue-900"
                                   href="{{ route('tasks.show', $item->id) }}">
                                    {{ $item->$value }}
                                </a>
                                @else
                                    {{ $item->$value }}
                            @endif
                            @break
                        @default
                            {{ $item->$value }}
                    @endswitch
                </td>
            @endforeach
        </tr>
{{--                <td>--}}
{{--                    <a href="{{ route('task_statuses.destroy', $status) }}"--}}
{{--                       class="text-red-600 mr-4"--}}
{{--                       data-confirm="Вы уверены?"--}}
{{--                       data-method="delete"--}}
{{--                       rel="nofollow">{{ __('Delete') }}--}}
{{--                    </a>--}}
{{--                    <a href="{{ route('task_statuses.edit', $status) }}"--}}
{{--                       class="text-blue-600"--}}
{{--                       data-method="get"--}}
{{--                       rel="nofollow">{{ __('Change') }}--}}
{{--                    </a>--}}
{{--                </td>--}}
{{--        @endauth--}}
    @endforeach
    </tbody>
</table>
