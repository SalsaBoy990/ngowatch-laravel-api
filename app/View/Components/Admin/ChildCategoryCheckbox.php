<?php

namespace App\View\Components\Admin;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChildCategoryCheckbox extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Category $childCategory, public array $postCategoryIds, public bool $postExists)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.child-category-checkbox');
    }
}
