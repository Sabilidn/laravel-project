<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products = [];
    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $editingProductId = null;
    public $showForm = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ];

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Product::all();
    }

    public function create()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        $this->resetForm();
        $this->loadProducts();
        session()->flash('message', 'Product created successfully!');
    }

    public function edit($productId)
    {
        $product = Product::findOrFail($productId);
        $this->editingProductId = $productId;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->showForm = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->editingProductId);
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        $this->resetForm();
        $this->loadProducts();
        session()->flash('message', 'Product updated successfully!');
    }

    public function delete($productId)
    {
        Product::findOrFail($productId)->delete();
        $this->loadProducts();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->editingProductId = null;
        $this->showForm = false;
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        if (!$this->showForm) {
            $this->resetForm();
        }
    }

    public function render()
    {
        return view('livewire.products');
    }
}
