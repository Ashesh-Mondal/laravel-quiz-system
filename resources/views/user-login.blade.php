<!DOCTYPE html>
<html lang="en">

<head>

    <title>User Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <div class=" flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h1 class="text-2xl mb-5 text-center">User Login Page</h1>
            @error('user')
                <span class="inline-block text-red-600">{{ $message }}</span>
            @enderror
            <form action="{{ route('user.login') }}" method="post" class="space-y-2">
                @csrf
                <div>
                    <label for="email" class="text-gray-800 mb-1 inline-block">User Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter user email"
                        class="w-full focus:outline-none py-2 px-4 border rounded-lg" id="">
                    @error('email')
                        <span class="inline-block text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-gray-800 mb-1 inline-block">Password</label>
                    <input type="password" name="password" placeholder="Enter User password"
                        class="w-full focus:outline-none py-2 px-4 border rounded-lg" id="">
                    @error('password')
                        <span class="inline-block text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-center items-center">
                    <button type="submit"
                        class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">Login</button>
                </div>
                <a href="/user-forgot-password"
                    class="text-green-500 mt-3 inline-block transition-colors hover:text-green-600 ease-in-out delay-200">Forget
                    Password?</a>
            </form>
        </div>
    </div>
</body>

</html>
