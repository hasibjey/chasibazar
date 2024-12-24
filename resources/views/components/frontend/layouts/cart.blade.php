@php
    $items = Cart::Items();
@endphp
<div class="group">
    <div
        class="relative bg-white rounded-md py-2 px-3 uppercase text-secondary text-sm transition-all duration-300 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
        </svg>
        <span
            class="cart-count absolute -top-3 -right-2 w-6 h-6 rounded-full bg-primary text-xs text-white flex flex-row items-center justify-center shadow shadow-white">{{ Cart::Count() }}</span>
    </div>
    <!-- Cart drawer -->
    <div class="cart-drawer absolute top-full right-0 {{ Cart::count() > 0? 'hidden group-hover:block' : 'hidden' }} z-50">
        <div
            class="mt-3 bg-white shadow-sm shadow-gray-400 w-72 py-3 rounded-md h-main-cart">

            <ul class="cart-drawer-item h-cart-item overflow-auto">
                @if (!empty($items))
                    @foreach ($items as $item)
                        <li class="px-3 border-b py-2">
                            <h2 class="text-xl font-semibold capitalize">{{ $item['title'] }}</h2>
                            <p class="text-xs text-primary font-semibold">{{ $item['quantity'] . $item['unit'] }} X
                                {{ $item['price'] }} = {{ $item['total'] }} TK</p>
                        </li>
                    @endforeach
                @endif
                {{-- <li class="px-3 border-b py-2">
                        <h2 class="text-xl font-semibold">lau</h2>
                        <p class="text-xs text-primary font-semibold">100 kg * 12 = 12000 TK</p>
                    </li> --}}
            </ul>


            <ul class="px-3 mt-6 bg-primary">
                <li class="flex flex-row justify-between font-semibold py-2 text-white">
                    <p>উপ মোট</p>
                    <p><span class="sub-total">{{ Cart::SubTotal() }}</span> TK</p>
                </li>
            </ul>

            <div class="flex flex-row px-3 justify-between gap-4 mt-6">
                <a href="{{ route('customer.cart') }}"
                    class="bg-primary-1 w-full text-center py-1 rounded-sm text-white transition-all duration-300 hover:bg-primary">কার্ট
                    দেখুন</a>
                <a href=""
                    class="bg-primary-1 w-full text-center py-1 rounded-sm text-white transition-all duration-300 hover:bg-primary">চেকআউট</a>
            </div>

        </div>
    </div>
</div>
