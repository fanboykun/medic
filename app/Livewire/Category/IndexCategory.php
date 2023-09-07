<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class IndexCategory extends Component
{
    use WithPagination;

    #[Url(as : 'q')]
    public $search = '';

    public int $perPage = 10;
    protected $queryString = ['q'];

    public array $selectedCategory;
    public $name, $description;

    public string $sortField = 'created_at';
    public string $sortDirection = 'asc';
    protected array $sortableField = ['name', 'created_at'];

    public function render() : View
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortField ?? 'created_at', $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.category.index-category', ['categories' => $categories]);
    }

    public function editCategory(array $category) : void
    {
        $this->selectedCategory = $category;
        $this->dispatch('open-modal', 'edit-category');
    }

    public function saveCategory() : void
    {
        $this->validate([
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:100',
        ]);
        Category::create([
            'name' => $this->name,
            'description' => $this->description
        ]);
        $this->reset('name', 'description');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Created!']);
    }

    public function updateCategory() : void
    {
        $this->dispatch('close-modal');
        $this->validate([
            'selectedCategory.name' => 'required|string|max:50',
            'selectedCategory.description' => 'nullable|string|max:100',
        ]);
        Category::where('id',$this->selectedCategory['id'])->update([
            'name' => $this->selectedCategory['name'],
            'description' => $this->selectedCategory['description']
        ]);
        $this->reset('selectedCategory');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Updated!']);
    }

    public function deleteCategory(array $category) : void
    {
        $this->selectedCategory = $category;
        $this->dispatch('open-modal', 'delete-category');
    }

    public function destroyCategory() : void
    {
        Category::where('id',$this->selectedCategory)->delete();
        $this->reset('selectedCategory');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Deleted!']);

    }

    public function clearForm(): void
    {
        $this->reset('name', 'description');
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
                $this->sortDirection = 'asc';
            }
            $this->sortField = $field;
        }
    }
}
