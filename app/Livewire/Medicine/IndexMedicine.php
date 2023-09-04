<?php

namespace App\Livewire\Medicine;

use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Medicine;

class IndexMedicine extends Component
{
    use WithPagination;

    #[Url(as : 'q')]
    public $search = '';

    protected $queryString = ['q'];
    public int $perPage = 5;

    public function render()
    {
        return view('livewire.medicine.index-medicine',
        [
            'medicines' => Medicine::where('name', 'like', '%'.$this->search.'%')
            ->with('supplier', 'unit', 'category')
            ->paginate($this->perPage)
        ]);
    }

    public function loadMore() : void
    {
        $this->perPage += 10;
    }
}
