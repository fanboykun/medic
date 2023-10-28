<?php

namespace App\Livewire\Purchase;

use Livewire\Component;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class AddPurchase extends Component
{
    // purchases data to be searched and selected
    // the feature is tbd
    public $purchases;

    // medicines data to be searched and selected
    // the feature is tbd
    public $medicines;

    // model purchase that will be filled after purchase created
    // the feature is tbd
    public $purchase;

    // model medicine that being selected
    // the feature is tbd
    public $selectedMedicine;

    // column model for new purchase data
    // i think this var(s) better should be in the newPurchase instead
    public $purchase_date;
    public $total_purchase;
    public $invoice;
    public $total_medicine;
    public $total_quantity;

    // data for select input for new medicine data
    public $categories;
    public $units;
    public $suppliers;

    // column model for new medicine data
    public $name;
    public $stock;
    public $storage;
    public $expired;
    public $description;
    public $purchase_price;
    public $selling_price;

    // column model for new medicine data that set from select input
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

    // purchase data variable
    // retrieve a new instance of purchase that hasn't been created
    // for now the data is array
    public $newPurchase;

    // medicine data variable
    // retrieve new instance(s) medicine data that hasn't been created
    // for now the data is array
    public $newMedicines;


    public function render() : View
    {
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
        $this->suppliers = Supplier::latest()->get();
        $this->purchases = Purchase::with('supplier')->latest()->get();
        $this->medicines = Medicine::with('supplier')->latest()->get();

        return view('livewire.purchase.add-purchase');
    }

    public function appendNewPurchase() : void
    {
        $this->validate([
            'purchase_date' => 'required|date_format:Y-m-d',
            'supplier_id' => 'required|integer|exists:App\Models\Supplier,id',
        ]);
        $this->newPurchase = [
            'supplier_id' => $this->supplier_id,
            'purchase_date' => $this->purchase_date,
        ];
        $this->dispatch('set-tab', 'medicine_form');
    }

    public function appendNewMedicine() : void
    {
        $this->validateMedicine();
        $this->newMedicines[] = [
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
        ];
        $this->clearNewMedicineForm();
        $this->getSummaryData();
    }

    public function unsetAMedicine( array $med ) : void
    {
        // unset an item of medicine from $this->newMedicines
        // return void
        // tbd
        if( ($key = array_search($med, $this->newMedicines) ) !== false ) {
            unset($this->newMedicines[$key]);
        }
        $this->getSummaryData();
    }

    private function clearNewMedicineForm() :void
    {
        $this->reset([
            'name', 'stock', 'storage', 'expired', 'description', 'purchase_price', 'selling_price', 'unit_id', 'category_id'
        ]);
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

    public function getSummaryData() :void
    {
        if($this->newMedicines == null){
            $this->reset('total_purchase', 'total_medicine', 'total_quantity', 'invoice');
            return ;
        }
        foreach($this->newMedicines as $key => $med){
            $this->total_purchase += $med['purchase_price'] * $med['stock'];
            $this->total_quantity += $med['stock'];
        }
        $this->total_medicine = count($this->newMedicines);
        $this->invoice = $this->invoice == null ? Str::random(7) : $this->invoice;
    }

    public function selectPurchase( Purchase $purchase ) : void
    {
        $this->purchase = $purchase->load('medicines');
    }

    public function selectMedicine( Medicine $medicine ) : void
    {
        $this->selectedMedicine = $medicine;
    }

    public function saveMedicinePurchase()
    {
        // save purchase and all medicine data to database
        // then attach each medicine to purchase relation
        // then return redirect to purchases.index route
        // tbd
        $this->validatePurchase();
        try{
            DB::transaction(function() {
                $purchase_created = $this->savePurchase();
                foreach( $this->newMedicines as $key => $newMed ) {
                    $medicine_created = $this->saveMedicine( $newMed );
                    $purchase_created->medicines()->attach($medicine_created->id,
                    ['quantity' => $medicine_created->stock, 'purchase_price' => $medicine_created->purchase_price]);
                }
            });
        }catch( \Exception $e ) {
            throw($e);
        }
        $this->redirect(
            route('purchases.index'),
            navigate: true
        );
        // return $this->redirect(route('purchases.index'), navigate: true);
    }

    public function validatePurchase() : void
    {
        $this->validate([
            'purchase_date' => 'required|date_format:Y-m-d',
            'supplier_id' => 'required|integer|exists:App\Models\Supplier,id',
            'invoice' => 'required|string|unique:purchases,invoice',
            'total_purchase' => 'required|integer'
        ]);
    }

    private function savePurchase() : Purchase|Throwable
    {
        // save purchase data to database
        // then return back the instance
        // tdb

        try{
            $new_purchase = Purchase::create([
                'invoice' => $this->invoice,
                'supplier_id' => $this->supplier_id,
                'purchase_date' => $this->purchase_date,
                'total_purchase' => $this->total_purchase,
            ]);
            return $new_purchase;
        }catch( \Exception $e ){
            throw($e);
        }
    }

    private function saveMedicine( array $med ) : Medicine|Throwable
    {
         // save medicine data to database
        // then return back the instance
        // tdb
        try{
            $new_medicine = Medicine::create([
                'name' => $med['name'],
                'stock' => (int) $med['stock'],
                'storage' => $med['storage'],
                'expired' => $med['expired'],
                'description' => $med['description'],
                'purchase_price' => $med['purchase_price'],
                'selling_price' => $med['selling_price'],
                'unit_id' => (int) $med['unit_id'],
                'category_id' => (int) $med['category_id'],
                'supplier_id' => (int) $med['supplier_id'],
            ]);
            return $new_medicine;
        }catch(\Exception $e){
            throw($e);
        }
    }

    public function regenerateInvoiceCode() : void
    {
        $this->invoice = Str::random(7);
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
