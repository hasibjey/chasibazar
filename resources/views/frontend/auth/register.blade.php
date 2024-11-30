<x-frontend.auth.app>
    <x-slot name="title">Register</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">Register an account</h2>
            <h3 class="text-xs text-justify">Your personal data will be used to support your experience throughout this website, to manage access to your account.</h3>

            <div class="mt-5">
                <form action="{{ route('register.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="w-full" placeholder="Enter full name" name="name">
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
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
                    <div class="mb-3">
                        <input type="password" class="w-full" placeholder="Password confirmation" name="password_confirmation">
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">register</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</x-frontend.auth.app>
