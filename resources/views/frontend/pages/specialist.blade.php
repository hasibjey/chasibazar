<x-frontend.layouts.app>
    <x-slot name="title">Agriculture specialist</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Hero section -->
        <section class="relative">
            <img src="{{ asset($item->hero_image) }}" alt="{{ $item->title }}">
            <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl font-bold text-white drop-shadow-lg uppercase">{{ $item->title }}</h2>
        </section>

        <section class="">
            <div class="container py-20">
                <h3 class=" pb-10 text-center text-2xl font-bold italic capitalize">
                    <span class="border-b-2 border-primary px-2">agriculture specialist</span>
                </h3>
                <div class="px-20 grid grid-cols-5 gap-2">
                    @if(!empty($item))
                        @foreach ($item->Specialist as $spe)
                            <div class="border border-primary rounded-md p-2">
                                <img src="{{ asset('frontend/images/specialist.jpeg') }}" alt="">
                                <h2 class="h-[48px] font-semibold text-sm transition-all duration-300 hover:text-primary cursor-pointer">{{ $spe->name }}</h2>
                                <div class="text-center mt-3">
                                    <button class="block  w-full border bg-green-800 text-white rounded-sm py-1 px-3 capitalize font-semibold tracking-wide text-sm transition-all duration-300 hover:bg-white hover:text-secondary">Details</button>
                                    <button class="block  w-full border bg-green-800 text-white rounded-sm py-1 px-3 capitalize font-semibold tracking-wide text-sm transition-all duration-300 hover:bg-white hover:text-secondary">booking now</button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
