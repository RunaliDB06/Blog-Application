<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
class BlogController extends Controller
{
    public function store(Request $request){

        $this->validate($request, [
            'tittle' => 'required',
            'dis' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'profile_image'=>'nullable',

        ]);
        $form = new Blog();
        $form->tittle=$request->tittle;
        $form->dis=$request->dis;
        $form->status=$request->status;
        $form->category_id=$request->category_id;
        if($request->hasfile('profile_image'))
        {
            $file=$request->file('profile_image');
            $extention=$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/blogs/',$filename);
            $form->profile_image=$filename;
        }

        $form->save();
        return redirect()->route('blog.index')->with('message', 'Added Successfully!');


    }
    public function create(Request $request){
        $categories = Category::all();
        return view('blog.create',compact('categories'));
    }



    public function index(){
        $forms = Blog::with('category')->latest()->paginate(10);
        return view('blog.index',compact('forms'));
    }

    public function edit($id){
        $categories = Category::all();

        $form = Blog::with('category')->find($id);
        return view('blog.simple',compact('form','categories'));


    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'tittle' => 'required',
            'dis' => 'required',
            'status' => 'required',
            'category_id' => 'required',
            'profile_image'=>'nullable',
        ]);
        $form = Blog::find($id);
        $form->tittle=$request->tittle;
        $form->dis=$request->dis;
        $form->status=$request->status;
        $form->category_id=$request->category_id;
        if($request->hasfile('profile_image'))
        {
            $file=$request->file('profile_image');
            $extention=$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('uploads/blogs/',$filename);
            $form->profile_image=$filename;
        }

        $form->save();

        return redirect()->route('blog.index')->with('message', 'Update Successfully!');
        



    }
    public function delete($id){
        $form = Blog::find($id);
        $form->delete();
        return redirect()->route('blog.index')->with('message', 'Delete Successfully!');


    }
    public function show($id){
     $blog=Blog::find($id);
     $categories= Category::paginate(6);
     return view('blog.show',compact('categories','blog'));
    }



}
