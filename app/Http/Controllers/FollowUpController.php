<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\FollowUp;
use Illuminate\Http\Request;

class FollowUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        $client->load('followUps');
        return view('clients.followups.index',compact('client'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'subject'=>'required|max:255',
            'follow_up_date'=>'required|date'
        ]);
        $client->followUps()->create([
            'subject'=>$request->subject,
            'description'=>$request->description,
            'follow_up_date'=>$request->follow_up_date,
            'status'=>$request->status,
            'user_id'=>auth()->id()
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FollowUp $followUp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FollowUp $followUp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FollowUp $followUp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FollowUp $followUp)
    {
        //
    }
}
