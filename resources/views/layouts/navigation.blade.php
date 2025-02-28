<nav class="flex justify-between items-center px-4 md:px-24 py-5 max-w-[1400px] mx-auto">
    <!-- Logo -->
    <div>
        <a href="/" class="text-black no-underline font-serif text-xl font-bold">ByRead</a>
    </div>

    <!-- Navigation Links -->
    <div>
        <ul class="flex items-center gap-8">
            <li>
                <a href="{{ route('stories.index') }}" 
                   class="text-[#242424] hover:text-black text-sm">
                    <i class="fas fa-book-reader mr-1"></i>
                    Our Story
                </a>
            </li>
            <li><a href="#" class="text-[#242424] hover:text-black text-sm">Membership</a></li>
            <li><a href="#" class="text-[#242424] hover:text-black text-sm">Write</a></li>
            
            @auth
                <li>
                    <a href="{{ route('dashboard') }}" class="text-[#242424] hover:text-black text-sm">Dashboard</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors">
                            Sign out
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" class="text-[#242424] hover:text-black text-sm">Sign in</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="bg-black text-white px-5 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors">
                        Get started
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>
