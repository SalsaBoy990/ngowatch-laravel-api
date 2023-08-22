<?php

namespace App\View\Components\Public;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeaderProfile extends Component
{

    public string $handler;
    public int $userId;

    /**
     * Create a new component instance.
     */
    public function __construct(string $handler, string $userId)
    {
        $this->handler = $handler;
        $this->userId = intval($userId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.public.header-profile');
    }
}
