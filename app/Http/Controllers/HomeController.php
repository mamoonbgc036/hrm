<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Award;
use App\Models\Brand;
use App\Models\Leave;
use App\Models\Station;
use App\Models\Employee;
use App\Models\Achievement;
use Illuminate\Http\Request;
use App\Models\LocalTraining;
use App\Models\PostingRecord;
use App\Models\ForeignTraining;
use App\Models\InhouseTraining;
use LaravelEnso\Charts\Factories\bar;
use Storage;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logos = Brand::all();
        Storage::put('dashboard_company_logo', $logos[0]->login_bk_small);
        $data = [];
        $data['all'] = Employee::query()
            ->where('status', 'active')
            ->count();
        $data['prl'] = Employee::query()
            ->where('status', 'active')
            ->where('lpr_date', "<=", Carbon::now()->format('Y-m-d'))
            ->count();
        $data['upcoming'] = Employee::query()
            ->where('status', 'active')
            ->whereBetween('lpr_date', [Carbon::now()->format('Y-m-d'), Carbon::now()->addYear()->format('Y-m-d')])
            ->count();
        $data['stations'] = Station::query()
            ->where('status', 'active')
            ->count();

        $data['total_transfer'] = PostingRecord::query()
            ->where('type', 'transfer')
            ->orWhere('type', 'both')
            ->get()->count();

        $data['total_promotion'] = PostingRecord::query()
            ->where('type', 'promotion')
            ->orWhere('type', 'both')
            ->get()->count();

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

        $transfer_group_by_month = [];
        foreach ($months as $key => $month) {
            $transfer_group_by_month[$key] = PostingRecord::query()
                ->whereIn('type', ['transfer', 'both'])
                ->whereBetween('from_date', [(date('Y') - 1) . '-' . $month . '-01', date('Y') . '-' . $month . '-31'])
                ->get()->count();
        }
        $data['transfer_group_by_month_last_year'] = $transfer_group_by_month;

        $promotion_group_by_month = [];
        foreach ($months as $key => $month) {
            $promotion_group_by_month[$key] = PostingRecord::query()
                ->whereIn('type', ['promotion', 'both'])
                ->whereBetween('from_date', [(date('Y') - 1) . '-' . $month . '-01', date('Y') . '-' . $month . '-31'])
                ->get()->count();
        }
        $data['promotion_group_by_month_last_year'] = $promotion_group_by_month;

        $awards = Award::all();
        $data['awarded_employee'] = [];
        $data['total_awarded_employee'] = 0;
        /*foreach ($awards as $key => $award) {
            $data['awarded_employee'][$key] = $award->approvedEmployees()->count();
            $data['total_awarded_employee'] += $data['awarded_employee'][$key];
        }*/

        $achievements = Achievement::all();
        $data['achievement_employee'] = [];
        $data['total_achievement_employee'] = 0;
        foreach ($achievements as $key => $achievement) {
            $data['achievement_employee'][$key] = $achievement->approvedEmployees()->count();
            $data['total_achievement_employee'] += $data['achievement_employee'][$key];
        }

        $leaves = Leave::all();
        $data['leave_employee'] = [];
        $data['total_leave_employee'] = 0;
        /*foreach ($leaves as $key => $leave) {
            $data['leave_employee'][$key] = $leave->approvedEmployees()->count();
            $data['total_leave_employee'] += $data['leave_employee'][$key];
        }*/

        $foreign_trainings = ForeignTraining::all();
        $data['foreign_trained_employee'] = [];
        $data['total_foreign_trained_employee'] = 0;
        foreach ($foreign_trainings as $key => $foreign_training) {
            $data['foreign_trained_employee'][$key] = $foreign_training->approvedEmployees()->count();
            $data['total_foreign_trained_employee'] += $data['foreign_trained_employee'][$key];
        }

        $local_trainings = LocalTraining::all();
        $data['local_trained_employee'] = [];
        $data['total_local_trained_employee'] = 0;
        foreach ($local_trainings as $key => $local_training) {
            $data['local_trained_employee'][$key] = $local_training->approvedEmployees()->count();
            $data['total_local_trained_employee'] += $data['local_trained_employee'][$key];
        }

        $inhouse_trainings = InhouseTraining::all();
        $data['inhouse_trained_employee'] = [];
        $data['total_inhouse_trained_employee'] = 0;
        foreach ($inhouse_trainings as $key => $inhouse_training) {
            $data['inhouse_trained_employee'][$key] = $inhouse_training->approvedEmployees()->count();
            $data['total_inhouse_trained_employee'] += $data['inhouse_trained_employee'][$key];
        }

        return view('home', $data);
    }

    /* ----- BULK DELETE FOR ANY MODEL ----- */
    public function bulk_delete(Request $request)
    {

        if (auth()->user()->can('Bulk delete employee operations')) {
            if ($request->model::query()->whereIn('id', $request->ids)->delete()) {
                return response()->json([
                    'message' => 'Bulk Delete Successful!',
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Something Went Wrong. Please try again!',
                    'success' => false,
                ]);
            }

        } else {
            $message = 'You Do Not Have The Permission for BULK DELETE!';
            return response()->json([
                'message' => $message,
                'success' => false,
            ]);
        }

    }
    /* ----- BULK DELETE FOR ANY MODEL ----- */

    /* ----- APPROVE ALL FOR ANY MODEL ----- */
    public function approve_all(Request $request)
    {

        if (auth()->user()->can('Approve all pending operations')) {
            if ($request->model::query()->where('status', 'inactive')->update(['status' => 'active'])) {
                return response()->json([
                    'message' => 'Approve All Successful!',
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Something Went Wrong. Please try again!',
                    'success' => false,
                ]);
            }

        } else {
            $message = 'You Do Not Have The Permission for APPROVE ALL!';
            return response()->json([
                'message' => $message,
                'success' => false,
            ]);
        }

    }
    /* ----- APPROVE ALL FOR ANY MODEL ----- */

    /* ----- DENY ALL FOR ANY MODEL ----- */
    public function deny_all(Request $request)
    {

        if (auth()->user()->can('Deny all pending operations')) {
            if ($request->model::query()->where('status', 'inactive')->delete()) {
                return response()->json([
                    'message' => 'Deny All Successful!',
                    'success' => true,
                ]);
            } else {
                return response()->json([
                    'message' => 'Something Went Wrong. Please try again!',
                    'success' => false,
                ]);
            }

        } else {
            $message = 'You Do Not Have The Permission for DENY ALL!';
            return response()->json([
                'message' => $message,
                'success' => false,
            ]);
        }

    }
    /* ----- DENY ALL FOR ANY MODEL ----- */

}
