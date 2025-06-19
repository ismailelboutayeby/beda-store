@extends('layouts.app')
@section('content')
<div class="container mx-auto p-4 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">{{ isset($user) ? 'Edit User' : 'Create User' }}</h1>
    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" class="bg-white shadow rounded-lg p-6" autocomplete="off">
        @csrf
        @if(isset($user))
            @method('PUT')
        @endif
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Password @if(!isset($user))<span class="text-xs text-gray-400">(required)</span>@endif</label>
            <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" @if(!isset($user)) required @endif>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Role</label>
            <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" @if(isset($user) && $user->roles->contains('name', $role->name)) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 mb-2">Permissions</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach($permissions as $permission)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-checkbox" @if(isset($user) && $user->permissions->contains('name', $permission->name)) checked @endif>
                        <span class="ml-2">{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">{{ isset($user) ? 'Update' : 'Create' }}</button>
        </div>
    </form>
</div>
@endsection
