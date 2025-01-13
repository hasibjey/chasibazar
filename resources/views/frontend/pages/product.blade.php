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
                            @auth('customer')
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
                                    <span class="text-gray-500">House#09, Road#03, Borobag, Bosoti Housing,
                                        Mirpur-2</span>
                                </li>
                                <li>
                                    <ul class="flex flex-row gap-2 py-2">
                                        <li>
                                            <button type="button"
                                                class="text-base flex flex-row items-center justify-center w-7 h-7 bg-primary-1 text-white rounded-full transition-all duration-300 hover:animate-zoom hover:bg-primary">
                                                <i class="ri-customer-service-2-fill"></i>
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" onclick="startCall()"
                                                class="text-base flex flex-row items-center justify-center w-7 h-7 bg-primary-1 text-white rounded-full transition-all duration-300 hover:animate-zoom hover:bg-primary">
                                                <i class="ri-video-chat-line"></i>
                                            </button>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            @if($product->quantity <= 0)
                                <div class="mt-3 text-red-600 text-xl">পণ্যটি বিক্রি হয়ে গিয়েছে।</div>
                            @else
                                <div class="mt-4 flex flex-row gap-10">
                                    <div class="flex flex-row gap-3 items-center justify-center">
                                        <div class="flex flex-row border items-center h-full">
                                        <button class="border-r h-full flex items-center px-1" onclick="decrease(event)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4 pointer-events-none">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                                </svg>
                                            </button>
                                            <div class="">
                                                <input type="text" class="quantity h-8 outline-none text-center w-28" value="{{ $product->quantity }}" data-target="{{ $product->quantity }}">
                                            </div>
                                            <button class="border-l h-full flex items-center px-1" onclick="increase(event)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="size-4 pointer-events-none">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <button
                                        class="bg-primary-1 py-1.5 px-7 rounded-md text-white transition-all duration-300 hover:bg-primary"
                                        onclick="addProduct(
                                        {{ $product->user_id }},
                                        {{ Auth::guard('customer')->user()->id }},
                                        '{{ $product->id }}',
                                        '{{ $product->title }}',
                                        '{{ $product->unit }}',
                                        {{ $product->price }},
                                        )">Add To Cart</button>
                                </div>
                            @endif
                            @endauth

                            @guest('customer')
                            <p class="mt-3 text-red-500">
                                If you are a customer, please <a href="{{ route('customer.register.index') }}"
                                    class="text-primary-1 transition-all duration-300 hover:text-primary italic">Register</a>
                                or <a href="{{ route('customer.login') }}"
                                    class="text-primary-1 transition-all duration-300 hover:text-primary italic">Login</a>
                                to your account to view the farmer information.
                            </p>
                            <div class="mt-4">
                                <a href="{{ route('customer.register.index') }}" class="inline-block bg-primary py-0.5 px-5 text-sm text-white rounded-sm transition-all duration-300 hover:bg-green-900">Register</a>
                                <a href="{{ route('customer.login') }}" class="inline-block bg-primary py-0.5 px-5 text-sm text-white rounded-sm transition-all duration-300 hover:bg-green-900">Login</a>
                            </div>
                            @endguest
                        </div>

                        @if(count($product->Images)>0)
                        <div class="border-t-2 border-primary pt-10">
                            <div class="grid grid-cols-5 gap-8">
                                @foreach ($product->Images as $image)
                                <div class="border border-primary rounded-md p-1 overflow-hidden group cursor-pointer">
                                    <img src="{{ asset($image->image) }}" alt="{{ $product->title }}"
                                        class="rounded-md scale-90 transition-all duration-300 group-hover:scale-100">
                                </div>
                                @endforeach
                                {{-- <div
                                    class="border border-primary rounded-md p-1 overflow-hidden group cursor-pointer">
                                    <img src="{{ asset('frontend/images/red_potato.jpeg') }}" alt=""
                                        class="rounded-md scale-90 transition-all duration-300 group-hover:scale-100">
                                </div> --}}
                            </div>
                            {{-- <div class="text-center mt-10">
                                <button
                                    class="bg-primary text-sm py-1 px-5 text-white italic rounded-sm uppercase tracking-wide font-semibold border border-transparent transition-all duration-300 hover:bg-transparent hover:border-primary hover:text-black">view
                                    more</button>
                            </div> --}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div id="video-call" class="fixed top-0 left-0 w-screen h-screen z-50 hidden">
                <input type="text" id="username" hidden>
                <video id="local-video" class="absolute top-0 left-0 m-5 rounded-xl w-60 h-60 bg-white"
                    autoplay></video>
                <video id="remote-video" class="bg-black w-full h-full" autoplay></video>

                <div class="call-action absolute bottom-6 left-1/2 -translate-x-1/2">
                    <button class="bg-white rounded-sm py-0.5 px-3 text-sm" onclick="muteVideo()">Mute video</button>
                    <button class="bg-white rounded-sm py-0.5 px-3 text-sm" onclick="muteAudio()">Mute audio</button>
                </div>
            </div>
        </section>
    </main>

    <x-slot name="js">
        <script>
            const increase = (e) => {
                const quantity = e.target.previousElementSibling.children[0];
                const maxQuantity = e.target.previousElementSibling.children[0].dataset.target;

                if(quantity.value < maxQuantity) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity + 1;
                }
            }
            const decrease = (e) => {
                const quantity = e.target.nextElementSibling.children[0];
                if(quantity.value > 1) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity - 1;
                }
            }
            const addProduct = (user_id, customer_id, product_id, product_title, product_unit, product_price) => {
                const maxQuantity = document.querySelector('.quantity').dataset.target;
                let quantity = document.querySelector('.quantity').value;
                const currentQuantity = maxQuantity - quantity;
                document.querySelector('.quantity').value = currentQuantity;

                addToCart(user_id, customer_id, product_id, product_title, maxQuantity, quantity, product_unit, product_price);

            }
        </script>
    </x-slot>
</x-frontend.layouts.app>
