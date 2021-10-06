<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LeadController extends Controller
{
    private $validations;

    public function __construct()
    {
        $this->validations = [
            'immatriculation' => 'required',
            'hcnumber' => 'required',
            'marque' => 'required',
            'chassisNumber' => 'required',
            'username' => 'required',
            'transportCabine' => 'required',
            'dateAchat' => 'required',
            'assuranceD' => 'required',
            'assuranceF' => 'required',
            'cartegriseD' => 'required',
            'cartegriseF' => 'required',
            'visitetechniqueD' => 'required',
            'visitetechniqueF' => 'required',
        ];
    }

    public function index(Request $request)
    {
        $package = null;
        $search = false;
        if ($request->has('package_search') && $request->input('package_search') != 0) {
            $package = Package::findOrFail($request->input('package_search'));
        }
        if ($request->has('search') && $request->input('search') !== '') {
            $search = true;
        }

        $leads = Lead::query()
            ->when($search, function ($query) use ($request) {
                $query->where('immatriculation', 'like', "%{$request->input('search')}%")
                    ->orWhere('hcnumber', 'like', "%{$request->input('search')}%");
            })
            ->orderByDesc('id')
            ->paginate(10);

        return Inertia::render('Leads/Index', [
            'leads' => $leads,
        ]);
    }

    public function create()
    {
        $packages = Package::query()
            ->where('status', 'active')
            ->orderByDesc('id')
            ->get();

        return Inertia::render('Leads/LeadAdd', [
            'packages' => $packages,
        ]);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, $this->validations);


        $dateAchat = Carbon::parse($postData['dateAchat']);
        $assuranceD = Carbon::parse($postData['assuranceD']);
        $cartegriseD = Carbon::parse($postData['cartegriseD']);
        $cartegriseF = Carbon::parse($postData['cartegriseF']);
        $visitetechniqueD = Carbon::parse($postData['visitetechniqueD']);
        $visitetechniqueF = Carbon::parse($postData['visitetechniqueF']);
        $assuranceF = Carbon::parse($postData['assuranceF']);



        Lead::create([
            /*'name'        => $postData['name'],
            'email'      => $postData['email'],
            'dob'         => $dob,
            'phone'         => $postData['phone'],
            'branch_id'       => 1,
            'age'            => $age,
            'added_by'           => Auth::user()->id,
            'interested_package'       => $package,*/

            'immatriculation' => $postData['immatriculation'],
            'hcnumber'=> $postData['hcnumber'],
            'marque' => $postData['marque'],
            'chassisNumber'=> $postData['chassisNumber'],
            'username'=> $postData['username'],
            'transportCabine'=> $postData['transportCabine'],
            'dateAchat'=> $postData['dateAchat'],
            'assuranceD'=> $postData['assuranceD'],
            'assuranceF'=> $postData['assuranceF'],
            'cartegriseD'=> $postData['cartegriseD'],
            'cartegriseF'=> $postData['cartegriseF'],
            'visitetechniqueD'=> $postData['visitetechniqueD'],
            'visitetechniqueF'=> $postData['visitetechniqueF'],
        ]);

        return redirect()->route('lead.list');
    }

    public function view(Lead $lead)
    {
        $lead->load(['reminders']);

        $packages = Package::query()
            ->where('status', 'active')
            ->orderByDesc('id')
            ->get();

        return Inertia::render('Leads/LeadView', [
            'lead-prop' => $lead,
            'packages' => $packages,
        ]);
    }

    public function update(Request $request)
    {
        $rules = $this->validations;
        $rules['id'] = 'required|exists:leads';

        $postData = $this->validate($request, $rules);

        $lead = Lead::where('id', $postData['id'])
            ->update($postData);

        return redirect()
            ->route('lead.view', ['lead' => $postData['id']])
            ->with('success', 'Your changes are saved now.');
    }
}
