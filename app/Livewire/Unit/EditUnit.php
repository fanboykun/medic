<?php

namespace App\Livewire\Unit;

use Livewire\Component;
use App\Livewire\Forms\Unit\UnitForm;
use App\Models\Unit;

class EditUnit extends Component
{
    public UnitForm $unitForm;

    public function render()
    {
        return view('livewire.unit.edit-unit');
    }

    public function edit( ?Unit $unit )
    {
        if($this->unitForm->fillInput($unit)) {
            $this->dispatch('open-modal', 'edit-unit');
        }
    }

    public function updateUnit()
    {
        if($this->unitForm->updateUnit()) {
            $this->dispatch('close-modal');
            $this->dispatch('unit-updated');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Updated!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error Updating Unit!']);
        }
    }
}
