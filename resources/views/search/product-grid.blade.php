@foreach($products as $product)
<div class="bg-white p-4 cursor-pointer hover:shadow-lg transition-shadow rounded shadow"
    onclick="window.location.href='/products/{{ $product->product_id }}'">
    <div class="h-48 w-full flex items-center justify-center overflow-hidden mb-4">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="object-contain h-full" />
    </div>
    <div class="mb-4">
        <h3 class="text-xl font-semibold mb-2">{{ $product->name }}</h3>
        <p class="text-gray-600">{{ $product->short_description }}</p>
    </div>
    <div class="flex justify-between items-center">
        <span class="text-lg font-semibold">${{ $product->price }}</span>
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
            Add to Cart
        </button>
    </div>
</div>
@endforeach