<?php

namespace App\Livewire\Purchase;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddPurchase extends Component
{
    // purchases data to be searched and selected
    public $purchases;

    // medicines data to be searched and selected
    public $medicines;

    // model purchase that will be filled after purchase created
    public $purchase;

    // model medicine that being selected
    public $selectedMedicine;

    // column model for purchase data
    public $purchase_date;
    public $total_purchase;
    public $invoice;
    public $total_medicine;
    public $total_quantity;

    // data for select input
    public $categories;
    public $units;
    public $suppliers;

    // column model for medicine data
    public $name;
    public $stock;
    public $storage;
    public $expired;
    public $description;
    public $purchase_price;
    public $selling_price;

    // column model for purchase data
    public $unit_id = '';
    public $category_id = '';
    public $supplier_id = '';

    // column model for creating new unit data
    public $unitName;

    // column model for creating new category data
    public $categoryName;
    public $categoryDescription;

    // column model for creating new supplier data
    public $supplierName;
    public $supplierAddress;
    public $supplierPhone;

    public function render() : View
    {
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
        $this->suppliers = Supplier::latest()->get();
        $this->purchases = Purchase::with('supplier')->latest()->get();
        $this->medicines = Medicine::with('supplier')->latest()->get();

        return view('livewire.purchase.add-purchase');
    }

    public function setPurchase() : void
    {
        $this->validate([
            'purchase_date' => 'required|date_format:Y-m-d',
            'supplier_id' => 'required|integer|exists:App\Models\Supplier,id',
        ]);
        $this->validateMedicine();
        $new_purchase = Purchase::firstOrNew(
            ['id' => $this->purchase?->id],
            [ 'invoice' => $this->invoice ?? Str::random(7), 'supplier_id' => $this->supplier_id, 'purchase_date' => $this->purchase_date, 'total_purchase' => $this->total_purchase]
        );
        dd($new_purchase);
    }

    private function validateMedicine() : void
    {
        $this->validate([
            'name' => 'required|string|max:250',
            'stock' => 'required|integer|min:1|max:9999|min_digits:1|max_digits:4',
            'storage' => 'nullable|string|max:250',
            'expired' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string|max:250',
            'purchase_price' => 'required|integer|min_digits:2|max_digits:8',
            'selling_price' => 'required|integer|min_digits:2|max_digits:8',
            'unit_id' => 'required|integer|exists:App\Models\Unit,id',
            'category_id' => 'required|integer|exists:App\Models\Category,id',
        ]);
    }

    public function selectPurchase( Purchase $purchase ) : void
    {
        $this->purchase = $purchase->load('medicines');
    }

    public function selectMedicine( Medicine $medicine ) : void
    {
        $this->selectedMedicine = $medicine;
    }

    public function saveMedicine()
    {
        try{
            DB::transaction(function () {
                Medicine::create([
                    'name' => $this->name,
                    'stock' => (int) $this->stock,
                    'storage' => $this->storage,
                    'expired' => $this->expired,
                    'description' => $this->description,
                    'purchase_price' => $this->purchase_price,
                    'selling_price' => $this->selling_price,
                    'unit_id' => (int) $this->unit_id,
                    'category_id' => (int) $this->category_id,
                    'supplier_id' => (int) $this->supplier_id,
                ]);
            });

        }catch(\Exception $e){
            throw($e);
        }
        // $this->dispatch('notify', ['status' => 'success', 'message' => 'Medicine Has Been Created!']);
        // return redirect()->route('medicines.index');

    }

    public function clearForm() : void
    {
        $this->reset('name', 'stock', 'storage', 'expired', 'description', 'purchase_price', 'selling_price', 'unit_id', 'category_id', 'supplier_id');
    }

    public function saveUnit() :void
    {
        $this->validate(['unitName' => 'required|string|min:2|max:100']);
        Unit::create(
            ['name' => $this->unitName]
        );
        $this->reset('unitName');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Created!']);
    }

    public function saveCategory() :void
    {
        $this->validate([
            'categoryName' => 'required|string|min:2|max:100',
            'categoryDescription' => 'required|string|min:2|max:100']);
        Category::create(
            ['name' => $this->categoryName,
            'description' => $this->categoryDescription]
        );
        $this->reset('categoryName', 'categoryDescription' );
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Created!']);
    }

    public function saveSupplier() :void
    {
        $this->validate([
            'supplierName' => 'required|string|min:2|max:100',
            'supplierAddress' => 'required|string|min:2|max:100',
            'supplierPhone' => 'required|string|min_digits:10|max_digits:14']);
        Supplier::create(
            ['name' => $this->supplierName,
            'address' => $this->supplierAddress,
            'phone' => $this->supplierPhone]
        );
        $this->reset('supplierName', 'supplierAddress', 'supplierPhone' );
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Created!']);
    }

}
