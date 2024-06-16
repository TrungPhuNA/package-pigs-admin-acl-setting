<?php

namespace Pigs\AdminAclSetting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmAclAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'phone'       => 'required',
            'email'        => 'required|unique:users,email,'.$this->id,
        ];
    }
}
