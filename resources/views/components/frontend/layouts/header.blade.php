@php
$navigations = Frontend::Navigation();
@endphp

<section class="relative">
    <!-- Header section -->
    <header class="absolute top-0 left-1/2 -translate-x-1/2 w-full bg-gradient-to-b from-black/70 z-50">
        <div class="container grid grid-cols-10 items-center py-5">
            <!-- Logo -->
            <hi class="col-span-7 lg:col-span-2 text-2xl uppercase font-bold tracking-wide flex flex-row items-end gap-1 [text-shadow:_0_2px_0_rgb(0_0_0_/_40%)]">
                <p class="first-letter:text-4xl">Chasir</p>
                <p class="text-white">bazar</p>
            </hi>
            <!-- Navigation -->
            <div class="col-span-7 text-white hidden lg:block">
                <ul class="flex flex-row justify-start items-center gap-5">
                    <li class="relative">
                        <a href="{{ route('home') }}" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">home</a>
                    </li>
                    @foreach ($navigations as $navigation)
                    @if(count($navigation->SubCategories)>0)
                    <li class="relative group">
                        <h2 class="block cursor-pointer py-4 px-3 capitalize">{{$navigation->name}}</h2>
                        <ul class="absolute top-full left-0 w-60 max-w-80 rounded-md bg-white shadow-sm border border-gray-100/60 rotate-x-90 origin-top transition-all duration-300 group-hover:rotate-x-0 z-50">
                            @foreach ($navigation->SubCategories as $subNav)
                                <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                    <a href="{{ $subNav->slug }}" class="block py-3 px-6 text-15 capitalize text-secondary">{{ $subNav->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @else
                    <li class="relative">
                        <a href="{{ $navigation->slug }}" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">{{ $navigation->name }}</a>
                    </li>
                    @endif
                    @endforeach
                    {{-- <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">about</a>
                    </li>
                    <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">team</a>
                    </li>
                    <li class="relative group">
                        <h2 class="block cursor-pointer py-4 px-3 capitalize">solution</h2>
                        <ul class="absolute top-full left-0 w-60 max-w-80 rounded-md bg-white shadow-sm border border-gray-100/60 rotate-x-90 origin-top transition-all duration-300 group-hover:rotate-x-0 z-50">
                            <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">for
                                    farmers</a>
                            </li>
                            <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">for
                                    founder</a>
                            </li>
                            <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">sofol</a>
                            </li>
                            <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">agri-input</a>
                            </li>
                            <li class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                                <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">IOT &
                                    precision farming</a>
                            </li>
                        </ul>
                    </li>
                    <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">report</a>
                    </li>
                    <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">impact</a>
                    </li>
                    <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">blog</a>
                    </li>
                    <li class="relative">
                        <a href="" class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">carer</a>
                    </li> --}}
                </ul>
            </div>

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
    <section class="absolute bottom-0 left-0 w-full z-50">
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
