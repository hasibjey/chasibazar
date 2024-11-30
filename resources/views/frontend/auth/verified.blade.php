<x-frontend.auth.app>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">Send verification code</h2>
            <h3 class="text-xs text-justify">Please check your email for verification code.</h3>


            <div class="mt-5">
                <form action="{{ route('verify.otp.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="w-full" name="email" value="{{ Auth::guard('web')->user()->email }}" readonly>
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
