<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Blog;

class BlogsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('blog_access'), 403);

        $blogs = Blog::orderBy('position', 'asc')
            ->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('blog_create'), 403);

        return view('admin.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        abort_unless(\Gate::allows('blog_create'), 403);
       
        $input = $request->all();
        
        $blog = new Blog();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images/blogs/featureImages', $imageName);
            
            $input['thumbnails'] = $imageName;

        }
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/blogs/galleryImages', $imagesname);
            }
            $input['gallery_img'] = json_encode($images_name);
        }
        if(  Blog::create($input) ){
            $response = ['message' => 'Blog Added Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.blogs.index')->with($response);
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        abort_unless(\Gate::allows('blog_show'), 403);

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        abort_unless(\Gate::allows('blog_edit'), 403);

        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        abort_unless(\Gate::allows('blog_edit'), 403);

        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images/blogs/featureImages', $imageName);
            
            $input['thumbnails'] = $imageName;

        }
        if($request->has('gallery_img')) {

            $gallery_images =  $request->file('gallery_img');
            $images_name = array();
            foreach($gallery_images as $gallery_image){
                $images_name[] = $gallery_image->getClientOriginalName();
                $imagesname = $gallery_image->getClientOriginalName();
                $gallery_image->storeAs('images/blogs/galleryImages', $imagesname);
            }
            $input['gallery_img'] = json_encode($images_name);
        }
        if(  $blog->update($input) ){
            $response = ['message' => 'Blog Updated Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.blogs.index')->with($response);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {

        abort_unless(\Gate::allows('blog_delete'), 403);

        $blog->delete();

        return back();
    }

    public function massDestroy(MassDestroyBlogRequest $request)
    {
        
        Blog::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }

    public function blogPosition(Request $request){
        foreach ($request->order as $order) {
            $blog = Blog::where("id", $order['id'])->first();
            $blog->position = $order['position'];
            $blog->save();
        }   
        return response(['status' => 'success']);
    }
}