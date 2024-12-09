<x-frontend.layouts.app>
    <x-slot name="title">Login</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md my-10 m-auto">
            <h2 class="text-xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">login to your account</h2>


            <div class="mt-5">
                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text"
                            class="w-full border border-primary-1 outline-none rounded-sm text-xs py-2 px-2 focus:border-primary"
                            placeholder="Enter phone number" name="phone">
                        @error('phone')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password"
                            class="w-full border border-primary-1 outline-none rounded-sm text-xs py-2 px-2 focus:border-primary"
                            placeholder="Enter password" name="password">
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                        <p class="block mt-1 text-end text-xs">
                            <a href="{{ route('password.reset') }}"
                                class="text-sm capitalize italic transition-all duration-300 hover:underline">forgot
                                password</a>
                        </p>
                    </div>
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">login</button>
                    </div>
                </form>

                <p class="text-center mt-5 text-sm">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}"
                        class="text-sm capitalize italic transition-all duration-300 hover:underline">Register now</a>
                </p>
            </div>
        </div>
    </main>
</x-frontend.layouts.app>
