<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use DB;

class ContactController extends Controller
{
    public function index()
    {
       
       return DB::select('CALL SelectContact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $first_name = $request->input('first_name');
        // $last_name = $request->input('last_name');
        // $email = $request->input('email');
        // $phone = $request->input('phone');
        // $address = $request->input('address');
         $contact = new Contact();
        $contact->create($request->all());
        //  DB::insert('Call InsertContact(?,?,?,?,?)',array($request->all()));
         
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
