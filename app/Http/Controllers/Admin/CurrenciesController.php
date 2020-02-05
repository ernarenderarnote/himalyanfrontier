<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCurrencyRequest;
use App\Http\Requests\StoreCurrencyRequest;
use App\Http\Requests\UpdateCurrencyRequest;
use App\Currency;

class CurrenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(\Gate::allows('currency_access'), 403);

        $currencies = Currency::all();
        

        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.currencies.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrencyRequest $request)
    {
      //  abort_unless(\Gate::allows('currency_create'), 403);
       
        $input = $request->all();

        if(   Currency::create($input) ){
            $response = ['message' => 'Currency added successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.currencies.index')->with($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        abort_unless(\Gate::allows('currency_show'), 403);

        return view('admin.currencies.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        abort_unless(\Gate::allows('currency_edit'), 403);

        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrencyRequest $request, Currency $currency)
    {
        abort_unless(\Gate::allows('currency_edit'), 403);

        $input = $request->all();

        if(  $currency->update($input) ){
            $response = ['message' => 'Currency updated successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.currencies.index')->with($response); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setDefault($currency){
        $removeDefault   = Currency::where('is_default', '1')->update(array('is_default' => '0'));
        $setDefault      = Currency::where('id',$currency)->first();
        $setDefault->is_default = '1';
        if(  $setDefault->save() ){
            $response = ['message' => 'Currency set as default successfully.', 'alert-type' => 'success'];
        }
        return redirect()->route('admin.currencies.index')->with($response); 
    }
}
