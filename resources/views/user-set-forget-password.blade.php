<!DOCTYPE html>
<html lang="en">

<head>

    <title>User SignUp</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <div class=" flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h1 class="text-2xl mb-5 text-center">User Reset Password</h1>
            @error('user')
                <span class="inline-block text-red-600">{{ $message }}</span>
            @enderror
            <form action="{{ route('user.set.forgot.password') }}" method="post" class="space-y-2">
                @csrf
                <div>
                    <input type="hidden" name="email" value="{{ $email }}" placeholder="Enter user email"
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
                <div>
                    <label for="password" class="text-gray-800 mb-1 inline-block">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm User password"
                        class="w-full focus:outline-none py-2 px-4 border rounded-lg" id="">
                </div>
                <div class="flex justify-center items-center">
                    <button type="submit"
                        class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">Reset
                        Password</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
