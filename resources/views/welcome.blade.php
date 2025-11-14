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
            <h1 class="pt-10 pb-5 text-4xl text-green-700 font-bold">Test Your Skill</h1>
            <form action="{{ route('search.quiz') }}" method="get">
                <div class="flex shadow-lg rounded-xl px-7 py-3 mt-2 text-xl bg-white">
                    <input type="text" name="search" placeholder="Enter name to search..."
                        class="outline-none inline-block w-md" value="{{ old('search') }}">
                    <button class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#666666">
                            <path
                                d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                        </svg>
                    </button>
                </div>
            </form>
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
                            {{-- Laravel automatically provides a $loop variable inside @foreach. --}}
                            <li class="w-30">{{ $loop->iteration }}</li>
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
        </div>
        <h1 class="text-4xl text-green-700 font-bold text-center mt-18">Top Quizzes</h1>
        <div class="w-200 flex justify-center m-auto flex-col my-10">
            <ul class="border border-gray-200 rounded-xl">
                <li>
                    <ul class="flex py-3 text-center font-bold">
                        <li class="w-30">S. No</li>
                        <li class="w-full text-left ml-3">Name</li>
                        <li class="w-30 mr-3">Total Question</li>
                        <li class="w-30">Action</li>
                    </ul>
                </li>
                @foreach ($quizList as $quiz)
                    <li class="even:bg-gray-200">
                        <ul class="flex py-3 text-center">
                            {{-- Laravel automatically provides a $loop variable inside @foreach. --}}
                            <li class="w-30">{{ $loop->iteration }}</li>
                            <li class="text-left w-full ml-3">{{ $quiz->name }}</li>
                            <li class="w-30 mr-3">{{ $quiz->mcq_count }}</li>
                            <li class="w-30 flex justify-center">
                                <a href="{{ route('start.quiz', ['id' => $quiz->id]) }}"
                                    class="text-green-600 font-bold text-lg">Start</a>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <x-footer-user></x-footer-user>
</body>


</html>
