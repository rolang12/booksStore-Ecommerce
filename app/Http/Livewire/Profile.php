<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $image;

    public function render()
    {
           
        $title_page = "Profile Settings";

        return view('livewire.profile.profile-form')
             ->extends('layouts.theme.app',compact('title_page'))->section('content');
    }

    public function updateImageProfile()
    {
        
        $user = User::find(Auth()->user()->id);

            $customFileName;
        if ($this->image) 
        {
            $customFileName = uniqid() .'_.' . $this->image->extension();
            $this->image->storeAs('public/users', $customFileName);
            $imageTemp = $user->image;

            $user->image = $customFileName;
            $user->save();

            if ($imageTemp != null) {
                if (file_exists('storage/users/'. $imageTemp)) {
                    unlink('storage/users/'. $imageTemp);
                }
            }


        }

        $this-> resetUI();
        $this->emit('user-updated', "Profile image updated successfully!");
    }

    public function resetUI()
    {
        $this->image = null;
    }


}
