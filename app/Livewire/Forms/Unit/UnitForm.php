<?php

namespace App\Livewire\Forms\Unit;

use App\Models\Unit;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UnitForm extends Form
{
    public ?Unit $unit;

    #[Locked]
    public int|null $unitId;        // uss this for selecting or manipulating existing data

    #[Validate('required', message: 'Please enter the unit name')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for name, max character is 255 character')]
    public string|null $name;

    public function saveUnit() : bool
    {
        $this->validate();
        try {
            Unit::create([
                'name' => $this->name,
            ]);
            $this->reset('name');
            return true;
        }catch (\Exception $e) {
            return false;
            // throw($e);
        }
    }

    public function clearForm(): void
    {
        $this->reset('name');
    }

    public function fillInput(Unit $unit): true
    {
        $this->unitId = $unit->id;
        $this->name = $unit->name;
        return true;
    }

    public function updateUnit() : bool
    {
        $this->validate();
        try {
            Unit::where('id',$this->unitId)->update([
                'name' => $this->name,
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        } finally {
            $this->reset();
        }
    }

}
