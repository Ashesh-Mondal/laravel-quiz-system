<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Home Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <div class="min-h-screen">
        <h1 class="text-4xl text-green-700 font-bold text-center mt-18 mb-8">Quiz Result</h1>
        <div class="w-200 flex justify-center m-auto flex-col space-y-4">
            <h1 class="text-3xl text-green-700 text-center font-bold">
                {{ $correctAnsCount }} out of {{count($quizResult)}} Correct
            </h1>
            <ul class="border border-gray-200 rounded-xl">
                <li>
                    <ul class="flex justify-between py-3 text-center font-bold">
                        <li class="w-30">S. No</li>
                        <li class="w-70 text-left">Question</li>
                        <li class="w-30">Marked Option</li>
                        <li class="w-30">Result</li>
                    </ul>
                </li>
                @foreach ($quizResult as $result)
                    <li class="even:bg-gray-200">
                        <ul class="flex justify-between py-3 text-center">
                            {{-- Laravel automatically provides a $loop variable inside @foreach. --}}
                            <li class="w-30">{{ $loop->iteration }}</li>
                            <li class="w-70 text-left">{{ $result->question }}</li>
                            <li class="w-30">{{ $result->select_answer }}</li>
                            <li class="w-30 flex gap-4 justify-center">
                                @if ($result->is_correct)
                                    <span class="text-green-600">Correct</span>
                                @else
                                    <span class="text-red-600">Incorrect</span>
                                @endif
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
