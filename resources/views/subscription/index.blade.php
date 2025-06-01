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

                                <button onclick="showSubscriptionPopup('Basic')" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-colors text-center">
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
                                <button onclick="showSubscriptionPopup('Premium')" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg transition-colors text-center">
                                    Subscribe to Premium
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Popup Notification -->
    <div id="subscriptionPopup" class="fixed bottom-4 right-4 bg-white border border-gray-200 rounded-lg shadow-xl p-6 max-w-80 z-50 hidden">
        <div class="flex items-start gap-3">
            <!-- Info Icon -->
            <div class="flex-shrink-0">
                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <!-- Content -->
            <div class="flex-1">
                <h4 class="font-semibold text-gray-900 mb-1">Subscription Request</h4>
                <p class="text-gray-600 text-sm mb-3" id="popupMessage">
                    To subscribe to the <span id="planName"></span> plan, please contact our support team who will assist you with placing your subscription box.
                </p>
                <div class="flex gap-2">
                    <a href="mailto:support@petsmart.lk" class="text-xs bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition-colors">
                        Contact Support
                    </a>
                    <button onclick="hideSubscriptionPopup()" class="text-xs text-gray-500 hover:text-gray-700 px-2 py-1">
                        Close
                    </button>
                </div>
            </div>
            <!-- Close Button -->
            <button onclick="hideSubscriptionPopup()" class="flex-shrink-0 text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    @push('styles')
    <style>
        /* Custom animation for popup */
        @keyframes slideInUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutDown {
            from {
                transform: translateY(0);
                opacity: 1;
            }

            to {
                transform: translateY(100%);
                opacity: 0;
            }
        }

        .popup-enter {
            animation: slideInUp 0.3s ease-out forwards;
        }

        .popup-exit {
            animation: slideOutDown 0.3s ease-in forwards;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function showSubscriptionPopup(planType) {
            const popup = document.getElementById('subscriptionPopup');
            const planName = document.getElementById('planName');

            planName.textContent = planType;
            popup.classList.remove('hidden', 'popup-exit');
            popup.classList.add('popup-enter');

            // Auto-hide after 8 seconds
            setTimeout(() => {
                hideSubscriptionPopup();
            }, 8000);
        }

        function hideSubscriptionPopup() {
            const popup = document.getElementById('subscriptionPopup');
            popup.classList.remove('popup-enter');
            popup.classList.add('popup-exit');

            // Hide completely after animation
            setTimeout(() => {
                popup.classList.add('hidden');
                popup.classList.remove('popup-exit');
            }, 300);
        }

        // Close popup when clicking outside
        document.addEventListener('click', function(event) {
            const popup = document.getElementById('subscriptionPopup');
            if (!popup.contains(event.target) && !popup.classList.contains('hidden')) {
                // Check if click was on a subscribe button
                const isSubscribeButton = event.target.closest('button[onclick*="showSubscriptionPopup"]');
                if (!isSubscribeButton) {
                    hideSubscriptionPopup();
                }
            }
        });
    </script>
    @endpush
</x-app-layout>