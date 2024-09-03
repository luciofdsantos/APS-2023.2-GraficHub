<?php

namespace App\View\Components\Projeto;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalShowComments extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $project)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projeto.modal-show-comments');
    }
}
