<div class="fixed w-full">
    <nav class="bg-white border-gray-200 py-2.5 shadow-md ">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">

            <div class="logo flex items-center">
                <div class="shrink-0 pr-2">
                    <a href="{{ route('index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800"/>
                    </a>
                </div>

                <a href="{{ route('index') }}" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap">Task manager</span>
                </a>
            </div>

            <div class="flex items-center lg:order-2">
                @auth
                    <div>{{ Auth::user()->name }}</div>
                    <x-primary-a-button :route="route('logout')" :method="'POST'" class="ml-4">
                        {{__('Sign out')}}
                    </x-primary-a-button>
                @endauth
                @guest
                    <x-primary-a-button :route="route('login')" :method="'GET'" class="ml-4">
                        {{__('Sign in')}}
                    </x-primary-a-button>
                    <x-primary-a-button :route="route('register')" :method="'GET'" class="ml-4">
                        {{__('Sign up')}}
                    </x-primary-a-button>
                @endguest
            </div>

            <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('tasks.index') }}"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{__('Tasks')}} </a>
                    </li>
                    <li>
                        <a href="{{ route('task_statuses.index') }}"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{__('Statuses')}} </a>
                    </li>
                    <li>
                        <a href="{{route('labels.index')}}"
                           class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0">
                            {{__('Labels')}} </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
