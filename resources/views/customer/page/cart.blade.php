@php
    $items = Cart::Items();
@endphp
<x-frontend.layouts.app>
    <x-slot name="title">Home</x-slot>

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
                        <tbody>
                            @if(!empty($items))
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td class="w-[5%] text-center">{{ ++$key }}</td>
                                        <td class="w-[40%] text-left">{{ $item['title'] }}</td>
                                        <td class="w-[15%] text-center"><span>{{ $item['quantity'] }}</span>{{ $item['unit'] }}</td>
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
                                        <input type="text" class=" col-span-3 border w-full h-9 outline-none px-3 rounded-md text-sm py-2 transition-all duration-300 focus:border-primary focus:shadow-sm focus:shadow-primary-1" placeholder="Enter your coupon code....">
                                        <button class="bg-primary-1 px-4 rounded-md text-white transition-all duration-300 hover:bg-primary">আবেদন করুন</button>
                                    </div>
                                </td>
                                <td class="!border-0"></td>
                                <td class="text-end !pr-5">Sub Total</td>
                                <td class="w-[15%] text-end font-semibold text-primary"><span class="subTotal">{{ Cart::SubTotal() }}</span>TK</td>
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
                                <td class="w-[15%] text-end font-semibold text-primary"><span class="total">{{ Cart::SubTotal() }}</span>TK</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="text-end mt-10">
                    <a href="" class="bg-primary-1 px-10 py-2 rounded-md text-white transition-all duration-300 hover:bg-primary">চেকআউট</a>
                </div>
            </div>
        </section>
    </main>

    <x-slot name="js">
        <script>
            const increase = (e) => {
                const quantity = e.target.previousElementSibling.children[0];
                const maxQuantity = e.target.previousElementSibling.children[0].dataset.target;

                if (quantity.value < maxQuantity) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity + 1;
                }
            }
            const decrease = (e) => {
                const quantity = e.target.nextElementSibling.children[0];
                if (quantity.value > 1) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity - 1;
                }
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
