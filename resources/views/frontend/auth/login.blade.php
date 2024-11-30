<x-frontend.auth.app>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">login to your account</h2>


            <div class="mt-5">
                <form action="{{ route('login.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="w-full" placeholder="Enter email address" name="email">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="w-full" placeholder="Enter password" name="password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">login</button>
                    </div>
                </form>

                <p class="text-center mt-5">
                    <a href="{{ route('password.reset') }}" class="text-sm capitalize italic transition-all duration-300 hover:underline">forgot password</a>
                </p>
            </div>
        </div>
    </main>
</x-frontend.auth.app>
