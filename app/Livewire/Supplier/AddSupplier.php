<?php

namespace App\Livewire\Supplier;

use App\Livewire\Forms\Supplier\SuppilerForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddSupplier extends Component
{
    public SuppilerForm $supplierForm;

    public function render() : View
    {
        return view('livewire.supplier.add-supplier');
    }

    public function saveSupplier() : void
    {
        if($this->supplierForm->saveSupplier()) {
            $this->dispatch('supplier-created');
            $this->dispatch('close-modal');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Created!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error creating supplier']);
        }
    }

    public function clearForm() : void
    {
        $this->supplierForm->clearForm();
    }
}
