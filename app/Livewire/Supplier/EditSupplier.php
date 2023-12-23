<?php

namespace App\Livewire\Supplier;

use App\Livewire\Forms\Supplier\SuppilerForm;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditSupplier extends Component
{
    public SuppilerForm $supplierForm;

    public function render() : View
    {
        return view('livewire.supplier.edit-supplier');
    }

    public function edit( ?Supplier $supplier ) : void
    {
        if($this->supplierForm->fillInput($supplier)) {
            $this->dispatch('open-modal', 'edit-supplier');
        }
    }

    public function updateSupplier() : void
    {
        if($this->supplierForm->updateSupplier()) {
            $this->dispatch('close-modal');
            $this->dispatch('supplier-updated');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Updated!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error Updating Supplier!']);
        }
    }
}
