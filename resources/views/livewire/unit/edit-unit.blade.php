<div>
    <div x-data="{
        prepareOpenEditUnitModal(id){
            $wire.edit(id)
        }
    }"
    x-on:open-edit-unit-modal.window="prepareOpenEditUnitModal($event.detail)">
    <x-simple-form action="updateUnit" x-on:close-modal.window="show = false">
        <x-slot name="form_header">
            Edit Unit Form
        </x-slot>
        <x-slot name="form_body">
            <x-floating-input name="name" type="text" :model="'unitForm.name'" id="name" required=true :label_name="'The Unit Name'" :requiredSymbol=true :showError=true />
        </x-slot>
        <x-slot name="form_action">
            <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                Clear
            </x-secondary-button>
            <x-primary-button wire:submit.attr="disabled" wire:target="updateUnit">
                Submit
            </x-primary-button>
        </x-slot>
    </x-simple-form>
</div>
</div>
