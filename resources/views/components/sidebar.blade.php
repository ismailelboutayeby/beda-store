<div class="w-full md:w-64 bg-white shadow-md p-4">
    <h2 class="text-2xl font-bold mb-6">BedaStore</h2>
    
    <ul class="space-y-2">
        <li><a href="{{ route('dashboard') }}" class="block hover:text-blue-600">Dashboard</a></li>

        @role('admin')
        <li><a href="{{ route('admin.users.index') }}" class="block hover:text-blue-600">Manage Users</a></li>
        @endrole

        @role('designer')
        <li><a href="{{ route('designer.orders.index') }}" class="block hover:text-blue-600">Design Orders</a></li>
        @endrole

        @role('warehouse')
        <li><a href="{{ route('warehouse.orders.index') }}" class="block hover:text-blue-600">Warehouse Orders</a></li>
        @endrole
    </ul>
</div>
