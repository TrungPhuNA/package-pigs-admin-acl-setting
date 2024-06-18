<?php

namespace Pigs\AdminAclSetting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmAclTagRequest extends FormRequest
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
            'status'       => 'required',
            'name'        => 'required|unique:tags,name,'.$this->id,
        ];
    }
}
