<div>
    <div x-data="{
            prepareOpenEditCategoryModal(id){
                $wire.edit(id)
            }
        }"
        x-on:open-edit-category-modal.window="prepareOpenEditCategoryModal($event.detail)">
        <x-simple-form action="updateCategory" x-on:close-modal.window="show = false">
            <x-slot name="form_header">
                Add Category Form
            </x-slot>
            <x-slot name="form_body">
                <x-floating-input name="name" type="text" :model="'categoryForm.name'" id="name" required=true :label_name="'The Medicine Name'" :requiredSymbol=true :showError=true />
                <x-floating-input name="description" type="text" :model="'categoryForm.description'" id="description" :label_name="'Description Category'" />
            </x-slot>
            <x-slot name="form_action">
                <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                    Clear
                </x-secondary-button>
                <x-primary-button wire:submit.attr="disabled" wire:target="updateCategory">
                    Submit
                </x-primary-button>
            </x-slot>
        </x-simple-form>
    </div>
</div>
