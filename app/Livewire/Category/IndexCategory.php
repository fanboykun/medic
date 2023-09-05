<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
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

    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')
        ->latest()->paginate($this->perPage);

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
    }

    public function updateCategory() : void
    {
        $this->validate([
            'selectedCategory.name' => 'required|string|max:50',
            'selectedCategory.description' => 'nullable|string|max:100',
        ]);
        Category::where('id',$this->selectedCategory['id'])->update([
            'name' => $this->selectedCategory['name'],
            'description' => $this->selectedCategory['description']
        ]);
        $this->reset('selectedCategory');
        $this->dispatch('close');

    }

    public function deleteCategory(array $category) : void
    {
        $this->selectedCategory = $category;
        $this->dispatch('open-modal', 'delete-category');
    }

    public function destroyCategory() : void
    {
        Category::where('id',$this->selectedCategory)->delete();
        $this->dispatch('close');
        $this->reset('selectedCategory');
    }

    public function clearForm(): void
    {
        $this->reset('name', 'description');
    }
}
