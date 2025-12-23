<div class="mt-10">
    <button wire:click="pay" wire:loading.attr="disabled" class="px-4 bg-green-500 text-white text-center py-1 rounded-2xl cursor-pointer">
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="..."></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('start-payment', (event) => {
            window.snap.pay(event.token, {
                onSuccess: function(result){ alert('Sukses!'); },
                onPending: function(result){ alert('Pending!'); },
                onError: function(result){ alert('Error!'); }
            });
        });
    });
</script>