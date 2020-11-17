<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;

class restoreVisitor extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($visitor_id)
    {   
        $visitor=Visitor::where("national_id",$visitor_id)->withTrashed()->first();
        $visitor->update(['deleted_by'=>null]);
        $visitor->restore();
        $visitor->trashedVisits()->each(function($visit) {
            $visit->restore(); 
         });

        session()->flash('message', 'visitor has been restored with all his trashed visits');
        return redirect('/visits');
    }
}
