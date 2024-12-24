@php
$navigations = Frontend::Navigation();
@endphp

<section class="relative">
    <!-- Header section -->
    <header class="bg-gradient-to-b from-black/70 w-full z-50">
        <!-- Top header -->
        @include('components.frontend.layouts.top')

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
            <div class="relative flex flex-row gap-2 justify-end col-span-3 lg:col-span-1">
                <button
                    class="bg-primary rounded-md py-2 px-3 uppercase text-white text-sm transition-all duration-300 hover:bg-green-800">en</button>
                <button
                    class="bg-white rounded-md py-2 px-3 uppercase text-secondary text-sm transition-all duration-300 hover:bg-green-800 hover:text-white">বাং</button>

                <!-- Cart -->
                @include('components.frontend.layouts.cart')
            </div>
        </div>
    </header>
</section>
