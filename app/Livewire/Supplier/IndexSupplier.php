<?php

namespace App\Livewire\Supplier;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class IndexSupplier extends Component
{
    use WithPagination;

    #[Url(as : 'q')]
    public $search = '';

    public int $perPage = 10;
    protected $queryString = ['q'];

    public array $selectedSupplier;
    public $name, $address, $phone;

    public string $sortField = 'created_at';
    public string $sortDirection = 'asc';
    protected array $sortableField = ['name', 'address', 'phone', 'created_at'];

    public function render() : View
    {
        $suppliers = Supplier::where('name', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortField ?? 'created_at', $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.supplier.index-supplier', ['suppliers' => $suppliers]);
    }

    public function editSupplier(array $supplier) : void
    {
        $this->selectedSupplier = $supplier;
        $this->dispatch('open-modal', 'edit-supplier');
    }

    public function saveSupplier() : void
    {
        $this->validate([
            'name' => 'required|string|max:20',
            'address' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
        ]);
        Supplier::create([
            'name' => $this->name,
            'address' => $this->address,
            'phone' => $this->phone
        ]);
        $this->reset('name', 'address', 'phone');
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Created!']);
    }

    public function updateSupplier() : void
    {
        $this->dispatch('close-modal');
        $this->validate([
            'selectedSupplier.name' => 'required|string|max:50',
            'selectedSupplier.address' => 'required|string|max:100',
            'selectedSupplier.phone' => 'required|string|max:100',
        ]);
        Supplier::where('id',$this->selectedSupplier['id'])->update([
            'name' => $this->selectedSupplier['name'],
            'address' => $this->selectedSupplier['address'],
            'phone' => $this->selectedSupplier['phone']
        ]);
        $this->reset('selectedSupplier');
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Updated!']);
    }

    public function deleteSupplier(array $supplier) : void
    {
        $this->selectedSupplier = $supplier;
        $this->dispatch('open-modal', 'delete-supplier');
    }

    public function destroySupplier() : void
    {
        Supplier::where('id',$this->selectedSupplier['id'])->delete();
        $this->reset('selectedSupplier');
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Supplier Has Been Deleted!']);
    }

    public function clearForm(): void
    {
        $this->reset('name', 'address', 'phone');
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
