<nav class="navbar navbar-light bg-white border-bottom shadow-sm justify-content-between px-2">
    <a class="navbar-brand p-0" href='{{ route('note.index') }}'><h3 class="m-0">{{config('app.name')}}</h3></a>

    {{-- AUTH --}}
    @auth
        <div class="d-flex flex-row-reverse align-items-center gap-3">
            <form action="{{route('auth.logout')}}" method="post" class="form-inline">
                @csrf
                <button class="btn btn-primary d-inline-flex align-items-center gap-1" type="submit"><i data-feather="log-out"></i> Logout</button>
            </form>
            <div class="dropdown open">
                <h3 class="m-0 me-3">
                    <span class="text-muted fs-5">Welcome </span>
                    <span style="cursor: pointer" data-bs-toggle="dropdown" aria-expanded="false">{{auth()->user()->username}}!</span>
                    <div class="dropdown-menu dropdown-menu-end bg-white" aria-labelledby="userDropdown" >
                        <a class="dropdown-item" href="{{ route('profile') }}">Edit profile</a>
                        {{-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">After divider action</a> --}}
                    </div>
                </h3>

            </div>

        </div>
    @endauth

    {{-- GUEST --}}
    @guest
        <div>
            <a href="{{route('auth.register')}}" class="btn btn-primary d-inline-flex align-items-center"><i data-feather="user-plus" class="align-middle me-2"></i>Register</a>
            <a href="{{route('auth.login')}}" class="btn btn-primary d-inline-flex align-items-center"><i data-feather="user" class="align-middle me-2"></i>Login</a>
        </div>
    @endguest
</nav>
