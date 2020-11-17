<?php

namespace App\Http\Requests;

use App\Visit;
use App\Visitor;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitInfoRequest extends FormRequest
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
        //my mysql is running on 32-bit so i can not used  digits:11 validtion for national_id
        //unique:visitors,national_id // iused firstorcreate
        return [
           'national_id'=>'bail|required|numeric|digits:9',
           'first_name'=>'required|string',
           'last_name'=>'required|string',
           'purpose'=>'required|string',
           'department_id'=>'required',
           'employee_id'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'national_id.required' => 'Please enter your national id.',
            'department_id.required' => 'You must choose a department to visit.',
            'employee_id.required' => 'You must choose an employee to visit.',
        ];
    }

    public function storeVisitInfo(){

        Visitor::firstOrCreate(['national_id'=>$this->national_id],
                               ['first_name'=>$this->first_name,
                                'last_name'=>$this->last_name]);
   
        Visit::create([
            'purpose'=>$this->purpose,
            'department_id'=>$this->department_id,
            'employee_id'=>$this->employee_id,
            'visitor_id'=>$this->national_id,
        ]);
    }
}
