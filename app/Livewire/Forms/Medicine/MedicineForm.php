<?php

namespace App\Livewire\Forms\Medicine;

use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;
use Livewire\Form;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;

class MedicineForm extends Form
{

    /**
     * lock the prop, so it can't be manipulated via frontend (js).
     * yes it can be manipulated since it's a public prop,
     * see the livewire v3 documentation.
     */
    #[Locked]
    public ?int $medicineId;                // for update and delete (or interacting with existing record, use this)

    public ?Medicine $medicine;         // for making new instance (create, or even select use this)

    /**
     * Init the variables, used for placing the medicine column value
     * also put the validation rule and validation error message
     * define the variable type, if needed, init the value
     * like $name = ''; (if needed)
     */
    #[Validate('required', message: 'Please enter the medicine name')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for name, max character is 255 character')]
    public string|null $name;

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for storage, max character is 255 character')]
    public string|null $storage;

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for description, max character is 255 character')]
    public string|null $description;

    #[Validate('required', message: 'please select one unit')]
    #[Validate('integer')]
    #[Validate('exists:App\Models\Unit,id', message: 'the unit does not exists, please create one then select it')]
    public int|null $unit_id;

    #[Validate('required', message : 'please select one category')]
    #[Validate('integer')]
    #[Validate('exists:App\Models\Category,id', message : 'the category does not exists, please create one')]
    public int|null $category_id;

    #[Validate('required', message : 'please select one supplier')]
    #[Validate('integer')]
    #[Validate('exists:App\Models\Supplier,id', message : 'the supplier does not exists, please create one')]
    public int|null $supplier_id;

    #[Validate('required', message : 'please enter the stock amount, min amount is 1')]
    #[Validate('integer')]
    #[Validate('min:1')]
    #[Validate('max:9999', message : 'too much value for stock, max value is 999')]
    #[Validate('min_digits:1', message : '')]
    #[Validate('max_digits:4', message : '')]
    public int|null $stock;

    #[Validate('required', message: 'plase fill the expiration date')]
    #[Validate('date_format:Y-m-d', message: 'the accepted date format is Y-m-d')]
    public string|null $expired;

    #[Validate('required', message: 'plase fill the selling price')]
    #[Validate('integer', message: 'only accepts number for price')]
    #[Validate('min_digits:2', message: 'the minimum accepted digit is 2 digit')]
    #[Validate('max_digits:8', message: 'the maximun accepted digit is 8 digit')]
    public float|null $selling_price;

    #[Validate('required', message: 'plase fill the purchase price')]
    #[Validate('integer', message: 'only accepts number for price')]
    #[Validate('min_digits:2', message: 'the minimum accepted digit is 2 digit')]
    #[Validate('max_digits:8', message: 'the maximun accepted digit is 8 digit')]
    public float|null $purchase_price;

    /**
     * For edit form, since supplier_id can't be edited
     * so just show the supplier name
     * same goes for purchase_price,
     * selling_price and stock.
     */
    public ?string $supplier_name;

    public function setMedicineForUpdate(Medicine|SupportCollection|array $medicine) : void
    {
        // transform array into object
        if(is_array($medicine)) {
            $medicine = (object) $medicine;
        }

        $this->medicineId = $medicine->id;
        $this->name = $medicine->name;
        $this->stock = $medicine->stock;
        $this->unit_id = $medicine->unit_id;
        $this->category_id = $medicine->category_id;
        $this->supplier_id = $medicine->supplier_id;
        $this->purchase_price = $medicine->purchase_price;
        $this->selling_price = $medicine->selling_price;
        $this->expired = Carbon::createFromFormat('Y-m-d',$medicine->expired)->format('Y-m-d'); // for HTML input type date, since it's only accepts Y-m-d format :)
        $this->storage = $medicine->storage;
        $this->description = $medicine->description;
        $this->supplier_name = Supplier::where('id', $this->supplier_id)->first('name')->name;
    }

    public function storeMedicineForUpdate($shouldReturn = false) : null|object
    {
        $this->validate();
        try{
            $medicine = tap(Medicine::where( 'id' , $this->medicineId )->with( 'purchases' )->first() , function(Medicine $medicine) {
                $medicine->update([
                    'name' => $this->name,
                    'storage' => $this->storage,
                    'expired' => $this->expired,
                    'description' => $this->description,
                    'unit_id' => $this->unit_id,
                    'category_id' => $this->category_id,
                ]);
            });
            if($shouldReturn){
                $pivot_value = $medicine->purchases->first()->pivot->toArray();     // not the best approach, only work when the medicine only has one purchase
                $medicine->pivot = $pivot_value;
                return $medicine;
            }
        }catch (\Exception $e){
            throw($e);
        }
        $this->reset();         // always reset the prop
    }

    public function destroyMedicineWithSoftDelete(int $medicine_id, $shouldUpdatePurchase = false) : bool
    {
        try {
            DB::transaction(function () use( $medicine_id ) {
                // find the desired medicine from database
                $medicine_to_destroy = Medicine::where('id',$medicine_id)->with( 'purchases' )->first();

                // get first purchase data to update
                // update the purchase data
                $purchase = $medicine_to_destroy->purchases->first();   // work only if the medicine only has one purchase
                $updated_total_purchase = (int) ($purchase->total_purchase - ( $purchase->pivot->purchase_price * $purchase->pivot->quantity ));
                $purchase->total_purchase = $updated_total_purchase >= 0 ? $updated_total_purchase : 0 ;
                $purchase->save();

                // detach medicine data from purchase_medicine pivot
                // then delete the medicine from the database
                $medicine_to_destroy->purchases()->detach();
                $medicine_to_destroy->delete();

            });
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }

    public function storeMedicineForCompleteUpdate($shouldReturn = false) : null|object
    {
        $this->validate();
        try{
            $updated_medicine = DB::transaction( function() : object|null {
                $medicine_to_update = tap(Medicine::where( 'id' , $this->medicineId )->with( 'purchases' )->first() , function( Medicine $medicine ) : object|null {
                    $updated_stock = ( $this->stock != $medicine->stock ) ? $this->stock : $medicine->stock; // fixed value, cannot be modified anymore
                    $updated_selling_price = ( $this->selling_price != $medicine->selling_price ) ? $this->selling_price : $medicine->selling_price; // initial value for selling_price in medicine data
                    $updated_purchase_price = ( $this->purchase_price != $medicine->purchase_price ) ? $this->purchase_price : $medicine->purchase_price ;    // initial value for purchase price in purchase and medicine data

                    $purchase = $medicine->purchases->first(); // retrieve the purchase data for use later

                    $updated_quantity = 0; // initial value for quantity in purchase data
                    $updated_total_purchase = $purchase->total_purchase;

                    // guard clause
                    if($this->stock > $medicine->stock || $this->purchase_price > $this->selling_price || $this->selling_price < $this->purchase_price) return null;

                    // prepare stock value in case the quantity in purchase data need to be updated
                    // subtract the old quantity be the old stock value, and then add the subtracted value with the new stock value
                    $updated_quantity = ($purchase->pivot->quantity - $medicine->stock) + $this->stock;

                    // prepare purchase_price value in case the purchase_price in purchase and medicine data need to be updated
                    // subtract the old value of $purchase->total_purchase by ( $purchase->total_purchase - $medicine->purchase_price ) * $purchase->pivot->quantity anf then add the value of $purchase->total_purchase by the new purchase_price * quantity value
                    $updated_total_purchase = ($purchase->total_purchase - ( $purchase->pivot->purchase_price * $purchase->pivot->quantity )) + ($updated_purchase_price * $updated_quantity);

                    // prepare selling_price value in case the selling_price in medicine data need to be updated
                    $updated_selling_price = $this->selling_price;

                    $medicine->update([
                        'name' => $this->name,
                        'storage' => $this->storage,
                        'expired' => $this->expired,
                        'description' => $this->description,
                        'unit_id' => $this->unit_id,
                        'category_id' => $this->category_id,
                        'selling_price' => $updated_selling_price,
                        'purchase_price' => $updated_purchase_price,
                        'stock' => $updated_stock
                    ]);
                    // $purchase_to_update = Purchase::where('id', $purchase->id)->first();
                    $purchase->update([
                        'total_purchase' => $updated_total_purchase,
                    ]);
                    $purchase->medicines()->syncWithoutDetaching([
                        $medicine->id => [
                            'quantity' => $updated_quantity != 0 ? $updated_quantity : $purchase->pivot->quantity,
                            'purchase_price' => $updated_purchase_price
                        ]
                    ]);

                });
                return $medicine_to_update;
            });
            // dd($updated_medicine);
            if($shouldReturn){
                $pivot_value = $updated_medicine->purchases->first()->pivot->toArray();     // not the best approach, only work when the medicine only has one purchase
                $updated_medicine->pivot = $pivot_value;
                return $updated_medicine;
            }
        }catch (\Exception $e){
            throw($e);
        }
        $this->reset();         // always reset the prop
    }
}
