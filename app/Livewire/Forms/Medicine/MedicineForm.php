<?php

namespace App\Livewire\Forms\Medicine;

use App\Models\Medicine;
use Carbon\Carbon;
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
    public $medicineId;                // for update and delete (or interacting with existing record, use this)

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
    public $supplier_name;

    public function setMedicineForUpdate(Medicine $medicine)
    {
        $this->medicineId = $medicine->id;
        $this->name = $medicine->name;
        $this->stock = $medicine->stock;
        $this->unit_id = $medicine->unit_id;
        $this->category_id = $medicine->category_id;
        $this->supplier_id = $medicine->supplier_id;
        $this->supplier_name = $medicine->supplier->name;
        $this->purchase_price = $medicine->purchase_price;
        $this->selling_price = $medicine->selling_price;
        $this->expired = Carbon::createFromFormat('Y-m-d',$medicine->expired)->format('Y-m-d'); // for HTML input type date, since it's only accepts Y-m-d format :)
        $this->storage = $medicine->storage;
        $this->description = $medicine->description;
    }

    public function storeMedicineForUpdate()
    {
        $this->validate();
        try{
            $medicine = Medicine::findOrFail($this->medicineId);
            $medicine->update([
                'name' => $this->name,
                'storage' => $this->storage,
                'expired' => $this->expired,
                'description' => $this->description,
                'unit_id' => $this->unit_id,
                'category_id' => $this->category_id,
            ]);
        }catch (\Exception $e){
            throw($e);
        }
        $this->reset();         // always reset the prop
    }
}
