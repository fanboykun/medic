<?php

namespace App\Livewire\Medicine;

use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Medicine;
use App\Models\Unit;
use App\Models\Category;

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

    public function render()
    {


        $this->units = Unit::all();
        $this->categories = Category::all();
        $today = today()->format('Y-m-d');

        return view('livewire.medicine.index-medicine',
        [
            'medicines' => Medicine::where('name', 'like', '%'.$this->search.'%')
            ->where('unit_id', 'like', '%'.$this->filter_unit. '%')
            ->where('category_id', 'like', '%'.$this->filter_category. '%')
            ->when($this->filter_expired, function ($query) use($today){
                return $query->whereDate('expired', '<=', $today);
            }, function ($query) use($today){
                return $query->whereDate('expired', '>=', $today);
            })
            ->with('supplier', 'unit', 'category')->latest()
            ->paginate($this->perPage)
        ]);
    }

    public function loadMore() : void
    {
        $this->perPage += 10;
    }
}
