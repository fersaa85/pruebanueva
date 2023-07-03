<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeResourceCollection;
use App\Models\Employee;
use App\Models\EmployeeSkill;
use App\Models\Skill;
use Illuminate\Http\Request;
use Geocoder\Laravel\ProviderAndDumperAggregator as Geocoder;

class EmployesController extends Controller
{
    public function index(){
        return new EmployeeResourceCollection( Employee::orderBy('id', 'DESC')->get() );
    }

    public function store(EmployeeStoreRequest $request, Geocoder $geocoder){
        $address = $geocoder->geocode($request->address)->get();
        $coordinates = $address->first()->getCoordinates();
        $lat = $coordinates->getLatitude();
        $lng = $coordinates->getLongitude();

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'date' => $request->date,
            'job' => $request->job,
            'lat' => $lat,
            'lng' => $lng,
        ]);

        $values = $request->get('skillsValues', []);

        $skillsDB = Skill::get();
        foreach ($request->skills as $skill){

            $currentSkill = $skillsDB->where('name', $skill)->first();
            if($currentSkill){
                EmployeeSkill::create([
                    'employee_id' => $employee->id,
                    'skill_id' => $currentSkill->id,
                    'value' => (count($values) && isset($values[$skill])) ? $values[$skill] : 1,
                ]);
            }


        }

        return new EmployeeResource($employee);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($email)
    {
        return new EmployeeResource(Employee::where('email', '=', $email)->first());
    }
}
