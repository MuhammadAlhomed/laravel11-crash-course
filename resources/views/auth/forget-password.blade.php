<x-layout>
    <div class="h-100 d-flex justify-content-center align-items-sm-center">
        <div class="col-md-6 col-xl-5 card p-4 bg-white shadow">
            <h1 class="h1 justify-text-center">Password Reset</h1>
            <form action="{{route('auth.forget-password')}}" method="post">
                @csrf
                <div class='mb-3'>
                    <p>Provide the email address associated with your account to receive password reset link.</p>
                </div>
                <div class='mb-3'>
                    <x-form-label for='email'>Email</x-form-label>
                    <x-form-input name='email' type='text' value="{{ old('email') }}" required/>
                </div>
                <div class="">
                    <div class="d-flex flex-row-reverse">
                        <button type="submit"class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
