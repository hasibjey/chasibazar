<x-frontend.auth.app>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="w-80 p-3 border border-gray-100 shadow-md rounded-md">
            <h2 class="text-2xl font-bold capitalize pb-2 border-b border-gray-400 mb-2">Reset password account verefication</h2>
            <div class="mt-5">
                <form action="{{ route('password.account.verification') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="email" class="w-full" name="email" value="{{ $email }}" readonly>
                        @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="text-sm block mb-1">Verification code</label>
                        <div class="grid grid-cols-4 gap-2">
                            <input type="text" class="w-full text-center number code next-code" name="code[]" placeholder="C">
                            <input type="text" class="w-full text-center number code next-code" name="code[]" placeholder="O">
                            <input type="text" class="w-full text-center number code next-code" name="code[]" placeholder="D">
                            <input type="text" class="w-full text-center number code" name="code[]" placeholder="E">
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-green-600 w-full py-1 rounded-sm text-white capitalize font-bold italic hover:bg-green-700">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-slot name="js">
        <script>
            $('.next-code').on('keyup', function() {
                const input = $(this).val();

                if (!isNaN(input) && $.isNumeric(input)) {

                    if ($(this).val().length == 1) {
                        $(this).next('.code').val(null);
                        $(this).next('.code').focus();
                    }

                    return;
                } else {
                    const newInput = input.slice(0, -1);
                    $(this).val(newInput);
                }
            });

            $(".number").keyup(function() {

            });

        </script>
    </x-slot>
</x-frontend.auth.app>
