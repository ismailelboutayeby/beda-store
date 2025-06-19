<header>
    <h1>
        @if($role === 'admin')
            Admin Panel
        @else
            User Dashboard
        @endif
    </h1>
    <nav>
        <a href="/">Home</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="background:none;border:none;padding:0;color:#007bff;cursor:pointer;">Logout</button>
        </form>
    </nav>
</header>
