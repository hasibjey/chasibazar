<x-frontend.layouts.app>
    <x-slot name="title">Agriculture event</x-slot>

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
                    <span class="border-b-2 border-primary px-2">agriculture event</span>
                </h3>
                <div class="px-20 grid grid-cols-2 gap-2">
                    @if(!empty($item))
                        @foreach ($item->Event as $event)
                            <div class="flex flex-cols gap-5 border border-primary rounded p-3">
                                <img src="{{ asset('frontend/images/event.webp') }}" alt="" class="w-20 h-20 rounded-md">
                                <div class="">
                                    <h2 class="text-sm font-semibold capitalize">event title</h2>
                                    <p class="text-sm text-gray-600">Type: {{ $event->type }}</p>
                                    <p class="text-sm text-gray-600">Time: {{ $event->timestamp }}</p>
                                    <p class="text-sm text-gray-600">{!! $event->description !!}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
