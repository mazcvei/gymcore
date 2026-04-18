<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Models\Membership;
use App\Models\MembershipPlan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(MembershipPlan $membershipplan)
    {
        return view('payments.create', compact('membershipplan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request, MembershipPlan $membershipplan)
    {
        $userMembership = Membership::where('user_id', auth()->id())->first(); 
        if($userMembership){
            $userMembership->delete();
        }
        $membership = Membership::create([
            'user_id' => auth()->id(),
            'type_id' => $membershipplan->id,
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays($membershipplan->duration_days), 
        ]);

        return redirect()->route('profile.edit')->with('success', 'Suscripción adquirida correctamente.');
    }

  
}
