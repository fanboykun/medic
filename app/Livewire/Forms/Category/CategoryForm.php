<?php

namespace App\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category;

    #[Validate('required', message: 'Please enter the category name')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for name, max character is 255 character')]
    public string $name = '';

    #[Validate('nullable')]
    #[Validate('string', message: 'Only accepts string')]
    #[Validate('max:250', message: 'too much character for description, max character is 255 character')]
    public string $description = '';

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

}
