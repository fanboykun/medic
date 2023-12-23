<?php

namespace App\Livewire\Unit;

use Livewire\Component;
use App\Models\Unit;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
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

    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    public array $sortableField = ['name', 'created_at'];

    #[On('unit-created')]
    public function render() : View
    {
        $units = Unit::where('name', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortField ?? 'created_at', $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.unit.index-unit', ['units' => $units]);
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
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Unit Has Been Deleted!']);

    }

    public function loadMore() : void
    {
        $this->perPage += 10;
    }

    public function sortBy(string $field) : void
    {
        if(in_array($field, $this->sortableField, true)){
            if ($this->sortField === $field) {
                $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            } else {
                $this->sortDirection = 'desc';
            }
            $this->sortField = $field;
        }
    }
}
