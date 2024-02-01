<?php
namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\log;
use Intervention\Image\Facades\Image;


    class Utility {

        public static function updateBy(array $data) {
            $user_id    = Auth::guard('admin')->user()->id;
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $user_id;
            return $data;
        }

        public static function createBy(array $data) {
            $user_id    = Auth::guard('admin')->user()->id;
            $data['created_by'] = $user_id;
            $data['updated_by'] = $user_id;
            return $data;
        }

        public static function deleteBy() {
            $user_id    = Auth::guard('admin')->user()->id;
            $data['deleted_by'] = $user_id;
            $data['deleted_at'] = date('Y-m-d H:i:s');
            return $data;
        }

        public static function saveDebugLog($screen, $queryLog) {
            $formattedQueries = '';
            foreach ($queryLog as $query) {
                $sqlQuery = $query['query'];
                foreach ($query['bindings'] as $binding) {
                    $sqlQuery = preg_replace('/\?/', "'" . $binding . "'", $sqlQuery,1);
                }
                $formattedQueries .= $sqlQuery . PHP_EOL;
            }
            Log::debug($screen . "- \n" . $formattedQueries);
        }

        public static function saveErrorLog($screen, $errorMessage){
            Log::error($screen . "- \n" . $errorMessage);
        }

        public static function cropResize($file, $destination_path, $unique_name){
            if(!file_exists($destination_path)){
                mkdir($destination_path, 0777, true);
            }
            $modifiedImage      = Image::make($file)
                                    ->crop(Constant::IMAGE_WIDTH, Constant::IMAGE_HEIGHT)
                                    ->encode();
            $modifiedImage->save($destination_path. '/' . $unique_name);
        }
    }
