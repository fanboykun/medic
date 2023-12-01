<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\Category\CategoryForm;
use Livewire\Component;

class AddCategory extends Component
{
    public CategoryForm $categoryForm;

    public function render()
    {
        return view('livewire.category.add-category');
    }

    public function saveCategory()
    {
        if($this->categoryForm->saveCategory()) {
            $this->dispatch('category-created');
            $this->dispatch('close-modal');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Created!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error creating category']);
        }
    }

    public function clearForm()
    {
        $this->categoryForm->clearForm();

    }
}
