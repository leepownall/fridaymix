<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use function now;
use function str;

class Track extends Component
{
    public function render()
    {
        return view('livewire.track');
    }
}
