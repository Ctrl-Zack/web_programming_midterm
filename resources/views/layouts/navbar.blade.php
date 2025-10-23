<nav id="navbar" class="fixed top-0 left-0 w-full bg-white shadow-md p-4 flex justify-between items-center transition-transform duration-300 z-50">
    <h1 class="text-2xl font-bold text-emerald-500">
        @auth
            <a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard') }}" class="hover:underline">Libry</a>
        @endauth
        @guest
            <a href="#" class="hover:underline">Libry</a>
        @endguest
    </h1>

    <button id="menu-btn" class="block md:hidden text-gray-700 hover:text-emerald-500 focus:outline-none">
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div id="menu" class="hidden absolute md:static top-full left-0 w-full md:w-auto bg-white md:bg-transparent shadow-md md:shadow-none md:flex flex-col md:flex-row md:items-center space-y-4 md:space-y-0 md:space-x-6 md:mt-0 p-4 md:p-0">
        @auth
            @if (Auth::user()->role === 'user')
                <ul class="flex flex-col md:flex-row md:items-center md:space-x-6">
                    <li><a href="{{ route('user.dashboard') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Home</a></li>
                    <li><a href="{{ route('user.books.index') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Books</a></li>
                    <li><a href="{{ route('user.histories') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Histories</a></li>
                    <li><a href="{{ route('user.book.request') }}"
                            class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Request Book</a></li>
                    <li class="relative group hidden md:block">
                        <button class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3 flex items-center">
                            Profile
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div class="absolute left-0 top-full h-3 w-full bg-transparent"></div>

                        <div class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200">
                            <div class="px-4 py-2 border-b border-gray-100 text-gray-600 text-sm cursor-default">
                                <p class="font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </li>
                    <li class="flex flex-col space-y-2 md:hidden border-t border-gray-100 pt-3 mt-2">
                        <a href="{{ route('user.profile') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-left text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Logout</button>
                        </form>
                    </li>
                </ul>

            @elseif (Auth::user()->role === 'admin')
                <ul class="flex flex-col md:flex-row md:items-center md:space-x-6">
                    <li><a href="{{ route ('admin.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Dashboard</a></li>
                    <li><a href="{{ route ('admin.categories.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Categories</a></li>
                    <li><a href="{{ route ('admin.books') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Books</a></li>
                    <li><a href="{{ route('admin.members.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Members</a></li>
                    <li><a href="{{ route('admin.loans.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Borrows</a></li>
                    <li><a href="{{ route('admin.request-book.index') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">Book Requests</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            @endif
        @endauth

        @guest
            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 hover:text-emerald-500 mx-3 text-center">
                    Login
                </a>
                <a href="{{ route('register') }}" class="bg-emerald-500 text-white px-3 py-1 rounded hover:bg-emerald-600 text-sm font-semibold mx-3 text-center">
                    Register
                </a>
            </div>
        @endguest
    </div>
</nav>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const menu = document.getElementById('menu');

    menuBtn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>