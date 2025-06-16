<main>
    @if($role === 'admin')
        <h2>Welcome, Admin!</h2>
        <p>Here you can manage the application and users.</p>
    @else
        <h2>Welcome, User!</h2>
        <p>Here is your dashboard overview.</p>
    @endif
</main>
