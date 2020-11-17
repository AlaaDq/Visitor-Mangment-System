<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // auth()->user()->assignRole('receptionist'); //worked
        // auth()->user()->assignRole('admin'); //worked
        
        $departments=Department::all();
        $employees=Employee::where('department_id',3)->get();
        return view('home',['departments'=>$departments,'employees'=>$employees]);
    }
}
