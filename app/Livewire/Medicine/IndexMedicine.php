<?php

namespace App\Livewire\Medicine;

use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Medicine;

class IndexMedicine extends Component
{
    public Collection $medicines;

    public function render()
    {
        $this->medicines = Medicine::with('supplier', 'unit', 'category')->get();

        return view('livewire.medicine.index-medicine');
    }
}
