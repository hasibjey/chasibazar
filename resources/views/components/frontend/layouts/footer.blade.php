@php
    $contact = Frontend::Contact();
    $branches = Frontend::Branch();
@endphp

<footer class="border-t border-t-primary py-10 px-5">
    <div class="grid grid-cols-5 gap-10">
        <!-- Contact -->
        <div class="">
            <h2 class="text-lg capitalize font-semibold mb-4">contact</h2>
            <ul>
                <li class="flex flex-col gap-1 py-3">
                    <p class="">Email</p>
                    <a href="" class="flex flex-row justify-start items-center gap-3 font-semibold">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <span>{{ $contact->email}}</span>
                    </a>
                </li>
                <li class="flex flex-col gap-1 py-3">
                    <p class="">Calling Hours</p>
                    <p class="flex flex-row justify-start items-center gap-3 font-semibold">
                        {{ $contact->calling_hours }}
                    </p>
                </li>
                <li class="flex flex-col gap-1 py-3">
                    <p class="">Chasir bazar Helpline</p>
                    <a href="" class="flex flex-row justify-start items-center gap-3 font-semibold">
                        <span>
                            <i class="ri-phone-line text-xl font-light"></i>
                        </span>
                        <span>{{ $contact->alterPhone }}</span>
                    </a>
                    <a href="" class="flex flex-row justify-start items-center gap-3 font-semibold">
                        <span>
                            <i class="ri-whatsapp-line font-light"></i>
                        </span>
                        <span>{{ $contact->whatsapp }}</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Location -->
        @if(count($branches)>0)
            <div class="">
                <h2 class="text-lg capitalize font-semibold mb-4">location</h2>
                <ul>
                    @foreach ($branches as $branch)
                        <li class="flex flex-col gap-1 py-3">
                            <p class="font-semibold mb-1">{{ $branch->name }}</p>
                            <p class="">{{ $branch->address}}</p>
                            <a href="tel:{{ $branch->phone }}" class="flex flex-row justify-start items-center gap-3">
                                <span>
                                    <i class="ri-phone-line text-xl font-extralight"></i>
                                </span>
                                <span>{{ $branch->phone }}</span>
                            </a>
                        </li>
                    @endforeach
                    {{-- <li class="flex flex-col gap-1 py-3">
                        <p class="font-semibold mb-1">Khulna</p>
                        <p class="">71, Ali Hafez Road, Christian Para, Khulna 9201</p>
                        <a href="" class="flex flex-row justify-start items-center gap-3">
                            <span>
                                <i class="ri-phone-line text-xl font-extralight"></i>
                            </span>
                            <span>01945907007</span>
                        </a>
                    </li>
                    <li class="flex flex-col gap-1 py-3">
                        <p class="font-semibold mb-1">Chattogram</p>
                        <p class="">8 Agrabad Access Rd, Chattogram 4100</p>
                        <a href="" class="flex flex-row justify-start items-center gap-3">
                            <span>
                                <i class="ri-phone-line text-xl font-extralight"></i>
                            </span>
                            <span>01945907007</span>
                        </a>
                    </li> --}}
                    <li class="flex flex-col gap-1 py-3">
                        <a href="" class="flex flex-row items-center justify-center gap-3 group relative">
                            <span class="relative after:absolute after:bottom-0 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">See
                                more</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        <!-- Contact -->
        <div class="">
            <h2 class="text-lg capitalize font-semibold mb-4">Business Information</h2>
            <ul>
                <li class="flex flex-col gap-1 py-3">
                    <p class="">Trade License Number</p>
                    <p class="flex flex-row justify-start items-center gap-3 font-semibold">

                    </p>
                </li>
                <li class="flex flex-col gap-1 py-3">
                    <p class="">BIN Number</p>
                    <p class="flex flex-row justify-start items-center gap-3 font-semibold">

                    </p>
                </li>
            </ul>
        </div>

        <!-- Legal -->
        <div class="">
            <h2 class="text-lg capitalize font-semibold mb-4">Legal</h2>
            <ul>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">Privacy
                            Policy</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">Terms
                            & Services</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">Risk
                            Management</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Company -->
        <div class="">
            <h2 class="text-lg capitalize font-semibold mb-4">Company</h2>
            <ul>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">About
                            us</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">gallery</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
                <li class="flex flex-col gap-1 py-2">
                    <a href="" class="flex flex-row items-center gap-4 group">
                        <span class="relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-px after:bg-black/50 after:transition-all after:duration-300 group-hover:after:w-full">FAQ</span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Copy right & social media -->
    <div class="grid grid-cols-2 pt-5 border-t border-primary-1/30">
        <div class="text-xs">&COPY; 2024 Chasir Bazar</div>
        <div class="flex justify-end items-center">
            <ul class="flex flex-row items-center gap-2 text-primary">
                <li>
                    <a href="" class="flex justify-center items-center w-8 h-8 rounded-full border border-primary transition-all duration-300 hover:bg-primary hover:text-white hover:animate-zoom"><i class="ri-facebook-fill"></i></a>
                </li>
                <li>
                    <a href="" class="flex justify-center items-center w-8 h-8 rounded-full border border-primary transition-all duration-300 hover:bg-primary hover:text-white hover:animate-zoom"><i class="ri-whatsapp-fill"></i></a>
                </li>
                <li>
                    <a href="" class="flex justify-center items-center w-8 h-8 rounded-full border border-primary transition-all duration-300 hover:bg-primary hover:text-white hover:animate-zoom"><i class="ri-twitter-x-fill"></i></a>
                </li>
            </ul>
        </div>
    </div>
</footer>
