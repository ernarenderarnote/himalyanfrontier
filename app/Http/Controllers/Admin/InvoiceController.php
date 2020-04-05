<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Invoice;
use App\Currency;
use App\PaymentSetting;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('admin.invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies       = Currency::all();
        return view('admin.invoices.create',compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $input = $request->all();
        
        $input['invoice_prefix'] = 'HIMFRPVT';

        $invoice = Invoice::latest()->first();
    

        if( empty($invoice) ){

            $invoice_id = '1000000000';
           
        }else{
            
            $invoice_id = $invoice->invoice_id + 1;
            
        }
        $input['invoice_id']     = $invoice_id;  

        if( Invoice::create($input) ){

            $response = ['message' => 'Invoice Saved Successfully.', 'alert-type' => 'success'];
        
        } 

        return redirect()->route('admin.invoices.index')->with($response); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $pdf = PDF::loadView('admin.invoices.show', compact('invoice'));
        return $pdf->stream('testfile.pdf')
        ->header('Content-Type','application/pdf');
    }    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $currencies       = Currency::all();
        return view('admin.invoices.edit',compact('invoice','currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $input = $request->all();
        
        $input['invoice_prefix'] = 'HIMFRPVT';

        if($invoice->update($input) ){

            $response = ['message' => 'Invoice Saved Successfully.', 'alert-type' => 'success'];
        
        } 

        return redirect()->route('admin.invoices.index')->with($response); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {

        if( $invoice->delete() ){
            $response = ['message' => 'Invoice Deleted Successfully.', 'alert-type' => 'success'];
        }

        return back()->with($response);
    }
    public function CalculatePrice(Request $request){
        $persons = $request->persons;
        $price   = $request->per_person_price;
        $tax     = $request->tax;
        if($tax == ''){
            $total_price = $persons * $price;
            $amount      = $persons * $price;
        }else{
            $approx_price = $persons * $price;
            $amount       = $persons * $price;
            $total_tax    = ($approx_price * $tax)/100;
            $total_price  = $approx_price + $total_tax; 
        }
        return response()->json(['msg'=>'success','total_price'=>number_format($total_price,2),'amount'=>number_format($amount,2)]);
    }

    public function downloadPDF($id){
        $invoice = Invoice::find($id);
        $pdf = PDF::loadView('admin.invoices.show', compact('invoice'));
        return $pdf->download('invoice.pdf');

    }
}
