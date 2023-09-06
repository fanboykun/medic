<?php

namespace App\Livewire\Medicine;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;

class AddMedicine extends Component
{
    public $categories;
    public $units;
    public $suppliers;

    public $name;
    public $stock;
    public $storage;
    public $expired;
    public $description;
    public $purchase_price;
    public $selling_price;

    public $unit_id;
    public $category_id;
    public $supplier_id;

    public function render()
    {
        $this->categories = Category::all();
        $this->units = Unit::all();
        $this->suppliers = Supplier::all();


        return view('livewire.medicine.add-medicine');
    }

    public function saveMedicine()
    {
       $this->validate([
            'name' => 'required|string|max:250',
            'stock' => 'required|integer|min_digits:1|max_digits:1000000',
            'storage' => 'nullable|string|max:250',
            'expired' => 'required|date_format:Y-m-d|max:250',
            'description' => 'nullable|string|max:250',
            'purchase_price' => 'required|integer|min_digits:2|max_digits:250',
            'selling_price' => 'required|integer|min_digits:2|max_digits:250',
            'unit_id' => 'required|integer|exists:App\Models\Unit,id',
            'category_id' => 'required|integer|exists:App\Models\Category,id',
            'supplier_id' => 'required|integer|exists:App\Models\Supplier,id',
        ]);

        try{
            DB::transaction(function () {
                Medicine::create([
                    'name' => $this->name,
                    'stock' => $this->stock,
                    'storage' => $this->storage,
                    'expired' => $this->expired,
                    'description' => $this->description,
                    'purchase_price' => $this->purchase_price,
                    'selling_price' => $this->selling_price,
                    'unit_id' => $this->unit_id,
                    'category_id' => $this->category_id,
                    'supplier_id' => $this->supplier_id,
                ]);
            });

        }catch(\Exception $e){
            throw($e);
        }

        return redirect()->route('medicines.index');

    }

    public function clearForm()
    {
        $this->reset('name', 'stock', 'storage', 'expired', 'description', 'purchase_price', 'selling_price', 'unit_id', 'category_id', 'supplier_id');
    }
}
