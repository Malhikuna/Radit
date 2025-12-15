<div>
    <form wire:submit.prevent="register">
        <input type="text" wire:model="name" placeholder="Nama">
        <input type="email" wire:model="email" placeholder="Email">
        <input type="password" wire:model="password" placeholder="Password">
        <button type="submit">Register</button>
    </form>
</div>
