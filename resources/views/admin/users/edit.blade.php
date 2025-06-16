<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Edit User Role – {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <x-flash />

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block font-medium text-sm text-gray-700" for="role">Role</label>
                <select name="role" id="role" class="w-full mt-1 rounded border-gray-300">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                💾 Save Role
            </button>
        </form>
    </div>
</x-app-layout>

