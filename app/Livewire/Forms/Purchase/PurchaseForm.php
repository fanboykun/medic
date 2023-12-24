<?php

namespace App\Livewire\Forms\Purchase;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PurchaseForm extends Form
{
    #[Locked]
    public ?int $purchase_id;

    #[Validate('required', message : 'please select one supplier')]
    #[Validate('exists:App\Models\Supplier,id', message : 'the supplier does not exists, please create one')]
    public string|int $supplier_id = '';

    #[Validate('required', message: 'plase fill the purchase date')]
    #[Validate('date_format:Y-m-d', message: 'the accepted date format is Y-m-d')]
    public $purchase_date = '';

    #[Validate('required')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250')]
    // #[Validate('unique:App\Models\Purchase,invoice'.$this->purchase_id, message : 'the invoice number already exists, please click regenerate')]
    public string $invoice = '';

    #[Validate('required', message: 'plase fill the selling price')]
    #[Validate('integer', message: 'only accepts number for price')]
    #[Validate('min_digits:2', message: 'the minimum accepted digit is 2 digit')]
    #[Validate('max_digits:8', message: 'the maximun accepted digit is 8 digit')]
    public float $total_purchase;

    public function fillInput(Purchase $purchase): void
    {
        $this->purchase_id = $purchase->id;
        $this->supplier_id = $purchase->supplier_id;
        $this->purchase_date = $purchase->purchase_date;
        $this->invoice = $purchase->invoice;
        $this->total_purchase = $purchase->total_purchase;
    }

    public function updatePurchaseOnly() : void
    {
        $this->validate();
        try {
            DB::transaction(function () {
                Purchase::where('id', $this->purchase_id)->update([
                    'supplier_id' => $this->supplier_id,
                    'purchase_date' => $this->purchase_date,
                    'total_purchase' => $this->total_purchase,
                ]);
            });
        } catch(\Exception $e) {
            throw($e);
        }
    }

    public function updatePurchase() : void
    {

    }

}
