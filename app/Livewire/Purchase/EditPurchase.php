<?php

namespace App\Livewire\Purchase;

use App\Livewire\Forms\Medicine\MedicineForm;
use App\Livewire\Forms\Purchase\PurchaseForm;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Component;

class EditPurchase extends Component
{
    public PurchaseForm $purchaseForm;
    public MedicineForm $medicineForm;

    // public Collection $purchase_medicine;
    public SupportCollection|array $purchase_medicine;
    public ?Collection $suppliers;
    public ?Collection $units;
    public ?Collection $categories;

    public ?int $total_medicine;
    public ?int $total_quantity;

    public function  mount(Purchase $purchase) : void
    {
        $purchase_data = $purchase->load(['medicines']);
        $this->purchase_medicine = $purchase_data->medicines;
        $this->purchaseForm->fillInput($purchase_data);

        $this->total_medicine = count($this->purchase_medicine);
        $this->total_quantity = $this->purchase_medicine->sum('pivot.quantity');

        $this->suppliers = Supplier::latest()->get();
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
    }

    public function render() : View
    {
        return view('livewire.purchase.edit-purchase');
    }

    public function deleteMedicine( int|array $id ) : void
    {
        return;
        try {
            if($this->medicineForm->destroyMedicineWithSoftDelete($id)) {
                $filtered_old_medicine =  $this->purchase_medicine->filter(fn($value) => $value->id != $id);
                $this->purchase_medicine = $filtered_old_medicine;
                $this->total_medicine = count($filtered_old_medicine);
                // buggy
                // $this->total_quantity = $filtered_old_medicine->sum('purchases.pivot.quantity');
            }
            $this->dispatch('notify', ['message' => 'Medicine has been deleted!', 'status' => 'success']);
        } catch(\Exception $err) {
            throw($err);
            $this->dispatch('notify', ['message' => 'Error! Medicine cannot be deleted!', 'status' => 'error']);
        }
    }

    public function editMedicine(int $id) : void
    {
        (object) $medicine_to_update = collect($this->purchase_medicine)->filter(fn($value) => $value->id == $id)->first();
        $this->medicineForm->setMedicineForUpdate($medicine_to_update);
        $this->dispatch('set-tab', 'medicine_form');
        $this->dispatch('change-form-label', 'Update Medicine');
    }

    public function updateMedicine() : void
    {
        try {
            // actions
            $updated_medicine =  $this->medicineForm->storeMedicineForUpdate(shouldReturn: true);

            // update the list of $this->purchase_medicine
            $this->purchase_medicine = $this->purchase_medicine->filter(function( $item ) use($updated_medicine) {
                return $item->id != $updated_medicine->id;
            })->push($updated_medicine)->sortByDesc('updated_at');

            // event dispacther to browser
            $this->dispatch('notify', ['message' => 'Medicine has been updated!', 'status' => 'success']);
            $this->dispatch('set-tab', 'purchase_form');
        } catch(\Exception $e) {
            throw($e);
            $this->dispatch('notify', ['message' => 'Error! Medicine cannot be updated!', 'status' => 'error']);
        }
    }

    public function updatePurchase() : void
    {
        try {
            $this->purchaseForm->updatePurchaseOnly();
            $this->dispatch('notify', ['message' => 'Purchase has been updated!', 'status' => 'success']);
        } catch(\Exception $e) {
            $this->dispatch('notify', ['message' => 'Error! Purchase cannot be updated!', 'status' => 'error']);
            throw($e);
        }

        // $total_purchase_amount  = $this->purchase_medicine;
    }

}
