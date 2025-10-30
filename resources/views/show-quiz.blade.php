{{-- <ol>
    @foreach ($mcqs as $mcq)
        <li>
            {{ $mcq->question }}
            <ol type="a">

                <li>{{ $mcq->a }}</li>
                <li>{{ $mcq->b }}</li>
                <li>{{ $mcq->c }}</li>
                <li>{{ $mcq->d }}</li>

            </ol>
        </li>
    @endforeach
</ol> --}}


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
            All Current Quiz's MCQs
            <a class="text-blue-400 hover:text-blue-600 transition-all delay-100 ease-in-out text-lg"
                href="{{ route('add.quiz') }}">Back</a>
        </h1>
    </div>
    <div class="w-200 flex justify-center m-auto flex-col mt-10">
        <ul class="border border-gray-200">
            <li>
                <ul class="flex justify-between py-3 font-bold">
                    <li class="w-30 text-center">MCQ Id</li>
                    <li class="w-170 ml-20">Question</li>
                </ul>
            </li>
            @foreach ($mcqs as $mcq)
                <li class="even:bg-gray-200">
                    <ul class="flex justify-between py-3">
                        <li class="w-30 text-center">{{ $mcq->id }}</li>
                        <li class="w-170 ml-20">{{ $mcq->question }}</li>
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</body>

</html>
