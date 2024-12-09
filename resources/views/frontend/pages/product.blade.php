<x-frontend.layouts.app>
    <x-slot name="title">Home</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Product items -->
        <section class="py-10">
            <div class="container">
                <div class="grid grid-cols-4 gap-10">
                    <div class="">
                        <img src="{{ asset($product->thumbnail) }}" alt="">
                    </div>
                    <div class="col-span-3 flex flex-col gap-10">
                        <h2 class="text-2xl font-bold capitalize">{{ $product->title }}</h2>
                        <div class="">
                            {!! $product->description !!}
                        </div>
                        <div class="">
                            <h3 class="text-lg font-semibold capitalize">farmer information:</h3>
                            <ul class="flex flex-col gap-1 text-sm mt-3">
                                <li>
                                    <span class="text-base">
                                        <i class="ri-user-fill"></i>
                                    </span>
                                    <span class="text-gray-500">{{ $product->User->name }}</span>
                                </li>
                                <li>
                                    <span class="text-base">
                                        <i class="ri-phone-fill"></i>
                                    </span>
                                    <span class="text-gray-500">{{ $product->User->phone }}</span>
                                </li>
                                <li>
                                    <span class="text-base">
                                        <i class="ri-map-pin-user-fill"></i>
                                    </span>
                                    <span class="text-gray-500">House#09, Road#03, Borobag, Bosoti Housing, Mirpur-2</span>
                                </li>
                                <li>
                                    <ul class="flex flex-row gap-2 py-2">
                                        <li>
                                            <a href="" class="text-base flex flex-row items-center justify-center w-7 h-7 bg-primary-1 text-white rounded-full transition-all duration-300 hover:animate-zoom hover:bg-primary"><i class="ri-customer-service-2-fill"></i></a>
                                        </li>
                                        <li>
                                            <a href="" class="text-base flex flex-row items-center justify-center w-7 h-7 bg-primary-1 text-white rounded-full transition-all duration-300 hover:animate-zoom hover:bg-primary"><i class="ri-video-chat-line"></i></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            {{-- <p class="mt-3">
                                After logging in, the farmer will be able to see the information.
                                <a href="" class="text-primary-1 transition-all duration-300 hover:text-primary italic">Login here</a>
                            </p> --}}
                        </div>

                        @if(count($product->Images)>0)
                            <div class="border-t-2 border-primary pt-10">
                                <div class="grid grid-cols-5 gap-8">
                                    @foreach ($product->Images as $image)
                                        <div class="border border-primary rounded-md p-1 overflow-hidden group cursor-pointer">
                                            <img src="{{ asset($image->image) }}" alt="{{ $product->title }}" class="rounded-md scale-90 transition-all duration-300 group-hover:scale-100">
                                        </div>
                                    @endforeach
                                    {{-- <div class="border border-primary rounded-md p-1 overflow-hidden group cursor-pointer">
                                        <img src="{{ asset('frontend/images/red_potato.jpeg') }}" alt="" class="rounded-md scale-90 transition-all duration-300 group-hover:scale-100">
                                    </div> --}}
                                </div>
                                {{-- <div class="text-center mt-10">
                                    <button class="bg-primary text-sm py-1 px-5 text-white italic rounded-sm uppercase tracking-wide font-semibold border border-transparent transition-all duration-300 hover:bg-transparent hover:border-primary hover:text-black">view more</button>
                                </div> --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
