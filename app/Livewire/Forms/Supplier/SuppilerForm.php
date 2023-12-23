<?php

namespace App\Livewire\Forms\Supplier;

use App\Models\Supplier;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SuppilerForm extends Form
{
    public ?Supplier $supplier;

    #[Locked]
    public int|null $supplierId;        // uss this for selecting or manipulating existing data

    #[Validate('required', message: 'Please enter the supplier name')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for name, max character is 255 character')]
    public string|null $name;

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for address, max character is 255 character')]
    public string|null $address;

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for address, max character is 255 character')]
    public string|null $phone;

    public function saveSupplier() : bool
    {
        $this->validate();
        try {
            Supplier::create([
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone
            ]);
            $this->reset('name', 'address', 'phone');
            return true;
        }catch (\Exception $e) {
            return false;
            // throw($e);
        }
    }

    public function clearForm(): void
    {
        $this->reset('name', 'address', 'phone');
    }

    public function fillInput(Supplier $supplier): true
    {
        $this->supplierId = $supplier->id;
        $this->name = $supplier->name;
        $this->address = $supplier->address;
        $this->phone = $supplier->phone;
        return true;
    }

    public function updateSupplier() : bool
    {
        $this->validate();
        try {
            Supplier::where('id',$this->supplierId)->update([
                'name' => $this->name,
                'address' => $this->address,
                'phone' => $this->phone
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        } finally {
            $this->reset();
        }

    }

}
