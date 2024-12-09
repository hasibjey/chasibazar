<x-frontend.layouts.app>
    <x-slot name="title">Home</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Product items -->
        <section class="py-10">
            <div class="container">
                @if(count($products)>0)
                    <div class="grid grid-cols-5 gap-10">
                        @foreach ($products as $product)
                            <div class="text-center swiper-slide">
                                <a href="{{ route('product', [$product->slug,$product->code]) }}" class="">
                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->title }}" class="w-52 m-auto">
                                </a>
                                <div class="mt-5">
                                    <h2 class="font-semibold h-[50px] overflow-hidden mb-2">
                                        <a href="{{ route('product', [$product->slug,$product->code]) }}">{{ $product->title }}</a>
                                    </h2>
                                    <a href="{{ route('product', [$product->slug,$product->code]) }}"
                                        class="inline-block border border-primary rounded-sm text-sm py-1 px-5 transition-all duration-300 hover:bg-primary hover:text-white">Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-red-500 text-center italic">No Data found..!</p>
                @endif
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
