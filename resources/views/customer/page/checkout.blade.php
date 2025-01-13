@php
    $items = Cart::Items();
    $sessionAddress = Cart::Address();
@endphp
<x-frontend.layouts.app>
    <x-slot name="title">Checkout</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Product items -->
        <section class="py-10">
            <div class="container">
                <h2 class="pb-5 text-center text-3xl font-bold italic capitalize tracking-wide">
                    <span class="border-b-2 px-4 border-primary">Checkout</span>
                </h2>

                <div class="grid grid-cols-3 gap-10 py-10">
                    <!-- Customer information -->
                    <div class="col-span-2">
                        <div class="mb-20">
                            <h3 class="mb-4 text-sm text-primary font-semibold">Customer Information:</h3>
                            @if(empty($sessionAddress) && empty($address))
                                <form action="{{ route('customer.address') }}" method="post">
                                    @csrf
                                    <div class="mb-4">
                                        <div class="grid grid-cols-2 gap-5 text-sm">
                                            <div>
                                                <label class="block pb-0.5">Name</label>
                                                <input type="text" class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" placeholder="Enter delivery person name" name="name">
                                                @error('name')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block pb-0.5">Phone</label>
                                                <input type="text" class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" placeholder="Enter delivery person number" name="phone">
                                                @error('phone')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-2 gap-5 text-sm">
                                            <div>
                                                <label class="block pb-0.5">Divisions</label>
                                                <select class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" name="division" onchange="getDistricts(event)">
                                                    <option value="">Select delivery division</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('division')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block pb-0.5">Districts</label>
                                                <select class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" id="district" name="district">
                                                    <option value="">Select delivery districts</option>
                                                </select>
                                                @error('district')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="grid grid-cols-2 gap-5 text-sm">
                                            <div>
                                                <label class="block pb-0.5">Address</label>
                                                <textarea rows="2" class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" name="address"></textarea>
                                                @error('address')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div>
                                                <label class="block pb-0.5">Note</label>
                                                <textarea rows="2" class="border border-secondary w-full rounded-sm py-2 px-3 outline-none" name="note"></textarea>
                                                @error('note')
                                                    <span class="text-xs text-red-500">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center mt-10">
                                        <button class="bg-primary py-1.5 px-10 rounded-sm text-sm capitalize text-white transition-all duration-300 hover:bg-green-900">Save</button>
                                    </div>
                                </form>
                            @else
                            <div class="grid grid-cols-2 gap-10">
                                <ul class="border rounded-md p-2 text-sm flex flex-col gap-2">
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">Name:</p>
                                        <p class="">{{ $sessionAddress['name'] ?? $address->name }}</p>
                                    </li>
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">Phone:</p>
                                        <p class="">{{ $sessionAddress['phone'] ?? $address->phone }}</p>
                                    </li>
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">Division:</p>
                                        <p class="">{{ $sessionAddress['division'] ?? $address->Division->name }}</p>
                                    </li>
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">District:</p>
                                        <p class="">{{ $sessionAddress['district'] ?? $address->District->name }}</p>
                                    </li>
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">Address:</p>
                                        <p class="">{{ $sessionAddress['address'] ?? $address->address }}</p>
                                    </li>
                                    <li class="flex flex-row gap-2">
                                        <p class="font-semibold">Note:</p>
                                        <p class="">{{ $sessionAddress['note'] ?? $address->note }}</p>
                                    </li>
                                        {{-- <li>
                                            <button class="bg-primary text-white px-2 rounded-sm text-sm py-1">Edit</button>
                                        </li> --}}
                                </ul>
                            </div>
                            @endif
                        </div>

                        <div class="flex flex-row justify-between">
                            <a href="{{ route('customer.cart') }}" class="flex flex-row items-center gap-2 text-sm text-blue-500 transition-all duration-300 hover:text-primary">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                                    </svg>
                                </span>
                                <span>Back To Cart</span>
                            </a>
                            <a href="{{ route('customer.order') }}" class="inline-block bg-primary py-1.5 px-10 rounded-sm text-sm capitalize text-white transition-all duration-300 hover:bg-green-900">checkout</a>
                        </div>
                    </div>

                    <!-- product information --->
                    <div class="">
                        <!-- Product item -->
                        <div class="flex flex-col gap-5 text-sm">
                            <h3 class="text-sm text-primary font-semibold">Products:</h3>
                            <ul class="border-b border-primary pb-3 flex flex-col gap-4">
                                @foreach ($items as $item)
                                    <li class="grid grid-cols-5">
                                        <img src="{{ asset('frontend/images/alu.png') }}" alt=""
                                            class="w-20 h-20 border border-primary rounded-md p-1">
                                        <div class="col-span-3 flex flex-col">
                                            <a href=""
                                                class="text-lg font-semibold transition-all duration-300 hover:text-primary capitalize">{{ $item['title'] }}</a>
                                            <small>({{ $item['quantity'] }}kg X {{ $item['price'] }})</small>
                                        </div>
                                        <div class="text-end">TK.{{ $item['total'] }}</div>
                                    </li>
                                @endforeach
                                {{-- <li class="grid grid-cols-5">
                                    <img src="{{ asset('frontend/images/alu.png') }}" alt=""
                                        class="w-20 h-20 border border-primary rounded-md p-1">
                                    <div class="col-span-3 flex flex-col">
                                        <a href=""
                                            class="text-lg font-semibold transition-all duration-300 hover:text-primary">Alu</a>
                                        <small>(500kg X 5)</small>
                                    </div>
                                    <div class="text-end">TK.2500</div>
                                </li> --}}
                            </ul>
                            <ul class="flex flex-col gap-2 text-sm">
                                <li class="flex flex-row justify-between">
                                    <p class="">Sub Total</p>
                                    <p class="font-semibold">TK.{{ Cart::SubTotal() }}</p>
                                </li>
                                <li class="flex flex-row justify-between">
                                    <p class="">Shipping cost</p>
                                    <p class="font-semibold">TK.0</p>
                                </li>
                                <li class="flex flex-row justify-between">
                                    <p class="">Discount</p>
                                    <p class="font-semibold">TK.0</p>
                                </li>
                                <li class="flex flex-row justify-between text-base font-semibold text-primary mt-3">
                                    <p class="">Total</p>
                                    <p class="font-semibold">TK.{{ Cart::SubTotal() }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
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

                if (parseInt(quantity.value) < parseInt(maxQuantity)) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity + 1;
                    changeQuantity(id, currentQuantity + 1);
                }
            }
            const decrease = (e) => {
                const quantity = e.target.nextElementSibling.children[0];
                const id = e.target.nextElementSibling.children[0].dataset.id;

                if (parseInt(quantity.value) > 1) {
                    const currentQuantity = parseInt(quantity.value) || 0;
                    quantity.value = currentQuantity - 1;
                    changeQuantity(id, currentQuantity - 1);
                }
            }

            const quantity = (e) => {
                const id = e.target.dataset.id;
                const maxQuantity = e.target.dataset.target;
                if (parseInt(e.target.value) > maxQuantity) {
                    e.target.value = maxQuantity;
                    changeQuantity(id, maxQuantity);
                } else if (parseInt(e.target.value) < 1) {
                    e.target.value = 1;
                    changeQuantity(id, 1);
                } else {
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
                        items.forEach((item, i) => {
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
                                                                    oninput="quantity(event)">
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

            const getDistricts = (e) => {
                const division = e.target.value;

                axios.post('{{ route('customer.districts') }}', {
                    division: division
                })
                .then(res => {
                    let options = `<option value="">Select delivery districts</option>`;
                    res.data.forEach(option => {
                        options += `<option value="${option.id}">${option.name}</option>`;
                    });
                    $('#district').html(options);
                })
                .catch(error => console.log(error))
            }
        </script>
    </x-slot>
</x-frontend.layouts.app>
