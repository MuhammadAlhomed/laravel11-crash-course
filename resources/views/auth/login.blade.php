<x-layout>
    <div class="vh-100 d-flex justify-content-center align-items-sm-center"> 
        <div class="col-md-4 card p-4">
            <h1 class="h1 justify-text-center">Login</h1>
            <form action="/register" method="post">
                @csrf
                <div class='mb-3'>
                    <x-form-label for='email'>Email</x-form-label>
                    <x-form-input name='email' type='text' required/>
                </div>
                <div class='mb-3'>
                    <x-form-label for='password'>Password</x-form-label>
                    <x-form-input name='password' type='password' required/>
                </div>
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check form-check-inline">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id=""
                                value="option1"
                            />
                            <label class="form-check-label" for="">Remember Me</label>
                        </div>
                        <a href="#">I Forgot my Password</a>
                    </div>
                </div>
                <div class="">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>Don't have an Account? <a href="/register">Join us!</a></div>
                        <button type="submit"class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>