<?php

use App\Http\Controllers\StaffCaseController;
use App\Models\Brand;
use App\Models\DynamicName;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UpazilaController;
use App\Http\Controllers\VillageController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\DataImportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EnvDynamicController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PunishmentController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Brand\BrandController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeOutController;
use App\Http\Controllers\SpecializedController;
use App\Http\Controllers\SubLocationController;
use App\Http\Controllers\EmployeeCRUDController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\RelationshipController;
use App\Http\Controllers\HourlyPayrollController;
use App\Http\Controllers\LocalTrainingController;
// use App\Http\Controllers\SubLocationController;
use App\Http\Controllers\PostingRecordController;
use App\Http\Controllers\RedesignationController;
use App\Http\Controllers\SubDepartmentController;
use App\Http\Controllers\ForeignTrainingController;
use App\Http\Controllers\InhouseTrainingController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\Payroll\WelfareController;

use App\Http\Controllers\StationCategoryController;
use App\Http\Controllers\settings\SettingController;
use App\Http\Controllers\Payroll\WelfareFundController;
// use App\Models\Brand;
// use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Auth; payroll/manage-a-salary
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\promotion\PromotionController;
use App\Http\Controllers\EmployeeConfirmationController;
use App\Http\Controllers\EmployeeStatusChangeController;
use App\Http\Controllers\ExperienceJobPostionController;
use App\Http\Controllers\Payroll\SalaryTemplateController;
// 
use App\Http\Controllers\EducationalQualificationController;
use App\Http\Controllers\Employee\EmployeeTrainingController;
use App\Http\Controllers\Payroll\WelfareFundRequestController;
Route::get('/', function () {
    // return redirect()->route('login');       
    // return redirect()->route('login');
    Storage::delete('icon');
    $branding_images = Brand::get()->first();
    Storage::put('icon', $branding_images->company_logo);
    $company_and_software_name = DynamicName::get()->first();
    return view('auth.login', compact('branding_images', 'company_and_software_name'));
})->name('auth-login');

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    dd('done');
    return back(); //Return anything http://127.0.0.1:8000/payroll/make-payment-details 
});

Route::get('thana/{district_id}', [DistrictController::class, 'get_thana'])->name('get-thanas');

Route::get('all-thanas/{district_id}', [DistrictController::class, 'all_thanas'])->name('all-thanas');

Route::get('get_allowance_deduction/{grade_id}', [PayrollController::class, 'allowance_deduction'])->name('allowance_deductions');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'web'])->group(static function () {
    // Create Experience Job Position employee/5/edit

    // http://127.0.0.1:8000/experience-job-position 

    // Route::get('employee-promotion-search', [PromotionController::class, 'search'])->name('promotion.search');


    Route::get('/all-confirmed-employees', [EmployeeConfirmationController::class, 'confirmed_employees'])->name('confirmed_employees');
    Route::get('/confirmed-employees-list', [EmployeeConfirmationController::class, 'confirmed_employees_list'])->name('confirmed_employees_list');

    Route::get('job-histories', [PostingRecordController::class, 'allJobHistory'])->name('job.histories');
    Route::get('job-histories-list', [PostingRecordController::class, 'allJobHistoryData'])->name('job.histories.list');

    Route::get('job-position', [ExperienceJobPostionController::class, 'index'])->name('job_position');
    Route::post('job-position-store', [ExperienceJobPostionController::class, 'store'])->name('job_position.store');
    Route::get('job-position-edit/{id}', [ExperienceJobPostionController::class, 'edit'])->name('job_position.edit');
    Route::patch('job-position-edit/{id}', [ExperienceJobPostionController::class, 'update'])->name('job_position.update');
    Route::get('job-position-delete', [ExperienceJobPostionController::class, 'delete'])->name('job_position.destroy');


    Route::get('all-terminations', [EmployeeController::class, 'all'])->name('terminations.all');

    Route::get('employee-discontinuation', [EmployeeOutController::class, 'index'])->name('employee.discontinuation');
    Route::get('employee-out', [EmployeeOutController::class, 'employee_discontinuation'])->name('employee.out');
    Route::get('employee-discontinuation-list', [EmployeeOutController::class, 'employee_discontinuation_list'])->name('employee.discontinuation.list');
    Route::post('employee-out-confirmed', [EmployeeOutController::class, 'store'])->name('employee.out.confirmed');

    Route::get('all-punishment', [PunishmentController::class, 'all'])->name('all.punishments');
    Route::get('financial-punish-types', [PunishmentController::class, 'financialPunishTypes'])->name('financial.punish.types');
    Route::get('all-punishment-list', [PunishmentController::class, 'punishmentList'])->name('all.punishments.list');
    Route::get('a-employee-punishments', [PunishmentController::class, 'Specific_Employee_Punishment'])->name('specific.employee.punishments');
    Route::post('punishment-store', [PunishmentController::class, 'punishment_store'])->name('punishment.insert');

    Route::get('employee-punishment', [PunishmentController::class, 'punish'])->name('employee.punishment');

    Route::get('staff-case', [StaffCaseController::class, 'index'])->name('staff.case');
    Route::get('staff-case-edit/{id}', [StaffCaseController::class, 'edit'])->name('staff.case.edit');

    Route::put('staff-case-edit', [StaffCaseController::class, 'update'])->name('staff.case.update');


    Route::post('staff-case', [StaffCaseController::class, 'store']);
    Route::delete('staff-case-delete/{id}', [StaffCaseController::class, 'destroy'])->name('staff.case.delete');

    Route::get('get-grade', [GradeController::class, 'all'])->name('all_grade');
    Route::get('get-grade-salary/{grade_id}', [GradeController::class, 'find'])->name('get_grade_salary');

    Route::get('get-designations', [DesignationController::class, 'all'])->name('get_designation');
    Route::get('get-departments', [DepartmentController::class, 'all'])->name('get_department');
    Route::get('employee-promotion', [PromotionController::class, 'index'])->name('promotion.index');

    Route::post('employee-promotion-store', [PromotionController::class, 'store'])->name('promotion.store');

    Route::get('employee-transfer', [TransferController::class, 'index'])->name('transfer.index');

    Route::resource('specialized', SpecializedController::class);
    Route::get('employee-confirmation', [EmployeeConfirmationController::class, 'index'])->name('confirmation.index');
    // Route::get('confirmation-search', [EmployeeConfirmationController::class, 'search'])->name('confirmation.search');
    // Route::patch('confirm/{id}', [EmployeeConfirmationController::class, 'confirm'])->name('confirm_done');
    Route::get('status-search', [EmployeeStatusChangeController::class, 'search'])->name('status.search');
    Route::get('status-change', [EmployeeStatusChangeController::class, 'confirm'])->name('status.change');



    Route::get('redesignation', [RedesignationController::class, 'index'])->name('redesignation');
    Route::get('redesignation-lists', [RedesignationController::class, 'redesignationList'])->name('redesignation.lists');


    Route::get('task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('task/create', [TaskController::class, 'store']);
    Route::get('task/start_stop/{id}', [TaskController::class, 'start_stop'])->name('task.start_stop');
    Route::get('task/edit/{id}', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('task/update/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('task/delete/{id}', [TaskController::class, 'destroy'])->name('task.delete');

    Route::get('task/all', [TaskController::class, 'all_task'])->name('task.all_task');

    // http://localhost:8080/PHRMS/public/payroll/payment-update/33

    Route::get('district/{division_id}', [DistrictController::class, 'get_district'])->name('get.districts');

    Route::get('payroll/select-payment/{id}', [PayrollController::class, 'payment_select'])->name('payroll.select-payment');
    Route::get('payroll/generate-payslip/{id}', [PayrollController::class, 'generate_payslip'])->name('payroll.generate-payslip');

    Route::patch('payroll/payment-update/{id}', [PayrollController::class, 'payment_update'])->name('payment.payment-update');

    Route::get('payroll/make-payment/{id?}', [PayrollController::class, 'make_payment'])->name('payroll.make-payment');
    Route::post('payroll/make-payment-details', [PayrollController::class, 'make_payment_details'])->name('payroll.make-payment-details');
    Route::delete('employee/payroll_erash/{id}', [PayrollController::class, 'destroy'])->name('employee.delete');

    Route::get('employee/payrol/{id}', [PayrollController::class, 'search'])->name('employee-payrol-search');

    Route::post('experience-job-position', [ExperienceJobPostionController::class, 'store'])->name('experience.job.position');

    //branding
    Route::get('brand/create', [BrandController::class, 'index'])->name('brand.create');
    Route::patch('brand/{id}', [BrandController::class, 'update'])->name('brand.update');

    Route::get('brand-name/create', [BrandController::class, 'dynamic_name'])->name('brand-name.create');
    Route::patch('brand-name/{id}', [BrandController::class, 'update_name'])->name('brand-name.update');

    //payroll

    Route::get('payroll/salary-template', [SalaryTemplateController::class, 'get_salary_template'])->name('payroll.salary-template');
    Route::post('payroll/salary-temp-set', [SalaryTemplateController::class, 'store'])->name('salary_temp.set');

    Route::get('payroll/salary-temp-edit/{id}', [SalaryTemplateController::class, 'edit'])->name('salary_temp.edit');
    Route::put('payroll/salary-temp-edit/{id}', [SalaryTemplateController::class, 'update']);

    Route::delete('payroll/salary-template/{id}', [SalaryTemplateController::class, 'destroy'])->name('salary_temp.delete');


    // 

    Route::get('get-template/{id}', [SettingController::class, 'getTemplate'])->name('get-salary-template');
    Route::get('payroll/hourly-rate', [PayrollController::class, 'get_hourly_rate'])->name('payroll.hourly-rate');
    // Route::get('payroll/salary-template', http://127.0.0.1:8000/payroll/manage-a-salary

    //Hourly Rate
    Route::get('payroll/hourly-rate', [HourlyPayrollController::class, 'get_hourly_rate'])->name('payroll.hourly-rate');
    Route::post('payroll/set-hourly-rate', [HourlyPayrollController::class, 'store_hourly'])->name('hourly.rates.store');
    Route::get('payroll/set-hourly-rate/{HourRate}', [HourlyPayrollController::class, 'edit_hourly_rate'])->name('hourly.rates.edit');
    Route::patch('payroll/update-hourly-rate/{id}', [HourlyPayrollController::class, 'update'])->name('hourly.rate.update');
    Route::delete('hourly-rate/delete/{id}', [HourlyPayrollController::class, 'destroy'])->name('hourly.rate.delete');

    //manage salary
    Route::get('payroll/manage_a_employee_payroll/{id}', [PayrollController::class, 'manage_a_employee_payroll'])->name('payroll.manage-a-employee-payroll');
    Route::get('payroll/manage-salary/{id?}', [PayrollController::class, 'get_manage_salary'])->name('payroll.manage-salary');
    Route::post('payroll/manage-a-salary', [PayrollController::class, 'get_manage_a_salary'])->name('payroll.manage-a-salary');
    Route::patch('payroll/manage-a-salary/{id}', [PayrollController::class, 'update_department_salary'])->name('payroll.update.salary');


    Route::get('payroll/salary-list', [PayrollController::class, 'employee_salary_list'])->name('payroll.salary-list');
    // Route::get('payroll/generate-payslip', [PayrollController::class, 'generate_payslip'])->name('payroll.generate-payslip');
    Route::get('payroll/payroll-summary', [PayrollController::class, 'payroll_summary'])->name('payroll.payroll-summary');
    Route::get('payroll/advance-salary', [PayrollController::class, 'advance_salary'])->name('payroll.advance-salary');
    Route::get('payroll/provident-fund', [PayrollController::class, 'provident_fund'])->name('payroll.provident-fund');


    //create welfare http://127.0.0.1:8000/employee/4 
    Route::get('payroll/welfare/create', [WelfareController::class, 'create'])->name('welfare.create');
    Route::post('payroll/welfare/create', [WelfareController::class, 'store']);

    //create welfare request
    Route::get('payroll/welfare/request', [WelfareFundRequestController::class, 'create'])->name('welfare.request');
    Route::post('payroll/welfare/request', [WelfareFundRequestController::class, 'store']);


    // Route::get('payroll/provident-fund', [])

    //welfare contribution functionalites http://127.0.0.1:8000/employee/create
    Route::get('payroll/welfare-fund', [WelfareFundController::class, 'index'])->name('payroll.welfare-fund');
    Route::get('payroll/welfare-fund/create', [WelfareFundController::class, 'create'])->name('welfare.fund.create');

    Route::post('payroll/welfare/contribution', [WelfareFundController::class, 'store'])->name('welfare.contributions.store');



    Route::get('organization/deleted', [OrganizationController::class, 'getDeletedOrganization'])->name('organization.deleted');
    Route::get('organization/restore/{id}', [OrganizationController::class, 'restore'])->name('organization.restore');
    Route::delete('organization/delete/{id}', [OrganizationController::class, 'permanentDelete'])->name('organization.permanent-delete');
    Route::resource('organization', OrganizationController::class);

    Route::get('location/deleted', [LocationController::class, 'getDeletedLocation'])->name('location.deleted');
    Route::get('location/restore/{id}', [LocationController::class, 'restore'])->name('location.restore');
    Route::delete('location/delete/{id}', [LocationController::class, 'permanentDelete'])->name('location.permanent-delete');
    Route::resource('location', LocationController::class);

    Route::get('sub-location/deleted', [SubLocationController::class, 'getDeletedSubLocation'])->name('sub-location.deleted');
    Route::get('sub-location/restore/{id}', [SubLocationController::class, 'restore'])->name('sub-location.restore');
    Route::delete('sub-location/delete/{id}', [SubLocationController::class, 'permanentDelete'])->name('sub-location.permanent-delete');
    Route::resource('sub-location', SubLocationController::class);

    Route::get('disease/deleted', [DiseaseController::class, 'getDeletedDisease'])->name('disease.deleted');
    Route::get('disease/restore/{id}', [DiseaseController::class, 'restore'])->name('disease.restore');
    Route::delete('disease/delete/{id}', [DiseaseController::class, 'permanentDelete'])->name('disease.permanent-delete');
    Route::resource('disease', DiseaseController::class);

    Route::resource('profile', ProfileController::class);
    Route::resource('env-dynamic', EnvDynamicController::class);
    Route::get('get-lpr-date', [ProfileController::class, 'lprDate']);
    Route::get('fetch-duration', [ForeignTrainingController::class, 'duration']);
    Route::get('/fetch-duration2', [ForeignTrainingController::class, 'duration2'])->name('fetch-duration2');
    Route::get('employee-age/{dob}', [EmployeeController::class, 'age']);

    Route::get('department/deleted', [DepartmentController::class, 'getDeletedDepartment'])->name('department.deleted');
    Route::get('department/restore/{id}', [DepartmentController::class, 'restore'])->name('department.restore');
    Route::delete('department/delete/{id}', [DepartmentController::class, 'permanentDelete'])->name('department.permanent-delete');
    Route::resource('department', DepartmentController::class);

    Route::get('office/deleted', [OfficeController::class, 'getDeletedOffice'])->name('office.deleted');
    Route::get('office/restore/{id}', [OfficeController::class, 'restore'])->name('office.restore');
    Route::delete('office/delete/{id}', [OfficeController::class, 'permanentDelete'])->name('office.permanent-delete');
    Route::resource('office', OfficeController::class);

    Route::get('sub-department/deleted', [SubDepartmentController::class, 'getDeletedSubDepartment'])->name('sub-department.deleted');
    Route::get('sub-department/restore/{id}', [SubDepartmentController::class, 'restore'])->name('sub-department.restore');
    Route::delete('sub-department/delete/{id}', [SubDepartmentController::class, 'permanentDelete'])->name('sub-department.permanent-delete');
    Route::resource('sub-department', SubDepartmentController::class);

    Route::get('designation/deleted', [DesignationController::class, 'getDeletedDesignation'])->name('designation.deleted');
    Route::get('designation/restore/{id}', [DesignationController::class, 'restore'])->name('designation.restore');
    Route::delete('designation/delete/{id}', [DesignationController::class, 'permanentDelete'])->name('designation.permanent-delete');
    Route::resource('designation', DesignationController::class);

    Route::get('division/deleted', [DivisionController::class, 'getDeletedDivision'])->name('division.deleted');
    Route::get('division/restore/{id}', [DivisionController::class, 'restore'])->name('division.restore');
    Route::delete('division/delete/{id}', [DivisionController::class, 'permanentDelete'])->name('division.permanent-delete');
    Route::resource('division', DivisionController::class);

    Route::get('district/deleted', [DistrictController::class, 'getDeletedDistrict'])->name('district.deleted');
    Route::get('district/restore/{id}', [DistrictController::class, 'restore'])->name('district.restore');
    Route::delete('district/delete/{id}', [DistrictController::class, 'permanentDelete'])->name('district.permanent-delete');
    Route::resource('district', DistrictController::class);

    Route::get('upazila/deleted', [UpazilaController::class, 'getDeletedUpazila'])->name('upazila.deleted');
    Route::get('upazila/restore/{id}', [UpazilaController::class, 'restore'])->name('upazila.restore');
    Route::delete('upazila/delete/{id}', [UpazilaController::class, 'permanentDelete'])->name('upazila.permanent-delete');
    Route::resource('upazila', UpazilaController::class);

    Route::resource('village', VillageController::class);

    Route::post('employee/training', [EmployeeTrainingController::class, 'store'])->name('employee-training');

    Route::get('get-nominees/{id}', [EmployeeController::class, 'getNominees'])->name('employee.nominees'); //search by multi column name
    Route::any('employee/search', [EmployeeController::class, 'search'])->name('employee.search'); //search by multi column name
    Route::any('employee/export-dynamic', [EmployeeController::class, 'exportDynamic'])->name('employee.export-dynamic'); //search by multi column name
    Route::get('users/export/', [EmployeeController::class, 'export_excel'])->name('employees.export');
    Route::any('employees/dynamic-export/', [EmployeeController::class, 'export_excel_dynamic'])->name('export_excel_dynamic');
    Route::get('employee-assign/{id}', [EmployeeController::class, 'assign'])->name('employee.assign');
    Route::get('search-employee', [EmployeeController::class, 'searchEmployee']); //search by pin no.
    Route::get('get-employees-info', [EmployeeController::class, 'getEmployeesInfo']);
    Route::get('employee/deleted', [EmployeeController::class, 'getDeletedEmployee'])->name('employee.deleted');
    Route::get('employee/prl-list', [EmployeeController::class, 'getPrlEmployees'])->name('employee.prl-list');
    Route::get('employee/upcoming-prl', [EmployeeController::class, 'getUpcomingPrlEmployees'])->name('employee.upcoming-prl');
    Route::get('employee/restore/{id}', [EmployeeController::class, 'restore'])->name('employee.restore');
    Route::delete('employee/delete/{id}', [EmployeeController::class, 'permanentDelete'])->name('employee.permanent-delete');
    Route::get('employee/latest/promotion-lists', [EmployeeController::class, 'latestPromotionLists'])->name('employee.latest.promotion.list');
    Route::resource('employee', EmployeeController::class);
    // 

    Route::post('/employee-basic-info', [EmployeeCRUDController::class, 'storeBasicInfo'])->name('employee-basic-store');
    Route::post('/employee-work-station', [EmployeeCRUDController::class, 'workStation'])->name('employee-work-station');
    Route::post('/employee-address', [EmployeeCRUDController::class, 'Address'])->name('employee-address');
    Route::post('/employee-education', [EmployeeCRUDController::class, 'Education'])->name('employee-education');
    Route::post('/employee-experience', [EmployeeCRUDController::class, 'Experience'])->name('employee-experience');
    Route::post('/employee-family', [EmployeeCRUDController::class, 'Family'])->name('employee-family');
    Route::post('/employee-journal', [EmployeeCRUDController::class, 'Journal'])->name('employee-journal');
    Route::post('/employee-nominee', [EmployeeCRUDController::class, 'Nominee'])->name('employee-nominee');
    Route::post('/employee-emergency', [EmployeeCRUDController::class, 'Emergency'])->name('employee-emergency');
    Route::post('/employee-training', [EmployeeCRUDController::class, 'Training'])->name('employee-training');
    Route::post('/employee-disease', [EmployeeCRUDController::class, 'Disease'])->name('employee-disease');
    Route::post('/employee-update-basic', [EmployeeCRUDController::class, 'updateBasicInfo'])->name('employee-update-basic');


    // 
    Route::get('fetch-divisions', [StationController::class, 'fetch_divisions']);
    Route::get('fetch-districts/{id}', [StationController::class, 'fetch_districts'])->name('fetch_districts');
    Route::get('fetch-upazillas', [StationController::class, 'fetch_upazillas'])->name('all-thana');
    Route::get('/fetch-branch/{district_id}', [StationController::class, 'fetch_branch'])->name('fetch_branch');

    Route::get('fetch-district', [StationController::class, 'fetch_district']);
    Route::get('fetch-thana/{id}', [StationController::class, 'fetch_thana'])->name('fetch-thana');

    Route::get('fetch-station-office-details', [StationController::class, 'fetch_division_district_thana'])->name('fetch-division-district-thana');

    Route::get('grade/deleted', [GradeController::class, 'getDeletedGrade'])->name('grade.deleted');
    Route::get('grade/restore/{id}', [GradeController::class, 'restore'])->name('grade.restore');
    Route::delete('grade/delete/{id}', [GradeController::class, 'permanentDelete'])->name('grade.permanent-delete');
    Route::resource('grade', GradeController::class);

    Route::get('education/deleted', [EducationController::class, 'getDeletedEducation'])->name('education.deleted');
    Route::get('education/restore/{id}', [EducationController::class, 'restore'])->name('education.restore');
    Route::delete('education/delete/{id}', [EducationController::class, 'permanentDelete'])->name('education.permanent-delete');
    Route::resource('education', EducationController::class);

    Route::resource('subject', SubjectController::class);

    Route::resource('batch', BatchController::class);

    Route::resource('institute', InstituteController::class);

    Route::resource('action', ActionController::class);

    Route::get('station/deleted', [StationController::class, 'getDeletedStation'])->name('station.deleted');
    Route::get('station/restore/{id}', [StationController::class, 'restore'])->name('station.restore');
    Route::delete('station/delete/{id}', [StationController::class, 'permanentDelete'])->name('station.permanent-delete');
    Route::resource('station', StationController::class);

    Route::get('nominee/deleted', [NomineeController::class, 'getDeletedNominee'])->name('nominee.deleted');
    Route::get('nominee/restore/{id}', [NomineeController::class, 'restore'])->name('nominee.restore');
    Route::delete('nominee/delete/{id}', [NomineeController::class, 'permanentDelete'])->name('nominee.permanent-delete');
    Route::get('nominee/delete-soft/{id}', [NomineeController::class, 'softDelete'])->name('nominee.soft-delete');
    Route::resource('nominee', NomineeController::class);

    Route::get('award/deleted', [AwardController::class, 'getDeletedAward'])->name('award.deleted');
    Route::get('award/restore/{id}', [AwardController::class, 'restore'])->name('award.restore');
    Route::delete('award/delete/{id}', [AwardController::class, 'permanentDelete'])->name('award.permanent-delete');
    Route::get('award/get-employee-id', [AwardController::class, 'getAwardedEmployeeId'])->name('get-awarded-employee-id');
    Route::get('award/search-employee/{awardId}', [AwardController::class, 'selectEmployee'])->name('search-employee-for-award');
    Route::get('award/add-employee', [AwardController::class, 'setAward'])->name('add-employee-to-award');
    Route::post('award/store-employee', [AwardController::class, 'addEmployeesToAward'])->name('add-employee-to-award-store');
    Route::get('award/show-awarded-employee/{awardId}/{employeeId}', [AwardController::class, 'showAwardedEmployee'])->name('show-awarded-employee');
    Route::get('award/edit-awarded-employee/{awardId}/{employeeId}', [AwardController::class, 'editAwardedEmployee'])->name('edit-awarded-employee');
    Route::post('award/update-awarded-employee', [AwardController::class, 'updateAwardedEmployee'])->name('update-awarded-employee');
    Route::get('award/pending-employee', [AwardController::class, 'pendingEmployeesToAward'])->name('pending-employee-to-award');
    Route::get('award/approve-deny-employee/{awardId}/{status}', [AwardController::class, 'approveDenyEmployeesToAward'])->name('approve-deny-employee-to-award');
    Route::delete('award/employee-delete/{awardId}/{employeeId}', [AwardController::class, 'deleteAwardedEmployee'])->name('awarded-employee-delete');
    Route::get('award/attachment_file/{id}', [AwardController::class, 'attachment_file'])->name('award.attachment.file');
    Route::resource('award', AwardController::class);

    Route::get('achievement/deleted', [AchievementController::class, 'getDeletedAchievement'])->name('achievement.deleted');
    Route::get('achievement/restore/{id}', [AchievementController::class, 'restore'])->name('achievement.restore');
    Route::delete('achievement/delete/{id}', [AchievementController::class, 'permanentDelete'])->name('achievement.permanent-delete');
    Route::get('achievement/get-employee-id', [AchievementController::class, 'getAchievementEmployeeId'])->name('get-achievement-employee-id');
    Route::get('achievement/search-employee/{achievementId}', [AchievementController::class, 'selectEmployee'])->name('search-employee-for-achievement');
    Route::get('achievement/add-employee', [AchievementController::class, 'setAward'])->name('add-employee-to-achievement');
    Route::post('achievement/store-employee', [AchievementController::class, 'addEmployeesToAchievement'])->name('add-employee-to-achievement-store');
    Route::get('achievement/edit-achievement-employee/{achievementId}/{employeeId}', [AchievementController::class, 'editAchievementEmployee'])->name('edit-achievement-employee');
    Route::get('achievement/show-achievement-employee/{achievementId}/{employeeId}', [AchievementController::class, 'showAchievementEmployee'])->name('show-achievement-employee');
    Route::post('achievement/update-achievement-employee', [AchievementController::class, 'updateAchievementEmployee'])->name('update-achievement-employee');
    Route::get('achievement/pending-employee', [AchievementController::class, 'pendingEmployeesToAchievement'])->name('pending-employee-to-achievement');
    Route::get('achievement/approve-deny-employee/{achievementId}/{status}', [AchievementController::class, 'approveDenyEmployeesToAchievement'])->name('approve-deny-employee-to-achievement');
    Route::delete('achievement/employee-delete/{achievementId}/{employeeId}', [AchievementController::class, 'deleteAchievementEmployee'])->name('achievement-employee-delete');
    Route::get('achievement/attachment_file/{id}', [AchievementController::class, 'attachment_file'])->name('achievement.attachment.file');
    Route::resource('achievement', AchievementController::class);

    Route::get('punishment/deleted/show/{id}', [PunishmentController::class, 'punishmentDeletedShow'])->name('punishment.deleted.show');
    Route::get('punishment/deleted', [PunishmentController::class, 'getDeletedPunishment'])->name('punishment.deleted');
    Route::get('punishment/restore/{id}', [PunishmentController::class, 'restore'])->name('punishment.restore');
    Route::delete('punishment/delete/{id}', [PunishmentController::class, 'permanentDelete'])->name('punishment.permanent-delete');
    Route::get('punishment/get-employee-id', [PunishmentController::class, 'getPunishmentEmployeeId'])->name('get-punishment-employee-id');
    Route::get('punishment/search-employee/{punishmentId}', [PunishmentController::class, 'selectEmployee'])->name('search-employee-for-punishment');
    Route::get('punishment/add-employee', [PunishmentController::class, 'setPunishment'])->name('add-employee-to-punishment');
    Route::post('punishment/store-employee', [PunishmentController::class, 'addEmployeesToPunishment'])->name('add-employee-to-punishment-store');
    Route::get('punishment/show-punishment-employee/{pivotId}', [PunishmentController::class, 'showPunishedEmployee'])->name('show-punishment-employee');
    Route::get('punishment/edit-punishment-employee/{pivotId}', [PunishmentController::class, 'editPunishedEmployee'])->name('edit-punishment-employee');
    Route::post('punishment/update-punishment-employee', [PunishmentController::class, 'updatePunishedEmployee'])->name('update-punishment-employee');
    Route::get('punishment/pending-employees', [PunishmentController::class, 'pendingEmployeesToPunishment'])->name('pending-employee-to-punishment');
    Route::get('punishment/approve-deny-employee/{punishmentId}/{status}', [PunishmentController::class, 'approveDenyEmployeesToPunishment'])->name('approve-deny-employee-to-punishment');
    Route::delete('punishment/remove-employee/{employeePunishmentId}', [PunishmentController::class, 'removeEmployeeFromPunishment'])->name('remove-employee-from-punishment');
    Route::get('punishment/attachment_file/{id}', [PunishmentController::class, 'attachment_file'])->name('punishment.attachment.file');
    Route::resource('punishment', PunishmentController::class);

    Route::get('leave/deleted', [LeaveController::class, 'getDeletedLeave'])->name('leave.deleted');
    Route::get('leave/restore/{id}', [LeaveController::class, 'restore'])->name('leave.restore');
    Route::get('leave/edit-history', [LeaveController::class, 'editHistory'])->name('leave.edit-history');
    Route::delete('leave/delete/{id}', [LeaveController::class, 'permanentDelete'])->name('leave.permanent-delete');
    Route::get('leave/get-employee-id', [LeaveController::class, 'getLeaveEmployeeId'])->name('get-leave-employee-id');
    Route::get('leave/search-employee/{leaveId}', [LeaveController::class, 'selectEmployee'])->name('search-employee-for-leave');
    Route::post('leave/store-employee', [LeaveController::class, 'addEmployeesToLeave'])->name('add-employee-to-leave-store');
    Route::post('leave/store-leaves-to-employee', [LeaveController::class, 'addLeavesToEmployee'])->name('add-leaves-to-employee-store');
    Route::get('leave/show-leave-employee/{pivotId}', [LeaveController::class, 'showLeaveEmployee'])->name('show-leave-employee');
    Route::get('leave/edit-leave-employee/{pivotId}', [LeaveController::class, 'editLeaveEmployee'])->name('edit-leave-employee');
    Route::post('leave/update-leave-employee', [LeaveController::class, 'updateLeaveEmployee'])->name('update-leave-employee');
    Route::get('leave/pending-employees', [LeaveController::class, 'pendingEmployeesToLeave'])->name('pending-employee-to-leave');
    Route::get('leave/approve-deny-employee/{leaveId}/{status}', [LeaveController::class, 'approveDenyEmployeesToLeave'])->name('approve-deny-employee-to-leave');
    Route::delete('leave/remove-employee/{employeeLeaveId}', [LeaveController::class, 'removeEmployeeFromLeave'])->name('remove-employee-from-leave');
    Route::get('leave/attachment_file/{id}', [LeaveController::class, 'attachment_file'])->name('leave.attachment.file');
    Route::resource('leave', LeaveController::class);

    Route::get('foreign-training/deleted', [ForeignTrainingController::class, 'getDeletedForeignTraining'])->name('foreign-training.deleted');
    Route::get('foreign-training/restore/{id}', [ForeignTrainingController::class, 'restore'])->name('foreign-training.restore');
    Route::delete('foreign-training/delete/{id}', [ForeignTrainingController::class, 'permanentDelete'])->name('foreign-training.permanent-delete');
    Route::get('foreign-training/get-employee-id', [ForeignTrainingController::class, 'getForeignTrainedEmployeeId'])->name('get-f-trained-employee-id');
    Route::get('foreign-training/search-employee/{fTrainingId}', [ForeignTrainingController::class, 'selectEmployee'])->name('search-employee-for-f-training');
    Route::get('foreign-training/add-employee', [ForeignTrainingController::class, 'setForeignTraining'])->name('add-employee-to-f-training');
    Route::post('foreign-training/store-employee', [ForeignTrainingController::class, 'addEmployeeToForeignTraining'])->name('add-employee-to-f-training-store');
    Route::post('foreign-training/store-foreign-trainings', [ForeignTrainingController::class, 'add_foreign_trainings_to_employee'])->name('add-foreign-trainings-to-employee');
    Route::get('foreign-training/show-foreign-trained-employee/{pivotId}', [ForeignTrainingController::class, 'showForeignTrainedEmployee'])->name('show-foreign-trained-employee');
    Route::get('foreign-training/edit-foreign-trained-employee/{pivotId}', [ForeignTrainingController::class, 'editForeignTrainedEmployee'])->name('edit-foreign-trained-employee');
    Route::post('foreign-training/update-foreign-trained-employee', [ForeignTrainingController::class, 'updateForeignTrainedEmployee'])->name('update-foreign-trained-employee');
    Route::get('foreign-training/pending-employees', [ForeignTrainingController::class, 'pendingEmployeesToForeignTraining'])->name('pending-employees-to-foreign-training');
    Route::get('foreign-training/approve-deny-employee/{foreign_training_id}/{status}', [ForeignTrainingController::class, 'approveDenyEmployeeToForeignTraining'])->name('approve-deny-employee-foreign-training');
    Route::delete('foreign-training/remove-employee/{employeeForeignTrainingId}', [ForeignTrainingController::class, 'removeEmployeeFromForeignTraining'])->name('remove-employee-from-foreign-training');
    Route::resource('foreign-training', ForeignTrainingController::class);

    Route::get('local-training/deleted', [LocalTrainingController::class, 'getDeletedLocalTraining'])->name('local-training.deleted');
    Route::get('local-training/restore/{id}', [LocalTrainingController::class, 'restore'])->name('local-training.restore');
    Route::delete('local-training/delete/{id}', [LocalTrainingController::class, 'permanentDelete'])->name('local-training.permanent-delete');
    Route::get('local-training/get-employee-id', [LocalTrainingController::class, 'getLocalTrainedEmployeeId'])->name('get-l-trained-employee-id');
    Route::get('local-training/search-employee/{lTrainingId}', [LocalTrainingController::class, 'selectEmployee'])->name('search-employee-for-l-training');
    Route::get('local-training/add-employee', [LocalTrainingController::class, 'setLocalTraining'])->name('add-employee-to-l-training');
    Route::post('local-training/store-employee', [LocalTrainingController::class, 'addEmployeeToLocalTraining'])->name('add-employee-to-l-training-store');
    Route::post('local-training/store-local-trainings', [LocalTrainingController::class, 'add_local_trainings_to_employee'])->name('add-local-trainings-to-employee');
    Route::get('local-training/show-local-trained-employee/{pivotId}', [LocalTrainingController::class, 'showLocalTrainedEmployee'])->name('show-local-trained-employee');
    Route::get('local-training/edit-local-trained-employee/{pivotId}', [LocalTrainingController::class, 'editLocalTrainedEmployee'])->name('edit-local-trained-employee');
    Route::post('local-training/update-local-trained-employee', [LocalTrainingController::class, 'updateLocalTrainedEmployee'])->name('update-local-trained-employee');
    Route::get('local-training/pending-employees', [LocalTrainingController::class, 'pendingEmployeesToLocalTraining'])->name('pending-employees-to-local-training');
    Route::get('local-training/approve-deny-employee/{local_training_id}/{status}', [LocalTrainingController::class, 'approveDenyEmployeeToLocalTraining'])->name('approve-deny-employee-local-training');
    Route::delete('local-training/remove-employee/{employeeLocalTrainingId}', [LocalTrainingController::class, 'removeEmployeeFromLocalTraining'])->name('remove-employee-from-local-training');
    Route::resource('local-training', LocalTrainingController::class);

    Route::get('inhouse-training/deleted', [InhouseTrainingController::class, 'getDeletedInhouseTraining'])->name('inhouse-training.deleted');
    Route::get('inhouse-training/restore/{id}', [InhouseTrainingController::class, 'restore'])->name('inhouse-training.restore');
    Route::delete('inhouse-training/delete/{id}', [InhouseTrainingController::class, 'permanentDelete'])->name('inhouse-training.permanent-delete');
    Route::get('inhouse-training/get-employee-id', [InhouseTrainingController::class, 'getInhouseTrainedEmployeeId'])->name('get-i-trained-employee-id');
    Route::get('inhouse-training/search-employee/{ITrainingId}', [InhouseTrainingController::class, 'selectEmployee'])->name('search-employee-for-i-training');
    Route::get('inhouse-training/add-employee', [InhouseTrainingController::class, 'setInhouseTraining'])->name('add-employee-to-i-training');
    Route::post('inhouse-training/store-employee', [InhouseTrainingController::class, 'addEmployeeToInhouseTraining'])->name('add-employee-to-i-training-store');
    Route::post('inhouse-training/store-inhouse-trainings', [InhouseTrainingController::class, 'add_inhouse_trainings_to_employee'])->name('add-inhouse-trainings-to-employee');
    Route::get('inhouse-training/show-inhouse-trained-employee/{pivotId}', [InhouseTrainingController::class, 'showInhouseTrainedEmployee'])->name('show-inhouse-trained-employee');
    Route::get('inhouse-training/edit-inhouse-trained-employee/{pivotId}', [InhouseTrainingController::class, 'editInhouseTrainedEmployee'])->name('edit-inhouse-trained-employee');
    Route::post('inhouse-training/update-inhouse-trained-employee', [InhouseTrainingController::class, 'updateInhouseTrainedEmployee'])->name('update-inhouse-trained-employee');
    Route::get('inhouse-training/pending-employees', [InhouseTrainingController::class, 'pendingEmployeesToInhouseTraining'])->name('pending-employees-to-inhouse-training');
    Route::get('inhouse-training/approve-deny-employee/{inhouse_training_id}/{status}', [InhouseTrainingController::class, 'approveDenyEmployeeToInhouseTraining'])->name('approve-deny-employee-inhouse-training');
    Route::delete('inhouse-training/remove-employee/{employeeInhouseTrainingId}', [InhouseTrainingController::class, 'removeEmployeeFromInhouseTraining'])->name('remove-employee-from-inhouse-training');
    Route::resource('inhouse-training', InhouseTrainingController::class);

    Route::get('posting-recordss/transfers', [PostingRecordController::class, 'getTransfers'])->name('posting-recordss.transfers');
    Route::get('posting-record/promotions', [PostingRecordController::class, 'getPromotions'])->name('posting-record.promotions');
    Route::get('posting-record/deleted', [PostingRecordController::class, 'getDeletedPostingRecord'])->name('posting-record.deleted');
    Route::get('posting-record/restore/{id}', [PostingRecordController::class, 'restore'])->name('posting-record.restore');
    Route::delete('posting-record/delete/{id}', [PostingRecordController::class, 'permanentDelete'])->name('posting-record.permanent-delete');
    Route::post('posting-record/add-posting-records-to-employee', [PostingRecordController::class, 'add_posting_records_to_employee'])->name('add-posting-records-to-employee');
    Route::get('posting-record/export-all', [PostingRecordController::class, 'export_excel'])->name('posting-record.export');
    Route::resource('posting-record', PostingRecordController::class);

    Route::get('educational-qualification/deleted', [EducationalQualificationController::class, 'getDeletedEducationalQualification'])->name('educational-qualification.deleted');
    Route::get('educational-qualification/restore/{id}', [EducationalQualificationController::class, 'restore'])->name('educational-qualification.restore');
    Route::delete('educational-qualification/delete/{id}', [EducationalQualificationController::class, 'permanentDelete'])->name('educational-qualification.permanent-delete');
    Route::get('educational-qualification/delete-soft/{id}', [EducationalQualificationController::class, 'softDelete'])->name('educational-qualification.soft-delete');
    Route::resource('educational-qualification', EducationalQualificationController::class);

    //Route::resource('files', FileController::class);
    Route::resource('station-category', StationCategoryController::class);
    Route::get('employee/{employee_id}/pds_short', [EmployeeController::class, 'short_generate_pdf'])->name('short.pdf');
    Route::get('employee/{employee_id}/pds_long', [EmployeeController::class, 'long_generate_pdf'])->name('long.pdf');
    Route::get('attached_file', [EmployeeController::class, 'attached_file'])->name('attached.file');

    Route::get('relationship/deleted', [RelationshipController::class, 'getDeletedRelationship'])->name('relationship.deleted');
    Route::get('relationship/restore/{id}', [RelationshipController::class, 'restore'])->name('relationship.restore');
    Route::delete('relationship/delete/{id}', [RelationshipController::class, 'permanentDelete'])->name('relationship.permanent-delete');
    Route::resource('relationship', RelationshipController::class);

    Route::get('quota/deleted', [QuotaController::class, 'getDeletedQuota'])->name('quota.deleted');
    Route::get('quota/restore/{id}', [QuotaController::class, 'restore'])->name('quota.restore');
    Route::delete('quota/delete/{id}', [QuotaController::class, 'permanentDelete'])->name('quota.permanent-delete');
    Route::resource('quota', QuotaController::class);

    Route::get('login-activity', [ActivityLogController::class, 'getLoginActivity'])->name('login-activity');
    Route::get('activity-log-clean-by-name', [ActivityLogController::class, 'cleanLoginActivity'])->name('activity-log-clean-by-name');
    Route::get('admin-activity', [ActivityLogController::class, 'getAdminActivity'])->name('admin-activity');
    Route::get('view-admin-activity/{id}', [ActivityLogController::class, 'viewAdminActivity'])->name('view-admin-activity');
    Route::post('revert-all-admin-activity/{id}', [ActivityLogController::class, 'revertAllAdminActivity'])->name('revert-all-admin-activity');
    Route::post('revert-admin-activity/{id}', [ActivityLogController::class, 'revertAdminActivity'])->name('revert-admin-activity');

});
Route::middleware('auth')->prefix('access-control')->group(function () {
    Route::resource('role', RoleController::class);
    Route::get('user/deleted', [UserController::class, 'getDeletedUser'])->name('user.deleted');
    Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user/permanent-delete/{id}', [UserController::class, 'permanentDelete'])->name('user.permanent-delete');
    Route::resource('user', UserController::class);
    Route::get('user-reset/{id}', [UserController::class, 'reset'])->name('user-reset');
    Route::post('bulk-delete', [HomeController::class, 'bulk_delete'])->name('bulk-delete');
    Route::post('approve-all', [HomeController::class, 'approve_all'])->name('approve-all');
    Route::post('deny-all', [HomeController::class, 'deny_all'])->name('deny-all');
    Route::resource('permission', PermissionController::class);
});

Route::get('/data/import/form', [DataImportController::class, 'importForm'])->name('data.import.form');
Route::post('/data/import', [DataImportController::class, 'dataImport'])->name('data.import');


