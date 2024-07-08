<!DOCTYPE html>
<html>

<head>@vite('resources/css/app.css')</head>

<body class="bg-amber-50 h-screen flex justify-center items-center">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold mb-4 text-center">Two beer or not two beer?</h1>
        <form method="POST" action="/login">
            @csrf
            <x-form-input type="name" id="name" name="name" placeholder="Name" required></x-form-input>
            <x-form-input type="password" id="password" name="password" placeholder="Password" required></x-form-input>
            <button type="submit" class="w-full bg-amber-600 text-white p-2 rounded hover:bg-white hover:text-amber-600 hover:border hover:border-amber-600">Login</button>
        </form>

        @if($errors->any())
        <div>
            @foreach ($errors->all() as $error)
            <p class="mt-4 text-red-600">{{ $error }}</p>
            @endforeach
        </div>
        @endif
    </div>
</body>

</html>