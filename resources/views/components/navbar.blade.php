<nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand">Navbar</a>

    {{-- AUTH --}}
    @auth
        <div class="d-flex gap-1">
            <h3>Welcome {{auth()->user()->username}}!</h3>            
            <form action="{{route('auth.logout')}}" method="post" class="form-inline">
                @csrf
                <button class="btn btn-primary" type="submit">Logout</button>
            </form>
        </div>
    @endauth

    {{-- GUEST --}}
    @guest
        <div>
            <a href="{{route('auth.register')}}" class="btn btn-primary">Register</a>
            <a href="{{route('auth.login')}}" class="btn btn-primary">Login</a>
        </div>
    @endguest
</nav>