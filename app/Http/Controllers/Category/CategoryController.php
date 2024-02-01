<?php

namespace App\Http\Controllers\Category;

use App\Constant;
use App\Utility;
use App\ReturnMessage;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repository\Category\CategoryRepositoryInterface;
use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryFormRequest;
use App\Http\Requests\CategoryUpdateFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    private $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository){
        DB::connection()->enableQueryLog();
        $this->categoryRepository = $categoryRepository;
    }
    public function create() {
        try{
            $screen = "show category create screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.category.form');
        }catch(\Exception $e){
            $screen = "show category create screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function store(CategoryFormRequest $request) {
        try{
            $result = $this->categoryRepository->store($request->all());
            if($result['softGuidStatusCode'] == ReturnMessage::OK){
                $screen = "Insert Category form";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return redirect('/sg-backend/category')->with(['success-msg' => 'Success,create catrgory!']);
            }else{
                return redirect('/sg-backend/category')->withErrors(['error-msg' => 'Fail!create category error']);
            }
        }catch(\Exception $e){
            $screen = "Insert Category form";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }

    public function categoryList() {
        try{

            $categories = $this->categoryRepository->showList();
            $screen = "show category list screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.category.category_list' , compact(['categories']));
        }catch(\Exception $e) {
            $screen = "show category list screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function edit($id) {
        try{
            $result = $this->categoryRepository->edit((int) $id);
            if($result['softGuidStatusCode'] == ReturnMessage::OK){
            $category = $result['category'];
            if($category == null) {
                return response()->view('errors.404', [], 404);
            }
            $screen = "Edit category screen";
            $queryLog = DB::getQueryLog();
            Utility::saveDebugLog($screen, $queryLog);
            return view('backend.category.form', compact(['category']));
        } else {
            return redirect('/sg-backend/category')->withErrors(['error-msg' => 'Fail!edit category error']);
        };
        }catch(\Exception $e){
            $screen = "Edit category screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }

    }

    public function update(CategoryUpdateFormRequest $request) {
        try{
            $update_result = $this->categoryRepository->update((array) $request->all());
            if($update_result['softGuidStatusCode'] == ReturnMessage::OK) {
                $screen = "Update category screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return redirect('/sg-backend/category')->with(['success-msg' => 'Success,create catrgory!']);
            }else{
                return redirect('/sg-backend/category')->withErrors(['error-msg' => 'Fail!create category error']);
            }
        }catch(\Exception $e){
            $screen = "update category screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }

    public function delete(CategoryDeleteRequest $request){
        try{
            $delete = $this->categoryRepository->delete((array) $request->all());
            if($delete['softGuidStatusCode'] == ReturnMessage::OK){
                $screen = "Update category screen";
                $queryLog = DB::getQueryLog();
                Utility::saveDebugLog($screen, $queryLog);
                return back();
            }
        }catch(\Exception $e){
            $screen = "delete category screen";
            Utility::saveDebugLog($screen, $e->getMessage());
            abort(500);
        }
    }
}