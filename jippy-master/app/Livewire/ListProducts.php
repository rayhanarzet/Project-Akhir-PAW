<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ListProducts extends Component
{
    public $selectedCategory = null;
    public $search = '';

    // Auto select category kalau URL pakai ?category=
    public function mount()
    {
        if (request()->has('category')) {
            $this->selectedCategory = request()->category;
        }
    }

    public function selectCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function clearFilter()
    {
        $this->selectedCategory = null;
    }

    public function render()
    {
        $query = Product::with('category');

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.list-products', [
            'products' => $query->get(),
            'categories' => Category::withCount('products')->get(),
        ]);
    }
}
