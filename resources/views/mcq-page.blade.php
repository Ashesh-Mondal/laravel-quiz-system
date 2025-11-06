<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MCQ Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-user-navbar></x-user-navbar>
    <h1 class="mt-15 pb-5 text-4xl text-green-800 text-center font-bold">{{ $name }}</h1>
    <h2 class="pb-5 text-2xl text-green-800 text-center font-bold">MCQ No.{{ $mcq[0]->id }}</h2>
    <div class="mt-2 p-4 bg-white w-1/3 shadow-2xl m-auto rounded-xl text-xl mb-10">
        <h3 class="my-2 font-bold">Q.1 {{ $mcq[0]->question }}</h3>
        <form action="">
            <label for="a" class="mcq-options">
                <input type="radio" name="" id="a" class="form-radio text-blue-500">
                <span class="">{{ $mcq[0]->a }}</span>
            </label>
            <label for="b" class="mcq-options">
                <input type="radio" name="" id="b" class="form-radio text-blue-500">
                <span class="">{{ $mcq[0]->b }}</span>
            </label>
            <label for="c" class="mcq-options">
                <input type="radio" name="" id="c" class="form-radio text-blue-500">
                <span class="">{{ $mcq[0]->c }}</span>
            </label>
            <label for="d" class="mcq-options">
                <input type="radio" name="" id="d" class="form-radio text-blue-500">
                <span class="">{{ $mcq[0]->d }}</span>
            </label>
            <a href="" type="submit"
                class="text-xl py-2 mt-6 inline-block rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer transition-all ease-in-out duration-300 px-5 mb-1">Submit
                and Next</a>
        </form>
    </div>
    <x-footer-user></x-footer-user>
</body>

</html>
