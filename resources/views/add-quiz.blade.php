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
        <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
            @if (!Session::has('quizDetails'))
                <h1 class="text-2xl mb-5 text-center text-gray-800">Add Quiz</h1>
                <form action="" method="get" class="space-y-2">
                    @csrf
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="quiz" placeholder="Enter Quiz name"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-400 focus:border-blue-800 hover:border-gray-800 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                        @error('quiz')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
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
                        @error('category')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
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
                <h1 class="text-2xl mb-5 text-center text-gray-800">Add MCQs</h1>
                <form method="get" action="" class="space-y-4">
                    <div>
                        <textarea name="question" id="" type="text" placeholder="Enter the question"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"></textarea>
                    </div>
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="firstOption"
                            placeholder="Enter first option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                    </div>
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="secondOption"
                            placeholder="Enter second option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                    </div>
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="thirdOption"
                            placeholder="Enter third option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                    </div>
                    <div>
                        <input type="text" value="{{ old('quiz') }}" name="fourthOption"
                            placeholder="Enter forth option"
                            class="w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                    </div>
                    <div>
                        <select type="text" name="options"
                            class="mt-2 w-full focus:outline-none py-2 px-4 border border-gray-300 focus:border-blue-500 hover:border-gray-500 transition-colors duration-300 ease-in-out rounded-lg"
                            id="">
                            <option value="">Select Correct Option</option>
                            <option value="a">A</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                        @error('category')
                            <span class="text-red-600 inline-block mt-1 ml-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit"
                            class="py-2 rounded-xl bg-blue-300 text-blue-900 hover:bg-blue-800 hover:text-white cursor-pointer mt-4 w-full transition-all ease-in-out duration-300">
                            Add More
                        </button>
                    </div>
                    <div class="flex justify-center items-center">
                        <button type="submit"
                            class="py-2 rounded-xl bg-green-300 text-green-900 hover:bg-green-800 hover:text-white cursor-pointer w-full transition-all ease-in-out duration-300">
                            Add and Submit
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</body>

</html>
