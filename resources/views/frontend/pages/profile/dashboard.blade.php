<x-frontend.auth.app>
    <x-slot name="title">Dashboard</x-slot>

    <main>
        <h2 class="text-3xl font-bold capitalize">welcome to user dashboard</h2>
        @can('update permissions', 'web')
        <p class="text-center italic text-gray-500">{{ Auth::guard('web')->user()->name }}</p>

        @endcan
        <ul class="flex flex-row justify-center items-center">
            <li>
                <button class="inline-block mt-2 text-gray-400 hover:text-gray-950" onclick="$('#logout').submit()">Logout</button>
            </li>
        </ul>
    </main>
</x-frontend.auth.app>
