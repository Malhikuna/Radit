@props(['id', 'name', 'value' => ''])

<input
    type="hidden"
    name="{{ $name }}"
    id="{{ $id }}_input"
    value="{{ $value }}"
    wire:model.defer="{{ $name }}"
/>

<trix-toolbar
    class="
        [&_.trix-button]:bg-white
        [&_.trix-button.trix-active]:bg-gray-300
        dark:[&_.trix-button]:bg-gray-800
        dark:[&_.trix-button]:border-gray-700
        dark:[&_.trix-button.trix-active]:bg-gray-700
    "
    id="{{ $id }}_toolbar"
></trix-toolbar>

<trix-editor
    id="{{ $id }}"
    toolbar="{{ $id }}_toolbar"
    input="{{ $id }}_input"
    class="
        trix-content
        rounded-xl min-h-37.5
        
        border border-gray-300
        bg-white text-gray-800
        
        dark:bg-gray-800   
        dark:text-gray-100 
        dark:border-gray-700
        
        focus:outline-none focus:ring-1 focus:ring-purple-500 dark:focus:ring-white
    "
></trix-editor>

<script>
    document.addEventListener('trix-change', function(event) {
        if (event.target.id === '{{ $id }}') {
            const content = event.target.innerHTML;
            @this.set('{{ $name }}', content);
        }
    });
</script>