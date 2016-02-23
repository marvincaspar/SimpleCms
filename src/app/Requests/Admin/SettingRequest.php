<?php
namespace Mc388\SimpleCms\App\Requests\Admin;

use App\Http\Requests\Request;

/**
 * Class SettingRequest
 *
 * @package Mc388\SimpleCms\App\Requests\Admin
 */
class SettingRequest extends Request
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
            'website_title' => 'required|min:3',
        ];
    }
}
