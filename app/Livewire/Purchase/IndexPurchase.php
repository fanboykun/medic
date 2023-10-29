<?php

namespace App\Livewire\Purchase;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
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

    public function destroyPurchase() : void
    {
        $msg = '';
        try{
            DB::transaction(function () {
                $purchase_to_be_deleted = Purchase::select('id')->where( 'id', $this->selectedPurchase->id )->with( ['medicines' => fn ( $q ) => $q->select('id')] )->first();
                $purchase_to_be_deleted->medicines()->detach();
                foreach( $purchase_to_be_deleted->medicines as $med ) {
                    $med->delete();
                }
                $purchase_to_be_deleted->delete();
            });
            $msg = 'success';

        }catch(\Exception $e){
            $msg = 'error';
            throw($e);
        }
        if($msg && $msg == 'success'){
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Purchase Has Been Deleted!']);
        }elseif($msg && $msg == 'error'){
        $this->dispatch('notify', ['status' => 'error', 'message' => 'Error! Medicine Cannot be Deleted!']);
        }
        $this->dispatch('close-modal');
        $this->reset('selectedPurchase');
    }
}
