<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class createDepartment extends Controller
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
        Department::create([
            'title'=>$request['title'],
            'created_by'=>auth()->user()->id,
            'updated_by'=>auth()->user()->id
        ]);

   
        return redirect()->route('home');
                        
    }
}
