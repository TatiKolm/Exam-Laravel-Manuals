<?php

namespace App\Http\Controllers;

use App\Mail\NewComplaint;
use App\Models\Complaint;
use App\Models\Manual;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all()->sortBy('created_at');

        return view('complaints.index', [
            'complaints' => $complaints
        ]);
    }

    public function store(Request $request, Manual $manual)
    {
        

        $request->validate([
            'complaint' => ['required', 'min:3', 'max:255'],
        ]);
        
        $complaint=Complaint::create(
            [
                'manual_id'=> $manual->id,
                'complaint'=> $request -> complaint,
            ]
        );

        Mail::to('laravel-project-seo@yandex.ru')->send(new NewComplaint($complaint));

        return redirect()->route('app.main')->with("success_complaint", "Ваше обращение принято на рассмотрение!");;
    }

    public function changeStatus(Request $request, Complaint $complaint)
    {
        $complaint -> update([
            'status' => $request -> status
        ]);
    }
    public function show($complaintId)
    {
        return view("complaints.show", [
            'complaint' => Complaint::where("id", $complaintId)->first()
        ]);
    }

}
