<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
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

    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    protected array $sortableField = ['name', 'created_at'];

    #[On('category-created')]
    public function render() : View
    {
        $categories = Category::where('name', 'like', '%'.$this->search.'%')
        ->orderBy($this->sortField ?? 'created_at', $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.category.index-category', ['categories' => $categories]);
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
        $this->dispatch('close-modal');
        $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Deleted!']);

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
