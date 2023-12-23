<div>
    <x-simple-form action="saveSupplier" x-on:close-modal.window="show = false">
        <x-slot name="form_header">
            Add Supplier Form
        </x-slot>
        <x-slot name="form_body">
            <x-floating-input name="name" type="text" :model="'supplierForm.name'" id="name" required=true :label_name="'The Medicine Name'" :requiredSymbol=true :showError=true />
            <x-floating-input name="address" type="text" :model="'supplierForm.address'" id="address" :label_name="'Address of Supplier'" />
            <x-floating-input name="phone" type="number" :model="'supplierForm.phone'" id="phone" :label_name="'Phone of Supplier'" />
        </x-slot>
        <x-slot name="form_action">
            <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                Clear
            </x-secondary-button>
            <x-primary-button wire:submit.attr="disabled" wire:target="saveSupplier">
                Submit
            </x-primary-button>
        </x-slot>
    </x-simple-form>
</div>
