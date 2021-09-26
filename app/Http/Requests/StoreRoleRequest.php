<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name'          => 'required|min:3|max:50|alpha_dash',
            'display_name'  => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
            'color'         => 'required|size:6|alpha_num',
            'permissions'   => 'required|array|exists:Spatie\Permission\Models\Permission,name',
        ];
    }
}
