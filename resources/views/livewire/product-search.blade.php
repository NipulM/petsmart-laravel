<div>
    <main class="container mx-auto px-4 py-8 mb-6 max-w-7xl">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Find the Perfect Treats & Supplies <br> <span class="block">for Your Pet!</span></h1>

            <!-- Search Bar -->
            <div class="relative w-[400px]">
                <input
                    wire:model.live="search"
                    wire:click="$set('showDropdown', true)"
                    type="text"
                    placeholder="Search for products..."
                    class="w-full px-4 py-2 rounded border focus:outline-none focus:ring-2 focus:ring-green-500">
                @if($showDropdown && count($searchResults) > 0)
                <div class="absolute z-50 w-full bg-white mt-1 rounded shadow-lg border border-gray-200">
                    @foreach($searchResults as $result)
                    <div
                        wire:click="selectProduct({{ $result->product_id }})"
                        class="p-2 hover:bg-gray-100 cursor-pointer flex items-center gap-2 border-b last:border-b-0">
                        <img src="{{ $result->image_url }}" alt="{{ $result->name }}" class="w-10 h-10 object-cover rounded">
                        <div>
                            <div class="font-semibold">{{ $result->name }}</div>
                            <div class="text-sm text-gray-600">${{ number_format($result->price, 2) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="flex gap-8">
            <!-- Sidebar -->
            <div class="w-[300px] flex-shrink-0">
                <div class="mb-6">
                    <h2 class="font-semibold mb-2">Select Category</h2>
                    <select wire:model="category" class="w-full p-2 border rounded bg-white">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->category_id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <h2 class="font-semibold mb-2">Filter by Price</h2>
                    <select wire:model="priceRange" class="w-full p-2 border rounded bg-white">
                        <option value="">All Prices</option>
                        <option value="0-9.99">$0 - $9.99</option>
                        <option value="9.99-19.99">$9.99 - $19.99</option>
                        <option value="19.99-49.99">$19.99 - $49.99</option>
                        <option value="49.99-99.99">$49.99 - $99.99</option>
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <button wire:click="applyFilters" class="w-full bg-green-500 text-white rounded py-2 px-4 hover:bg-green-600 transition">
                        Apply Filters
                    </button>
                    <button wire:click="clearFilters" class="w-full bg-gray-100 text-gray-700 rounded py-2 px-4 hover:bg-gray-200 transition">
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">All Items ({{ $products->total() }})</h2>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    @foreach($products as $product)
                    <a href="{{ route('products.show', $product->product_id) }}" class="block">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-semibold mb-2">{{ $product->name }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ $product->short_description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-green-600 font-bold">${{ number_format($product->price, 2) }}</span>
                                    <span class="bg-green-500 text-white px-4 py-2 rounded">
                                        View Details
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>

    @if($showDropdown)
    <div wire:click="closeDropdown" class="fixed inset-0 z-40"></div>
    @endif
</div>