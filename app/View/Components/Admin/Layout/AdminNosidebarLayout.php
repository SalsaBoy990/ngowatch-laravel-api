<?php

namespace App\View\Components\Admin\Layout;

use Illuminate\View\Component;

class AdminNosidebarLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.admin-nosidebar');
    }
}

