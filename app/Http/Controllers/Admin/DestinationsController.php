<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDestinationRequest;
use App\Http\Requests\StoreDestinationRequest;
use App\Http\Requests\UpdateDestinationRequest;
use App\Destination;

class DestinationsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('destination_access'), 403);

        $destinations = Destination::all();

        return view('admin.destinations.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(\Gate::allows('destination_create'), 403);

        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDestinationRequest $request)
    {
        abort_unless(\Gate::allows('destination_create'), 403);
       
        $input = $request->all();
        
        $destination = new Destination();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            //dd(public_path('images'));
            $image->storeAs('images', $imageName);
            
            $input['thumbnails'] = $imageName;

        }

        if( Destination::create($input) ){
            $response = ['message' => 'Destination Added Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.destinations.index')->with($response); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Destination $destination)
    {
        abort_unless(\Gate::allows('destination_show'), 403);

        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Destination $destination)
    {
        abort_unless(\Gate::allows('destination_edit'), 403);

        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDestinationRequest $request, Destination $destination)
    {
        abort_unless(\Gate::allows('destination_edit'), 403);

        $input = $request->all();
        
        $input['slug'] = \Str::slug($request->title);

        if($request->has('image')) {

            $image =  $request->file('image');

            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            
            $image->storeAs('images', $imageName);
            
            $input['thumbnails'] = $imageName;

        }

        if( $destination->update($input) ){
            $response = ['message' => 'Destination Updated Successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.destinations.index')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destination $destination)
    {

        abort_unless(\Gate::allows('destination_delete'), 403);

        if( $destination->delete() ){
            $response = ['message' => 'Destination Deleted Successfully.', 'alert-type' => 'success'];
        }

        return back()->with($response);
    }

    public function massDestroy(MassDestroyDestinationRequest $request)
    {
        
        if( Destination::whereIn('id', request('ids'))->delete() ){
            $response = ['message' => 'Destination Added Successfully.', 'alert-type' => 'success'];
        }

        return response(null, 204);
    }
}
