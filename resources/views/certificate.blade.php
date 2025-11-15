<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Certificate</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="flex flex-col justify-center items-center min-h-screen">
        <div class="w-200 border-4 m-10 mb-0 bg-gray-100 border-indigo-900 p-10 text-center">
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                    fill="#000">
                    <path
                        d="m385-412 36-115-95-74h116l38-119 37 119h117l-95 74 35 115-94-71-95 71ZM244-40v-304q-45-47-64.5-103T160-560q0-136 92-228t228-92q136 0 228 92t92 228q0 57-19.5 113T716-344v304l-236-79-236 79Zm236-260q109 0 184.5-75.5T740-560q0-109-75.5-184.5T480-820q-109 0-184.5 75.5T220-560q0 109 75.5 184.5T480-300ZM304-124l176-55 176 55v-171q-40 29-86 42t-90 13q-44 0-90-13t-86-42v171Zm176-86Z" />
                </svg>
                <h1 class="text-5xl">Certificate of completion</h1>
            </div>
            <p class="text-2xl mt-5">This is to clarify that</p>
            <h2 class="text-4xl">{{ $name }}</h2>
            <p class="text-2xl mt-3">has successfully completed the</p>
            <h3 class="text-3xl">{{ $quizName }}</h3>
            <p class="text-2xl mt-5">{{ date('d-m-y') }}</p>
        </div>
        <a href="#" class="text-green-700 font-bold text-xl w-1/2 text-right curson-pointer">Download</a>
    </div>

</body>

</html>
