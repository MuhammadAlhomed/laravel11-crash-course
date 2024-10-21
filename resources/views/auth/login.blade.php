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
                <div class="">
                    <div class="d-flex justify-content-end">
                        <button type="submit"class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>