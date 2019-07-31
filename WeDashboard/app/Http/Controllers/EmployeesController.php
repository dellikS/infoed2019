<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Employee;
use Auth;
use Validator;

class EmployeesController extends Controller
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

    /**
     * Fetch employee
     * (You can extract this to repository method).
     * @param $id
     *
     * @return mixed
     */
    public function getEmployeeById($id)
    {
        return Employee::whereid($id)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request)
    {
        
            try {
                $employee = $this->getEmployeeById($request->input('employee'));
            } catch (ModelNotFoundException $exception) {
                abort(404);
            }
            $user = Auth::user();
            
            
            if ($employee) {
                
                $salary = $employee->salary;

                if ($employee->business->project) {
                    $salary = $request->input('salary');
                }

                if ($employee->business->id == $user->business->id) {
                    $employee->fill([
                        'job_title'      => $request->input('job_title'), 
                        'responsability' => $request->input('responsability'),
                        'salary'         => $salary,
                    ])->save();
                } else {
                    return back()->with('error', 'This employee doesn`t work for you');
                }
            } else {
                return back()->with('error', 'This employee doesn`t exist');
            }
    
            $employee->save();
            return back()->with('success', 'You have successfully update the employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
