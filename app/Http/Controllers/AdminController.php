<?php

namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use App\Models\GymClass;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $countUsers = \App\Models\User::count();
        $countClasses = GymClass::count();
        $countReservations = \App\Models\Reservation::count();
        $countActiveMemberships = \App\Models\Membership::where('end_date', '>', now())->count();
        return view('admin.index', compact('countUsers', 'countClasses', 'countReservations', 'countActiveMemberships'));
    }

    public function indexClasses()
    {
        $classes = GymClass::with('trainer')->get();
        return view('admin.classes.index', compact('classes'));
    }

     public function indexMemberships()
    {
        $memberships = \App\Models\Membership::with('user', 'membershipPlan')->get();
        return view('admin.memberships.index', compact('memberships'));
    }


    public function indexTrainers()
    {
        $roleTrainer = \App\Models\Role::where('name', 'trainer')->first()->id;
        $trainers = \App\Models\User::where('role_id', $roleTrainer)->get();
        return view('admin.trainers.index', compact('trainers'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function editTrainer(User $trainer = null)
    {
        return view('admin.trainers.edit', compact('trainer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeTrainer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $trainerRole = \App\Models\Role::where('name', 'trainer')->first();

        $trainer = new \App\Models\User();
        $trainer->name = $request->name;
        $trainer->email = $request->email;
        $trainer->phone = $request->phone;
        $trainer->password = Hash::make($request->password);
        $trainer->role_id = $trainerRole->id;
        $trainer->save();
        return redirect()->route('admin.trainers.index')->with('success', 'Entrenador creado correctamente.');
    }

    public function updateTrainer(Request $request, User $trainer)
    {
        $data = $request->validate([
            'name' => 'required',
            'lastname' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $trainer->id,
            'phone' => 'nullable',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Solo actualizar password si se envía
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $trainer->update($data);

        return redirect()->route('admin.trainers.index')
            ->with('success', 'Entrenador actualizado correctamente');
    }

  
    public function destroyTrainer(User $trainer)
    {
        $trainer->delete();
        return redirect()->route('admin.trainers.index')
            ->with('success', 'Entrenador eliminado correctamente');
    }
}
