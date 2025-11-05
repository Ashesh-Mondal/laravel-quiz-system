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
    @if (Session::has('success'))
        <div class="bg-[#acdbac] text-green-800 py-1 px-2 text-lg">{{ Session::get('success') }}</div>
    @endif
    <div class="flex justify-center pt-10">
        <h1 class="text-2xl mb-5 text-center text-gray-800">
            Category Name : {{ $name }}
            <a class="text-blue-400 hover:text-blue-600 transition-all delay-100 ease-in-out text-lg"
                href="{{ route('admin.categories') }}">Back</a>
        </h1>
    </div>
    <div class="w-200 flex justify-center m-auto flex-col mt-10">
        <ul class="border border-gray-200">
            <li>
                <ul class="flex justify-between py-3 font-bold">
                    <li class="w-30 text-center">Quiz Id</li>
                    <li class="w-140 ml-20">Name</li>
                    <li class="w-30 text-center">Action</li>
                </ul>
            </li>
            @foreach ($quizDetails as $quizDetail)
                <li class="even:bg-gray-200">
                    <ul class="flex justify-between py-3">
                        <li class="w-30 text-center">{{ $quizDetail->id }}</li>
                        <li class="w-140 ml-20">{{ $quizDetail->name }}</li>
                        <li class="w-30">
                            <a href="{{ route('show.quiz', ['id' => $quizDetail->id, 'name' => $quizDetail->name]) }}">
                                <svg class="cursor-pointer inline-block text-center w-full"
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
</body>

</html>
