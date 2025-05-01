<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <section class="bg-[#F8F8F8] py-20">
            <div class="container mx-auto flex items-center">
                <div class="w-1/2">
                    <h1 class="text-4xl font-bold mb-4">
                        Your One-Stop Shop for <br>
                        <span class="block">Pet Essentials</span>
                    </h1>
                    <p class="text-gray-600 mb-8">
                        Find everything your pet loves in one place—delivered to your door. From premium food to stylish toys and accessories, PetSmart brings convenience and quality together for your furry friends.
                    </p>
                    <a href="#" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded">Browse Now</a>
                </div>
                <div class="w-1/2">
                    <img src="{{ asset('images/homepage-hero.png') }}" alt="Pet Essentials" class="w-4/5 mx-auto mr-1">
                </div>
            </div>
        </section>

        <section class="py-16">
            <div class="container mx-auto">
                <h2 class="text-3xl font-bold mb-8">New Arrivals for Your Beloved Pets</h2>
                <p class="text-gray-600 mb-8 -mt-5">
                    Check out the latest additions to our collection! From delicious treats to fun toys, these fresh picks are here to delight your pets and make life easier for you.
                </p>
            </div>
        </section>
    </div>
</x-app-layout>