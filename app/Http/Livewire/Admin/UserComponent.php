<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function assingRole(User $user, $value){
        if ($value == '1') {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }

    public function render()
    {
        $users = User::where('id', '<>', 1/* auth()->user->email */)
                        ->where(function ($query){
                            $query->where('name', 'like', '%' . $this->search . '%');
                            $query->orWhere('email', 'like', '%' . $this->search . '%');
                        })->paginate();                    

        return view('livewire.admin.user-component', compact('users'))->layout('layouts.admin');
    }
}
