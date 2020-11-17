<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;

class deleteVisitor extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Visitor $visitor)
    {   
        $visitor->update(['deleted_by'=>auth()->user()->id]);
        $visitor->visits()->each(function($visit) {
            $visit->delete(); 
         });
        $visitor->delete();

        //use forceDelete() to delete it in none soft delete way
        session()->flash('message', 'visitor has been deleted with all his visits');
        return redirect('/visits');
    }
}

