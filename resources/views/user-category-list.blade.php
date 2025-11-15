<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz System Home Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <div class="min-h-screen">
        <div class="flex flex-col items-center">
            @if (session('message-success'))
                <div class="text-green-800 bg-green-500 py-1 px-4 mt-4 rounded-xl">{{ session('message-success') }}</div>
            @endif
        </div>
        <h1 class="text-4xl text-green-700 font-bold text-center mt-18">Top Categories</h1>
        <div class="w-200 flex justify-center m-auto flex-col my-10">
            <ul class="border border-gray-200 rounded-xl">
                <li>
                    <ul class="flex justify-between py-3 text-center font-bold">
                        <li class="w-30">S. No</li>
                        <li class="w-70">Name</li>
                        <li class="w-30">Total Quiz</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>
                @foreach ($categoryList as $singleCategory)
                    <li class="even:bg-gray-200">
                        <ul class="flex justify-between py-3 text-center">
                            <li class="w-30">{{ $categoryList->firstItem() + $loop->index }}</li>
                            <li class="w-70">{{ $singleCategory->name }}</li>
                            <li class="w-30">{{ $singleCategory->quiz->count() }}</li>
                            <li class="w-30 flex gap-4 justify-center">
                                <a href="{{ route('show.quiz.list', ['id' => $singleCategory->id]) }}">
                                    <svg class="cursor-pointer inline-block text-center"
                                        xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#177eee">
                                        <path
                                            d="M480-312q70 0 119-49t49-119q0-70-49-119t-119-49q-70 0-119 49t-49 119q0 70 49 119t119 49Zm0-72q-40 0-68-28t-28-68q0-40 28-68t68-28q40 0 68 28t28 68q0 40-28 68t-68 28Zm0 192q-142.6 0-259.8-78.5Q103-349 48-480q55-131 172.2-209.5Q337.4-768 480-768q142.6 0 259.8 78.5Q857-611 912-480q-55 131-172.2 209.5Q622.6-192 480-192Zm0-288Zm0 216q112 0 207-58t146-158q-51-100-146-158t-207-58q-112 0-207 58T127-480q51 100 146 158t207 58Z" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
            <div class="mt-8">{{ $categoryList->links() }}</div>
        </div>
    </div>
    <x-footer-user></x-footer-user>
</body>


</html>
