<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <main class="max-w-7xl mx-auto px-4 py-8 mb-6">
        <!-- Welcome Section -->
        <h1 class="text-4xl font-bold text-center mb-12">Welcome to PetSmart!</h1>

        <!-- About Us Section -->
        <div class="flex items-center justify-between mb-20">
            <div class="w-1/2 pr-12">
                <h2 class="text-2xl font-bold mb-4">About us</h2>
                <p class="text-gray-700">At PetSmart, we believe in making the world a better place—one paw at a time. As pet lovers ourselves, we understand the joy and responsibility of caring for your furry, feathery, or scaly companions. That's why we created an e-commerce platform dedicated to providing high-quality, eco-friendly, and sustainable pet products that both you and your pets will love.</p>
            </div>
            <div class="w-2/2">
                <img src="{{ asset('images/aboutpage-dog.png') }}" alt="Happy dog with toys" class="clip-path-blob1 w-full">
            </div>
        </div>

        <!-- Mission Section -->
        <div class="flex items-center justify-between mb-20">
            <div class="w-2/2">
                <img src="{{ asset('images/aboutpage-owner-with-dog.png') }}" alt="Pet owner with dog" class="clip-path-blob2 w-full">
            </div>
            <div class="w-1/2 pl-12">
                <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
                <p class="mb-4">Our mission is simple:</p>
                <ul class="list-disc pl-6 space-y-2">
                    <li>To provide pet owners with sustainable and ethical choices.</li>
                    <li>To support a healthier planet by reducing waste and promoting environmentally friendly practices.</li>
                    <li>To ensure every pet gets the care, comfort, and love they deserve.</li>
                </ul>
            </div>
        </div>

        <!-- Why Choose Us Section -->
        <div class="flex items-center justify-center mb-20">
            <div class="w-[700px]">
                <h2 class="text-2xl font-bold mb-6">Why Choose Us?</h2>
                <p class="mb-4">We know you have options when it comes to shopping for your pets, but here's what sets us apart:</p>
                <div class="space-y-4">
                    <p><span class="font-bold">1. Eco-Friendly Products:</span> From non-toxic toys to biodegradable pet care essentials, we prioritise sustainability in everything we offer.</p>
                    <p><span class="font-bold">2. Convenience at Your Fingertips:</span> No more rushing to the store—shop from the comfort of your home and have everything delivered right to your door.</p>
                    <p><span class="font-bold">3. Tailored Monthly Subscriptions:</span> Our Monthly Box is customised to suit your pet's unique needs, bringing joy and surprises every month.</p>
                    <p><span class="font-bold">4. Educational Resources:</span> Stay informed with our blogs and videos on pet care, sustainable living, and DIY tips to make your pet's life even better.</p>
                </div>
            </div>
        </div>

        <!-- Blog Section -->
        <p class="mb-8">Looking for tips on pet grooming, training, or sustainable living? <a href="#blogs" class="text-blue-600 hover:underline">Check out our blog</a>, where we share weekly articles and videos to help you care for your pets with love and knowledge.</p>

        <p class="-mt-5 mb-12">Thank you for being part of the PetSmart community—where happy pets meet a healthier planet! ❤️</p>

        <!-- Care & Comfort Section -->
        <h2 id="blogs" class="text-2xl font-bold mb-7">Care & Comfort Corner</h2>
        <div id="blog-container" class="bg-white rounded-lg shadow-lg overflow-hidden">
        </div>
    </main>

</x-app-layout>