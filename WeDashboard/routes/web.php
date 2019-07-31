<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/

// Homepage Route
Route::get('/', 'WelcomeController@welcome')->name('welcome');


Route::prefix('social')->group(function () {
    Route::get('github', 'Pages\RegularController@github')->name('github');
    Route::get('youtube', 'Pages\RegularController@youtube')->name('youtube');
    Route::get('facebook', 'Pages\RegularController@facebook')->name('facebook');
    Route::get('instagram', 'Pages\RegularController@instagram')->name('instagram');
});

// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', [
        'as' => 'user.reactivate', 
        'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes

    Route::get('/logout', [
        'uses' => 'Auth\LoginController@logout'
    ])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', [
        'as' => 'public.home',   
        'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);

    Route::resource('businesses', 'BusinessesController');
    
    Route::put('businesses/{id}/updateProject', [
        'as'   => '{id}',
        'uses' => 'BusinessesController@updateProject',
    ]);

    Route::put('businesses/{id}/updateRecruitment', [
        'as'   => '{id}',
        'uses' => 'BusinessesController@updateRecruitment',
    ]);

    Route::post('businesses/{id}/rate', [
        'as'   => '{id}',
        'uses' => 'BusinessesController@rate',
    ]);

    Route::get('businesses/{id}/logs', [
        'as'   => '{id}',
        'uses' => 'BusinessesController@logs',
    ]);


    Route::delete('businesses/{id}/deleteProject', [
        'as'   => '{id}',
        'uses' => 'BusinessesController@deleteProject',
    ]);

    Route::get('businesses/{id}/apply', [
        'as'   => '{id}',
        'uses' => 'RecruitmentController@create',
    ]);

    Route::get('businesses/{id}/applications', [
        'as'   => '{id}',
        'uses' => 'RecruitmentController@index',
    ]);

    Route::get('application/{id}', [
        'as'   => '{id}',
        'uses' => 'RecruitmentController@show',
    ]);

    Route::put('application/{id}/respond', [
        'as'   => '{id}',
        'uses' => 'RecruitmentController@respond',
    ]);

    Route::post('businesses/{id}/apply', [
        'as'   => '{id}',
        'uses' => 'RecruitmentController@store',
    ]);


    // employees routes

    Route::put('employees/update', [
        'uses' => 'EmployeesController@update',
    ]);

    Route::post('businesses/search', 'BusinessesController@search')->name('search-businesses');

});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    Route::get('profile/{username}/logs', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@logs',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses' => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);
    Route::post('search-users', 'UsersManagementController@search')->name('search-users');
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
});



Route::redirect('/php', '/phpinfo', 301);

Route::post('/language', ['middleware' => 'lang', 'uses' => 'LanguageController@index'])->name('language');

Route::group(['prefix' => '/notification', 'middleware' => ['auth', 'activated']], function () {
    Route::get('/read/{which}','NotificationController@read');
    Route::get('/delete/{which}','NotificationController@delete');
    Route::get('/delete/all','NotificationController@deleteAll')->name('delete-all');
    Route::get('/read/all','NotificationController@readAll')->name('read-all');
});

