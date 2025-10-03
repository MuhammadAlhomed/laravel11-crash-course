<x-layout>
    <div class="h-100 d-flex justify-content-center align-items-sm-center">
        <div class="col-md-6 col-xl-5 card p-4 bg-white shadow">
            <h1 class="h1 justify-text-center">Password Reset</h1>
            <div>
                <p>We have successfully sent a password reset link to:</p>
                <h4><strong>{{$resetToken->email}}</strong></h4>
                <p>If you can't find an email from us, check your 'Spam' folder.</p>

                @env('local')
                <p>TEST ENVIRONMENT: <a href="{{ route('auth.reset-password', ['token' => $resetToken->token]) }}">Click here to go to the reset password link</a></p>
                @endenv
            </div>
        </div>
    </div>
</x-layout>
