<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <div x-data="{ activeTab: 'profile' }" class="mt-6">
        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button
                    type="button"
                    @click="activeTab = 'profile'"
                    :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'profile',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400': activeTab !== 'profile'}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Basic Information
                </button>
                <button
                    type="button"
                    @click="activeTab = 'pet'"
                    :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'pet',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400': activeTab !== 'pet'}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Pet Information
                </button>
                <button
                    type="button"
                    @click="activeTab = 'orders'"
                    :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'orders',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400': activeTab !== 'orders'}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Order History
                </button>
                <button
                    type="button"
                    @click="activeTab = 'subscriptions'"
                    :class="{'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'subscriptions',
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400': activeTab !== 'subscriptions'}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Subscriptions
                </button>
            </nav>
        </div>

        <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <!-- Profile Information Tab -->
            <div x-show="activeTab === 'profile'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div class="space-y-4">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                {{ __('Your email address is unverified.') }}

                                <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>

                            @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div>
                        <x-input-label for="phone" :value="__('Phone')" />
                        <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                        <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                    </div>

                    <div>
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" />
                        <x-input-error class="mt-2" :messages="$errors->get('address')" />
                    </div>

                    <div>
                        <x-input-label for="bio" :value="__('Bio')" />
                        <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                    </div>
                </div>
            </div>

            <!-- Pet Information Tab -->
            <div x-show="activeTab === 'pet'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                @php
                $petInfo = json_decode($user->pet_info, true) ?? [];
                @endphp

                <div class="space-y-4">
                    <div>
                        <x-input-label for="pet_name" :value="__('Pet Name')" />
                        <x-text-input id="pet_name" name="pet_info[pet_name]" type="text" class="mt-1 block w-full" :value="old('pet_info.pet_name', $petInfo['pet_name'] ?? '')" />
                    </div>

                    <div>
                        <x-input-label for="age" :value="__('Age')" />
                        <x-text-input id="age" name="pet_info[age]" type="text" class="mt-1 block w-full" :value="old('pet_info.age', $petInfo['age'] ?? '')" />
                    </div>

                    <div>
                        <x-input-label for="breed" :value="__('Breed')" />
                        <x-text-input id="breed" name="pet_info[breed]" type="text" class="mt-1 block w-full" :value="old('pet_info.breed', $petInfo['breed'] ?? '')" />
                    </div>

                    <div>
                        <x-input-label for="weight" :value="__('Weight')" />
                        <x-text-input id="weight" name="pet_info[weight]" type="text" class="mt-1 block w-full" :value="old('pet_info.weight', $petInfo['weight'] ?? '')" />
                    </div>

                    <div>
                        <x-input-label for="medical_history" :value="__('Medical History')" />
                        <textarea id="medical_history" name="pet_info[medicalHistory]" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('pet_info.medicalHistory', $petInfo['medicalHistory'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <x-input-label for="special_requirements" :value="__('Special Requirements')" />
                        <textarea id="special_requirements" name="pet_info[specialRequirements]" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('pet_info.specialRequirements', $petInfo['specialRequirements'] ?? '') }}</textarea>
                    </div>

                    <div>
                        <x-input-label :value="__('Vaccinations')" class="mb-2" />
                        <div class="space-y-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="pet_info[vaccinations][rabies]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('pet_info.vaccinations.rabies', $petInfo['vaccinations']['rabies'] ?? false) ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('Rabies') }}</span>
                            </label>
                            <br>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="pet_info[vaccinations][dhpp]" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('pet_info.vaccinations.dhpp', $petInfo['vaccinations']['dhpp'] ?? false) ? 'checked' : '' }}>
                                <span class="ml-2">{{ __('DHPP') }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order History Tab -->
            <div x-show="activeTab === 'orders'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div x-data="{ orders: [], loading: true }" x-init="
                    fetch('/api/orders', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Authorization': `Bearer ${localStorage.getItem('api_token')}`
                        },
                        credentials: 'include'
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            orders = data.data.orders;
                            loading = false;
                        })
                        .catch(error => {
                            console.error('Error fetching orders:', error);
                            loading = false;
                        })
                ">
                    <div x-show="loading" class="text-center py-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500 mx-auto"></div>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Loading orders...</p>
                    </div>

                    <div x-show="!loading && orders.length === 0" class="text-center py-4">
                        <p class="text-gray-600 dark:text-gray-400">No orders found.</p>
                    </div>

                    <div x-show="!loading && orders.length > 0" class="space-y-4">
                        <template x-for="order in orders" :key="order._id">
                            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="'Order #' + order._id"></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Date: ' + new Date(order.created_at).toLocaleDateString()"></p>
                                    </div>
                                    <span :class="{
                                        'px-2 py-1 text-xs font-semibold rounded-full': true,
                                        'bg-yellow-100 text-yellow-800': order.status === 'pending',
                                        'bg-green-100 text-green-800': order.status === 'delivered',
                                        'bg-blue-100 text-blue-800': order.status === 'processing'
                                    }" x-text="order.status"></span>
                                </div>

                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Order Items:</h4>
                                    <div class="mt-2 space-y-2">
                                        <template x-for="item in order.order_items" :key="item.id || item.product_id">
                                            <div class="flex items-center space-x-4">
                                                <img :src="item.imageUrl || item.image_url" :alt="item.name" class="w-16 h-16 object-cover rounded">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="item.name"></p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Quantity: ' + item.quantity"></p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Price: $' + item.price"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount:</p>
                                        <p class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="'$' + order.total_amount.toFixed(2)"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Subscriptions Tab -->
            <div x-show="activeTab === 'subscriptions'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <div x-data="{ subscriptions: [], loading: true }" x-init="
                    fetch('/api/subscription-boxes', {
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Authorization': `Bearer ${localStorage.getItem('api_token')}`
                        },
                        credentials: 'include'
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            subscriptions = data;
                            loading = false;
                        })
                        .catch(error => {
                            console.error('Error fetching subscriptions:', error);
                            loading = false;
                        })
                ">
                    <div x-show="loading" class="text-center py-4">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-500 mx-auto"></div>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">Loading subscriptions...</p>
                    </div>

                    <div x-show="!loading && subscriptions.length === 0" class="text-center py-4">
                        <p class="text-gray-600 dark:text-gray-400">No active subscriptions found.</p>
                    </div>

                    <div x-show="!loading && subscriptions.length > 0" class="space-y-4">
                        <template x-for="subscription in subscriptions" :key="subscription.id">
                            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="'Subscription #' + subscription.id"></h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Start Date: ' + new Date(subscription.start_date).toLocaleDateString()"></p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Expiry Date: ' + new Date(subscription.expiry_date).toLocaleDateString()"></p>
                                    </div>
                                    <span :class="{
                                        'px-2 py-1 text-xs font-semibold rounded-full': true,
                                        'bg-green-100 text-green-800': subscription.status === 'active',
                                        'bg-red-100 text-red-800': subscription.status === 'expired',
                                        'bg-yellow-100 text-yellow-800': subscription.status === 'pending'
                                    }" x-text="subscription.status"></span>
                                </div>

                                <div class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-gray-100">Subscription Items:</h4>
                                    <div class="mt-2 space-y-2">
                                        <template x-for="item in (typeof subscription.order_items === 'string' ? JSON.parse(subscription.order_items) : subscription.order_items)" :key="item.product_id">
                                            <div class="flex items-center space-x-4">
                                                <img :src="item.image_url" :alt="item.name" class="w-16 h-16 object-cover rounded">
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100" x-text="item.name"></p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400" x-text="item.short_description"></p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Quantity: ' + item.quantity"></p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400" x-text="'Price: $' + item.price"></p>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex justify-between items-center">
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount:</p>
                                        <p class="text-lg font-medium text-gray-900 dark:text-gray-100" x-text="'$' + subscription.total_amount"></p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</section>