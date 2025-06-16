<aside>
    @if($role === 'admin')
        <ul>
            <li><a href="/admin">Admin Dashboard</a></li>
            <li><a href="/admin/users">Manage Users</a></li>
            <li><a href="/admin/settings">Settings</a></li>
        </ul>
    @else
        <ul>
            <li><a href="/dashboard">Dashboard</a></li>
            <li><a href="/profile">Profile</a></li>
        </ul>
    @endif
</aside>
