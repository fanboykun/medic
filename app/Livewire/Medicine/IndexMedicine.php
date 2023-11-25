<?php

namespace App\Livewire\Medicine;

use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Medicine;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class IndexMedicine extends Component
{
    use WithPagination;

    #[Url(as : 'q')]
    public $search = '';

    protected $queryString = ['q'];
    public int $perPage = 10;
    public $units;
    public $categories;
    public $filter_unit;
    public $filter_category;
    public $filter_expired;
    // public $medicine;
    public $selectedMedicine;

    public function render() : View
    {
        $this->units = Unit::all();
        $this->categories = Category::all();
        $today = $this->filter_expired != null ? today()->format('Y-m-d') : '';
        $medicines = Medicine::where('name', 'like', '%'.$this->search.'%')
        ->where('unit_id', 'like', '%'.$this->filter_unit. '%')
        ->where('category_id', 'like', '%'.$this->filter_category. '%')
        ->when($today != '', function ($q) use($today){
            return $this->filter_expired ? $q->whereDate('expired', '<=', $today) : $q->whereDate('expired', '>=', $today);
        })
        ->with('supplier', 'unit', 'category')
        ->latest()
        ->paginate($this->perPage);
        return view('livewire.medicine.index-medicine',['medicines' => $medicines]);
    }

    public function loadMore() : void
    {
        $this->perPage += 10;                   # not a good option, but will do for now
        // $this->nextPage();                   # should be like this, old way pagination instead of incrementing the limit number
    }

    public function deleteMedicine(array $medicine) : void
    {
        $this->selectedMedicine = $medicine;
        $this->dispatch('open-modal', 'delete-medicine');
    }

    public function destroyMedicine() : void
    {
        try{
            DB::transaction(function () {
                // find the desired medicine from database
                $med = Medicine::where('id',$this->selectedMedicine)->with( 'purchases' )->first();

                // get first purchase data to update
                // update the purchase data
                $purchase = $med->purchases->first();
                $purchase->total_purchase = $purchase->total_purchase - $med->purchase_price;
                $purchase->save();

                // detach medicine data from purchase_medicine pivot
                // then delete the medicine from the database
                $med->purchases()->detach();
                $med->delete();
            });
            $this->dispatch('notify', ['message' => 'Medicine has been deleted!', 'status' => 'success']);

        }catch(\Exception $e){
            $this->dispatch('notify', ['message' => 'Error! Medicine cannot be deleted!', 'status' => 'error']);
            throw($e);
        }


        $this->dispatch('close-modal');
        $this->reset('selectedMedicine');
    }


}
