<?php

namespace App\Livewire\Medicine;

use App\Livewire\Forms\Medicine\MedicineForm;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Unit;
use Livewire\Component;

class EditMedicine extends Component
{

    public MedicineForm $form;          // form object, new thing in livewire v3

    public $units;
    public $categories;

    public function mount(int $medicineId)
    {
        $medicine = Medicine::with(['unit', 'category', 'supplier'])->findOrFail($medicineId);
        $this->form->setMedicineForUpdate(medicine: $medicine);         // typed arguments, new thing in PHP 8.3
    }

    public function render()
    {
        $this->units = Unit::latest()->get();
        $this->categories = Category::latest()->get();
        return view('livewire.medicine.edit-medicine');
    }

    public function updateMedicine()
    {
        $this->form->storeMedicineForUpdate();
        session()->flash( 'success-notify', 'Medicine Has Been Updated!' );
        $this->redirect(
            route('medicines.index'),
            navigate: true
        );
    }
}
