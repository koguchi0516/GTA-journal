<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PsidValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'change-psid' => [new Psid],
        ];
    }
    
    public function message(){
        return [];
    }
}
