<x-filament::page>
    <h1 class="text-2xl font-semibold text-gray-800">Dashboard</h1>

    <div class="mt-6">
        <h3 class="text-xl font-semibold">Total Users: {{ $userCount }}</h3>

        <div class="mt-4">
            <h3 class="text-lg font-semibold">Users List</h3>
            <ul class="space-y-2">
                @foreach($users as $user)
                    <li class="flex justify-between">
                        <span>{{ $user->name }}</span>
                        <span>{{ $user->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-filament::page>
