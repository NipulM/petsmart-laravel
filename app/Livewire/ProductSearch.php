<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $priceRange = '';
    public $categories;
    public $searchResults = [];
    public $showDropdown = false;
    public $appliedFilters = [
        'category' => '',
        'priceRange' => ''
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatedSearch()
    {
        $this->showDropdown = strlen($this->search) > 0;
        if (strlen($this->search) > 0) {
            $this->searchResults = Product::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('short_description', 'like', '%' . $this->search . '%')
                ->limit(5)
                ->get();
        } else {
            $this->searchResults = [];
        }
    }

    public function selectProduct($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $this->search = $product->name;
        }
        $this->showDropdown = false;
        $this->resetPage();
    }

    public function applyFilters()
    {
        $this->appliedFilters['category'] = $this->category;
        $this->appliedFilters['priceRange'] = $this->priceRange;
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['category', 'priceRange', 'search', 'appliedFilters']);
        $this->resetPage();
    }

    public function closeDropdown()
    {
        $this->showDropdown = false;
    }

    public function render()
    {
        $query = Product::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('short_description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->appliedFilters['category'], function ($query) {
                $query->where('category_id', $this->appliedFilters['category']);
            })
            ->when($this->appliedFilters['priceRange'], function ($query) {
                [$min, $max] = explode('-', $this->appliedFilters['priceRange']);
                $query->whereBetween('price', [$min, $max]);
            });

        $products = $query->paginate(8);

        return view('livewire.product-search', [
            'products' => $products
        ]);
    }
}
