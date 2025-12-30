<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Layout;

class UserManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $roleFilter = '';
    public $isModalOpen = false;
    public $userId;
    public $selectedRole;

    #[Layout('layouts.admin')]
    public function render()
    {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        // Note: For prototype, not implementing complex role filtering on query to save time
        // In real app: $query->role($this->roleFilter)

        return view('livewire.user-management', [
            'users' => $query->latest()->paginate(10),
            'roles' => Role::all(),
        ]);
    }

    public function editRole($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->selectedRole = $user->roles->first()?->name ?? 'user';
        $this->isModalOpen = true;
    }

    public function updateRole()
    {
        $user = User::findOrFail($this->userId);
        
        // Remove all roles and assign new one (Simplified for prototype)
        $user->syncRoles([$this->selectedRole]);

        $this->isModalOpen = false;
        session()->flash('message', 'User role updated successfully.');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted.');
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
}
