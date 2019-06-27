<?php 
 namespace App\Api\V1\Requests;
use Dingo\Api\Http\FormRequest;

class BranchUpdate extends FormRequest
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
            'name'=>'unique:branches|max:255',
            'email' => 'unique:branches',
            'mobile'=>'unique:branches',
        ];
    }

    public function messages()
    {
        return ['required' => 'The :attribute field is required.',
        'unique' => ':attribute is not unique',];
    }
}