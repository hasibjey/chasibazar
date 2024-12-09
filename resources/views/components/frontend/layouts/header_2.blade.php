@php
$navigations = Frontend::Navigation();
@endphp

<section class="relative">
    <!-- Header section -->
    <header class="bg-gradient-to-b from-black/70 w-full z-50">
        <div class="bg-white">
            <div class="container">
                <div class="grid grid-cols-2 py-1 text-sm">
                    <ul class="flex flex-row justify-start items-center">
                        <li class="flex flex-row items-center gap-2">
                            <span class="text-base"><i class="ri-customer-service-2-fill"></i></span>
                            <a href="tel:01945907007"
                                class="transition-all duration-300 hover:text-primary">01945907007</a>
                        </li>
                    </ul>
                    <ul class="flex flex-row justify-end items-center">
                        <li class="flex flex-row items-center gap-2">
                            <span class="text-base"><i class="ri-user-3-fill"></i></span>
                            <a href="{{ route('login') }}" class="transition-all duration-300 font-semibold capitalize hover:text-primary">login</a>
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
                <button
                    class="bg-primary rounded-md py-2 px-3 uppercase text-white text-sm transition-all duration-300 hover:bg-green-800">en</button>
                <button
                    class="bg-white rounded-md py-2 px-3 uppercase text-secondary text-sm transition-all duration-300 hover:bg-green-800 hover:text-white">বাং</button>
            </div>
        </div>
    </header>
</section>
