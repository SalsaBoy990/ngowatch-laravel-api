<?php

namespace App\Http\Livewire\Permission;

use App\Models\Permission;
use App\Support\InteractsWithBanner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Delete extends Component
{
    use InteractsWithBanner;
    use AuthorizesRequests;

    // used by blade / alpinejs
    public string $modalId;
    public bool $isModalOpen;
    public bool $hasSmallButton;

    // inputs
    public int $permissionId;
    public Permission $permission;
    public string $name;


    protected array $rules = [
        'permissionId' => 'required|int|min:1',
    ];

    public function mount(string $modalId, Permission $permission, bool $hasSmallButton = false)
    {
        $this->modalId = $modalId;
        $this->isModalOpen = false;
        $this->hasSmallButton = $hasSmallButton;
        $this->permission = $permission;
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
    }


    public function render()
    {
        return view('livewire.permission.delete');
    }


    public function deletePermission()
    {
        $this->authorize('delete', [Permission::class, $this->permission]);

        // validate user input
        $this->validate();

        // delete role, rollback transaction if fails
        DB::transaction(
            function () {
                $this->permission->delete();
            },
            2
        );


        $this->banner(__('The permission with the name ":name" was successfully deleted.',
            ['name' => htmlspecialchars($this->name)]));
        request()->session()->flash('flash.activeTab', 'Permissions');

        return redirect()->route('role-permission.manage');
    }
}
