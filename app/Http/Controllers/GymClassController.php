<?php

namespace App\Http\Controllers;

use App\Http\Requests\GymClassRequest;
use App\Models\ClassSchedule;
use App\Models\GymClass;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GymClassController extends Controller
{
    public function index()
    {
        $classes = GymClass::with('trainer')->get();
        return view('classes.index', compact('classes'));
    }

    public function show(GymClass $gymClass)
    {
        $schedules = ClassSchedule::where('class_id', $gymClass->id)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
        return view('classes.show', compact('gymClass', 'schedules'));
    }

    public function edit(GymClass $gymClass)
    {
        $roleTrainer = Role::where('name', 'trainer')->first()->id;
        $trainers = User::where('role_id', $roleTrainer)->get();
        return view('admin.classes.edit', compact('gymClass', 'trainers'));
    }
    public function create()
    {
        $roleTrainer = Role::where('name', 'trainer')->first()->id;
        $trainers = User::where('role_id', $roleTrainer)->get();
        return view('admin.classes.create', compact('trainers'));
    }
    public function store(GymClassRequest $request)
    {
      
            $gymClass = GymClass::create($request->only('name', 'description', 'trainer_id'));

            if($request->has('image')){
                $imagePath = $request->file('image')->store('class_images', 'public');
                $gymClass->image = $imagePath;
                $gymClass->save();
            }

            if($request->has('schedules')){
                foreach($request->schedules as $scheduleData){
                    $start = Carbon::createFromFormat('H:i', $scheduleData['start_time']);
                    $end = $start->copy()->addMinutes((int)$request->duration);
                    ClassSchedule::create([
                        'class_id' => $gymClass->id,
                        'date' => $scheduleData['date'],
                        'start_time' => $start->format('H:i'),
                        'end_time' =>  $end->format('H:i'),
                    ]);
                }
            }
    
            return redirect()->route('admin.classes.index')->with('success', 'Clase creada exitosamente.');
    }

   public function update(GymClassRequest $request, GymClass $gymClass)
    {
        $gymClass->update(
            $request->only('name', 'description', 'trainer_id', 'capacity', 'duration')
        );


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('class_images', 'public');
            $gymClass->image = $imagePath;
            $gymClass->save();
        }

        $existingIds = $gymClass->schedules()->pluck('id')->toArray();
        $incomingIds = [];

        if ($request->has('schedules')) {
            foreach ($request->schedules as $scheduleData) {

                if (!empty($scheduleData['id'])) {

                    $schedule = $gymClass->schedules()
                        ->where('id', $scheduleData['id'])
                        ->first();

                    if ($schedule) {
                        $schedule->update([
                            'date' => $scheduleData['date'],
                            'start_time' => $scheduleData['start_time'],
                            'max_capacity' => $scheduleData['max_capacity'],
                        ]);

                        $incomingIds[] = $schedule->id;
                    }

                } 
               
                else {

                    $newSchedule = $gymClass->schedules()->create([
                        'date' => $scheduleData['date'],
                        'start_time' => $scheduleData['start_time'],
                        'max_capacity' => $scheduleData['max_capacity'],
                    ]);

                    $incomingIds[] = $newSchedule->id;
                }
            }
        }


        $toDelete = array_diff($existingIds, $incomingIds);

        if (!empty($toDelete)) {
            $gymClass->schedules()
                ->whereIn('id', $toDelete)
                ->delete();
        }

        return redirect()->back()->with('success', 'Clase actualizada correctamente.');
    }
    public function destroy(GymClass $gymClass)
    {
        $gymClass->delete();  
        return redirect()->route('classes.index')->with('success', 'Clase eliminada exitosamente.');  
    }
}
