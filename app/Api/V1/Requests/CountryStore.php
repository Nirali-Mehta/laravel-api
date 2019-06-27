<?php 
 namespace App\Api\V1\Requests;
use Dingo\Api\Http\FormRequest;
class CountryStore extends FormRequest
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
            'name'=>'required|unique:countries|max:255',
		    'short_code'=>'required|unique:countries|max:10',
        ];
        // $request = new Request();
        // $this->validate($request, $rules, $customMessages);  
    }

    public function messages()
    {
        return ['required' => 'The :attribute field is required.',
        'unique' => ':attribute is not unique',];
    }
}