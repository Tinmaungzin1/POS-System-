<?php

namespace App\Http\Controllers\Discount;

// use App\Constant;
use App\Utility;
// use App\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Models\Shift;
// use App\Repository\Shift\ShiftRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DiscountController extends Controller
{
    public function index() {
        try{
            $screen = "show shift screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.discount.discount');
        }catch(\Exception $e){
            $screen = "show shift screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function discountList() {
        return view('backend.discount.discount_list');
    }
}