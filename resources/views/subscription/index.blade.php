<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscriptions') }}
        </h2>
    </x-slot>

    <main>
        <section class="bg-[#F8F8F8] py-1">
            <div class="container mx-auto flex items-center -my-20">
                <div class="w-1/2">
                    <img src="{{ asset('images/subscriptionpage-hero.png') }}" alt="Pet Essentials" class="w-9/10 mx-auto -ml-10">
                </div>
                <div class="w-1/2">
                    <h1 class="text-4xl font-bold mb-4">
                        Subscribe to Simplify <br>
                        <span class="block">Your Pet Care!</span>
                    </h1>
                    <p class="text-gray-600 mb-8">
                        Say goodbye to the stress of last-minute shopping for your pet's needs. With PetSmart's subscription plans, you'll enjoy seamless, regular deliveries tailored to your pet's lifestyle—ensuring happiness, health, and convenience every step of the way.
                    </p>
                    <a href="#plans" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded">Choose a Plan</a>
                </div>
            </div>
        </section>

        <section id="plans" class="py-16 bg-[#F8F8F8] -mt-7">
            <div class="container mx-auto px-4">
                <div class="flex justify-center gap-8">
                    <!-- Basic Plan Card -->
                    <div class="w-96 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                        <div class="m-5">
                            <img src="{{ asset('images/basic-box.webp') }}" alt="Basic Plan" class="w-full h-64 rounded-2xl object-cover">
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <!-- Content Container -->
                            <div class="flex-grow">
                                <h2 class="text-2xl font-bold text-center mb-4">Basic</h2>
                                <p class="text-gray-600 text-center mb-8 h-24">
                                    Enjoy hassle-free pet care with a 3-month subscription. Customize your supplies and receive regular deliveries to your door.
                                </p>

                                <div class="space-y-4 mb-8">
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">Flexible supply updates anytime.</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">Monthly toy replacement to keep your pet entertained.</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">Perfect for pet parents seeking convenience and reliability.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Price and Button Container -->
                            <div class="mt-auto">
                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold mb-2">$19.99</div>
                                    <p class="text-gray-600 text-sm">3 months of hassle-free pet care!</p>
                                </div>

                                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                    Subscribe to Basic
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Premium Plan Card -->
                    <div class="w-96 bg-white rounded-lg shadow-lg overflow-hidden flex flex-col">
                        <div class="m-5">
                            <img src="{{ asset('images/premium-box.png') }}" alt="Premium Plan" class="w-full h-64 rounded-2xl object-cover">
                        </div>
                        <div class="p-8 flex flex-col flex-grow">
                            <!-- Content Container -->
                            <div class="flex-grow">
                                <h2 class="text-2xl font-bold text-center mb-4">Premium</h2>
                                <p class="text-gray-600 text-center mb-8 h-24">
                                    Simplify your pet care for an entire year with our Premium Plan. Fully managed supplies and monthly surprises!
                                </p>

                                <div class="space-y-4 mb-8">
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">All benefits of the Basic Plan.</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">Exclusive premium items included.</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                        <svg class="w-5 h-5 mt-1 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        <p class="text-gray-700">Exclusive discounts on pet essentials and add-ons.</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Price and Button Container -->
                            <div class="mt-auto">
                                <div class="text-center mb-6">
                                    <div class="text-4xl font-bold mb-2">$49.99</div>
                                    <p class="text-gray-600 text-sm">1 year of premium pet care!</p>
                                </div>

                                <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-colors">
                                    Subscribe to Premium
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
</x-app-layout>