<!DOCTYPE html>
<html lang="en">

<head>

    <title>Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        <h1 class="text-2xl mb-3 text-center">Admin Login Page</h1>
        <form action="{{ route('admin.login') }}" method="post" class="space-y-2">
            @csrf
            <div>
                <label for="name" class="text-gray-800 mb-1 inline-block">Admin Name</label>
                <input type="text" name="name" placeholder="Enter admin name"
                    class="w-full focus:outline-none py-2 px-4 border rounded-lg" id="">
            </div>
            <div>
                <label for="password" class="text-gray-800 mb-1 inline-block">Password</label>
                <input type="password" name="password" placeholder="Enter admin password"
                    class="w-full focus:outline-none py-2 px-4 border rounded-lg" id="">
            </div>
            <div class="flex justify-center items-center">
                <button type="submit"
                    class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
