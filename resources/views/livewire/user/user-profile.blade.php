<div>
    <x-slot name="header">
        Profile
    </x-slot>
    @include('profile.edit', ['user' => Auth::user()])
</div>
