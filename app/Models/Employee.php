<?php

namespace App\Models;

use DateTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Spatie\Activitylog\Traits\LogsActivity;

class Employee extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    //

    protected $guarded = ['id'];
    protected $table = 'employees';

    //spatie activity log
    protected static $logAttributes = ["*"];
    protected static $logName = 'Employee';
    protected $appends = ['tentative_confirmation_date', 'confirmation_date'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): \Spatie\Activitylog\LogOptions
    {
        return \Spatie\Activitylog\LogOptions::defaults()
            ->logOnly(['name', 'description'])
            ->useLogName('subject');
    }


    public static function religions()
    {
        return [
            'Islam',
            'Hinduism',
            'Christianity',
            'Buddhism',
            'Other Religion'
        ];
    }

    public static function categories()
    {
        return [
            'Award',
            'Achievement',
            'Leave',
            'Punishment',
            'Posting Record',
            'Abroad Training',
            'Inland Training',
            'Inhouse Training'
        ];
    }

    public static function blood_groups()
    {
        return [
            'A+',
            'A-',
            'B+',
            'B-',
            'O+',
            'O-',
            'AB+',
            'AB-'
        ];
    }


    public function staff_cases()
    {
        return $this->hasMany(StaffCase::class, 'employee_id', 'id');
    }


    public function getTentativeConfirmationDateAttribute()
    {

        $joinDate = Carbon::parse($this->join_date);
        $tentativeDate = Carbon::parse($this->tentative_date);
        $daysDifference = $joinDate->diffInDays($tentativeDate);

        return Carbon::parse($this->join_date)
            ->addDays($daysDifference)
            ->format('d/m/Y');

        // $tentativeMonths = Carbon::parse($this->tentative_date)->diffInMonths($joinDate);
        // return Carbon::parse($this->join_date)
        //     ->addMonths($tentativeMonths)
        //     ->format('d/m/Y');
    }

    public function getConfirmationDateAttribute()
    {
        $joinDate = Carbon::parse($this->join_date);
        $tentativeMonths = Carbon::parse($this->tentative_date)->diffInDays($joinDate);
        if ($this->extend_date) {
            $extendDays = Carbon::parse($this->tentative_date)->diffInDays(Carbon::parse($this->extend_date));
        } else {
            $extendDays = null; // or handle this case as needed
        }

        return $joinDate->addDays($tentativeMonths + $extendDays)
            ->format('d/m/Y');
    }

    public function employee_out()
    {
        return $this->hasOne(EmployeeOut::class, 'employee_id', 'id');
    }

    public function speciliazes()
    {
        return $this->hasMany(EmployeeSpecilizedSkills::class, 'employee_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function educations()
    {
        return $this->hasMany(EducationalQualification::class, 'employee_id', 'id')->latest('passing_year');
    }
    public function professional_experiences()
    {
        return $this->hasMany(ProfessionalExperience::class, 'employee_id', 'id');
    }
    public function getExperiences()
    {
        return $this->hasMany(Experience::class, 'employee_id', 'id');
    }
    public function RelationDetails()
    {
        return $this->hasMany(Relation_details::class, 'employee_id', 'id');
    }
    public function GurantorDetails()
    {
        return $this->hasMany(Gurantor::class, 'employee_id', 'id');
    }

    public function RefereeDetails()
    {
        return $this->hasMany(Referee::class, 'employee_id', 'id');
    }
    public function getContact()
    {
        return $this->hasMany(Contact::class, 'employee_id', 'id');
    }
    public function getDiseaseHist()
    {
        return $this->hasMany(Disease_hist::class, 'employee_id', 'id');
    }
    public function getTraining()
    {
        return $this->hasMany(Training::class, 'employee_id', 'id');
    }
    public function getNominee()
    {
        return $this->hasMany(Nominee::class, 'employee_id', 'id');
    }
    public function awards()
    {
        return $this->belongsToMany(Award::class, 'employee_awards')
            ->wherePivot('status', 'active')
            ->withPivot('issue_authorities', 'memo_no', 'memo_date', 'date', 'description', 'status', 'created_at')
            ->orderByPivot('date', 'desc')
            ->using(AwardEmployee::class)
            ->withTimestamps();
    }
    public function leaves()
    {
        return $this->belongsToMany(Leave::class, 'employee_leaves', 'employee_id', 'leave_id')
            ->wherePivot('status', 'active')
            ->withPivot('memo_no', 'memo_date', 'from_date', 'to_date', 'duration', 'description', 'status', 'created_at')
            ->orderByPivot('from_date', 'desc')
            ->using(LeaveEmployee::class)
            ->withTimestamps();
    }
    public function achievements()
    {
        return $this->belongsToMany(Achievement::class, 'achievement_employee', 'employee_id', 'achievement_id')
            ->withPivot('issue_authorities', 'memo_no', 'memo_date', 'date', 'description', 'status', 'created_at')
            ->wherePivot('status', 'active')
            ->orderByPivot('date', 'desc')
            ->using(AchievementEmployee::class)
            ->withTimestamps();
    }
    public function punishments()
    {
        return $this->belongsToMany(Punishment::class, 'employee_punishments', 'employee_id', 'punishment_id')
            ->wherePivot('status', 'active')
            ->withPivot('offence', 'action', 'from_date', 'to_date', 'duration', 'show_cause', 'financial_punishment_type', 'fine_amount', 'description', 'complaint_description', 'departmental_case_memo_no_date_and_section', 'settlement_punishment_memo_date_and_description_of_punishment', 'appeal_and_disposal_order_along_with_the_secretary', 'case_no_and_judgment_of_the_administrative_tribunal', 'case_no_and_judgment_of_the_administrative_appeal_tribunal', 'leave_to_memo_no_and_judgement', 'review_case_no_and_judgement', 'punishment_notice', 'accused_reply', 'action_apply', 'disposal_verdict', 'additional_notes', 'comments', 'complaint_file', 'departmental_case_file', 'settlement_punishment_file', 'appeal_and_disposal_file', 'case_no_and_judgment_file', 'case_no_administrative_file', 'leave_to_memo_file', 'review_case_no_file', 'punishment_notice', 'accused_reply_file', 'action_apply_file', 'disposal_verdict_file', 'additional_notes_file', 'comments_file', 'status', 'created_at')
            ->orderByPivot('from_date', 'desc')
            ->using(PunishmentEmployee::class)
            ->withTimestamps();
    }
    public function nominees()
    {
        return $this->hasMany(Nominee::class);
    }
    public function foreign_trainings()
    {
        return $this->belongsToMany(ForeignTraining::class, 'employee_foreign_trainings')
            ->withPivot('country_id', 'result', 'course_coordinator', 'venue', 'from_date', 'to_date', 'duration', 'memo_number', 'memo_date', 'description', 'status', 'created_at')
            ->wherePivot('status', 'active')
            ->orderByPivot('from_date', 'desc')
            ->using(ForeignTrainedEmployee::class)
            ->withTimestamps();
    }
    public function local_trainings()
    {
        return $this->belongsToMany(LocalTraining::class, 'employee_local_trainings')
            ->withPivot('country_id', 'result', 'course_coordinator', 'venue', 'location', 'from_date', 'to_date', 'duration', 'memo_number', 'memo_date', 'description', 'status', 'created_at')
            ->wherePivot('status', 'active')
            ->orderByPivot('from_date', 'desc')
            ->using(LocalTrainedEmployee::class)
            ->withTimestamps();
    }
    public function inhouse_trainings()
    {
        return $this->belongsToMany(InhouseTraining::class, 'employee_inhouse_training')
            ->withPivot('country', 'result', 'course_coordinator', 'venue', 'from_date', 'to_date', 'duration', 'memo_number', 'memo_date', 'description', 'status', 'created_at')
            ->wherePivot('status', 'active')
            ->orderByPivot('from_date', 'desc')
            ->using(InhouseTrainedEmployee::class)
            ->withTimestamps();
    }
    public function posting_records()
    {
        return $this->hasMany(PostingRecord::class)->latest('from_date');
    }
    public function spouses()
    {
        return $this->hasMany(Spouse::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function spouse_home_district()
    {
        return $this->belongsTo(District::class, 's_home_district_id', 'id');
    }
    public function thana()
    {
        return $this->belongsTo(Upazila::class, 'police_station_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    public function prCountry()
    {
        return $this->belongsTo(Country::class, 'present_country_id', 'id');
    }
    public function prDivision()
    {
        return $this->belongsTo(Division::class, 'pr_division_id', 'id');
    }
    public function prDistrict()
    {
        return $this->belongsTo(District::class, 'pr_district_id', 'id');
    }
    public function prUpzila()
    {
        return $this->belongsTo(Upazila::class, 'pr_upazila_id', 'id');
    }
    public function employee_home_district()
    {
        return $this->belongsTo(District::class, 'e_home_district_id', 'id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
    public function presentAddress()
    {
        return $this->hasOne(PresentAddress::class);
    }
    public function parmanentAddress()
    {
        return $this->hasOne(ParmanentAddress::class);
    }

    //job assign
    public function jobStation()
    {
        return $this->belongsTo(Station::class, 'police_station_id');
    }

    public function posting_station()
    {
        return $this->belongsTo(Station::class, 'station_id', 'id');
    }
    public function jobGrade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function monthly_grade()
    {
        return $this->hasOne(Salary_template::class, 'grade_id', 'grade_id');
    }

    public function hourGrade()
    {
        return $this->belongsTo(HourRate::class, 'grade_id', 'id');
    }

    public function salary_histories()
    {
        return $this->hasMany(SalaryHistory::class);
    }

    public function latestSalaryHistory()
    {
        return $this->hasOne(SalaryHistory::class)->latest('created_at');  // Or 'id' if based on ID
    }

    public function gradeType()
    {
        return $this->belongsTo(GradeType::class, 'grade_type_id', 'id');
    }

    public function jobOffice()
    {
        return $this->belongsTo(Office::class, 'office');
    }
    public function jobDivision()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
    public function jobDistrict()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
    public function jobUpazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    //attached_information

    public function attachedDesignation()
    {
        return $this->belongsTo(Designation::class, 'attached_designation_id', 'id');
    }
    public function attachedStation()
    {
        return $this->belongsTo(Station::class, 'attached_police_station_id');
    }
    public function attachedGrade()
    {
        return $this->belongsTo(Grade::class, 'attached_grade_id');
    }
    public function attachedOffice()
    {
        return $this->belongsTo(Office::class, 'attached_office');
    }
    public function attachedDivision()
    {
        return $this->belongsTo(Division::class, 'attached_division_id');
    }
    public function attachedDistrict()
    {
        return $this->belongsTo(District::class, 'attached_district_id');
    }
    public function attachedUpazila()
    {
        return $this->belongsTo(Upazila::class, 'attached_upazila_id');
    }

    public function availableNomineePercentage()
    {
        return 100 - $this->nominees()->sum('percentage');
    }

    public function getJoinDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d-m-Y') : '';
    }

    public function education_jsc()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->where('type', 'jsc');
    }

    public function education_ssc()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->where('type', 'ssc');
    }

    public function education_hsc()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->where('type', 'hsc');
    }

    public function education_graduation()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->where('type', 'graduation');
    }

    public function education_masters()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->where('type', 'masters');
    }

    public function education_more()
    {
        return $this->hasMany(EducationalQualification::class, 'employee_id', 'id')->where('type', 'more');
    }

    public function education_professional()
    {
        return $this->hasMany(ProfessionalExperience::class, 'employee_id', 'id')->latest();
    }

    public function all_educations()
    {
        return $this->hasMany(EducationalQualification::class, 'employee_id', 'id')->orderBy('passing_year');
    }

    public function highest_education()
    {
        return $this->hasOne(EducationalQualification::class, 'employee_id', 'id')->orderBy('passing_year', 'desc');
    }

    public function journals()
    {
        return $this->hasMany(Journal::class, 'employee_id', 'id')->orderBy('publication_date');
    }
    public function getPublication()
    {
        return $this->hasMany(Journal::class, 'employee_id', 'id');
    }
    public function calculateDuration($start, $end)
    {
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);

        if ($interval->y < 2) {
            $year = $interval->y . ' Year';
        } else {
            $year = $interval->y . ' Years';
        }

        if ($interval->m < 2) {
            $month = $interval->m . ' Month';
        } else {
            $month = $interval->m . ' Months';
        }

        $interval->d = $interval->d + 1;
        if ($interval->d < 2) {
            $day = $interval->d . ' Day';
        } else {
            $day = $interval->d . ' Days';
        }

        if ($interval->y == 0 && $interval->m == 0) {
            $duration = $day;
        } else if ($interval->y == 0) {
            $duration = $month . ', ' . $day;
        } else {
            $duration = $year . ', ' . $month . ', ' . $day;
        }

        return $duration;
    }

    public function last_promotion()
    {
        return $this->hasMany(PostingRecord::class)->latest('from_date')
            ->where('type', 'promotion')
            ->orWhere('type', 'both');
    }

    public function last_transfer()
    {
        return $this->hasMany(PostingRecord::class)->latest('from_date')
            ->where('type', 'transfer')
            ->orWhere('type', 'both');
    }

    public static function getTotalSal($employee)
    {
        $tAllowance = 0;
        $tDeduction = 0;

        if ($employee->monthly_grade && $employee->monthly_grade->allowances->count() > 0) {
            foreach ($employee->monthly_grade->allowances as $allowance) {
                $tAllowance += $allowance->allowance_value;
            }
        }

        if ($employee->monthly_grade && $employee->monthly_grade->deduction->count() > 0) {
            foreach ($employee->monthly_grade->deduction as $deduction) {
                $tDeduction += $deduction->deduction_value;
            }
        }
        $basicSal = $employee->monthly_grade->basic_salary ?? 0;
        return $tSal = $basicSal + $tAllowance - $tDeduction;
    }

}
