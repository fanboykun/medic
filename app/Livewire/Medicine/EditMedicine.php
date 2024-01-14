<?php

namespace App\Livewire\Medicine;

use App\Livewire\Forms\Medicine\MedicineForm;
use App\Models\Category;
use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditMedicine extends Component
{

    public MedicineForm $form;          // form object, new thing in livewire v3

    public ?Collection $units;
    public ?Collection $categories;

    public function mount(int $medicineId) : void
    {
        $medicine = Medicine::with(['unit', 'category', 'supplier'])->findOrFail($medicineId);
        $this->form->setMedicineForUpdate(medicine: $medicine);         // typed arguments, new thing in PHP 8.3
    }

    public function render() : View
    {
        $this->units = Unit::latest()->get();
        $this->categories = Category::latest()->get();
        return view('livewire.medicine.edit-medicine');
    }

    public function updateMedicine() : void
    {
        $this->form->storeMedicineForUpdate();
        session()->flash( 'success-notify', 'Medicine Has Been Updated!' );
        $this->redirect(
            route('medicines.index'),
            navigate: true
        );
    }

    public function goToFullUpdate()
    {
        $purchase = DB::table('medicine_purchase')->select('purchase_id')
        ->where('medicine_id', $this->form->medicineId)->first();
        $this->redirectRoute('purchases.edit', ['purchase' => $purchase->purchase_id, 'medicine' => $this->form->medicineId], navigate: true);
    }
}
