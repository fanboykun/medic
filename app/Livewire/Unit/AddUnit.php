<?php

namespace App\Livewire\Unit;

use Livewire\Component;
use App\Livewire\Forms\Unit\UnitForm;
use Illuminate\Contracts\View\View;

class AddUnit extends Component
{
    public UnitForm $unitForm;

    public function render() : View
    {
        return view('livewire.unit.add-unit');
    }

    public function saveUnit() : void
    {
        if($this->unitForm->saveUnit()) {
            $this->dispatch('unit-created');
            $this->dispatch('close-modal');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Created!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error creating unit']);
        }
    }

    public function clearForm() : void
    {
        $this->unitForm->clearForm();

    }
}
