@forelse($products as $product)
    <x-product-card :product="$product" />
@empty
    <div class="col-span-full text-center py-8">
        <p class="text-gray-500">No products found</p>
    </div>
@endforelse
