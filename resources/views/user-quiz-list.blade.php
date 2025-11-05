<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Page</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <h1 class="mt-15 pb-5 text-4xl text-green-800 text-center font-bold">Category Name: {{ $categoryName->name }}</h1>
    <div class="w-200 flex justify-center m-auto flex-col my-10">
        <ul class="border border-gray-200 rounded-xl">
            <li>
                <ul class="flex py-3 text-center font-bold">
                    <li class="w-30">S. No</li>
                    <li class="w-full text-left ml-3">Name</li>
                    <li class="w-30">Action</li>
                </ul>
            </li>
            @foreach ($quizList as $quiz)
                <li class="even:bg-gray-200">
                    <ul class="flex py-3 text-center">
                        {{-- Laravel automatically provides a $loop variable inside @foreach. --}}
                        <li class="w-30">{{ $loop->iteration }}</li>
                        <li class="text-left w-full ml-3">{{ $quiz->name }}</li>
                        <li class="w-30 flex justify-center">
                            <a href="" class="text-green-600 font-bold text-lg">Start</a>
                        </li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
