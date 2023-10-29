<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class IndexPurchase extends Component
{
    use WithPagination;

    public $selectedPurchase;
    public int $perPage = 10;

    public $filter_supplier = '';

    #[Url(as : 'q')]
    public $search = '';
    protected $queryString = ['q'];

    public function render() : View
    {
        $suppliers = Supplier::latest()->get();
        $purchases = Purchase::where('invoice', 'like', '%'.$this->search.'%')
        ->where('supplier_id', 'like', '%'.$this->filter_supplier. '%')
        ->with('supplier')->latest()->paginate($this->perPage);
        return view('livewire.purchase.index-purchase', ['purchases' => $purchases, 'suppliers' => $suppliers]);
    }

    public function openPurchaseMedicine( Purchase $purchase ) : void
    {
        $this->selectedPurchase = $purchase->load('medicines');
        $this->dispatch('open-modal', 'purchase-medicine-detail');
    }

    public function deletePurchase( Purchase $purchase )
    {
        $this->selectedPurchase = $purchase;
        $this->dispatch('open-modal', 'delete-purchase');
    }

    public function destroyPurchase()
    {

        $this->dispatch('open-modal', 'delete-purchase');
    }
}
