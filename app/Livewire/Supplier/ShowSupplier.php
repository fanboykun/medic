<?php

namespace App\Livewire\Supplier;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ShowSupplier extends Component
{
    #[Locked]
    public Collection $purchases;
    public Supplier $supplier;

    public function mount( Supplier &$supplier )
    {
        $this->supplier = $supplier;
        // eager load relation
        $this->purchases = $supplier->load(['purchases' => function( /** Relation as argument */ HasMany $query  ) : Builder {
            return $query->with('medicines');
        }])->purchases;
    }

    public function render()
    {
        return view('livewire.supplier.show-supplier');
    }
}
