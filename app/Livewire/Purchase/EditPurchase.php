<?php

namespace App\Livewire\Purchase;

use App\Livewire\Forms\Medicine\MedicineForm;
use App\Livewire\Forms\Purchase\PurchaseForm;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection as SupportCollection;
use Livewire\Attributes\Url;
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

    public string $medicine_form_mode = 'add';

    public bool $medicine_query_exists = false;

    /** Load the inital data */
    public function  mount(Purchase $purchase) : void
    {
        // load medicine id from query string, in case the user coming from edit medicine form
        $m_id = request('medicine');

        $purchase_data = $purchase->load(['medicines']);

        $this->purchase_medicine = $purchase_data->medicines->toArray();
        $this->purchaseForm->fillInput( $purchase_data );

        if($m_id != null) {
            $filtered_medicine = $purchase_data->medicines->where('id', $m_id);
            if(!empty($filtered_medicine)) {
                $this->medicine_query_exists = true;
                $this->medicineForm->setMedicineForUpdate($filtered_medicine->first());
            }
        }

        $this->total_medicine = count($this->purchase_medicine);
        $this->total_quantity = array_sum( (array) Arr::pluck($this->purchase_medicine, 'pivot.quantity'));

        $this->suppliers = Supplier::latest()->get();
        $this->categories = Category::latest()->get();
        $this->units = Unit::latest()->get();
    }

    /** Render the view component */
    public function render() : View
    {
        return view('livewire.purchase.edit-purchase');
    }

    /**
     * delete the selected mediicine data that passed from the client,
     * must be validated to verify that the received medicine data is
     *  belongsto the currently selected purchase
     *
     * @param int|array $data
     * int for the id only, array for the whole medicine data
     */
    public function deleteMedicine( int|array $data ) : void
    {
        // checking andvalidating the arguments
        if(is_array($data) && array_key_exists('id', $data)) {
            $id = $data['id'];
        } else if(is_int($data)) {
            $id = $data;
        } else {
            return;
        }

        try {
            // action
            if($this->medicineForm->destroyMedicineWithSoftDelete($id, shouldUpdatePurchase: true)) {
                try{
                    // updating displayed data
                    $filtered_old_medicine =  Arr::where($this->purchase_medicine, fn($arr) : bool => $arr['id'] != $id);
                    $this->purchase_medicine = $filtered_old_medicine;
                    $this->total_medicine = count($filtered_old_medicine);
                    $this->total_quantity = array_sum( (array) Arr::pluck($this->purchase_medicine, 'pivot.quantity'));
                    $this->purchaseForm->getUpdatedTotalPurchase();
                }catch(\Exception $e) {
                    throw($e);
                    $this->dispatch('notify', ['message' => 'Error! Failed Updating Purchase Data', 'status' => 'error']);
                }
            }
            $this->dispatch('notify', ['message' => 'Medicine has been deleted!', 'status' => 'success']);
        } catch(\Exception $err) {
            if( env('APP_DEBUG') === true ) throw($err);
            $this->dispatch('notify', ['message' => 'Error! Medicine cannot be deleted!', 'status' => 'error']);
        }
    }

    /**
     * Find the existing medicine data from initial medicines data that already queried,
     * select it by the retrieved id agrument, then assign thoose selected medicine to
     * the form object. finally set the form tab to medicine_form
     *
     * @param integer $id
     * @return void
     */
    public function editMedicine(int $id) : void
    {
        (object) $medicine_to_update = collect($this->purchase_medicine)->filter(fn($value) : bool => $value['id'] == $id)->first();
        $this->medicineForm->setMedicineForUpdate($medicine_to_update);
        $this->medicine_form_mode = 'edit';
        $this->dispatch('set-tab', 'medicine_form');
    }

    public function updateMedicine() : void
    {
        try {
            // actions
            $updated_medicine =  $this->medicineForm->storeMedicineForCompleteUpdate(shouldReturn: true);
            if($updated_medicine == null) {
                $this->dispatch('notify', ['message' => 'Error Updating Medicine and Purchase!', 'status' => 'error']);
                return;
            }
            // update the list of $this->purchase_medicine
            $updated_purchase_medicine = collect( (object) $this->purchase_medicine)->filter( function( $item ) use ( $updated_medicine ): bool {
                return (is_array($item) == true) ? $item['id'] != $updated_medicine->id : $item->id != $updated_medicine->id;
            })->push($updated_medicine)->toArray();

            // sorting
            $this->purchase_medicine = array_values(Arr::sortDesc($updated_purchase_medicine, fn($arr) => $arr['updated_at'] ));

            // update the displayed purchase data
            $this->total_medicine = count($updated_purchase_medicine);
            $this->total_quantity = array_sum( (array) Arr::pluck($updated_purchase_medicine, 'pivot.quantity'));
            $this->purchaseForm->getUpdatedTotalPurchase();

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
            // we should re-query the relation, do not rely on public modifiable data. but will do for now
            $medicine_id_to_update = !empty($this->purchase_medicine) ? Arr::pluck($this->purchase_medicine, 'id') : [];

            // action
            $this->purchaseForm->updatePurchaseOnly($medicine_id_to_update);

            $this->dispatch('notify', ['message' => 'Purchase has been updated!', 'status' => 'success']);
        } catch(\Exception $e) {
            $this->dispatch('notify', ['message' => 'Error! Purchase cannot be updated!', 'status' => 'error']);
            throw($e);
        }
    }

    public function addNewMedicine() : void
    {
        $this->medicineForm->clearForm();
        $this->medicineForm->supplier_id = $this->purchaseForm->supplier_id;
        $this->medicine_form_mode = 'add';
        $this->dispatch('set-tab', 'medicine_form');
    }

    public function saveNewMedicine() : void
    {
        $newly_created_medicine = $this->medicineForm->storeMedicine();
        if($newly_created_medicine == null) {
            $this->dispatch('notify', ['message' => 'Error! Something wrong when creating medicine!', 'status' => 'error']);
            return;
        }

        $updated_purchase = $this->purchaseForm->storeMedicineToPurchase($newly_created_medicine);
        if($updated_purchase == null) {
            $this->dispatch('notify', ['message' => 'Error! Something wrong when updating purchase!', 'status' => 'error']);
            return;
        }

        // transfrom data to array, so it can be assigned and accessed as an array
        $newly_created_medicine = $newly_created_medicine->toArray();
        $updated_purchase = $updated_purchase->toArray();

        // assign pivot value from updated purchase to the newly created medicine
        $newly_created_medicine['pivot'] = $updated_purchase['pivot'];

        // push newly created medicine to medicines table/list
        $updated_purchase_medicine = collect((object) $this->purchase_medicine)->push($newly_created_medicine);

        // sorting
        $this->purchase_medicine = array_values(Arr::sortDesc($updated_purchase_medicine, fn($arr) => $arr['updated_at'] ));

        // update the displayed purchase data
        $this->total_medicine = count($updated_purchase_medicine);
        $this->total_quantity = array_sum( (array) Arr::pluck($updated_purchase_medicine, 'pivot.quantity'));
        $this->purchaseForm->getUpdatedTotalPurchase();

        $this->dispatch('notify', ['message' => 'Medicine Created, Purchase has been updated!', 'status' => 'success']);
        $this->dispatch('set-tab', 'purchase_form');
    }

    public function clearFormAfterChangeTab() : void
    {
        $this->medicineForm->clearValidatedState();
    }

}
