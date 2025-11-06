<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start Quiz</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-user-navbar></x-user-navbar>
    <h1 class="mt-15 pb-5 text-4xl text-green-800 text-center font-bold">{{ $quizName->name }}</h1>
    <p class="text-center font-bold text-green-800 text-2xl mt-5">
        This quiz contains {{ $quizName->mcq->count() }} Questions and no limit to attempt this Quiz
    </p>
    <p class="text-center font-bold text-green-800 text-3xl mt-8">Good Luck</p>
    @if (Session::has('normalUser'))
        <div class="flex justify-center mt-20">
            <a href="{{ route('user.signup') }}" type="submit"
                class="text-xl py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer transition-all ease-in-out duration-300 px-5">
                Start Quiz
            </a>
        </div>
    @else
        <div class="flex justify-center mt-20">
            <a href="{{ route('user.signup.quiz') }}" type="submit"
                class="text-xl py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer transition-all ease-in-out duration-300 px-5">
                Login/SignUp for Start Quiz
            </a>
        </div>
    @endif
</body>

</html>
