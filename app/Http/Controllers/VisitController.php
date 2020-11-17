<?php

namespace App\Http\Controllers;

use App\Department;
use App\Visit;
use App\Visitor;
use App\Employee;
use App\Http\Requests\StoreVisitInfoRequest;
use App\Http\Requests\UpdateVisitInfoRequest;
use Illuminate\Http\Request;


class VisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin')->only(['edit','restore','destroy','update']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasRole('admin'))
        return view('visit.index',['visits' => Visit::with(['visitor','employee:id,username','department:id,title'])->get()]);
        else
        return view('visit.index',
        ['visits' => Visit::with(['visitor','employee:id,username','department:id,title'])->get(), 
        'trashedVisits' => Visit::onlyTrashed()->with('trashedVisitor')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('visit.create',['departments'=>Department::select('title','id')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitInfoRequest $request)
    {

        $request->storeVisitInfo();

        return redirect('/visits');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        return view('visit.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        $visit=Visit::with('employee','visitor','department')->where('id',$visit->id)->first();
        $departments=Department::select('title','id')->get();
        return view('visit.edit', compact(['visit','departments']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitInfoRequest $request, Visit $visit)
    {
        $request->updateVisitInfo($visit);
        session()->flash('message', 'the visit has been updated.');

        return redirect('/visits');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        $visit->update(['deleted_by'=>auth()->user()->id]);
        $visit->delete();
        session()->flash('message', 'the visit has been deleted.');
        return redirect('/visits');
    }

    public function restore($visit_id){
        //use forceDelete() to delete it in none soft delete way

        $visit=Visit::where("id",$visit_id)->withTrashed()->first();
        if(Visitor::where('national_id',$visit->visitor_id)->first())
        {$visit->update(['deleted_by'=>null]);
        $visit->restore();}
        else
        session()->flash('message', 'you cant restore a visit for a visitor is not exiest.');
        return redirect('/visits');
    }


}
