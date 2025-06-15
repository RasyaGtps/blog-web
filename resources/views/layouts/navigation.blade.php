<nav class="flex justify-between items-center px-4 md:px-24 py-5 max-w-[1400px] mx-auto">
    <!-- Logo -->
    <div>
        <a href="/" class="text-black no-underline font-serif text-xl font-bold flex items-center gap-2">
            <i class="fas fa-book-open"></i>
            ByRead
        </a>
    </div>

    <!-- Navigation Links -->
    <div>
        <ul class="flex items-center gap-8">
            <li>
                <a href="{{ route('about') }}" 
                   class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                    <i class="fas fa-info-circle"></i>
                    About Us
                </a>
            </li>
            <li>
                <a href="{{ route('stories.index') }}" 
                   class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                    <i class="fas fa-book-reader"></i>
                    Articles
                </a>
            </li>
            <li>
                <a href="{{ route('membership.index') }}" 
                   class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                    <i class="fas fa-crown"></i>
                    Membership
                </a>
            </li>
            
            @auth
                <li>
                    <a href="{{ route('articles.create') }}" 
                       class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                        <i class="fas fa-pen"></i>
                        Write
                    </a>
                </li>
                <li>
                    <a href="{{ route('chat.index') }}" 
                       class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                        <i class="fas fa-inbox"></i>
                        Pesan
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}" 
                       class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                        <i class="fas fa-columns"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-black text-white px-5 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors flex items-center gap-1">
                            <i class="fas fa-sign-out-alt"></i>
                            Sign out
                        </button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}" 
                       class="text-[#242424] hover:text-black text-sm flex items-center gap-1">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign in
                    </a>
                </li>
                <li>
                    <a href="{{ route('register') }}" 
                       class="bg-black text-white px-5 py-2.5 rounded-full text-sm hover:bg-[#242424] transition-colors flex items-center gap-1">
                        <i class="fas fa-user-plus"></i>
                        Sign up
                    </a>
                </li>
            @endauth
        </ul>
    </div>
</nav>