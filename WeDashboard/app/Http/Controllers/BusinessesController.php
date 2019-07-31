<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use App\Http\Requests\UpdateBusinessDetails;
use App\Http\Requests\UpdateProjectDetails;
use App\Http\Requests\UpdateRecruitmentDetails;
use App\Http\Requests\DeleteBusinessProject;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Business;
use App\Models\BusinessRating;
use App\Models\Project;
use App\Models\Employee;
use App\Models\BusinessSurvey;
use Auth;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use App\Models\Country;
use Carbon\Carbon;
use App\Notifications\BusinessCreated;
use App\Notifications\ProjectUpdated;
use App\Notifications\ProjectCreated;

class BusinessesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ownsBiz')->only(['create', 'store']);
        $this->middleware('ownerBiz')->only(['edit', 'update', 'updateProject', 'updateRecruitment', 'destroy', 'deleteProject']);
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

    
    /**
     * Format date
     * (You can extract this to repository method).
     * @param $input
     *
     * @return mixed
     */
    public function formatDate($input)
    {
        $dateFormatted = Carbon::createFromFormat('d/m/Y', $input);
        return $dateFormatted;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $pagintaionEnabled = config('usersmanagement.enablePagination');
        $employee = Employee::where('user_id', $user->id)->first();
        if ($pagintaionEnabled) {
            $businesses = Business::paginate(config('usersmanagement.paginateListSize'));
        } else {
            $businesses = Business::all();
        }

        $data = [
            'businesses'         => $businesses,
            'employee'           => $employee,
        ];

        return View('businesses.show-businesses')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('businesses.create-business');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),
        [
            'name'                  => ['required','regex:/^[A-Z]([a-zA-Z0-9]|[- @\.#&!])*$/', 'min: 3','max:32','unique:businesses'],
            'description'           => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'type'                  => ['required','regex:/^([A-Z]{1}[a-z]{1,30}[- ]{0,1}|[A-Z]{1}[- \']{1}[A-Z]{0,1}[a-z]{1,30}[- ]{0,1}|[a-z]{1,2}[- \']{1}[A-Z]{1}[a-z]{1,30}){1,3}+$/','min:3','max:32'],
            'vacancies'             => 'required|integer|between:1,10',
            'currency'              => ['required','regex:/^[A-Z]{3}?$/'],
            'deadline'              => 'required|date_format:d/m/Y|after:now|before:1 year',
            'address'               => ['nullable','regex:/^$|^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'max: 255'],
            'email'                 => ['required','regex:/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'],
            'phone'                 => ['nullable','regex:/^$|^\(?\d{2,4}\)?[\d\s-]+$/', 'min:3','max:16'],
            'fax'                   => ['nullable','regex:/^$|^\(?\d{2,4}\)?[\d\s-]+$/', 'min:3','max:16'],
            'website'               => ['nullable','regex:/^$|^(([a-zA-Z]{1})|([a-zA-Z]{1}[a-zA-Z]{1})|([a-zA-Z]{1}[0-9]{1})|([0-9]{1}[a-zA-Z]{1})|([a-zA-Z0-9][a-zA-Z0-9-_]{1,61}[a-zA-Z0-9]))\.([a-zA-Z]{2,6}|[a-zA-Z0-9-]{2,30}\.[a-zA-Z]{2,3})$/'],
            'country_id'            => 'required|integer|between:1,110',
            'budget'                => ['required','regex:/^\d{1,9}+(\.\d{1,2})?$/'],
            'details'               => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'instruction'           => ['required', 'min: 3', 'max: 2000'],
            'title'                 => ['required', "regex:/^[A-Za-z0-9\s\-_,\.;:()]+$/", 'min: 3', 'max: 32'],
        ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $business = Business::create([
            'user_id'               => auth()->id(),
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'type'                  => $request->input('type'),
            'vacancies'             => $request->input('vacancies'),
            'currency'              => $request->input('currency'),
            'address'               => $request->input('address'),
            'email'                 => $request->input('email'),
            'phone'                 => $request->input('phone'),
            'fax'                   => $request->input('fax'),
            'website'               => $request->input('website'),
            'country_id'            => $request->input('country_id'),
        ]);

        $deadline = $this->formatDate($request->input('deadline'));
        $project = new Project();
        $business->project()->create([
            'business_id'        => $business->id,
            'title'              => $request->input('title'),
            'details'            => $request->input('details'),
            'instruction'        => clean($request->input('instruction')),
            'deadline'           => $deadline,
            'currency'           => $business->currency,
            'budget'             => $request->input('budget'),
        ]);
        
        $business->save();

        Auth::user()->notify(new BusinessCreated($business));

        return redirect('businesses')->with('success', trans('usersmanagement.createSuccess'));
    }      //

    public function rate(Request $request, $id)
    {

        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $request->validate([
            'score' => 'required|numeric|min:0.5|max:5',
        ]);
            
        $rating = BusinessRating::updateOrCreate(
        [
            'user_id'              => auth()->id(),
            'business_id'          => $business->id,
        ],
        [
            'business_id'           => $business->id,
            'score'                 => $request->input('score'),
        ]);

        $rating->save();
        


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
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        
        $user = Auth::user();
        $deletedProjects = Project::onlyTrashed()->where('business_id', $id)->get();
        $country = Country::find($business->country_id);
        $employee = Employee::where('user_id', $user->id)->first();

        $data = [
            'business'         => $business,
            'country'          => $country,
            'deletedProjects'  => $deletedProjects,
            'employee'         => $employee,
        ];

        return view('businesses.show-business')->with($data);
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
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $country = Country::find($business->country_id);

        $data = [
            'business'         => $business,
            'country'      => $country,
        ];

        return view('businesses.edit-business')->with($data);
    }

    /**
     * Update a business's details.
     *
     * @param \App\Http\Requests\UpdateBusinessDetails $request
     * @param $username
     *
     * @throws Laracasts\Validation\FormValidationException
     *
     * @return mixed
     */
    public function update(UpdateBusinessDetails $request, $id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $input = Input::only('name', 'description', 'motd', 'currency', 'type', 'address', 'email', 'website', 'phone', 'fax');

        $business->fill($input)->save();
        $business->save();

        return redirect('businesses/'.$business->id.'/edit')->with('success', trans('businesses.updateSuccess'));
    }

    public function updateProject(UpdateProjectDetails $request, $id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        
        // deadline time verification

        if ($business->project) {
            if ($business->project->deadline < Carbon::now()->addDays(7)) {
                $deadline = $this->formatDate($request->input('deadline'));       
            } else {
                $deadline = $business->project->deadline;
            }
        } else {
            $deadline = $this->formatDate($request->input('deadline'));
        }

        // end of deadline time verification

        if ($business->project == null) {
            $project = new Project();
            $project->fill([
                'title' => $request->input('title'), 
                'details' => $request->input('details'),
                'instruction' => clean($request->input('instruction')),
                'deadline' => $deadline,
                'budget' => $request->input('budget'), 
                'currency'  => $business->currency,
            ]);
            $business->project()->save($project);
            foreach($business->employee as $employee) {
                $employee->user->notify(new ProjectCreated($project));
            }
            $business->user->notify(new ProjectCreated($project));
        } else {
            foreach($business->employee as $employee) {
                $employee->user->notify(new ProjectUpdated($business->project));
            }
            $business->user->notify(new ProjectUpdated($business->project));
            $business->project->fill([
                'title' => $request->input('title'), 
                'details' => $request->input('details'), 
                'instruction' => clean($request->input('instruction')),
                'deadline' => $deadline
            ])->save();
        }

        $business->save();
        return redirect('businesses/'.$business->id.'/edit')->with('success', trans('businesses.updateSuccess'));
    }

    public function updateRecruitment(UpdateRecruitmentDetails $request, $id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $questions = $request->input('questions');

        if (count($questions) > 16) { 
            return redirect('businesses/'.$business->id.'/edit')->with('error', 'You can create max 15 questions');
        }
          
        if ($business->survey == null) {
            $survey = new BusinessSurvey();
            $survey->fill([
                'business_id' => $business->id, 
                'questions'  => $questions,
            ]);
            $business->survey()->save($survey);
        } else { 
            $business->survey->fill([
                'business_id' => $business->id, 
                'questions'  => $questions,
            ])->save();
        }

        $hiring = $request->input('hiring');

        if ($hiring == true) {
            $business->hiring = true;
        } else {
            $business->hiring = false;
        }


        $business->save();
        return redirect('businesses/'.$business->id.'/edit')->with('success', trans('businesses.updateSuccess'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\DeleteBusinessProject $request
     * @param int                                  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteProject(DeleteBusinessProject $request, $id)
    {
        try {
            $business = $this->getBusinessById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $user = Auth::user();

        if ($business->user_id != $user->id) {
            redirect('businesses/'.$business->id.'/edit')->with('error', 'This is not your project');
        }

        if ($business->project) {
            if ($business->project->deadline < Carbon::now() || $business->employee->count() < 1) {
                $business->project->delete();
                return redirect('businesses/'.$business->id.'/edit')->with('success', 'The project has been deleted');
            } else {
                return redirect('businesses/'.$business->id.'/edit')->with('error', 'The project has not been deleted');
            }
        } else {
            return redirect('businesses/'.$business->id.'/edit')->with('error', 'Your business has no project');
        }

    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('business_search_box');
        $searchRules = [
            'business_search_box' => 'required|string|max:255',
        ];
        $searchMessages = [
            'business_search_box.required' => 'Search term is required',
            'business_search_box.string'   => 'Search term has invalid characters',
            'business_search_box.max'      => 'Search term has too many characters - 255 allowed',
        ];

        $validator = Validator::make($request->all(), $searchRules, $searchMessages);

        if ($validator->fails()) {
            return response()->json([
                json_encode($validator),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = Business::where('id', 'like', $searchTerm.'%')
                            ->orWhere('name', 'like', $searchTerm.'%')
                            ->orWhere('email', 'like', $searchTerm.'%')->get();

        // Attach roles to results

        return response()->json([
            json_encode($results),
        ], Response::HTTP_OK);
    }
}
