<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image -->
                <div class="md:w-1/2 py-10">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-auto object-cover max-h-[500px]">
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

                    <div class="mb-6">
                        <span class="text-2xl font-bold text-green-500">${{ number_format($product->price, 2) }}</span>

                        @if($product->stock_quantity > 0)
                        <span class="ml-4 text-sm bg-green-100 text-green-800 px-2 py-1 rounded">In Stock ({{ $product->stock_quantity }})</span>
                        @else
                        <span class="ml-4 text-sm bg-red-100 text-red-800 px-2 py-1 rounded">Out of Stock</span>
                        @endif
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Description</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Category</h3>
                        <p class="text-gray-600">{{ $product->category ? $product->category->name : 'Uncategorized' }}</p>
                    </div>

                    @if($product->stock_quantity > 0)
                    <button
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded w-full md:w-auto add-to-cart-btn"
                        data-product-id="{{ $product->product_id }}"
                        data-price="{{ $product->price }}"
                        data-name="{{ $product->name }}"
                        data-image-url="{{ $product->image_url }}"
                        data-stock="{{ $product->stock_quantity }}"
                        data-category="{{ $product->category ? $product->category->name : '' }}">
                        Add to Cart
                    </button>
                    @else
                    <button disabled class="bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded w-full md:w-auto cursor-not-allowed">
                        Out of Stock
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>