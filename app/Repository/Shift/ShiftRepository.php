<?php
namespace App\Repository\Shift;

use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShiftRepository implements ShiftRepositoryInterface {

    public function getShiftStart() {
        try{
            $shift = Shift::SELECT(DB::RAW('count(id) as total'))
                    ->whereNotNull('start_date_time')
                    ->whereNull('end_date_time')
                    ->where('status','=',Constant::ENABLE_STATUS)
                    ->whereNull('deleted_at')
                    ->first();
                    return $shift;
        }catch(\Exception $e){
            $screen = "getShiftStart screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function updateShiftEnd() {
        $returnedArray = array();
        $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $data = [
                'end_date_time' => date('Y-m-d H:i:s')
            ];
            $update_data = Utility::updateBy((array) $data);
            $update = Shift::whereNull('end_date_time')->update($update_data);
            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            return $returnedArray;
        }catch(\Exception $e){
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

    public function create(array $data) {
        $returnedArray = array();
        $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $insertData = Utility::createBy((array) $data);
            Shift::create($insertData);
            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            return $returnedArray;
        }catch(\Exception $e){
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

    public function showList() {
        try{
            $shift = Shift::SELECT('id', 'start_date_time', 'end_date_time')
            ->where('status','=',Constant::ENABLE_STATUS)
            ->whereNull('deleted_at')
            ->orderBy('start_date_time', 'desc')
            ->paginate(2);
            return $shift;
        }catch(\Exception $e){
            $screen = "create screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }
}