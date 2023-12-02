<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\Category\CategoryForm;
use App\Models\Category;
use Livewire\Component;

class EditCategory extends Component
{
    // public ?Category $category;     // no need mount funtion, since no relationship data required in this action
    public CategoryForm $categoryForm;

    public function edit( ?Category $category )
    {
        if($this->categoryForm->fillInput($category)) {
            $this->dispatch('open-modal', 'edit-category');
        }
    }

    public function render()
    {
        return view('livewire.category.edit-category');
    }

    public function updateCategory()
    {
        if($this->categoryForm->updateCategory()) {
            $this->dispatch('close-modal');
            $this->dispatch('category-updated');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Updated!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error Updating Category!']);
        }
    }
}
