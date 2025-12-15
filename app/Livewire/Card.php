<?php

namespace App\Livewire;

use Livewire\Component;

class Card extends Component
{
   public string $author;
    public string $time;
    public string $title;
    public ?string $content = null;
    public ?string $image = null;
    public int $likes = 0;
    public int $comments = 0;

    public function like()
    {
        $this->likes++;
    }

    public function render()
    {
        return view('livewire.card');
    }
}