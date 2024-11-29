<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class Breadcumb extends Component
{
    public array $values;
    public array $routes;
    /**
     * Create a new component instance.
     */
    public function __construct(array $values = [], array $routes = [])
    {
        $this->values = $values;
        $this->routes = $routes;
    }

    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function render(): View|Closure|string
    {
        return view('components.breadcumb');
    }
}
