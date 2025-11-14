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
        <h1 class="text-4xl text-green-700 font-bold text-center mt-18 mb-8">User Details</h1>
        <div class="w-200 flex justify-center m-auto flex-col space-y-5">
            <h1 class="text-3xl text-green-700 text-center font-bold">Attempted Quiz</h1>
            <ul class="border border-gray-200 rounded-xl mb-8">
                <li>
                    <ul class="flex justify-between py-3 text-center font-bold">
                        <li class="w-30">S. No</li>
                        <li class="w-70 text-left">Name</li>
                        <li class="w-40 text-left">Status</li>
                    </ul>
                </li>
                @foreach ($userDetails as $userDetail)
                    <li class="even:bg-gray-200">
                        <ul class="flex justify-between py-3 text-center">
                            {{-- Laravel automatically provides a $loop variable inside @foreach. --}}
                            <li class="w-30">{{ $loop->iteration }}</li>
                            <li class="w-70 text-left">{{ $userDetail->quiz->name }}</li>
                            @if ($userDetail->status == '2')
                                <li class="w-40 text-green-600 text-left">Completed</li>
                            @elseif($userDetail->status == '1')
                                <li class="w-40 text-orange-600 text-left">Not Completed</li>
                            @endif
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <x-footer-user></x-footer-user>
</body>


</html>
