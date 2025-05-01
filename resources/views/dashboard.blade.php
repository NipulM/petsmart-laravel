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
                <!-- New Products Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                    @forelse($newProducts as $product)
                    <div
                        class="bg-white shadow-md rounded-lg overflow-hidden flex-shrink-0 cursor-pointer hover:shadow-lg transition-shadow"
                        data-url="{{ route('products.show', $product->product_id) }}">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ $product->short_description ?? $product->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-green-500 font-bold">${{ number_format($product->price, 2) }}</span>
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded"
                                    onclick="event.stopPropagation(); handleCartClick(this)"
                                    data-id="{{ $product->id }}"
                                    data-price="{{ $product->price }}"
                                    data-name="{{ $product->name }}"
                                    data-image="{{ $product->image_url }}"
                                    data-stock="{{ $product->stock_quantity }}"
                                    data-category="{{ $product->category }}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-3 text-center py-10">
                        <p class="text-gray-500">No new products available at the moment.</p>
                    </div>
                    @endforelse
                </div>

            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('[data-url]');
            productCards.forEach(card => {
                card.addEventListener('click', function() {
                    window.location.href = this.dataset.url;
                });
            });
        });
    </script>
</x-app-layout>