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
    <nav class="shadow-md px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="nav-links">
                Quiz System
            </div>
            <div class="space-x-2">
                <a class="nav-links" href="">Category</a>
                <a class="nav-links" href="">Quiz</a>
                <a class="nav-links" href="">Welcome {{ $userDetails->name }}</a>
                <a class="nav-links" href="">Logout</a>
            </div>
        </div>
    </nav>
</body>

</html>
