<div class="col-span-7 text-white hidden lg:block">
    <ul class="flex flex-row justify-start items-center gap-5">
        <li class="relative">
            <a href="{{ route('home') }}"
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">home</a>
        </li>
        <li class="relative group">
            <h2 class="block cursor-pointer py-4 px-3 capitalize">Service</h2>
            <ul
                class="absolute top-full left-0 w-60 max-w-80 rounded-md bg-white shadow-sm border border-gray-100/60 rotate-x-90 origin-top transition-all duration-300 group-hover:rotate-x-0 z-50">
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="{{ route('labor') }}" class="block py-3 px-6 text-15 capitalize text-secondary">Labor service</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="{{ route('specialist') }}" class="block py-3 px-6 text-15 capitalize text-secondary">agriculter specialist</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="{{ route('event') }}" class="block py-3 px-6 text-15 capitalize text-secondary">Events</a>
                </li>
            </ul>
        </li>
        @foreach ($navigations as $navigation)
        @if(count($navigation->SubCategories)>0)
        <li class="relative group">
            <h2 class="block cursor-pointer py-4 px-3 capitalize">{{$navigation->name}}</h2>
            <ul
                class="absolute top-full left-0 w-60 max-w-80 rounded-md bg-white shadow-sm border border-gray-100/60 rotate-x-90 origin-top transition-all duration-300 group-hover:rotate-x-0 z-50">
                @foreach ($navigation->SubCategories as $subNav)
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="/products/{{ $subNav->slug }}" class="block py-3 px-6 text-15 capitalize text-secondary">{{
                        $subNav->name }}</a>
                </li>
                @endforeach
            </ul>
        </li>
        @else
        <li class="relative">
            <a href="{{ $navigation->slug }}"
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">{{
                $navigation->name }}</a>
        </li>
        @endif
        @endforeach
        {{-- <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">about</a>
        </li>
        <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">team</a>
        </li>
        <li class="relative group">
            <h2 class="block cursor-pointer py-4 px-3 capitalize">solution</h2>
            <ul
                class="absolute top-full left-0 w-60 max-w-80 rounded-md bg-white shadow-sm border border-gray-100/60 rotate-x-90 origin-top transition-all duration-300 group-hover:rotate-x-0 z-50">
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">for
                        farmers</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">for
                        founder</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">sofol</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">agri-input</a>
                </li>
                <li
                    class="border-b border-primary-1/20 last:border-0 transition-all duration-300 hover:bg-primary/10 first:rounded-tl-md first:rounded-tr-md last:rounded-bl-md last:rounded-br-md">
                    <a href="" class="block py-3 px-6 text-15 capitalize text-secondary">IOT &
                        precision farming</a>
                </li>
            </ul>
        </li>
        <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">report</a>
        </li>
        <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">impact</a>
        </li>
        <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">blog</a>
        </li>
        <li class="relative">
            <a href=""
                class="block cursor-pointer py-1 px-3 capitalize before:absolute before:bottom-0 before:left-0 before:content[''] before:w-0 before:py-px before:bg-gradient-to-r before:from-primary-1 before:transition-all before:duration-500 before:hover:w-full">carer</a>
        </li> --}}
    </ul>
</div>
