<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contacts = DB::table('contacts')->paginate(6);
        return view('contacts.index', ['contacts' => $contacts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreContactRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateContactRequest  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }

    /**
     * Search the specified resource from storage.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $search_text = $request->input('query');
        $contacts = DB::table('contacts')
            ->where('name', 'LIKE', '%' . $search_text . '%')
            ->paginate(6);

        if(!$search_text)
            $contacts = DB::table('contacts')->paginate(6);
            
        return view('contacts.index', ['contacts' => $contacts]);
    }

    public function addContact(Request $request)
    {

        $name = $request->input('name');

        $phone = $request->input('phone');
        $phone0 = $request->input('phone0');
        $phone1 = $request->input('phone1');

        $email = $request->input('email');
        $email0 = $request->input('email0');
        $email1 = $request->input('email1');

        $contactCheck = DB::table('contacts')->where('name', $name)->exists();
        if($contactCheck)
            return response()->json([
                'status' => 401,
                'message' => 'Contact is already Exsists!'
            ]);

        $contact = new Contact();
        $contact->name = $name;
        $contact->save();
        
        function phoneStausCheck($phone, $contact){
            if($phone)
                if(DB::table('phones')->where('phone', $phone)->exists())
                    return response()->json([
                        'status' => 401,
                        'message' => 'Contact '.$phone.' is already Exsists!'
                    ]);
                else
                    DB::table('phones')->insert([
                        'contact_id' => $contact->id,
                        'phone' => $phone , 
                    ]);
        } 

        phoneStausCheck($phone, $contact);
        phoneStausCheck($phone0, $contact);
        phoneStausCheck($phone1, $contact);

        function emailStausCheck($email, $contact){
            if($email)
                if(DB::table('emails')->where('email', $email)->exists())
                    return response()->json([
                        'status' => 401,
                        'message' => 'Contact with: '.$email.' email is already Exsists!'
                    ]);
                else
                    DB::table('emails')->insert([
                        'contact_id' => $contact->id,
                        'email' => $email, 
                    ]);
        } 

        emailStausCheck($email, $contact);
        emailStausCheck($email0, $contact);
        emailStausCheck($email1, $contact);

        return response()->json([
            'status' => 200,
            'message' => 'Contact created successfully'
        ]);




      

            
        
    }
}
