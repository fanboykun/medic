<div>
    <div x-data="{
            prepareOpenEditSupplierModal(id){
                $wire.edit(id)
            }
        }"
        x-on:open-edit-supplier-modal.window="prepareOpenEditSupplierModal($event.detail)">
        <x-simple-form action="updateSupplier" x-on:close-modal.window="show = false">
            <x-slot name="form_header">
                Edit Supplier Form
            </x-slot>
            <x-slot name="form_body">
                <x-floating-input name="name" type="text" :model="'supplierForm.name'" id="name" required=true :label_name="'The Supplier Name'" :requiredSymbol=true :showError=true />
                <x-floating-input name="address" type="text" :model="'supplierForm.address'" id="address" :label_name="'Address Supplier'" />
                <x-floating-input name="phone" type="text" :model="'supplierForm.phone'" id="phone" :label_name="'Phone Supplier'" />
            </x-slot>
            <x-slot name="form_action">
                <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                    Clear
                </x-secondary-button>
                <x-primary-button wire:submit.attr="disabled" wire:target="updateSupplier">
                    Submit
                </x-primary-button>
            </x-slot>
        </x-simple-form>
    </div>
</div>
