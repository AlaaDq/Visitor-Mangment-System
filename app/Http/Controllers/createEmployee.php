<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class createEmployee extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
               
        //this is not part of the task so it was done in dirty way
        Employee::create([
            'department_id'=>$request['department_id'],
            'full_name'=>$request['full_name'],
            'username'=>$request['username'],
            'address'=>$request['address'],
            'password'=>Hash::make($request['password']),
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id
        ]);

        
        return redirect()->route('home');

    }
}
