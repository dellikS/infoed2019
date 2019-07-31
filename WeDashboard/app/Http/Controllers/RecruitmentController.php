<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RespondToApplication;
use App\Models\User;
use App\Models\Business;
use App\Models\Employee;
use App\Models\UserApplication;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Auth;
use Validator;
use Carbon\Carbon;

class RecruitmentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('apply')->only(['create', 'store']);
    }

    /**
     * Fetch business
     * (You can extract this to repository method).
     * @param $id
     *
     * @return mixed
     */
    public function getBusinessById($id)
    {
        return Business::whereid($id)->firstOrFail();
    }

    public function getApplicationById($id)
    {
        return UserApplication::whereid($id)->firstOrFail();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $user = Auth::user();

        $employee = Employee::where('user_id', $user->id)->first();
        $applications = UserApplication::where('business_id', $business->id)->paginate(15);

        $data = [
            'business'         => $business,
            'employee'         => $employee,
            'applications'     => $applications,
        ];

        return view('businesses.recruitment.applications')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $user = Auth::user();

        $data = [
            'business'         => $business,
            'user'             => $user,
        ];

        return view('businesses.recruitment.apply')->with($data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $user = Auth::user();

        $validator = Validator::make($request->all(),
        [
            'answers.*'             => ['required','regex:/^[a-zA-Z0-9,.!? ]*$/','string','min: 3','max:2000'],
        ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $application = UserApplication::create([
            'user_id'               => auth()->id(),
            'business_id'           => $business->id,
            'questions'             => $business->survey->questions,
            'answers'               => $request->input('answers'),
        ]);

        $application->save();

        return redirect('businesses/'.$business->id)->with('success', 'Your application has been submitted!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $application = $this->getApplicationById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

       if ($application->business->isOwnerHere() || $application->user->id == Auth::user()->id) {
        
        $data = [
            'application' => $application,
        ];

        return view('businesses.recruitment.application')->with($data);

        } else {

            return $this->index($application->business->id);
        
        } 
    }

    public function logs($id)
    {

        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $audits = Audit::where('auditable_id', $business->id)->where('event', 'updated')->where('auditable_type', 'App\Models\Business')->orderBy('id', 'desc')->paginate(5);

        $data = [
            'business'          => $business,
            'audits'            => $audits,
        ];

        if (Auth::user()->isAdmin() || Auth::user()->id == $business->user_id) {
            return view('businesses.logs')->with($data);
        } else {
            return redirect('home')->with('error', trans('businesses.notYourBusiness'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function respond(RespondToApplication $request, $id)
    {

        try {
            $application = $this->getApplicationById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        if ($application->business->employee->count() > $application->business->vacancies) {
            return redirect('/application/'.$application->id)->with('error', 'You have no available places!');
        }

        if ($application->business->isOwnerHere() && $application->status === null) {
            $application->fill([
                'status' => $request->input('status'), 
                'reason' => $request->input('reason'),
                'answer_date' => Carbon::now(),
                'answerer_id' => Auth::user()->id,
            ]);

            if ($request->input('status') == true && !$application->user->employee) {
                $employee = new Employee();
                $employee->create([
                    'business_id'        => $application->business->id,
                    'user_id'            => $application->user->id,           
                ])->save();
            }

            $application->save();

            return redirect('/application/'.$application->id)->with('success', 'Application has been updated!');
        }

        return redirect('/application/'.$application->id)->with('error', 'It is a problem with your form!');
        
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
