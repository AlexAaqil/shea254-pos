<div class="Products">
    <div class="container">
        <div class="header">
            <div class="info">
                <h2>Products</h2>
                <div class="stats">
                    <span>{{ $count_products }} {{ Str::plural('product', $count_products) }}</span>
                </div>
            </div>

            <div class="search">
                <input type="text" placeholder="Search...">
                <button>Search</button>
            </div>

            <div class="button">
                <!-- <a href="{{ Route::has('products.create') ? route('products.create') : '#' }}" wire:navigate class="btn">Create Product</a> -->
            </div>
        </div>

        <div class="products">
            @forelse ($products as $product)
                <div class="product" wire:key="product-{{ $product->id }}">
                    <div class="image">
                        <img src="{{ $product->getFirstImage() }}" alt="{{ $product->title }}" class="rounded-lg" />
                    </div>

                    <div class="content">
                        <div class="info">
                            <h3 class="names">{{ $product->title }}</h3>
                            <p class="">{{ $product->price }}</p>
                            <!-- <p class="phone_number">{{ $product->phone_number ?? '-' }}</p> -->
                        </div>
                        <div class="actions">
                            <div class="crud">
                                <a href="{{ Route::has('products.edit') ? route('products.edit', ['uuid' => $product->id]) : '#' }}" wire:navigate>
                                    <x-svgs.edit class="w-4 h-4 mr-1 text-green-600" />
                                </a>
                                <button x-data="" x-on:click.prevent="$wire.set('delete_product_id', {{ $product->id }}); $dispatch('open-modal', 'confirm-product-deletion')" class="btn_transparent" >
                                    <x-svgs.trash class="w-4 h-4 text-red-600" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>

        <div class="pagination_links">
            {{ $products->links() }}
        </div>
    </div>

    <x-modal name="confirm-product-deletion" :show="$delete_product_id !== null" focusable>
        <div class="custom_form">
            <form wire:submit="deleteproduct" @submit="$dispatch('close-modal', 'confirm-product-deletion')" class="p-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Confirm Deletion
                </h2>

                <p class="mt-2 mb-4 text-sm text-gray-600">
                    Are you sure you want to permanently delete this product?
                </p>

                <div class="buttons_group">
                    <button type="submit" class="btn_danger">
                        Delete product
                    </button>

                    <button type="button" class="mr-2" x-on:click="$dispatch('close-modal', 'confirm-product-deletion')">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</div>
