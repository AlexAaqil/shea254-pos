<?php

namespace App\Livewire\Pages\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;

class Index extends Component
{
    public function render()
    {
        $count_users = User::where('user_level', '>=', '1')->count();
        $count_admins = User::where('user_level', '<=', '1')->count();

        $count_products = Product::count();
        $count_product_categories = ProductCategory::count();

        return view('livewire.pages.dashboard.index', compact(
            'count_admins',
            'count_users',

            'count_products',
            'count_product_categories',
        ));
    }
}
