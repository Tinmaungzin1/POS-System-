<?php

namespace App\Http\Controllers\Item;

// use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemFormRequest;
use App\Http\Requests\ItemUpdateFormRequest;
use App\Http\Requests\ItemDeleteRequest;
use App\Models\Item;
use App\Repository\Item\ItemRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ItemController extends Controller
{
    private $itemRepository;
    public function __construct(ItemRepositoryInterface $itemRepository) {
        DB::connection()->enableQueryLog();
        $this->itemRepository = $itemRepository;
    }
    public function create() {
        try{
            $screen = "show shift screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.item.item');
        }catch(\Exception $e){
            $screen = "show shift screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function store(ItemFormRequest $request) {
        try{

            $item = $this->itemRepository->store($request->all());
            if($item['SoftGuideStatusCode'] == ReturnMessage::OK){
                $screen = "Item store screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return redirect('/sg-backend/item')->with(['success-msg' => 'Item created success']);
            }

        }catch(\Exception $e){
            $screen = "Item store screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }
    public function itemList() {
        try{
            $items =  $this->itemRepository->showList();
                $screen = "Item list screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return view('backend.item.item_list', compact(['items']));
        }catch(\Exection $e){
            $screen = "Item store screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }

    public function edit($id) {
        try{
            $result = $this->itemRepository->edit((int) $id);
            if($result['softGuidStatusCode'] == ReturnMessage::OK){
            $item = $result['item'];
            if($item == null) {
                return response()->view('errors.404', [], 404);
            }
            $screen = "Edit item screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.item.item', compact(['item']));
        } else {
            return redirect('/sg-backend/item')->withErrors(['error-msg' => 'Fail!edit item error']);
        };
        }catch(\Exception $e){
            $screen = "Edit category screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }



    }

    public function update(ItemUpdateFormRequest $request) {
        try{
            $update_result = $this->itemRepository->update((array) $request->all());
            if($update_result['softGuidStatusCode'] == ReturnMessage::OK) {
                $screen = "Update item screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return redirect('/sg-backend/item')->with(['success-msg' => 'Success,create catrgory!']);
            }else{
                return redirect('/sg-backend/item')->withErrors(['error-msg' => 'Fail!create item error']);
            }
        }catch(\Exception $e){
            $screen = "update item screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function delete(ItemDeleteRequest $request){
        dd($request->all());
        try{
            $delete = $this->itemRepository->delete((int) $id);
            if($delete['softGuidStatusCode'] == ReturnMessage::OK){
                $screen = "Update item screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return back();
            }
        }catch(\Exception $e){
            $screen = "delete item screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }
}