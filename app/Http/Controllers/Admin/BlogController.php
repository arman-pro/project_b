<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function __construct()
    {
        // user permission check
        $this->middleware('permission:blog-index,admin')->only(['index', 'show']);
        $this->middleware('permission:blog-create,admin')->only(['create', 'store']);
        $this->middleware('permission:blog-update,admin')->only(['edit', 'update']);
        $this->middleware('permission:blog-destroy,admin')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with(['user', 'categories', 'categories.category'])->orderBy("id", "desc")->get();
        return view("admin.blog.index", compact("blogs"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereIsActive(true)->get();
        return view("admin.blog.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $data = $request->all();

        if($request->file('image')) {
            $file_name = rand()."_".date('d_m_y').".".$request->file('image')->getClientOriginalExtension(); // set file name
            if(!$request->file('image')->storeAs('public/blogs/', $file_name)) // store image
                $file_name = null; // if fail to store image then set file name null
            $data['image'] = $file_name;
        }

        $data['created_by'] = Auth::guard('admin')->id();        
        $data['description'] = htmlentities($data['description']);
        $blog = Blog::create($data);
        foreach($request->categories as $category) {
            BlogCategory::create([
                'blog_id' => $blog->id,
                'category_id' => $category,
            ]);
        }
        return redirect()->route('admin.blogs.index')->with("message", "Blog create successfull!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($blog)
    {
        $blog = Blog::with(['categories', 'user', 'categories.category'])->find($blog);
        return view("admin.blog.view", compact("blog"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($blog)
    {
        $categories = Category::whereIsActive(true)->get();
        $blog = Blog::with(['categories', 'user', 'categories.category'])->find($blog);
        return view("admin.blog.edit", compact("blog", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $data = $request->all();
        $data["image"] = $blog->image;
        if($request->file('image')) {
            $file_path = storage_path("app/public/blogs/".$blog->image);
            if($blog->image && file_exists($file_path)) {
                unlink($file_path); // delete previous file
            }
            $file_name = rand()."_".date('d_m_y').".".$request->file('image')->getClientOriginalExtension(); // set file name
            if(!$request->file('image')->storeAs('public/blogs/', $file_name)) // store image
                $file_name = null; // if fail to store image then set file name null
            $data['image'] = $file_name;
        }

        $data['created_by'] = Auth::guard('admin')->id(); 
        $data['description'] = htmlentities($data['description']);
        $blog->update($data);
        BlogCategory::where('blog_id', $blog->id)->delete(); // delete blog category collections
        foreach($request->categories as $category) {
            BlogCategory::create([
                'blog_id' => $blog->id,
                'category_id' => $category,
            ]);
        }
        return redirect()->route("admin.blogs.index")->with("message", "Blog update successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        BlogCategory::where("blog_id", $blog->id)->delete();
        $blog->delete();
        return redirect()->route("admin.blogs.index")->with("message", "Blog delete successfull!");
    }
}
