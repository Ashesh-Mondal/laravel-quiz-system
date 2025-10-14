<nav class="bg-white shadow-md px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="nav-links">
            Quiz System
        </div>
        <div class="space-x-2">
            <a class="nav-links" href="{{ route('dashboard') }}">Dashboard</a>
            <a class="nav-links" href="{{ route('admin.categories') }}">Category</a>
            <a class="nav-links" href="">Quiz</a>
            <a class="nav-links" href="">Welcome {{ $userDetails->name }}</a>
            <a class="nav-links" href="{{ route('admin.logout') }}">Logout</a>
        </div>
    </div>
</nav>
