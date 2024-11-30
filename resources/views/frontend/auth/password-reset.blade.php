<x-frontend.auth.app>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">forgot password</h2>
            <h3 class="text-xs text-justify">Lost your password? Please enter your email address. You will receive a code to create a new password via email.</h3>


            <div class="mt-5">
                <form action="{{ route('password.reset.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="w-full" name="email" placeholder="Email address">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">Send OTP</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-frontend.auth.app>
