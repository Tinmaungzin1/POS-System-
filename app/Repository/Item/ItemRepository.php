<?php
namespace App\Repository\Item;

use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemRepository implements ItemRepositoryInterface {

    public function store(array $data) {

        $reutrnArray = array();
        $reutrnArray['SoftGuideStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $file       = $data['image'];
            $name_without_extension     = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension                  = $file->getClientOriginalExtension();
            $unique_name                = $name_without_extension . '_' . date("Ymd_His") . '_' . uniqid() . "." . $extension;


            $insert_data = [];
            $insert_data['name']         = $data['name'];
            $insert_data['category_id']  = $data['category_id'];
            $insert_data['price']        = $data['price'];
            $insert_data['quantity']     = $data['quantity'];
            $insert_data['image']        = $unique_name;
            $ins_data        = Utility::createBy((array) $insert_data);
            $create_item    = Item::create($ins_data);

            $randomString = Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') .
                Str::random(1, 'abcdefghijklmnopqrstuvwxyz') .
                Str::random(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') .
                Str::random(1, 'abcdefghijklmnopqrstuvwxyz');
            $user_id = Auth::guard('admin')->user()->id;

            $last_inserted_id =$create_item->id;
            $code_no = $user_id . $last_inserted_id . '-' . $randomString;

            $item = Item::find($create_item->id);
            $update = $item->update(['code_no' => $code_no]);

            $destination_path =storage_path('app/public/upload/item/' . $create_item->id);
            Utility::cropResize($file, $destination_path, $unique_name);

            $reutrnArray['SoftGuideStatusCode'] = ReturnMessage::OK;
            $reutrnArray['update'] = $update;
            return $reutrnArray;
        }catch(\Exception $e){
            $screen = 'Item store screen';
            Utility::saveErrorLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function showList() {
        try{
            $items = Item::SELECT('id', 'name', 'category_id', 'price', 'quantity', 'code_no','status', 'image')
                    ->whereNull('deleted_at')
                    ->paginate(10);
            return $items;
        }catch(\Exception $e){
            $screen = "Item list screen";
            Utility::saveErrorLog($screen, $e->getMessage());
            abort(500);
        }

    }

    public function edit(int $id){
        try{
            $item = Item::find($id);
            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            $returnedArray['item'] = $item;
            return $returnedArray;
        }catch(\Exception $e){
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }
    public function update(array $data) {
        $returnedArray = array();
        $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try {
            $image_exist = false;
            $update_data = [];
            if (isset($data['image']) && $data['image']->isValid()) {
                // array_key_exists('image', $data')
                $image_exist = true;
                $file = $data['image'];
                $name_without_ext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $unique_name = $name_without_ext . "_" . date("Ydm_His") . "_" . uniqid() . "." . $extension;
                $update_data['image']        = $unique_name;
            }
            $update_data['name']         = $data['name'];
            $update_data['category_id']  = $data['category_id'];
            $update_data['price']        = $data['price'];
            $update_data['quantity']     = $data['quantity'];
            $item_id                     = $data['id'];


            $ins_data = Utility::updateBy((array) $update_data);

            $item = Item::find($item_id);
            if($image_exist == true) {

                $destination_path =storage_path('app/public/upload/item/' . $item_id);
                Utility::cropResize($file, $destination_path, $unique_name);
                $image_path = storage_path('app/public/upload/item/' . $item_id . '/' . $item->image);
                unlink($image_path);
            }
            $update = $item->update($ins_data);

            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            $returnedArray['update'] = $update;

            return $returnedArray;
        } catch (\Exception $e) {
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

    // public function delete(int $id) {
    //     $returnedArray = array();
    //     $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
    //     try{
    //        $deleteData = Utility::deleteBy();
    //        $category = Category::find($id);
    //        $delete = $category->update($deleteData);

    //        $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
    //         $returnedArray['delete'] = $delete;

    //         return $returnedArray;
    //     }catch(\Exception $e){
    //         $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
    //         $screen = "Category update screen";
    //         Utility::saveErrorLog($screen, $e->getMessage());
    //         abort(500);
    //     }
    // }

}
