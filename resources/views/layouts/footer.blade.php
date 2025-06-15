<footer class="bg-white border-t border-gray-200">
    <div class="max-w-[1200px] mx-auto px-4 py-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-book-open"></i>
                <span class="font-serif">ByRead</span>
                <span class="text-sm text-gray-500">Temukan cerita, pemikiran, dan keahlian.</span>
            </div>

            <div class="flex items-center gap-6 text-sm text-gray-500">
                <a href="{{ route('about') }}" class="hover:text-black">Tentang Kami</a>
                <a href="{{ route('membership.index') }}" class="hover:text-black">Membership</a>
                <a href="{{ route('articles.create') }}" class="hover:text-black">Write</a>
                <a href="{{ route('privacy') }}" class="hover:text-black">Privasi</a>
                <a href="{{ route('terms') }}" class="hover:text-black">Ketentuan</a>
            </div>
        </div>
    </div>
</footer> 