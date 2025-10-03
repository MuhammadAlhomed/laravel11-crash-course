<x-layout>
    <div class="vh-100 d-flex justify-content-center align-items-sm-center">
        <div class="col-md-4 card p-4 bg-white shadow">
            <h1 class="h1 justify-text-center">Register new account</h1>
            <form action="{{route('auth.register')}}" method="post">
                @csrf
                <div class='mb-3'>
                    <x-form-label for='username'>Username</x-form-label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                        <x-form-input name='username' type='text' placeholder='username' value="{{ old('username')}}" required/>
                    </div>
                </div>
                <div class='mb-3'>
                    <x-form-label for='email'>Email</x-form-label>
                    <x-form-input name='email' type='email' placeholder="John@doe.com" value="{{ old('email') }}" required/>
                </div>
                <div class='mb-3'>
                    <x-form-label for='password'>Password</x-form-label>
                    <x-form-input name='password' type='password' required/>
                </div>
                <div class='mb-3'>
                    <x-form-label for='password_confirmation'>Confirm Password</x-form-label>
                    <x-form-input name='password_confirmation' type='password' required/>
                </div>
                <div class='mb-3'>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        />
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-end">
                        <button type="submit"class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
