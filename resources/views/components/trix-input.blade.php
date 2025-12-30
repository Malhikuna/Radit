@props(['id', 'name', 'value' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
    wire:model.defer="{{ $name }}"
/>

<trix-toolbar
    class="[&_.trix-button]:bg-white [&_.trix-button.trix-active]:bg-gray-300"
    id="{{ $id }}_toolbar"
></trix-toolbar>

<trix-editor
    id="{{ $id }}"
    toolbar="{{ $id }}_toolbar"
    input="{{ $id }}_input"
    class="trix-content border-gray-300 ..."
></trix-editor>
<script>
    document.addEventListener('trix-change', function(event) {
        if (event.target.id === '{{ $id }}') {
            const content = event.target.innerHTML;
            @this.set('{{ $name }}', content);
        }
    });
</script>