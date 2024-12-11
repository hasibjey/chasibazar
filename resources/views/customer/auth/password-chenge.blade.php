<x-frontend.auth.app>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">enter new password</h2>


            <div class="mt-5">
                <form action="{{ route('new.password.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="w-full border border-primary-1 outline-none rounded-sm text-xs py-2 px-2 focus:border-primary" name="phone" value="{{ $phone }}" readonly>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="w-full" name="password" placeholder="Password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="w-full" name="password_confirmation" placeholder="password confirmation">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">Change password</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-frontend.auth.app>
