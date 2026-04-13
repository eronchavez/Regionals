<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
use App\Models\Owner;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    //

    public function index()
    {
        $companies = Company::all();

        return view('companies.index',compact('companies'));
    }

    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    public function create()
    {
       return view('companies.create');
    }

    public function store(Request $req, Company $company)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'address' => 'required',
            'owner_name' => 'required',
            'owner_mobile' => 'required',
            'owner_email' => 'required|email',
            'contact_name' => 'required',
            'contact_mobile' => 'required',
            'contact_email' => 'required|email',

        ]);


        $company = new Company();
        $company->name = $req->name;
        $company->address = $req->address;
        $company->telephone = $req->telephone;
        $company->email = $req->email;
        


        $owner = new Owner();
        $owner->name = $req->owner_name;
        $owner->number = $req->owner_mobile;
        $owner->email = $req->owner_email;
        $owner->save();

        $contact = new Contact();
        $contact->name = $req->contact_name;
        $contact->number = $req->contact_mobile;
        $contact->email = $req->contact_email;
        $contact->save();

        $company->contact_id = $contact->id;
        $company->owner_id = $owner->id;

        $company->save();

       return redirect('/companies')->with('success', 'Company successfully added!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

     public function update(Request $req, Company $company)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'address' => 'required',
            'owner_name' => 'required',
            'owner_mobile' => 'required',
            'owner_email' => 'required|email',
            'contact_name' => 'required',
            'contact_mobile' => 'required',
            'contact_email' => 'required|email',

        ]);


    
        $company->name = $req->name;
        $company->address = $req->address;
        $company->telephone = $req->telephone;
        $company->email = $req->email;
       


        $owner = $company->owner;
        $owner->name = $req->owner_name;
        $owner->number = $req->owner_mobile;
        $owner->email = $req->owner_email;
        $owner->save();

        $contact = $company->contact;
        $contact->name = $req->contact_name;
        $contact->number = $req->contact_mobile;
        $contact->email = $req->contact_email;
        $contact->save();

        $company->contact_id = $contact->id;
        $company->owner_id = $owner->id;

        $company->save();

       return redirect('/companies')->with('success', 'Company successfully updated!');
    }

    public function deactivate(Company $company)
    {   
        $company->active = 0;
        $company->products()->update(['hidden' => 1]);
        $company->save();

        return redirect('/companies')->with('success', 'Company deactivated!');
    }
}
