<div>
    <x-simple-form action="saveUnit" x-on:close-modal.window="show = false">
        <x-slot name="form_header">
            Add Unit Form
        </x-slot>
        <x-slot name="form_body">
            <x-floating-input name="name" type="text" :model="'unitForm.name'" id="name" required=true :label_name="'The Unit Name'" :requiredSymbol=true :showError=true />
        </x-slot>
        <x-slot name="form_action">
            <x-secondary-button class="mx-4 px-5 py-2.5" wire:click="clearForm"  wire:submit.attr="disabled" wire:target="clearForm">
                Clear
            </x-secondary-button>
            <x-primary-button wire:submit.attr="disabled" wire:target="saveUnit">
                Submit
            </x-primary-button>
        </x-slot>
    </x-simple-form>
</div>
