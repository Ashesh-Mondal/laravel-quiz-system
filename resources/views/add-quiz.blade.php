<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Quiz</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <x-navbar :userDetails="$userDetails"></x-navbar>
    @if (Session::has('success'))
        <div class="bg-[#acdbac] text-green-800 py-1 px-2 text-lg">{{ Session::get('success') }}</div>
    @endif
    <div class="flex justify-center mt-10 w-4xl m-auto">
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md mb-8">
            @if (!Session::has('quizDetails'))
                <h1 class="text-2xl mb-5 text-center text-gray-800">Add Quiz</h1>
                <form action="" method="get" class="space-y-2">
                    @csrf
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="quiz" required
                            placeholder="Enter Quiz name"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-400 focus:border-blue-800 hover:border-gray-800 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                    </div>
                    <div>
                        <select type="text" name="category_id"
                            class=" mt-2 w-full focus:outline-none py-2 px-4 border border-gray-400 focus:border-blue-800 hover:border-gray-800 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                            <option value="">Select Category</option>
                            @foreach ($categoryListDetails as $categoryList)
                                <option value="{{ $categoryList->id }}">{{ $categoryList->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit"
                            class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">
                            Add and Next
                        </button>
                    </div>
                    <div class="mt-3 text-green-600">Click Add and Next for adding MCQ in quiz</div>
                </form>
            @else
                <span class="text-green-500 font-bold mb-3 inline-block">Quiz :
                    {{ Session::get('quizDetails')->name }}</span>
                <p class="text-green-500 font-bold mb-3">
                    Total MCQs : {{ $totalMCQs }}
                    @if ($totalMCQs > 0)
                        <a class="text-blue-400 hover:text-blue-600 transition-all delay-100 ease-in-out"
                            href="{{ route('show.quiz', ['id'=>Session::get('quizDetails')->id]) }}">Show MCQs</a>
                    @endif
                </p>
                <h1 class="text-2xl mb-5 text-center text-gray-800">Add MCQs</h1>
                <form method="post" action="{{ route('add.mcqs') }}" class="space-y-4">
                    @csrf
                    <div>
                        <textarea name="question" id="" type="text" placeholder="Enter the question"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            value="{{ old('question') }}"></textarea>
                        @error('question')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="text" value="{{ old('a') }}" name="a"
                            placeholder="Enter first option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                        @error('a')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="text" value="{{ old('b') }}" name="b"
                            placeholder="Enter second option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                        @error('b')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="text" value="{{ old('c') }}" name="c"
                            placeholder="Enter third option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                        @error('c')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="text" value="{{ old('d') }}" name="d"
                            placeholder="Enter forth option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                        @error('d')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <select type="text" name="correct_ans"
                            class="mt-2 w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                            <option value="">Select Correct Option</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                        @error('correct_ans')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit" name="submit" value="add-more"
                            class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">
                            Add More
                        </button>
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit" name="submit" value="done"
                            class="py-2 rounded-xl bg-green-300 text-green-900 hover:bg-green-800 hover:text-white cursor-pointer w-full transition-all ease-in-out duration-300">
                            Add and Submit
                        </button>
                    </div>
                    <div class="flex justify-center items-center">
                        <a href="{{ route('exit.mcqs') }}"
                            class="py-2 text-center rounded-xl bg-red-300 text-red-900 hover:bg-red-800 hover:text-white cursor-pointer w-full transition-all ease-in-out duration-300">Finish
                            and Leave</a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</body>

</html>
