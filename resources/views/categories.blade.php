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
                        <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-center items-center">
                    <button type="submit"
                        class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">Add</button>
                </div>
            </form>
        </div>
    </div>
    <div class="w-200 flex justify-center m-auto flex-col mt-10">
        <h1 class="text-2xl text-blue-500 mb-2">Category List</h1>
        <ul class="border border-gray-200 rounded-xl">
            <li>
                <ul class="flex justify-between py-3 text-center font-bold">
                    <li class="w-30">S. No</li>
                    <li class="w-70">Name</li>
                    <li class="w-70">Creator</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>
            @foreach ($categoryDetails as $category)
                <li class="even:bg-gray-200">
                    <ul class="flex justify-between py-3 text-center">
                        <li class="w-30">{{ $category->id }}</li>
                        <li class="w-70">{{ $category->name }}</li>
                        <li class="w-70">{{ $category->creator }}</li>
                        <li class="w-30">
                            <a href="{{ route('delete.category', ['id' => $category->id]) }}">
                                <svg class="text-center inline-block cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                                    height="20px" viewBox="0 -960 960 960" width="20px" fill="#EA3323">
                                    <path
                                        d="M312-144q-29.7 0-50.85-21.15Q240-186.3 240-216v-480h-48v-72h192v-48h192v48h192v72h-48v479.57Q720-186 698.85-165T648-144H312Zm336-552H312v480h336v-480ZM384-288h72v-336h-72v336Zm120 0h72v-336h-72v336ZM312-696v480-480Z" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
