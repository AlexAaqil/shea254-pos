<?php

namespace App\Livewire\Pages\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;

class Index extends Component
{
    use WithPagination;

    public $confirm_product_deletion = false;
    public $product_to_delete = null;
    public ?int $delete_product_id = null;

    protected $listeners = [
        'confirm-product-deletion' => 'confirmProductDeletion',
    ];

    public function confirmProductDeletion($data)
    {
        $this->delete_product_id = $data['product_id'];
        $this->dispatch('open-modal', 'confirm-product-deletion');
    }

    public function deleteproduct()
    {
        if($this->delete_product_id) {
            $product = product::findOrFail($this->delete_product_id);
            if($product) {
                $product->delete();

                $this->delete_product_id = null;
                $this->dispatch('close-modal', 'confirm-product-deletion');
                $this->dispatch('notify', type: 'success', message: 'product is deleted');
            }
        }
    }

    public function render()
    {
        $products = Product::with('product_category', 'getProductImages')->orderBy('product_order', 'asc')->orderBy('title', 'asc')->paginate(50);
        $count_products = Product::count();

        return view('livewire.pages.products.index', compact('products', 'count_products'));
    }
}
