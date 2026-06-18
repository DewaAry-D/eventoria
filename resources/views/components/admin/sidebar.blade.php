@props(['active' => 'dashboard'])

<div x-data="{ open: false }" class="shrink-0">

    <!-- TOMBOL TRIGGER HAMBURGER -->
    <div class="flex items-center justify-between bg-surface-container-lowest p-sm border-b border-outline-variant/30 md:hidden w-full">
        <div class="flex items-center gap-xs">
            <div class="w-8 h-8 shrink-0 flex items-center justify-center">
                <svg width="100%" height="100%" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="40" height="40" rx="8" fill="#000666"/>
                    <path d="M20 28.75L13.1944 25.0556V19.2222L9.30554 17.0833L20 11.25L30.6944 17.0833V24.8611H28.75V18.1528L26.8055 19.2222V25.0556L20 28.75ZM20 20.6806L26.6597 17.0833L20 13.4861L13.3403 17.0833L20 20.6806ZM20 26.5382L24.8611 23.9132V20.2431L20 22.9167L15.1389 20.2431V23.9132L20 26.5382Z" fill="white"/>
                </svg>
            </div>
            <span class="text-title-lg font-bold text-primary tracking-tight">Eventoria</span>
        </div>
        
        <button @click="open = !open" class="p-sm text-on-surface hover:bg-surface-container rounded-md focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                <path x-show="open" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <!-- SIDEBAR UTAMA DESKTOP          -->
    <aside 
        :class="open ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        class="w-sidebar bg-surface-container-lowest border-r border-outline-variant/30 flex flex-col justify-between p-md shrink-0 fixed md:sticky top-0 left-0 bottom-0 z-50 h-screen transition-transform duration-300 md:transform-none">
        
        <div>
            <div class="flex items-center gap-sm mb-xl px-xs">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center shadow-sm rounded-xl overflow-hidden">
                    <svg width="100%" height="100%" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="40" height="40" rx="8" fill="#000666"/>
                        <path d="M20 28.75L13.1944 25.0556V19.2222L9.30554 17.0833L20 11.25L30.6944 17.0833V24.8611H28.75V18.1528L26.8055 19.2222V25.0556L20 28.75ZM20 20.6806L26.6597 17.0833L20 13.4861L13.3403 17.0833L20 20.6806ZM20 26.5382L24.8611 23.9132V20.2431L20 22.9167L15.1389 20.2431V23.9132L20 26.5382Z" fill="white"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-title-lg font-bold text-primary tracking-tight leading-tight">Eventoria</h1>
                    <p class="text-caption text-secondary/70 font-medium tracking-wide">Academic Management</p>
                </div>
            </div>

            <!-- NAVIGASI MENU UTAMA -->
            <nav class="space-y-xs">
                <!-- Dashboard -->
                <a href="#" 
                    class="flex items-center justify-between group px-md py-sm rounded-md transition-all relative
                    {{ $active === 'dashboard' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                    <div class="flex items-center gap-md">
                        <svg class="w-5 h-5 {{ $active === 'dashboard' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                        </svg>
                        <span class="text-body-md">Dashboard</span>
                    </div>
                    @if($active === 'dashboard')
                        <span class="absolute right-0 top-1/4 bottom-1/4 w-1 bg-primary rounded-l-full"></span>
                    @endif
                </a>

                <!-- Moderasi Organisasi -->
                <a href="#" 
                    class="flex items-center justify-between group px-md py-sm rounded-md transition-all relative
                    {{ $active === 'moderasi-organisasi' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                    <div class="flex items-center gap-md">
                        <svg class="w-5 h-5 {{ $active === 'moderasi-organisasi' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-body-md">Moderasi Organisasi</span>
                    </div>
                    @if($active === 'moderasi-organisasi')
                        <span class="absolute right-0 top-1/4 bottom-1/4 w-1 bg-primary rounded-l-full"></span>
                    @endif
                </a>

                <!-- Moderasi Event -->
                <a href="#" 
                    class="flex items-center justify-between group px-md py-sm rounded-md transition-all relative
                    {{ $active === 'moderasi-event' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                    <div class="flex items-center gap-md">
                        <svg class="w-5 h-5 {{ $active === 'moderasi-event' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-body-md">Moderasi Event</span>
                    </div>
                    @if($active === 'moderasi-event')
                        <span class="absolute right-0 top-1/4 bottom-1/4 w-1 bg-primary rounded-l-full"></span>
                    @endif
                </a>

                <!-- Master Data Kategori -->
                <a href="#" 
                    class="flex items-center justify-between group px-md py-sm rounded-md transition-all relative
                    {{ $active === 'master-kategori' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                    <div class="flex items-center gap-md">
                        <svg class="w-5 h-5 {{ $active === 'master-kategori' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM5 13a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1v-4a1 1 0 00-1-1H5zM13 16a3 3 0 116 0 3 3 0 01-6 0z"/>
                        </svg>
                        <span class="text-body-md">Master Data Kategori</span>
                    </div>
                    @if($active === 'master-kategori')
                        <span class="absolute right-0 top-1/4 bottom-1/4 w-1 bg-primary rounded-l-full"></span>
                    @endif
                </a>

                <!-- Data Organisasi Aktif -->
                <a href="#" 
                    class="flex items-center justify-between group px-md py-sm rounded-md transition-all relative
                    {{ $active === 'organisasi-aktif' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                    <div class="flex items-center gap-md">
                        <svg class="w-5 h-5 {{ $active === 'organisasi-aktif' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="text-body-md">Data Organisasi Aktif</span>
                    </div>
                    @if($active === 'organisasi-aktif')
                        <span class="absolute right-0 top-1/4 bottom-1/4 w-1 bg-primary rounded-l-full"></span>
                    @endif
                </a>
            </nav>
        </div>

        <!-- BOTTOM MENU -->
        <div class="border-t border-outline-variant/30 pt-md space-y-xs bg-surface-container-lowest">
            <!-- Pengaturan -->
            <a href="#" 
                class="flex items-center gap-md px-md py-sm rounded-md transition-colors group
                {{ $active === 'pengaturan' ? 'bg-secondary-container text-primary-container font-semibold' : 'text-secondary hover:bg-surface-container/50' }}">
                <svg class="w-5 h-5 {{ $active === 'pengaturan' ? 'text-primary' : 'text-secondary/70 group-hover:text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-body-md">Pengaturan</span>
            </a>
            
            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-md px-md py-sm text-error hover:bg-error-container/60 rounded-md transition-colors text-left group">
                    <svg class="w-5 h-5 text-error transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span class="text-body-md font-semibold">Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <div x-show="open" @click="open = false" x-transition.opacity class="fixed inset-0 bg-black/40 z-40 md:hidden" style="display: none;"></div>
</div>