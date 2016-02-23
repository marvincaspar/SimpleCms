<?php
namespace Mc388\SimpleCms\App\Requests\Admin;

use App\Http\Requests\Request;

/**
 * Class ContactRequest
 *
 * @package Mc388\SimpleCms\App\Requests\Admin
 */
class ContactRequest extends Request
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
            'name' => 'required|min:3',
            'street' => 'required|min:3',
            'postal_code' => 'required|min:3',
            'city' => 'required|min:3',
        ];
    }
}
