<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Sale extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth()->user()->status == 'LOCKED' ){
            return false;
        } else {
            return true;
        }
            
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' => 'min:16|max:16',
            'card_owner' => 'regex:/^[\pL\s\-]+$/u',
            'cvv' => 'min:3|max:4'
        ];
    }
}
