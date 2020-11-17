<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class getDepartmentEmployees extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
    
        //i prefered to used short time caching here
        $employees=Employee::where('department_id',$request['department_id'])->get();
        
        $html='<option value="">Select Employee </option>';
        
        foreach ($employees as $employee) {
            $html .= '<option value="'.$employee->id.'">'.$employee->username.'</option>';
        }
        
        
        return response()->json(['html'=>$html]);
        
    }
}
