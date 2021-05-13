<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class ContactController extends Controller
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

    public function index(Request $request)
    {
        $order = $request->input('order', 'asc');

        $search = $request->input('search');
        if($search){
            $loggedId = Auth::user()->id;

            $data = Contact::where('user_uuid', $loggedId)->orderBy('name', $order)->where('name', 'like', '%'.$search.'%')->get();

            return view('home', ['data' => $data, "userStatus" => Auth::user(), "order" => $order]);
        }

        $loggedId = Auth::user()->id;

        $data = Contact::where('user_uuid', $loggedId)->orderBy('name', $order)->get();

        return view('home', ['data' => $data, "userStatus" => Auth::user(), "order" => $order]);

    }

    public function store(Request $request)
    {

        $data = $request->only([
            'name',
            'phone',
            'description'
        ]);
        $bars = array("(", ")", "-", " ");
        $clean   = array("", "", "", "");
        $data['phone'] = intval(str_replace($bars, $clean, $data['phone']));

        $validator = $this->validator($data);
        if($validator->fails()){
            return redirect()->route('home')->withErrors($validator)->withInput();
        }

        $contact = $this->create($data);
        return redirect()->route('home',);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'integer','digits_between:10,11'],
            'description' => ['nullable','string', 'max:250'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $loggedId = Auth::user()->id;

        return Contact::create([
            'id' => Str::uuid(),
            'name' => $data['name'],
            'phone' => $data['phone'],
            'description' => $data['description'],
            'user_uuid' => $loggedId,
        ]);
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        if($contact){
            return view('edit', ['contact' => $contact, "userStatus" => Auth::user()]);
        }
        return redirect()->route('home');
                                                        
    }    

    public function update(Request $request, $id)
    {
        $loggedId = Auth::user()->id;
        $contact = Contact::find($id);
        if($contact){
            $data = $request->only([
                'name',
                'phone',
                'description'
            ]);
            $bars = array("(", ")", "-", " ");
            $clean = array("", "", "", "");
            $data['phone'] = intval(str_replace($bars, $clean, $data['phone']));

            $validator = Validator::make([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ],  [
                'name' => ['required', 'string', 'max:100'],
                'phone' => ['required', 'integer','digits_between:10,11'],
            ]);

            $contact->name = $data['name'];
            $contact->phone = $data['phone'];
            $contact->description = $data['description'];


            if(count($validator->errors()) > 0){
                return redirect()->route('contact.edit', [
                    'contact' => $id
                ])->withErrors($validator);
            }

            $contact->save();
        }

        return redirect()->route('home');

    }
    
    public function destroy($id)
    {
        //$contact = Contact::where('id', $id)->delete();
        $contact = Contact::find($id);
        $contact->delete();

        return redirect()->route('home');
    }
}
