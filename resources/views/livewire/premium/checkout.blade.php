<div class="mt-10 flex justify-center">
    <button 
        wire:click="pay" 
        wire:loading.attr="disabled" 
        class="px-4 py-2 bg-green-500 text-white text-center rounded-2xl cursor-pointer hover:bg-green-600 transition-colors duration-200"
    >
        Bayar Sekarang
    </button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="..."></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('start-payment', (event) => {
            if (!event.token) {
                alert('Token pembayaran tidak tersedia!');
                return;
            }

            window.snap.pay(event.token, {
                onSuccess: function(result) { alert('Sukses!'); },
                onPending: function(result) { alert('Pending!'); },
                onError: function(result) { alert('Error!'); }
            });
        });
    });
</script>
