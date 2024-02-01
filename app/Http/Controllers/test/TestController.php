<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TestFormRequest;
use App\Http\Requests\TestUpdateForm;
use App\Models\Shift;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{

    public function index() {
        $string = "i am string";
        $array = [
            'name' => 'mg mg',
            'age' => 22
        ];
        $insert_data = [
            'id' => 3,
            'start_date_time' => date('Y-m-d H:i:s'),
            'end_date_time' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_by' => 1,

        ];
        // $id = 3;
        // $update = Shift::find($id);
        // $update->start_date_time = date('Y-m-d H:i:s');
        // $update->save();

        // Shift::create($insert_data);
        // $delete_id = 1;
        // $delete = Shift::find($delete_id);
        // $delete->delete();
        $id=2;
        $shift_start = Shift::find($id);
        $shift = Shift::SELECT('id', 'start_date_time', 'end_date_time')->get();
        return view('test.test', compact(['string', 'array', 'shift', 'shift_start']));
    }

    public function showForm() {
        return view('test.show_form');
    }

    public function storeForm(TestFormRequest $request) {
        $data = $request->all();
        $data['created_by'] = 1;
        $data['updated_by'] = 1;

        Setting::create($data);
    }

    public function showList() {
        $settings = Setting::select('id', 'company_name', 'company_phone', 'company_email', 'company_address')
                        ->whereNull('deleted_at')->get();
        return view('test.show_list', compact(['settings']));
    }

    public function showEdit($id) {
        $setting = Setting::find($id);
        return view('test.show_form', compact(['setting']));
    }

    public function updateForm(TestUpdateForm $request){
        // dd($request->all());
        $data               = $request->all();
        $data['updated_by'] = 2;
        $setting            = Setting::find($data['id']);
        $setting->update($data);
        return to_route('showList');
        // return redirect()->route('showList');

    }
    public function showDelete($id){
        $delete = Setting::find($id);
        // dd($delete);
        $delete->delete();
        return back();
    }
    // public function testDelete($id){
    //     $delete = Setting::find($id);
    //     $delete->deleted_at = date('Y-m-d H:i:s');
    //     $delete->deleted_by = 1;
    //     $delete->save();
    //     return back();
    // }
    // public function testUpdate(Request $request){
    //     $id = $request->id;
    //     $data = Setting::find($id);
    //     $data->fill($request->all());
    //     $data->save();
    //     return redirect()->route('test#listPage');
    // }
    public function unauthorize() {
        return view('auth.unauthorize');
    }

}
