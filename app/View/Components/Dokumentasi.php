<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Dokumentasi extends Component
{
    public $dokumentasis;

    public function __construct($dokumentasis)
    {
        $this->dokumentasis = $dokumentasis;
    }

    public function render()
    {
        return view('components.dokumentasi');
    }
}
