<?php

namespace App\Livewire\Medicine;

use App\Models\Medicine;
use Livewire\Component;

class ShowMedicine extends Component
{
    public $medicine;

    public function mount(Medicine $medicine)
    {
        $this->medicine = $medicine->load(['unit', 'category', 'supplier', 'purchases' => fn ($q) => $q->take(5)->latest(), 'sales' => fn ($q) => $q->take(5)->latest()]);
    }

    public function render()
    {
        return view('livewire.medicine.show-medicine');
    }
}
