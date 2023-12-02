<?php

namespace App\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category;


    #[Locked]
    public int|null $categoryId;        // uss this for selecting or manipulating existing data

    #[Validate('required', message: 'Please enter the category name')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for name, max character is 255 character')]
    public string|null $name;

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for description, max character is 255 character')]
    public string|null $description;

    public function saveCategory() : bool
    {
        $this->validate();
        try {
            Category::create([
                'name' => $this->name,
                'description' => $this->description
            ]);
            $this->reset('name', 'description');
            return true;
        }catch (\Exception $e) {
            return false;
            // throw($e);
        }
    }

    public function clearForm(): void
    {
        $this->reset('name', 'description');
    }

    public function fillInput(Category $category): true
    {
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description;
        return true;
    }

    public function updateCategory()
    {
        $this->validate();
        try {
            Category::where('id',$this->categoryId)->update([
                'name' => $this->name,
                'description' => $this->description
            ]);
            return true;
        } catch(\Exception $e) {
            return false;
        }
        $this->reset();

    }

}
