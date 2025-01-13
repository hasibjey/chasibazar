@php
    $items = Cart::Items();
@endphp
<x-frontend.layouts.app>
    <x-slot name="title">Cart</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Product items -->
        <section class="py-10">
            <div class="container">
                <h2 class="pb-5 text-center text-3xl font-bold italic capitalize tracking-wide">
                    <span class="border-b-2 px-4 border-primary">Cart items</span>
                </h2>
                <div class="">
                    <table class="w-full cart-table">
                        <thead>
                            <tr>
                                <th class="w-[5%] text-center">#</th>
                                <th class="w-[40%] text-left">Title</th>
                                <th class="w-[15%] text-center">QTY</th>
                                <th class="w-[15%] text-center">Rate</th>
                                <th class="w-[15%] text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            @if (!empty($items))
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td class="w-[5%] text-center">{{ ++$key }}</td>
                                        <td class="w-[40%] text-left">{{ $item['title'] }}</td>
                                        <td class="w-[15%] text-center">
                                            <div class="flex flex-rows items-center justify-between gap-2">
                                                <span class="w-full">
                                                    <div class="flex flex-row gap-3 items-center justify-center">
                                                        <div class="flex flex-row border items-center h-full">
                                                            <button class="border-r h-8 flex items-center px-1"
                                                                onclick="decrease(event)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor"
                                                                    class="size-4 pointer-events-none">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M5 12h14" />
                                                                </svg>
                                                            </button>
                                                            <div class="">
                                                                <input type="text"
                                                                    class="quantity h-8 outline-none text-center w-full"
                                                                    value="{{ $item['quantity'] }}"
                                                                    data-target="{{ $item['maxQuantity'] }}"
                                                                    data-id="{{ $item['pid'] }}"
                                                                    onchange="quantity(event)">
                                                            </div>
                                                            <button class="border-l h-8 flex items-center px-1"
                                                                onclick="increase(event)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor"
                                                                    class="size-4 pointer-events-none">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span class="">{{ $item['unit'] }}</span>
                                            </div>
                                        </td>
                                        <td class="w-[15%] text-center"><span>{{ $item['price'] }}</span>TK</td>
                                        <td class="w-[15%] text-end">{{ $item['total'] }}TK</td>
                                    </tr>
                                @endforeach
                            @endif
                            {{-- <tr>
                                <td class="w-[5%] text-center">1</td>
                                <td class="w-[40%] text-left">lau</td>
                                <td class="w-[15%] text-center">100Kg</td>
                                <td class="w-[15%] text-center">10TK</td>
                                <td class="w-[15%] text-end">3000TK</td>
                            </tr> --}}
                        </tbody>
                        <tfoot class="border-t-4">
                            <tr>
                                <td class="!border-0"></td>
                                <td class="!border-l-0"rowspan="4">
                                    <label class="text-sm mb-1 block font-semibold">Coupon code</label>
                                    <div class="grid grid-cols-4 gap-2">
                                        <input type="text"
                                            class=" col-span-3 border w-full h-9 outline-none px-3 rounded-md text-sm py-2 transition-all duration-300 focus:border-primary focus:shadow-sm focus:shadow-primary-1"
                                            placeholder="Enter your coupon code....">
                                        <button
                                            class="bg-primary-1 px-4 rounded-md text-white transition-all duration-300 hover:bg-primary">Apply</button>
                                    </div>
                                </td>
                                <td class="!border-0"></td>
                                <td class="text-end !pr-5">Sub Total</td>
                                <td class="w-[15%] text-end font-semibold text-primary"><span
                                        class="subTotal">{{ Cart::SubTotal() }}</span>TK</td>
                            </tr>
                            <tr>
                                <td class="!border-0"></td>
                                <td class="!border-0"></td>
                                <td class="text-end !pr-5">Discount</td>
                                <td class="w-[15%] text-end font-semibold text-primary">0TK</td>
                            </tr>
                            <tr>
                                <td class="!border-0"></td>
                                <td class="!border-0"></td>
                                <td class="text-end !pr-5">Shipping Cost</td>
                                <td class="w-[15%] text-end font-semibold text-primary">0TK</td>
                            </tr>
                            <tr>
                                <td class="!border-0"></td>
                                <td class="!border-0"></td>
                                <td class="text-end !pr-5">Net Total</td>
                                <td class="w-[15%] text-end font-semibold text-primary"><span
                                        class="total">{{ Cart::SubTotal() }}</span>TK</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end mt-10">
                    <a href="{{ route('customer.checkout') }}"
                        class="bg-primary-1 px-10 py-2 rounded-md text-white transition-all duration-300 hover:bg-primary">Checkout</a>
                </div>
            </div>
        </section>
    </main>

    <x-slot name="js">
        <script>
            const increase = (e) => {
                const quantity = e.target.previousElementSibling.children[0];
                const maxQuantity = e.target.previousElementSibling.children[0].dataset.target;
                const id = e.target.previousElementSibling.children[0].dataset.id;

                if(parseInt(quantity.value) < parseInt(maxQuantity)) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity + 1;
                    changeQuantity(id, currentQuantity + 1);
                }
            }
            const decrease = (e) => {
                const quantity = e.target.nextElementSibling.children[0];
                const id = e.target.nextElementSibling.children[0].dataset.id;

                if(parseInt(quantity.value) > 1) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity - 1;
                    changeQuantity(id, currentQuantity - 1);
                }
            }

            const quantity = (e) => {
                const id = e.target.dataset.id;
                const maxQuantity = e.target.dataset.target;
                if(parseInt(e.target.value) > maxQuantity) {
                    e.target.value = maxQuantity;
                    changeQuantity(id, maxQuantity);
                }
                else if(parseInt(e.target.value) < 1) {
                    e.target.value = 1;
                    changeQuantity(id, 1);
                }
                else {
                    changeQuantity(id, e.target.value);
                }
            }

            const changeQuantity = (id, quantity) => {
                axios.post("{{ route('customer.cart.update') }}", {
                    id: id,
                    quantity: quantity
                })
                .then(res => {
                    const items = res.data.items;
                    let cart = null;
                    items.forEach((item, i)=> {
                        cart += `<tr>
                                        <td class="w-[5%] text-center">${ ++i }</td>
                                        <td class="w-[40%] text-left">${ item.title }</td>
                                        <td class="w-[15%] text-center">
                                            <div class="flex flex-rows items-center justify-between gap-2">
                                                <span class="w-full">
                                                    <div class="flex flex-row gap-3 items-center justify-center">
                                                        <div class="flex flex-row border items-center h-full">
                                                            <button class="border-r h-8 flex items-center px-1"
                                                                onclick="decrease(event)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor"
                                                                    class="size-4 pointer-events-none">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M5 12h14" />
                                                                </svg>
                                                            </button>
                                                            <div class="">
                                                                <input type="text"
                                                                    class="quantity h-8 outline-none text-center w-full"
                                                                    value="${ item.quantity }"
                                                                    data-target="${ item.maxQuantity }"
                                                                    data-id="${ item.pid }"
                                                                    onchange="quantity(event)">
                                                            </div>
                                                            <button class="border-l h-8 flex items-center px-1"
                                                                onclick="increase(event)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                    viewBox="0 0 24 24" stroke-width="2"
                                                                    stroke="currentColor"
                                                                    class="size-4 pointer-events-none">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </span>
                                                <span class="">${ item.unit }</span>
                                            </div>
                                        </td>
                                        <td class="w-[15%] text-center"><span>${ item.price }</span>TK</td>
                                        <td class="w-[15%] text-end">${ item.total }TK</td>
                                    </tr>`;
                    });
                    $("#cart-items").html(cart);
                    $('.subTotal').html(res.data.subTotal);
                    $('.total').html(res.data.subTotal);

                })
                .catch(error => console.log(error))
            }

            const addProduct = (user_id, customer_id, product_id, product_title, product_unit, product_price) => {
                const maxQuantity = document.querySelector('.quantity').dataset.target;
                let quantity = document.querySelector('.quantity').value;
                const currentQuantity = maxQuantity - quantity;
                document.querySelector('.quantity').value = currentQuantity;

                addToCart(user_id, customer_id, product_id, product_title, quantity, product_unit, product_price);

            }
        </script>
    </x-slot>
</x-frontend.layouts.app>
