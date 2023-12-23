<?php

namespace App\Livewire\Category;

use App\Livewire\Forms\Category\CategoryForm;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddCategory extends Component
{
    public CategoryForm $categoryForm;

    public function render() : View
    {
        return view('livewire.category.add-category');
    }

    public function saveCategory() : void
    {
        if($this->categoryForm->saveCategory()) {
            $this->dispatch('category-created');
            $this->dispatch('close-modal');
            $this->dispatch('notify', ['status' => 'success', 'message' => 'Category Has Been Created!']);
        }else {
            $this->dispatch('notify', ['status' => 'error', 'message' => 'Error creating category']);
        }
    }

    public function clearForm() : void
    {
        $this->categoryForm->clearForm();

    }
}
