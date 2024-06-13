<?php

namespace Pigs\AdminAclSetting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmAclPermissionRequest extends FormRequest
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
            'description' => 'required',
            'group'       => 'required',
            'name'        => 'required|unique:permissions,name,'.$this->id,
        ];
    }
}
