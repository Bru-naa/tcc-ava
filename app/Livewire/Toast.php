<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Toast extends Component
{
    public $show = false;
    public $message = '';
    public $type = 'success'; // success ou error

    protected $listeners = ['showToast'];

    // Listener chamado via emit
    public function showToast($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;

        // Desaparece sozinho depois de 3s
        $this->dispatchBrowserEvent('toast-shown');

        $this->emitSelf('hideToastAfterDelay');
    }

    public function hideToastAfterDelay()
    {
        sleep(3); // espera 3s
        $this->show = false;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.toast');
    }
}
