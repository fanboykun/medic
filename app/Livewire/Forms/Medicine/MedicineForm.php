<?php

namespace App\Livewire\Forms\Medicine;

use App\Models\Medicine;
use Carbon\Carbon;
use Exception;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Form;

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
    #[Validate(['required|string|max:250'], [
        'required' => 'Please enter the medicine name',
        'max' => 'too much character for name, max character is 255 character'
        ])]
    public string|null $name;

    #[Validate(['nullable|string|max:250'], [
        'max' => 'too much character for storage, max character is 255 character'
    ])]
    public string|null $storage;

    #[Validate(['nullable|string|max:250'], [
        'max' => 'too much character for description, max character is 255 character'
    ])]
    public string|null $description;

    #[Validate(['required|integer|exists:App\Models\Unit,id'], [
        'exists' => 'the unit does not exists, please create one',
        'required' => 'please select one unit'
        ])]
    public int|null $unit_id;

    #[Validate(['required|integer|exists:App\Models\Category,id'],[
        'exists' => 'the category does not exists, please create one',
        'required' => 'please select one category'
        ])]
    public int|null $category_id;

    #[Validate(['required|integer|exists:App\Models\Supplier,id'], [
        'exists' => 'the supplier does not exists, please create one',
        'required' => 'please select one supplier'
        ])]
    public int|null $supplier_id;

    #[Validate(['required|integer|min:1|max:9999|min_digits:1|max_digits:4'], [
        'required' => 'please enter the stock amount, min amount is 1',
        'max' => 'too much value for stock, max value is 9999',
        'integer' => 'please input only real number for stock, not accepting decimal'
    ])]
    public int|null $stock;

    #[Validate(['required|date_format:Y-m-d'], [
        'required' => 'plase fill the expiration date',
        'date_format' => 'the accepted date format is Y-m-d'
    ])]
    public string|null $expired;

    #[Validate(['required|integer|min_digits:2|max_digits:8'],[
        'required' => 'plase fill the selling price',
        'integer' => 'only accepts number',
        'min_digits' => 'the minimum accepted digit is 2 digit',
        'max_digit' => 'the maximun accepted digit is 8 digit'
    ])]
    public float|null $selling_price;

    #[Validate(['required|integer|min_digits:2|max_digits:8'], [
        'required' => 'plase fill the purchase price',
        'integer' => 'only accepts number',
        'min_digits' => 'the minimum accepted digit is 2 digit',
        'max_digit' => 'the maximun accepted digit is 8 digit'
    ])]
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
        $this->supplier_name = $medicine->supplier->name;
        $this->purchase_price = $medicine->purchase_price;
        $this->selling_price = $medicine->selling_price;
        $this->expired = Carbon::createFromFormat('Y-m-d',$medicine->expired)->format('Y-m-d');
        $this->storage = $medicine->storage;
        $this->description = $medicine->description;
    }

    public function validateMedicineForUpdate()
    {
        $this->validate([
            'name' => 'required|string|max:250',
            'storage' => 'nullable|string|max:250',
            'expired' => 'required|date_format:Y-m-d',
            'description' => 'nullable|string|max:250',
            'unit_id' => 'required|integer|exists:App\Models\Unit,id',
            'category_id' => 'required|integer|exists:App\Models\Category,id',
        ]);
    }

    public function storeMedicineForUpdate()
    {
        $this->validateMedicineForUpdate();
        try{
            Medicine::where('id', $this->medicineId)->update([
                'name' => $this->name,
                'storage' => $this->storage,
                'expired' => $this->expired,
                'description' => $this->description,
                'unit_id' => $this->unit_id,
                'category_id' => $this->unit_id,
            ]);
        }catch (\Exception $e){
            throw new Exception('Something Goes Wrong');
        }
        $this->reset();         // always reset the prop
    }
}
