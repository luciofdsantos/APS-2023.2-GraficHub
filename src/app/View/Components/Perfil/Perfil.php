<?php

namespace App\View\Components\Perfil;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Perfil extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $user, public $projects, public $favoritos)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.perfil.perfil');
    }
}
