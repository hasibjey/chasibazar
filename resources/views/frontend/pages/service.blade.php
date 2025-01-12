<x-frontend.layouts.app>
    <x-slot name="title">Home</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Hero section -->
        <section class="relative">
            <img src="{{ asset($item->hero_image) }}" alt="{{ $item->title }}">
            <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl font-bold text-white drop-shadow-lg uppercase">{{ $item->title }}</h2>
        </section>

        <!-- labor booking -->
        <section class="">
            <div class="container text-end py-10">
                <a href="{{ route('labor.create') }}" class="inline-block border bg-green-800 text-white rounded-md py-2 px-3 capitalize font-semibold tracking-wide text-sm transition-all duration-300 hover:bg-white hover:text-secondary">booking labor</a>
            </div>
        </section>

        <section class="">
            <div class="container py-20">
                <h3 class=" pb-10 text-center text-2xl font-bold italic capitalize">
                    <span class="border-b-2 border-primary px-2">Labor list</span>
                </h3>
                <ul class="px-20 flex flex-col gap-2">
                    <li class="grid grid-cols-4 border border-primary rounded-sm cursor-none p-2 capitalize font-semibold">
                        <p class="">Service</p>
                        <p class="">Labor type</p>
                        <p class="">Working shift</p>
                        <p class="text-end">Labor cost</p>
                    </li>
                    @if(!empty($item))
                        @foreach ($item->Labor as $labor)
                            <li class="grid grid-cols-4 border border-primary rounded-sm cursor-pointer p-2 capitalize hover:bg-green-50">
                                <p class="">{{ $item->title }}</p>
                                <p class="">{{ $labor->type }}</p>
                                <p class="">{{ $labor->shift }}</p>
                                <p class="text-end">{{ $labor->cost }}</p>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
