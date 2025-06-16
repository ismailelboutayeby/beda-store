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
        <a href="/logout">Logout</a>
    </nav>
</header>
