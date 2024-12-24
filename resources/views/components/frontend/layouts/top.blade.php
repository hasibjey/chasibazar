<div class="bg-white">
    <div class="container">
        <div class="grid grid-cols-2 py-1 text-sm">
            <ul class="flex flex-row justify-start items-center">
                <li class="flex flex-row items-center gap-2">
                    <span class="text-base"><i class="ri-customer-service-2-fill"></i></span>
                    <a href="tel:01945907007" class="transition-all duration-300 hover:text-primary">01945907007</a>
                </li>
            </ul>
            <ul class="flex flex-row justify-end items-center gap-5">
                <li class="flex flex-row items-center gap-1 relative z-50 group">
                    <span class="text-base"><i class="ri-user-3-fill"></i></span>
                    @guest
                        <a href="{{ route('login') }}"
                            class="transition-all duration-300 font-semibold capitalize hover:text-primary">Farmer
                            login</a>
                    @endguest
                    @auth('web')
                        <a href="{{ route('user.dashboard') }}"
                            class="transition-all duration-300 font-semibold capitalize hover:text-primary">{{ Auth::user()->name }}</a>

                        <ul class="absolute top-full right-0 bg-white w-40 rounded-br-md rounded-bl-md mt-1 transition-all duration-300 rotate-x-90 origin-top group-hover:rotate-x-0">
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="{{ route('user.dashboard') }}" class="block px-2">Dashboard</a>
                            </li>
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="" class="block px-2">Profile</a>
                            </li>
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="#" role="button" class="block px-2" onclick="$('#logout').submit()">Logout</a>
                            </li>
                        </ul>
                    @endauth
                </li>
                <li class="flex flex-row items-center gap-1 relative z-50 group">
                    <span class="text-base"><i class="ri-user-3-fill"></i></span>
                    @guest('customer')
                        <a href="{{ route('customer.login') }}"
                            class="transition-all duration-300 font-semibold capitalize hover:text-primary">Customer
                            login</a>
                    @endguest
                    @auth('customer')
                        <a href="{{ route('customer.dashboard') }}"
                            class="transition-all duration-300 font-semibold capitalize hover:text-primary">{{ Auth::guard('customer')->user()->name }}</a>

                        <ul class="absolute top-full right-0 bg-white w-40 rounded-br-md rounded-bl-md mt-1 transition-all duration-300 rotate-x-90 origin-top group-hover:rotate-x-0">
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="{{ route('customer.dashboard') }}" class="block px-2">Dashboard</a>
                            </li>
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="" class="block px-2">Profile</a>
                            </li>
                            <li class="bg-white py-1 border-b last:border-b-0 text-sm last:rounded-bl-md last:rounded-br-md transition-all duration-300 hover:bg-primary hover:last:rounded-bl-md hover:last:rounded-br-md hover:text-white">
                                <a href="#" role="button" class="block px-2" onclick="$('.customer-logout').submit()">Logout</a>
                            </li>
                        </ul>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</div>
<form action="{{ route('logout') }}" method="post" id="logout">
    @csrf
</form>
<form action="{{ route('customer.logout') }}" method="post" class="customer-logout">
    @csrf
</form>
