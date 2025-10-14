<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Categories</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-navbar :userDetails="$userDetails"></x-navbar>
    {{-- @if (session('category'))
        <div class="bg-[#acdbac] text-green-800 py-1 px-2 text-lg">{{ session('category') }}</div>
    @endif --}}
    @if (Session::has('success'))
        <div class="bg-[#acdbac] text-green-800 py-1 px-2 text-lg">{{ Session::get('success') }}</div>
    @endif
    <div class="flex justify-center pt-10">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
            <h1 class="text-2xl mb-5 text-center text-gray-800">Add Category</h1>
            <form action="{{ route('add.category') }}" method="post" class="space-y-2">
                @csrf
                <div>
                    <input type="text" name="category" placeholder="Enter category name"
                        class="w-full focus:outline-none py-2 px-4 border border-gray-400 focus:border-blue-800 hover:border-gray-800 transition-colors duration-300 ease-in-out rounded-lg"
                        id="">
                    @error('category')
                        <span class="text-red-600 inline-block">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-center items-center">
                    <button type="submit"
                        class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">Add</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
