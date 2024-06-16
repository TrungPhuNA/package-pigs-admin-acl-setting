<?php

namespace Pigs\AdminAclSetting\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdmAclSettingEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'mail_driver'       => 'required',
            'mail_port'         => 'required',
            'mail_host'         => 'required',
            'mail_username'     => 'required',
            'mail_password'     => 'required',
            'mail_domain'       => 'required',
            'mail_from_address' => 'required',
        ];
    }
}
