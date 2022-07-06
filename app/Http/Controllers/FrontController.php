<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;

class FrontController extends Controller
{
    public function index()
    {
        $categories=category::all();
        $blogs=Blog::where('status',1)->latest()->paginate(4);
        $featured_blog=Blog::latest()->first();
        return view('welcome',compact('categories','blogs','featured_blog'));
    }

}
