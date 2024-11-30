<x-frontend.layouts.app>
    <x-slot name="title">Home</x-slot>

    <main>
        @include('components.frontend.layouts.header')

        @if(count($items)>0)
        @foreach ($items as $key => $item)
            @if($key%2==0)
                <section class="my-32">
                    <div class="container flex flex-col gap-36">
                        @foreach ($item->SubCategories as $key => $list)
                        @if($key%2==0)
                        <div class="grid grid-cols-2 gap-4">
                            <div class="mr-10">
                                <h2 class="text-5xl mb-14 font-semibold">{{ $list->name }}</h2>
                                <h3 class="text-justify mb-10">
                                    {!! $list->description !!}
                                </h3>
                                <a href="{{ $list->slug }}" class="border border-primary w-2/6 rounded-full py-3 px-8 flex flex-row items-center justify-between transition-all duration-300 hover:bg-primary hover:text-white">
                                    <span class="capitalize">learn more</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                            <div class="flex justify-end">
                                <img src="{{ asset($list->image) }}" alt="" class="w-[488px] h-[580px] rounded-lg">
                            </div>
                        </div>
                        @else
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex justify-start">
                                <img src="{{ asset($list->image) }}" alt="" class="w-[488px] h-[580px] rounded-lg">
                            </div>
                            <div class="ml-10">
                                <h2 class="text-5xl mb-14 font-semibold">{{ $list->name }}</h2>
                                <h3 class="text-justify mb-10">
                                    {!! $list->description !!}
                                </h3>
                                <a href="{{ $list->slug }}" class="border border-primary w-2/6 rounded-full py-3 px-8 flex flex-row items-center justify-between transition-all duration-300 hover:bg-primary hover:text-white">
                                    <span class="capitalize">learn more</span>
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        {{-- <div class="grid grid-cols-2 gap-4">
                                <div class="flex justify-start">
                                    <img src="{{ asset('frontend/images/item-2.webp') }}" alt="" class="w-[488px] h-[580px] rounded-lg">
                    </div>
                    <div class="ml-10">
                        <h2 class="text-5xl mb-14 font-semibold">Creating Access to Quality Input</h2>
                        <h3 class="text-justify mb-10">
                            We empower Agri input retailers by offering a one stop solution for all Agri input supply,
                            offering omni channel presence, doorstep delivery and buy now pay later solutions. This
                            enables the farmers to get access to quality input from their local Agri input shops.
                        </h3>
                        <a href="" class="border border-primary w-2/6 rounded-full py-3 px-8 flex flex-row items-center justify-between transition-all duration-300 hover:bg-primary hover:text-white">
                            <span class="capitalize">learn more</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </a>
                    </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mr-10">
                            <h2 class="text-5xl mb-14 font-semibold">Improving Access to Market for the Farmers</h2>
                            <h3 class="text-justify mb-10">
                                We use our tech-enabled supply chain network to aggregate fresh produce, directly from
                                farming communities. Thus offering farmers, quality driven competitive prices factoring in
                                all associated costs and expenses, simple payment terms and logistics support. We work with
                                wholesalers, modern trade retailers, exporters and processors to give them access to quality
                                farm produce at a competitive price without having to deal with multiple intermediaries.
                            </h3>
                            <a href="" class="border border-primary w-2/6 rounded-full py-3 px-8 flex flex-row items-center justify-between transition-all duration-300 hover:bg-primary hover:text-white">
                                <span class="capitalize">learn more</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div class="flex justify-end">
                            <img src="{{ asset('frontend/images/item-3.webp') }}" alt="" class="w-[488px] h-[580px] rounded-lg">
                        </div>
                    </div> --}}
                    </div>
                </section>
            @else
                <section class="py-32 bg-primary text-white">
                    <div class="container">
                        <div class="grid grid-cols-2 gap-20">
                            <div class="mr-20">
                                <h2 class="text-7xl mb-7 font-semibold">{{ $item->name }}</h2>
                                <h3 class="">
                                    {!! $item->description !!}
                                </h3>
                            </div>
                            @if(count($item->SubCategories)>0)
                                <div class="">
                                    <ul>
                                        @foreach ($item->SubCategories as $list)
                                            <li class="py-5 border-t border-white/50 last:border-b">
                                                <h2 class="text-4xl font-semibold mb-5">{{ $list->name }}</h2>
                                                <p class="">
                                                    {!! $list->description !!}
                                                </p>
                                            </li>
                                        @endforeach
                                        {{-- <li class="py-5 border-t border-white/50 last:border-b">
                                            <h2 class="text-4xl font-semibold mb-5">Funders</h2>
                                            <p class="">
                                                We use technology and data to enable institutions and individuals to support in
                                                creating access to finance for the farmers
                                            </p>
                                        </li>
                                        <li class="py-5 border-t border-white/50 last:border-b">
                                            <h2 class="text-4xl font-semibold mb-5">Agriculture Companies</h2>
                                            <p class="">
                                                We work with agricultural input companies and service providers, offering quality
                                                agriculture input and advisory services to the farmers
                                            </p>
                                        </li>
                                        <li class="py-5 border-t border-white/50 last:border-b">
                                            <h2 class="text-4xl font-semibold mb-5">Buyers</h2>
                                            <p class="">
                                                We source directly from the farmers and supply agriculture produce in bulk quantity
                                                to large enterprises, modern trade retailers and wholesale markets.
                                            </p>
                                        </li> --}}
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
        @endif


        <section class="my-32">
            <div class="container px-52 relative">
                <div class="relative swiper testimonial">
                    <div class="swiper-wrapper">
                        <div class="text-center swiper-slide">
                            <div class="mb-5">
                                In 2021, I got to know about iFarmer and reached out to them for assistance. I have
                                asked for a Power Tiller in hopes of an increased income to support my family. iFarmer
                                instantly supported me by giving me a Power Tiller. I believe, by using this power
                                tiller, I will be able to develop my agricultural work.
                            </div>
                            <h2 class="text-lg font-semibold">
                                Md. Mohsin Ali, Farmer
                            </h2>
                        </div>
                        <div class="text-center swiper-slide">
                            <div class="mb-5">
                                iFarmer’s advisory service is very effective and I find it very useful. They also keep
                                us updated with advice through SMS. I get my necessary suggestions very easily.
                            </div>
                            <h2 class="text-lg font-semibold">
                                Saud Babu, Potato Farmer
                            </h2>
                        </div>
                        <div class="text-center swiper-slide">
                            <div class="mb-5">
                                iFarmer is the reason behind my development. iFarmer is providing us with many
                                facilities related to agricultural work and farming. All credit goes to iFarmer.
                            </div>
                            <h2 class="text-lg font-semibold">
                                Mst Rokhsana Rony , Livestock Farmer
                            </h2>
                        </div>
                    </div>
                    <div class="swiper-button-next hidden"></div>
                    <div class="swiper-button-prev hidden"></div>
                </div>
                <div class="">
                    <button class="prev-btn absolute top-1/2 left-0 -translate-y-1/2 border border-primary w-20 h-20 rounded-full flex justify-center items-center group disabled:border-gray-300" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7 scale-75 transition-all duration-300 group-hover:scale-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                    </button>
                    <button class="next-btn absolute top-1/2 right-0 -translate-y-1/2 border border-primary w-20 h-20 rounded-full flex justify-center items-center group disabled:border-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-7 scale-75 transition-all duration-300 group-hover:scale-100">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </section>
    </main>
</x-frontend.layouts.app>
