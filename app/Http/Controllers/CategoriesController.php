<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use File;
use Redirect;
use App\Http\Requests\CategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::with('sub_categories')
                                    ->orderBy('id','desc')
                                    ->get();
        return view('categories/index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        $category_image = $request->image;

        // create directory if not exist
        $dir = public_path('uploads')."/images";
        if (!File::exists($dir)){
            File::makeDirectory($dir,0777,true);
        }

        $image_new_name = time().uniqid().'.'.$category_image->extension();
        if($category_image->move($dir, $image_new_name)){
            $Categories = new Categories();
            $Categories->image = $image_new_name;
            $Categories->email_id = $request->email;
            $Categories->name = $request->name;
            $Categories->save();
            $last_inserted_id = $Categories->id;

            foreach($request->sub_category as $subcat){
                if(isset($subcat) && !empty($subcat)){
                    $sub_cat = new SubCategories();
                    $sub_cat->categories_id = $last_inserted_id;
                    $sub_cat->name = $subcat;
                    $sub_cat->save();
                }
            }

            $request->session()->flash('success', "Category has been added successfully.");
            return redirect()->route('categories.index');
        }
        else{
            $request->session()->flash('danger', "Image uploading fail,hence category not inserted.");
            return redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::with('sub_categories')
                                ->where('id',$id)
                                ->first();
        return view('categories/edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, $id)
    {
        $category_image = $request->image;

        if(!empty($category_image)){
            // create directory if not exist
            $dir = public_path('uploads')."/images";
            if (!File::exists($dir)){
                File::makeDirectory($dir,0777,true);
            }

            $image_new_name = time().uniqid().'.'.$category_image->extension();
            $category_image->move($dir, $image_new_name);

            // remove old file
            $old_file_dir = public_path('uploads')."/images/".$request->old_image;
            if (!File::exists($old_file_dir)){
                File::delete($old_file_dir);
            }
        }
        else{
            $image_new_name = $request->old_image;
        }
        

        $update_data = array();

        $update_data = array(
                            'name'      => $request->name,
                            'email_id'  => $request->email,
                            'image'     => $image_new_name,
                        );

        $is_update = Categories::where('id',$id)->update($update_data);

        if($is_update){

            SubCategories::where('categories_id',$id)->delete();

            foreach($request->sub_category as $subcat){
                if(isset($subcat) && !empty($subcat)){
                    $sub_cat = new SubCategories();
                    $sub_cat->categories_id = $id;
                    $sub_cat->name = $subcat;
                    $sub_cat->save();
                }
            }

            $request->session()->flash('success', "Category has been updated successfully.");
            return redirect()->route('categories.index');
        }
        else{
            $request->session()->flash('danger', "Category not updated successfully.");
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $check_Sub_Category = SubCategories::where('categories_id',$id)->count();

        if($check_Sub_Category <= 1){
            Categories::find($id)->delete();
            $request->session()->flash('success', "Category has been deleted successfully.");
            return redirect()->route('categories.index');
        }
        else{
            $request->session()->flash('danger', "Category already have 2 or more subcategories.");
            return redirect()->route('categories.index');
        }
    }
}
