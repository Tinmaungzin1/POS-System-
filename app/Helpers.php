<?php
use App\Models\Category;
use App\Models\Item;
use App\Constant;

if(!function_exists('getParentCategory')){

    function getParentCategory($parent_id, $item=false) {

        $categories = $categories = Category::where('parent_id', 0)
                                    ->whereNull('deleted_at')
                                    ->where('status', Constant::ENABLE_STATUS)
                                    ->get();

        foreach ($categories as $category) {
            $disabled = '';
            $parent_cat_id = $category['id'];
            $parent_cat_name = $category['name'];

            if($item) {
                $is_child_exit = checkChildCategoryExit($parent_cat_id);
                if($is_child_exit) {
                    $disabled = 'disabled';
                }

            } else {
                $is_item_exist = checkItemExit($parent_cat_id);
                if($is_item_exist) {
                    $disabled = 'disabled';
                }
            }

            if($parent_id == $parent_cat_id) {
                echo "<option value='$parent_cat_id' selected $disabled>$parent_cat_name</option>";
            } else {
                echo "<option value='$parent_cat_id' $disabled>$parent_cat_name</option>";
            }

            getChildCategory($parent_cat_id, 1, $parent_id, $item);
        }

    }
}

if(!function_exists('getChildCategory')){
        function getChildCategory($parent_cat_id, $count, $parent_id, $item=false)
    {
        $childCategories = $categories = Category::select('id', 'name')
                        ->where('parent_id', $parent_cat_id)
                        ->whereNull('deleted_at')
                        ->where('status', Constant::ENABLE_STATUS)
                        ->get();

        foreach ($childCategories as $childCategory) {
            $disabled = '';
            $child_cat_id = $childCategory['id'];
            $child_cat_name = $childCategory['name'];
            $dash = str_repeat('-- ', $count); // Include a space after each pair of hyphens

            if($item) {
                // $is_item_exist = checkItemExit($parent_cat_id);
                // if($is_item_exist) {
                //     $disabled = 'disabled';
                // }
                $is_child_exit = checkChildCategoryExit($child_cat_id);
                if($is_child_exit) {
                    $disabled = 'disabled';
                }
            } else {
                $is_item_exist = checkItemExit($child_cat_id); // Change here
                if ($is_item_exist) {
                    $disabled = 'disabled';
                }
            }

            if($parent_id == $child_cat_id) {
                echo "<option value='$child_cat_id' selected> $disabled" . $dash . $child_cat_name . " </option>";
            } else {
                echo "<option value='$child_cat_id' $disabled>" . $dash . $child_cat_name . " </option>";
            }

            $total = Category::where('parent_id', $child_cat_id)
                                        ->whereNull('deleted_at')
                                        ->where('status', Constant::ENABLE_STATUS)
                                        ->count();

            if($total > 0) {
                getChildCategory($child_cat_id, $count + 1, $parent_id,$item); // Increment count for deeper indentation
            }
        }
    }
}

if(!function_exists('checkChildCategoryExit')){
    function checkChildCategoryExit($parent_cat_id) {
        $total = 0;
        $total = Category::where('parent_id', $parent_cat_id)
                ->whereNull('deleted_at')
                ->where('status', Constant::ENABLE_STATUS)
                ->count();
            return $total;
     }
}

if(!function_exists('checkItemExit')){
    function checkItemExit($parent_cat_id){
        $total = 0;
        $total = Item::where('category_id', $parent_cat_id)
                ->whereNull('deleted_at')
                ->where('status', Constant::ENABLE_STATUS)
                ->count();
        return $total;
     }
}
