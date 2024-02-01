<?php

namespace App\Http\Controllers\Shift;

use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Repository\Shift\ShiftRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ShiftController extends Controller
{
    private $shiftRepository;
    public function __construct(ShiftRepositoryInterface $shiftRepository) {
        DB::connection()->enableQueryLog();
        $this->shiftRepository = $shiftRepository;
    }

    public function index() {
        try{
            $shift_open = false;
            $shift_count = $this->shiftRepository->getShiftStart();
                if($shift_count->total > 0) {
                    $shift_open = true;
                }
                $shift_list = $this->shiftRepository->showList();

                $screen = "show shift screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return view('backend.shift.shift', compact(['shift_open', 'shift_list']));
        }catch(\Exception $e){
            $screen = "show shift screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }
    public function start() {
        try{

            $today_date = date('Y-m-d H:i:s');
            $shift = $this->shiftRepository->getShiftStart();
            if($shift->total > 0){
                return redirect()->back()->withErrors(['error-msg' => 'Shift is already start!']);
            }else {
                $data = [];
                $data['start_date_time'] = date('Y-m-d H:i:s');
                $result = $this->shiftRepository->create($data);
                if($result['softGuidStatusCode'] == ReturnMessage::OK){
                    $screen = "Shift start form ";
                    $queryLog = DB::getQueryLog();
                    Utility::saveDebugLog($screen, $queryLog);
                    return redirect()->back()->with(['success-msg' => 'Success,Shift is starting now!']);
                }else{
                    return redirect()->back()->withErrors(['error-msg' => 'Fail!Shift can not open']);
                }
            }
        }catch(\Exception $e){
            $screen = "Shift start form";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function end() {
        try{

            $shift  = $this->shiftRepository->getShiftStart();
            if($shift->total <= 0){
                return redirect()->back()->withErrors(['error-msg' => 'Shift is already end!']);
            }else {
               $result = $this->shiftRepository->updateShiftEnd();
               if($result['softGuidStatusCode'] == ReturnMessage::OK){
                    $screen = "Shift end form ";
                    $queryLog = DB::getQueryLog();
                    Utility::saveDebugLog($screen, $queryLog);
                return redirect()->back()->with(['success-msg' => 'Success,Shift is closed now!']);
               }else {
                return redirect()->back()->withErrors(['error-msg' => 'Fail!Shift can not close!']);
               }
            }
        }catch(\Exception $e){
            $screen = "Shift end form";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }
}