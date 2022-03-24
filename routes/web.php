<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FrontendCtrl;

// Backend
use App\Http\Controllers\CountryCtrl;
use App\Http\Controllers\StateCtrl;
use App\Http\Controllers\CityCtrl;
use App\Http\Controllers\BankCtrl;
use App\Http\Controllers\SchooltypeCtrl;
use App\Http\Controllers\ExpensetypeCtrl;
use App\Http\Controllers\PlanCtrl;
use App\Http\Controllers\BloodCtrl;
use App\Http\Controllers\ReligionCtrl;
use App\Http\Controllers\GradeCtrl;
use App\Http\Controllers\LocalizationCtrl;
use App\Http\Controllers\FetchCtrl;
use App\Http\Controllers\RoleCtrl;
use App\Http\Controllers\RegisterCtrl;
use App\Http\Controllers\LoginCtrl;

use App\Http\Controllers\DepartmentCtrl;
use App\Http\Controllers\PositionCtrl;
use App\Http\Controllers\StaffCtrl;
use App\Http\Controllers\CurriculumCtrl;
use App\Http\Controllers\SubjectCtrl;
use App\Http\Controllers\SubjecttypeCtrl;
use App\Http\Controllers\SyllabusCtrl;
use App\Http\Controllers\PeriodCtrl;
use App\Http\Controllers\SectionCtrl;
use App\Http\Controllers\PackageCtrl;
use App\Http\Controllers\BatchCtrl;
use App\Http\Controllers\TeachersegmentCtrl;
use App\Http\Controllers\ScheduleCtrl;
use App\Http\Controllers\ScheduletypeCtrl;
use App\Http\Controllers\HolidayCtrl;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontendCtrl::class, 'index'])->name('index');

// /* Registration Routes... */
Route::get('register',[RegisterCtrl::class,'showRegistrationForm'])->name('register');
Route::post('register',[RegisterCtrl::class,'register']);

// Verify
Route::get('verify/{id}', [RegisterCtrl::class,'verifyMail'])->name('verify');
Route::post('verify/user', [RegisterCtrl::class,'verifyUser'])->name('verify.user');
Route::post('/verify/resend/{id}',[RegisterCtrl::class, 'verifyResendcode'])->name('verify.resend');

Route::group(['middleware' => ['auth']], function () {
    // Register Step by Step
    Route::get('procedure', [RegisterCtrl::class,'procedure'])->name('procedure');
    Route::post('procedure', [RegisterCtrl::class,'procedureAction'])->name('procedure');
});

/* Authentication Routes... */
Route::get('login',[LoginCtrl::class,'showLoginForm'])->name('login');
Route::post('login',[LoginCtrl::class,'login'])->name('login');



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//language
Route::get('lang/{locale}',[LocalizationCtrl::class, 'index'])->name('lang');

// Backend Route

Route::group(['prefix' => 'master', 'as' => 'master.'], function(){

    // Schedule 
    Route::resource('/schedule',ScheduleCtrl::class);

    // Holiday
    Route::resource('/holiday',HolidayCtrl::class);
    Route::get('/getlistHolidays',[HolidayCtrl::class, 'getlistData'])->name('getlistHolidays');
    Route::post('/holiday/update/{id}',[HolidayCtrl::class, 'update'])->name('holiday.update');

    // Schedule Type
    Route::resource('/scheduletype',ScheduletypeCtrl::class);
    Route::get('/getlistScheduletypes',[ScheduletypeCtrl::class, 'getlistData'])->name('getlistScheduletypes');
    Route::post('/scheduletype/update/{id}',[ScheduletypeCtrl::class, 'update'])->name('scheduletype.update');

    // Teachersegment ( Assign Teacher )
    Route::resource('/teachersegment',TeachersegmentCtrl::class);

    // Batch
    Route::resource('/batch',BatchCtrl::class);
    Route::post('/batch/update/{id}',[BatchCtrl::class, 'update'])->name('batch.update');

    // Package
    Route::resource('/package',PackageCtrl::class);
    Route::post('/package/update/{id}',[PackageCtrl::class, 'update'])->name('package.update');
    Route::post('/sectioninstallment/update/{id}',[PackageCtrl::class, 'sectioninstallment'])->name('sectioninstallment.update');

    // Staff
    Route::resource('/staff', StaffCtrl::class);
    Route::get('/getlistStaff/{id}',[StaffCtrl::class, 'getlistData'])->name('getlistStaff');
    Route::post('/staff/resign/{id}',[StaffCtrl::class, 'resign'])->name('staff.resign');
    Route::post('/staff/restore/{id}',[StaffCtrl::class, 'restore'])->name('staff.restore');
    
    Route::post('/storeSubject_byuserid',[StaffCtrl::class, 'storeSubject_byuserid'])->name('storeSubject_byuserid');
    Route::post('/storePermission_byuserid',[StaffCtrl::class, 'storePermission_byuserid'])->name('storePermission_byuserid');

    // Section
    Route::resource('/section',SectionCtrl::class);
    Route::get('/getlistSections',[SectionCtrl::class, 'getlistData'])->name('getlistSections');
    Route::post('/section/update/{id}',[SectionCtrl::class, 'update'])->name('section.update');

    // Period ~ Academic year
    Route::resource('/period', PeriodCtrl::class);
    Route::get('/getlistPeriods',[PeriodCtrl::class, 'getlistData'])->name('getlistPeriods');
    Route::post('/period/update/{id}',[PeriodCtrl::class, 'update'])->name('period.update');

    // Syllabus
    Route::resource('/syllabus', SyllabusCtrl::class);

    // // Curriculum
    Route::resource('/curriculum', CurriculumCtrl::class);
    Route::post('curriculum/store/sorting',[CurriculumCtrl::class, 'storesorting'])->name('curriculum.store.sorting');

    // // Subject
    Route::resource('/subject', SubjectCtrl::class);
    Route::get('/getlistSubjects',[SubjectCtrl::class, 'getlistData'])->name('getlistSubjects');
    Route::post('/subject/update/{id}',[SubjectCtrl::class, 'update'])->name('subject.update');

    // Subject Type
    Route::resource('/subjecttype', SubjecttypeCtrl::class);
    Route::get('/getlistSubjecttypes',[SubjecttypeCtrl::class, 'getlistData'])->name('getlistSubjecttypes');
    Route::post('/subjecttype/update/{id}',[SubjecttypeCtrl::class, 'update'])->name('subjecttype.update');

    
    // Department
    Route::resource('/department', DepartmentCtrl::class);
    Route::post('/department/update/{id}',[DepartmentCtrl::class, 'update'])->name('department.update');
    Route::post('department/store/sorting',[DepartmentCtrl::class, 'storesorting'])->name('department.store.sorting');

    //Position
    Route::resource('/position', PositionCtrl::class);
    Route::post('/position/update/{id}',[PositionCtrl::class, 'update'])->name('position.update');
    Route::post('position/store/sorting',[PositionCtrl::class, 'storesorting'])->name('position.store.sorting');


    Route::resource('/country', CountryCtrl::class);
    Route::get('/getlistCountries',[CountryCtrl::class, 'getlistData'])->name('getlistCountries');
    Route::post('/country/update/{id}',[CountryCtrl::class, 'update'])->name('country.update');

    Route::resource('/country', CountryCtrl::class);
    Route::get('/getlistCountries',[CountryCtrl::class, 'getlistData'])->name('getlistCountries');
    Route::post('/country/update/{id}',[CountryCtrl::class, 'update'])->name('country.update');

    Route::resource('/state', StateCtrl::class);
    Route::get('/getlistStates',[StateCtrl::class, 'getlistData'])->name('getlistStates');
    Route::post('/state/update/{id}',[StateCtrl::class, 'update'])->name('state.update');

    Route::resource('/city', CityCtrl::class);
    Route::post('/city/update/{id}',[CityCtrl::class, 'update'])->name('city.update');

    Route::resource('/bank', BankCtrl::class);
    Route::get('/getlistBanks',[BankCtrl::class, 'getlistData'])->name('getlistBanks');
    Route::post('/bank/update/{id}',[BankCtrl::class, 'update'])->name('bank.update');

    Route::resource('/schooltype', SchooltypeCtrl::class);
    Route::get('/getlistSchooltypes',[SchooltypeCtrl::class, 'getlistData'])->name('getlistSchooltypes');
    Route::post('/schooltype/update/{id}',[SchooltypeCtrl::class, 'update'])->name('schooltype.update');

    Route::resource('/expensetype', ExpensetypeCtrl::class);
    Route::get('/getlistExpensetypes',[ExpensetypeCtrl::class, 'getlistData'])->name('getlistExpensetypes');
    Route::post('/expensetype/update/{id}',[ExpensetypeCtrl::class, 'update'])->name('expensetype.update');

    Route::resource('/blood', BloodCtrl::class);
    Route::get('/getlistBloods',[BloodCtrl::class, 'getlistData'])->name('getlistBloods');
    Route::post('/blood/update/{id}',[BloodCtrl::class, 'update'])->name('blood.update');

    Route::resource('/religion', ReligionCtrl::class);
    Route::get('/getlistReligions',[ReligionCtrl::class, 'getlistData'])->name('getlistReligions');
    Route::post('/religion/update/{id}',[ReligionCtrl::class, 'update'])->name('religion.update');

    Route::resource('/grade', GradeCtrl::class);
    Route::get('/getlistGrades',[GradeCtrl::class, 'getlistData'])->name('getlistGrades');
    Route::post('/grade/update/{id}',[GradeCtrl::class, 'update'])->name('grade.update');

    Route::resource('/plan', PlanCtrl::class);
    Route::get('/getlistPlans',[PlanCtrl::class, 'getlistData'])->name('getlistPlans');
    Route::post('/plan/update/{id}',[PlanCtrl::class, 'update'])->name('plan.update');

    Route::resource('/role', RoleCtrl::class);
    Route::get('/getlistRoles',[RoleCtrl::class, 'getlistData'])->name('getlistRoles');
    Route::post('/role/update/{id}',[RoleCtrl::class, 'update'])->name('role.update');


});

Route::get('getCountries',[FetchCtrl::class, 'getCountries'])->name('getCountries');
Route::get('getStates',[FetchCtrl::class, 'getStates'])->name('getStates');
Route::get('getCities', [FetchCtrl::class, 'getCities'])->name('getCities');
Route::post('getPositions_bydepartmentid', [FetchCtrl::class, 'getPositions_bydepartmentid'])->name('getPositions_bydepartmentid');

Route::post('getCurricula_bygradeid', [FetchCtrl::class, 'getCurricula_bygradeid'])->name('getCurricula_bygradeid');

Route::post('getTotalinstallment_bysectionid', [FetchCtrl::class, 'getTotalinstallment_bysectionid'])->name('getTotalinstallment_bysectionid');
Route::post('getPackageinstallments_bysectionid', [FetchCtrl::class, 'getPackageinstallments_bysectionid'])->name('getPackageinstallments_bysectionid');
Route::post('getBatches_bysectionid', [FetchCtrl::class, 'getBatches_bysectionid'])->name('getBatches_bysectionid');
Route::post('/getTeachersegments_bysectionid',[FetchCtrl::class, 'getTeachersegments_bysectionid'])->name('getTeachersegments_bysectionid');

Route::post('/getUser_bysubjectid',[FetchCtrl::class, 'getUser_bysubjectid'])->name('getUser_bysubjectid');

Route::post('getSection', [FetchCtrl::class, 'getSection'])->name('getSection');

Route::post('/getSection_byperiodid',[FetchCtrl::class, 'getSection_byperiodid'])->name('getSection_byperiodid');
Route::post('/getSubjects_bybatchid',[FetchCtrl::class, 'getSubjects_bybatchid'])->name('getSubjects_bybatchid');
Route::post('/getTeachersegments_bybatchid',[FetchCtrl::class, 'getTeachersegments_bybatchid'])->name('getTeachersegments_bybatchid');

