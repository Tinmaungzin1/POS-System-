<?php
namespace App\Repository\Category;

use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface {

    public function showList() {
        try{
            $category = Category::select(
                'category.id',
                'category.name',
                'category.parent_id',
                'category.status',
                'category.image',
                DB::raw('COALESCE(category_parent.name, "None") as parent_name')
            )
            ->leftJoin('category as category_parent', 'category.parent_id', '=', 'category_parent.id')
            ->whereNull('category.deleted_at')
            ->paginate(10);

        return $category;

        }catch(\Exception $e){
            $screen = "show shift screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function edit(int $id){
        try{
            $category = Category::find($id);
            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            $returnedArray['category'] = $category;
            return $returnedArray;
        }catch(\Exception $e){
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

    public function store(array $data){
            $returnedArray = array();
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{

            $file = $data['image'];
            $name_without_ext = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $unique_name = $name_without_ext . "_" . date("Ydm_His") . "_" . uniqid() . "." . $extension;
            $insert_data = [];
            $insert_data['name']         = $data['name'];
            $insert_data['parent_id']    = $data['parent_id'];
            $insert_data['status']    = $data['status'];
            $insert_data['image']        = $unique_name;
            $insData = Utility::createBy((array) $insert_data);
            $create_category = Category::create($insData);
            $destination_path =storage_path('app/public/upload/category/' . $create_category->id);

            Utility::cropResize($file, $destination_path, $unique_name);

            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
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
            $update_data['parent_id']    = $data['parent_id'];
            $update_data['status']       = $data['status'];
            $categoryId                 = $data['id'];

            $insData = Utility::updateBy((array) $update_data);
            $category = Category::find($categoryId);


            if($image_exist == true) {

                $destination_path =storage_path('app/public/upload/category/' . $categoryId);
                Utility::cropResize($file, $destination_path, $unique_name);
                $image_path = storage_path('app/public/upload/category/' . $categoryId . '/' . $category->image);
                unlink($image_path);
            }
            $update = $category->update($insData);
            $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            $returnedArray['update'] = $update;

            return $returnedArray;
        } catch (\Exception $e) {
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

    public function delete(array $data) {
        $returnedArray = array();
        $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
        try{
            $id = $data['id'];
            $deleteData  = Utility::deleteBy();
            $category    = Category::find($id);
            $delete      = $category->update($deleteData);

           $returnedArray['softGuidStatusCode'] = ReturnMessage::OK;
            $returnedArray['delete'] = $delete;

            return $returnedArray;
        }catch(\Exception $e){
            $returnedArray['softGuidStatusCode'] = ReturnMessage::INTERNAL_SERVER_ERROR;
            return $returnedArray;
        }
    }

}
