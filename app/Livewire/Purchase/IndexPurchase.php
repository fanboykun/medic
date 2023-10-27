<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class IndexPurchase extends Component
{
    use WithPagination;

    public $selectedPurchase;
    public int $perPage = 10;

    #[Url(as : 'q')]
    public $search = '';
    protected $queryString = ['q'];

    public function render() : View
    {
        $purchases = Purchase::where('invoice', 'like', '%'.$this->search.'%')->with('supplier')->latest()->paginate($this->perPage);
        return view('livewire.purchase.index-purchase', ['purchases' => $purchases]);
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
