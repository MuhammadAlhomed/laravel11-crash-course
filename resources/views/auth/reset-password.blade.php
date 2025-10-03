<x-layout>
    <div class="h-100 d-flex justify-content-center align-items-sm-center">
        <div class="col-md-6 col-xl-5 card p-4 bg-white shadow">
            <h1 class="h1 justify-text-center">Reset Password</h1>
            <form action="{{route('auth.reset-password')}}" method="post">
                @csrf
                <input type="hidden" name="token", value="{{ request()->query('token') }}">
                <div class='mb-3'>
                    <p>Resetting password for: <strong>{{ $resetToken->email }}</strong></p>
                </div>
                <div class='mb-3'>
                    <x-form-label for='password'>Password</x-form-label>
                    <x-form-input name='password' type='password' required/>
                </div>
                <div class='mb-3'>
                    <x-form-label for='password_confirmation'>Confirm Password</x-form-label>
                    <x-form-input name='password_confirmation' type='password' required/>
                </div>
                <div class="">
                    <div class="d-flex justify-content-end">
                        <button type="submit"class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
