<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Toast extends Component
{
    public bool $show = false;
    public string $message = '';
    public string $type = 'success';

    #[On('showToast')]
    public function showToast(string $type, string $message): void
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;

        $this->dispatch('toast-shown');
    }

    public function hideToast(): void
    {
        $this->show = false;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.toast');
    }
}