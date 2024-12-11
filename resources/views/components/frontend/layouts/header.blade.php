@php
$navigations = Frontend::Navigation();
@endphp

<section class="relative">
    <!-- Header section -->
    <header class=" absolute bg-gradient-to-b from-black/70 top-0 left-1/2 -translate-x-1/2 w-full z-50">
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
                        <li class="flex flex-row items-center gap-1">
                            <span class="text-base"><i class="ri-user-3-fill"></i></span>
                            @guest
                                <a href="{{ route('login') }}" class="transition-all duration-300 font-semibold capitalize hover:text-primary">Farmer login</a>
                            @endguest
                            @auth('web')
                                <a href="{{ route('user.dashboard') }}" class="transition-all duration-300 font-semibold capitalize hover:text-primary">{{ Auth::user()->name }}</a>
                            @endauth
                        </li>
                        <li class="flex flex-row items-center gap-1">
                            <span class="text-base"><i class="ri-user-3-fill"></i></span>
                            @guest('customer')
                                <a href="{{ route('customer.login') }}" class="transition-all duration-300 font-semibold capitalize hover:text-primary">Customer login</a>
                            @endguest
                            @auth('customer')
                                <a href="{{ route('customer.dashboard') }}" class="transition-all duration-300 font-semibold capitalize hover:text-primary">{{ Auth::guard('customer')->user()->name }}</a>
                            @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container grid grid-cols-10 items-center py-5">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="block col-span-7 lg:col-span-2">
                <h1 class="text-2xl uppercase font-bold tracking-wide flex flex-row items-end gap-1 [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">
                    <p class="first-letter:text-4xl">Chasir</p>
                    <p class="text-white">bazar</p>
                </h1>
            </a>
            <!-- Navigation -->
            @include('components.frontend.layouts.navigation')

            <!-- Language button -->
            <div class="flex flex-row gap-2 justify-end col-span-3 lg:col-span-1">
                <button class="bg-primary rounded-md py-2 px-3 uppercase text-white text-sm transition-all duration-300 hover:bg-green-800">en</button>
                <button class="bg-white rounded-md py-2 px-3 uppercase text-secondary text-sm transition-all duration-300 hover:bg-green-800 hover:text-white">বাং</button>
            </div>
        </div>
    </header>

    <!-- Slider section -->
    <section class="main-slider mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('frontend/images/slider.webp') }}" alt="" class="w-full h-screen">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('frontend/images/slider_4.webp') }}" alt="" class="w-full h-screen">
            </div>
            <div class="swiper-slide">
                <img src="{{ asset('frontend/images/slider_2.jpg') }}" alt="" class="w-full h-screen">
            </div>
        </div>
    </section>

    <!-- Hero section -->
    <section class="absolute top-[25%] z-40 left-1/2 -translate-x-1/2 w-full">
        <div class="text-center text-white">
            <p class="text-3xl md:text-5xl mb-10 lg:mb-16 [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">Democratizing
            </p>
            <p class="hero-title text-5xl md:text-8xl lg:text-9xl font-bold capitalize scale-100 transition-all duration-500 [text-shadow:_0_6px_0_rgb(0_0_0_/_40%)]">
                Supply Chain</p>
        </div>
    </section>

    <!-- Counter -->
    <section class="absolute bottom-0 left-0 w-full z-40">
        <div class="grid grid-cols-2 lg:grid-cols-4 text-white items-center border-b-[20px] border-primary counters">
            <div class="flex justify-center py-5 lg:py-10 border border-white border-b-0 border-r-0 border-l-0 counters">
                <div class="">
                    <p class="text-3xl lg:text-5xl [text-shadow:_0_6px_0_rgb(0_0_0_/_40%)] font-semibold" data-count="0" data-end="2.4" data-increment="0.5">TK <span class="counter" data-count="0" data-end="2.4" data-increment="0.5">2.45</span>B</p>
                    <p class="text-base md:text-lg [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">Finance Facilitated
                    </p>
                </div>
            </div>
            <div class="flex justify-center py-5 lg:py-10 border border-white border-b-0 border-r-0">
                <div class="">
                    <p class="text-3xl lg:text-5xl [text-shadow:_0_6px_0_rgb(0_0_0_/_40%)] font-semibold"><span class="counter" data-count="0" data-end="113839" data-increment="1000">113839</span>+</p>
                    <p class="text-base md:text-lg [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">Registered Farmers
                    </p>
                </div>
            </div>
            <div class="flex justify-center py-5 lg:py-10 border border-white border-b-0 border-r-0 border-l-0 lg:border-l">
                <div class="">
                    <p class="text-3xl lg:text-5xl [text-shadow:_0_6px_0_rgb(0_0_0_/_40%)] font-semibold"><span class="counter" data-count="0" data-end="14000" data-increment="100">14000</span>+
                    </p>
                    <p class="text-base md:text-lg [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">Registered Retailers
                    </p>
                </div>
            </div>
            <div class="flex justify-center py-5 lg:py-10 border border-white border-b-0 border-r-0">
                <div class="">
                    <p class="text-3xl lg:text-5xl [text-shadow:_0_6px_0_rgb(0_0_0_/_40%)] font-semibold"><span class="counter" data-count="0" data-end="299" data-increment="1">299</span>K Ton</p>
                    <p class="text-base md:text-lg [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">Farm Produce Sold
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>
