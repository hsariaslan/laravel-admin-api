<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return $this->user()->can('update_user', $this->user);
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
            'username'              => ['required',Rule::unique('users')->ignore($this->user),'min:5','max:50'],
            'email'                 => ['required',Rule::unique('users')->ignore($this->user),'min:6','max:50','email:rfc,dns,spoof'],
            'password'              => 'required|min:6|max:50|confirmed',
            'password_confirmation' => 'required|same:password',
            'name'                  => 'required|min:3|max:50|alpha',
            'surname'               => 'required|min:3|max:50|alpha',
            'roles'                 => 'required|array|exists:Spatie\Permission\Models\Role,name',
            'permissions'           => 'nullable|array|exists:Spatie\Permission\Models\Permission,name',
        ];
    }
}
