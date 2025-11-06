<nav class="bg-white shadow-md px-6 py-4">
    <div class="flex justify-between items-center">
        <div class="user-nav-links">
            Quiz System
        </div>
        <div class="space-x-2">
            <a class="user-nav-links" href="/">Home</a>
            <a class="user-nav-links" href="{{ route('admin.categories') }}">Category</a>

            @if (Session::has('normalUser'))
                <a class="user-nav-links" href="">Welcome {{ Session::get('normalUser')->name }}</a>
                <a class="user-nav-links" href="{{ route('logout.user') }}">Logout</a>
            @else
                <a class="user-nav-links" href="/user-signup">SignUp</a>
                <a class="user-nav-links" href="">Login</a>
            @endif
            <a class="user-nav-links" href="{{ route('admin.logout') }}">Blog</a>
        </div>
    </div>
</nav>
