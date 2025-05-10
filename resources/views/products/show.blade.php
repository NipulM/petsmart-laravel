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
                    <div class="flex items-center gap-4 mb-4">
                        <div class="flex items-center border rounded">
                            <button type="button" class="px-3 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 quantity-decrease">-</button>
                            <input type="number" id="quantity-input" class="w-16 px-3 py-3 text-center border-0 focus:ring-0 focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" value="1" min="1"
                                data-max-stock="{{ $product->stock_quantity }}" style="-webkit-appearance: none;">
                            <button type="button" class="px-3 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 quantity-increase">+</button>
                        </div>
                        <button
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded flex-1 add-to-cart-btn"
                            data-product-id="{{ $product->product_id }}"
                            data-price="{{ $product->price }}"
                            data-name="{{ $product->name }}"
                            data-image="{{ $product->image_url }}"
                            data-stock="{{ $product->stock_quantity }}"
                            data-category="{{ $product->category ? $product->category->name : '' }}">
                            Add to Cart
                        </button>
                    </div>
                    @else
                    <button disabled class="bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded w-full md:w-auto cursor-not-allowed">
                        Out of Stockkk
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity-input');
            const maxStock = parseInt(quantityInput.dataset.maxStock);

            document.querySelector('.quantity-decrease').addEventListener('click', function() {
                decrementQuantity();
            });

            document.querySelector('.quantity-increase').addEventListener('click', function() {
                incrementQuantity(maxStock);
            });

            quantityInput.addEventListener('change', function() {
                validateQuantity(maxStock);
            });

            quantityInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            document.querySelector('.add-to-cart-btn').addEventListener('click', function() {
                const btn = this;
                addToCartWithQuantity(
                    parseInt(btn.dataset.productId),
                    parseFloat(btn.dataset.price),
                    btn.dataset.name,
                    btn.dataset.image,
                    parseInt(btn.dataset.stock),
                    btn.dataset.category
                );
            });
        });
    </script>
</x-app-layout>