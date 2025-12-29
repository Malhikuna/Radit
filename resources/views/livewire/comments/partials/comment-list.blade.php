<div class="space-y-3">
    @foreach ($comments as $comment)
        @include('livewire.comments.partials.comment', [
            'comment' => $comment,
            'level' => $level
        ])
    @endforeach
</div>
