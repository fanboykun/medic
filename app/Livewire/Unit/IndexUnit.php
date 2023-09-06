<?php

namespace App\Livewire\Unit;

use Livewire\Component;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class IndexUnit extends Component
{
    use WithPagination;

    #[Url(as : 'q')]
    public $search = '';

    public int $perPage = 10;
    protected $queryString = ['q'];

    public array $selectedUnit;
    public $name;

    public function render() : View
    {
        $units = Unit::where('name', 'like', '%'.$this->search.'%')
        ->latest()->paginate($this->perPage);

        return view('livewire.unit.index-unit', ['units' => $units]);
    }

    public function editUnit(array $unit) : void
    {
        $this->selectedUnit = $unit;
        $this->dispatch('open-modal', 'edit-unit');
    }

    public function saveUnit() : void
    {
        $this->validate([
            'name' => 'required|string|max:50',
        ]);
        Unit::create([
            'name' => $this->name,
        ]);
        $this->reset('name');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Created!']);
    }

    public function updateUnit() : void
    {
        $this->dispatch('close-modal');
        $this->validate([
            'selectedUnit.name' => 'required|string|max:50',
        ]);
        Unit::where('id',$this->selectedUnit['id'])->update([
            'name' => $this->selectedUnit['name'],
        ]);
        $this->reset('selectedUnit');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Updated!']);
    }

    public function deleteUnit(array $unit) : void
    {
        $this->selectedUnit = $unit;
        $this->dispatch('open-modal', 'delete-unit');
    }

    public function destroyUnit() : void
    {
        Unit::where('id',$this->selectedUnit)->delete();
        $this->reset('selectedUnit');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Deleted!']);

    }

    public function clearForm(): void
    {
        $this->reset('name');
    }

    public function loadMore() : void
    {
        $this->perPage += 10;
    }
}
