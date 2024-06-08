<div class="fixed top-0 left-0 w-full z-50">
    <div class="navbar bg-green-300 w-11/12 sm:w-3/4 mx-auto mt-5 rounded-md shadow-md glass">
        <div class="navbar-start w-1/12 mr-2 md:hidden">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </div>
                <ul tabindex="0"
                    class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li>
                        <a wire:navigate href="{{ route('home') }}">Beranda</a>
                    </li>
                    {{-- <li>
                        <a wire:navigate href="{{ route('menu.index') }}">Menu</a>
                    </li>
                    <li>
                        <a wire:navigate href="{{ route('snackbox.index') }}"
                            class="{{ request()->routeIs('snackbox.index') ? 'active' : '' }}">SnackBox</a>
                    </li>
                    <li>
                        <a wire:navigate href="{{ route('paket.menu') }}"
                            class="{{ request()->routeIs('paket.menu') ? 'active' : '' }}">Paket</a>
                    </li> --}}

                </ul>
            </div>
        </div>
        <div class="flex-1">
            <a wire:navigate href="{{ route('home') }}" class="text-xl">
                <img src="{{ asset('../assets/images/website/amanina-logo-1.png') }}" alt=""
                    class="w-24 sm:w-40">
            </a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 text-base font-semibold gap-2">
                {{-- <li>
                    <a wire:navigate href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('menu.index') }}"
                        class="{{ request()->routeIs('menu.index') ? 'active' : '' }}">Menu</a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('snackbox.index') }}"
                        class="{{ request()->routeIs('snackbox.index') ? 'active' : '' }}">SnackBox</a>
                </li>
                <li>
                    <a wire:navigate href="{{ route('paket.menu') }}"
                        class="{{ request()->routeIs('paket.menu') ? 'active' : '' }}">Paket</a>
                </li> --}}
                {{-- <li>
                    <details>
                        <summary>Paket</summary>
                        <ul class="p-2">
                            <li><a>Submenu 1</a></li>
                            <li><a>Submenu 2</a></li>
                        </ul>
                    </details>
                </li> --}}
            </ul>
        </div>
        <div class="flex gap-1 sm:gap-3 mr-3">
            {{-- @livewire('home.cart') --}}

            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <i class="fas fa-poll text-lg"></i>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a class="justify-between">
                                Profile
                                <span class="badge">New</span>
                            </a>
                        </li>
                        {{-- <li>
                            <a wire:navigate href="{{ route('front.dashboard') }}">Riwayat Pesanan</a>
                        </li> --}}
                        <li>
                            <!-- Logout Button -->
                            <form action="{{ route('logout') }}" method="POST" class="mr-4">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <div class="dropdown text-base-content">
                    <a wire:navigate href="{{ route('login') }}" class="btn btn-ghost btn-circle">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
