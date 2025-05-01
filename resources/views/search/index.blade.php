<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search') }}
        </h2>
    </x-slot>
    <main class="container mx-auto px-4 py-8 mb-6 max-w-7xl">
        <h1 class="text-3xl font-bold mb-8">Find the Perfect Treats & Supplies <br> <span class="block">for Your Pet!</span></h1>
        <div class="flex gap-8">
            <!-- Sidebar -->
            <div class="w-[400px] flex-shrink-0">
                <form id="filter-form" action="{{ route('search.filter') }}" method="GET">
                    <div class="mb-6">
                        <h2 class="font-semibold mb-2">Select Category</h2>
                        <select name="category" id="category-select" class="w-full p-2 border rounded bg-white">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ request('category') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <h2 class="font-semibold mb-2">Filter by Price</h2>
                        <select name="price_range" id="price-select" class="w-full p-2 border rounded bg-white">
                            <option value="">All Prices</option>
                            <option value="0-9.99" {{ request('price_range') == '0-9.99' ? 'selected' : '' }}>$0 - $9.99</option>
                            <option value="9.99-19.99" {{ request('price_range') == '9.99-19.99' ? 'selected' : '' }}>$9.99 - $19.00</option>
                            <option value="19.99-49.99" {{ request('price_range') == '19.99-49.99' ? 'selected' : '' }}>$19.99 - $49.00</option>
                            <option value="49.99-99.99" {{ request('price_range') == '49.99-99.99' ? 'selected' : '' }}>$49.99 - $99.00</option>
                        </select>
                    </div>

                    <div class="flex justify-between items-center mb-2">
                        <button type="submit" class="bg-green-500 text-white rounded py-2 px-4 w-1/2 mr-2">Apply Filters</button>
                        <a href="{{ route('search') }}" class="bg-green-500 text-white rounded py-2 px-4 w-1/2 text-center">Clear Filters</a>
                    </div>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="flex-1">
                <div id="results-title">
                    <h2 class="text-xl font-semibold mb-6">All Items ({{ count($products) }})</h2>
                </div>
                <div id="filtered-products" class="grid grid-cols-2 gap-6">
                    @include('search.product-grid')
                </div>
            </div>
        </div>
    </main>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('filter-form');
            const productsGrid = document.getElementById('filtered-products');
            const resultsTitle = document.getElementById('results-title');

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(form);
                const queryString = new URLSearchParams(formData).toString();

                fetch(`${form.action}?${queryString}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        productsGrid.innerHTML = html;
                        const productCount = productsGrid.querySelectorAll('.bg-white').length;
                        resultsTitle.innerHTML = `<h2 class="text-xl font-semibold mb-6">Filtered Items (${productCount})</h2>`;
                    });
            });
        });
    </script>
    @endpush
</x-app-layout>