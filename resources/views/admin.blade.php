<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css')
</head>

<body>
    <x-navbar :userDetails="$userDetails"></x-navbar>
    <div class="w-200 flex justify-center m-auto flex-col mt-10">
        <h1 class="text-2xl text-blue-500 mb-2">Users List</h1>
        <ul class="border border-gray-200 rounded-xl">
            <li>
                <ul class="flex justify-between py-3 text-center font-bold">
                    <li class="w-30">S. No</li>
                    <li class="w-70 text-left">Name</li>
                    <li class="w-70 text-left">Email</li>
                </ul>
            </li>
            @foreach ($usersList as $singleUser)
                <li class="even:bg-gray-200">
                    <ul class="flex justify-between py-3 text-center">
                        <li class="w-30">{{ $usersList->firstItem() + $loop->index }}</li>
                        <li class="w-70 text-left">{{ $singleUser->name }}</li>
                        <li class="w-70 text-left">{{ $singleUser->email }}</li>
                    </ul>
                </li>
            @endforeach
        </ul>
        <div class="mt-5">
            {{ $usersList->links() }}
        </div>
    </div>
</body>

</html>
