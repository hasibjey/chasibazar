<x-frontend.layouts.app>
    <x-slot name="title">Labor booking</x-slot>

    <main>
        @include('components.frontend.layouts.header_2')

        <!-- Hero section -->
        <section class="relative">
            <img src="{{ asset($item->hero_image) }}" alt="{{ $item->title }}">
            <h2 class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-6xl font-bold text-white drop-shadow-lg uppercase">{{ $item->title }}</h2>
        </section>

        <!-- labor booking -->
        <section class="">
            <div class="container py-10 relative">
                <div class="w-96 min-h-40 border border-primary rounded-md m-auto">
                    <h3 class="text-center py-2 mb-3">
                        <span class="border-b-2 border-primary px-2 text-lg capitalize font-semibold italic">Labor booking</span>
                    </h3>
                    <div class="px-3 py-3">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Booking Date</label>
                                <input type="date" class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Working Shift</label>
                                <select class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100">
                                    <option value="day">Day</option>
                                    <option value="night">Night</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Labor Type</label>
                                <select class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100">
                                    <option>Select labor type</option>
                                                <option value="domestic_helper">Domestic helper</option>
                                                <option value="household_assistant">Household assistant</option>
                                                <option value="multi_task_labourer">Multi task labourer</option>
                                                <option value="helping_hand">Helping hand</option>
                                                <option value="household_friend">Household friend</option>
                                                <option value="care_companion">Care companion</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Labor Quantity</label>
                                <input type="text" class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100">
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Labor cost</label>
                                <input type="text" class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="block text-sm pb-0.5 font-semibold italic">Labor total cost</label>
                                <input type="text" class="w-full border border-secondary rounded-sm p-2 text-sm outline-none transition-all duration-300 focus:border-primary focus:shadow focus:shadow-green-100" disabled>
                            </div>
                            <div class="mt-7 text-center">
                                <button class="bg-primary py-1 px-6 capitalize text-white rounded-sm transition-all duration-300 hover:bg-green-800">booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </main>
</x-frontend.layouts.app>
