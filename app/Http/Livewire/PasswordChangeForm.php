<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\UpdateUserPassword;
use App\Models\User;
use Livewire\Component;

class PasswordChangeForm extends Component
{
    public $password, $current_password, $confirm_password;

    public function render()
    {
        return view('livewire.profile.password-change-form');
    }

   
    public function updatePassword()
    {
        dd($this->current_password);
        if ($this->current_password != Auth()->user()->password ) {
            $this->emit('update-error', "Invalid Current password");
            
        }

        $user = User::find(Auth()->user()->id);
        
        if ($this->password != $this->confirm_password ) {

            validator([$this->state['password']],
            $rules = ['password' => "confirm|min:8"],
            $messages = ['password.confirm' => 'The email must be unique',
                         'password.min' => 'The email must be real',
            ]);
        }
        
        // $this->validate($rules, $messages);
        $user->update($this->state);


        $this->emit('user-updated', "The Password has been updated successfully!");

    }

    public function updatePass(UpdateUserPassword $updateUserPassword)
    {

    }



}
