<div class="relative">
    <div class="navbar bg-base-100 glass fixed z-10 top-0 inset-x-0">
        <div class="flex-1">
            <a wire:navigate href="{{ route('home') }}" class="btn btn-ghost text-xl">SiDAQ TPQ</a>
        </div>
        <div class="flex-none">
            @auth
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <i class="fas fa-poll text-lg"></i>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li>
                            <a wire:navigate href="{{ route('profile-diri.show') }}" class="justify-between">
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
