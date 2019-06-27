<?php 
 namespace App\Api\V1\Requests;
use Dingo\Api\Http\FormRequest;
class BranchStore extends FormRequest
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
            'name'=>'required|unique:branches|max:255',
            'slug'=>'required|unique:branches|max:255',
            'email' => 'required|unique:branches',
            'branch_type_id'=> 'required',
            'company_id'=>'required',
            'mobile'=>'required|unique:branches',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required', 
        ];
    }

    public function messages()
    {
        return ['required' => 'The :attribute field is required.',
        'unique' => ':attribute is not unique',];
    }
}