<?php

namespace Modules\CRM\Http\Controllers;
use App\Http\Controllers\Controller;
use Modules\CRM\Models\Currencies;
use Illuminate\Http\Request;
use Modules\CRM\Models\Customer;
use Modules\CRM\Models\Quotation;
use Modules\CRM\Models\QuotationItem;


class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $quotation_list       = Quotation::with('customer_details')->get();
        $quotation_item_list  = QuotationItem::all();
        return view('CRM::quotation.index', compact('quotation_list','quotation_item_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_list = Customer::all();
        $currencies_list = Currencies::all();

        return view('CRM::quotation.create',compact('customer_list','currencies_list'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (quotation::where("quotation_no", "=", $code)->first());
  
        return $code;
        // return view('CRM::quotation.create',compact('code'));

    }
    public function store(Request $request)
    {
        

        $quotation = new Quotation();
        $quotation->customer_id = $request->customer_id;
        $quotation->currency = $request->currencies_id;
        $quotation->quotation_no = $this->generateUniqueCode();
        $quotation->sub_total = $request->total;
        $quotation->total_discount = $request->total_discount;
        $quotation->shipping_cost = $request->shipping;     
        $quotation->total_tax =$request->total; 
        $quotation->status = 1;
        $quotation->save();

        $current_quotation_id = $quotation->quotation_id;
       
        if(!empty($request->all())); 
        {
            $item_name  = $request->item_name;
            $quantity  = $request->quantity;
            $unit_price = $request->unit_price;
            $discount   = $request->discount;
            $amount = $request->amount;

            foreach($item_name as $key => $value ){
                $data = QuotationItem::create([
                    'item_name'  =>  $value,
                    'quantity' => $quantity[$key],
                    'unit_price' => $unit_price[$key],
                    'discount' => $discount[$key],
                    'item_cost' => $amount[$key],
                    'quotation_id'   => $current_quotation_id,
                ]);
            }
        }

        return redirect()->route('quotation.index')->with('success', 'Quotation Added successfully');
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
        $customer_list = Customer::all();     
        $currencies_list= Currencies::all();
        $quotation = Quotation::find($id);
        $quotation_items = QuotationItem::where('quotation_id', $quotation->quotation_id)->get();
    //    dd($quotation_items);
        return view('CRM::quotation.edit', compact('quotation','quotation_items','customer_list','currencies_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $quotation      = Quotation::find($id);
        $quotation->customer_id = $request->customer_id;
        $quotation->currency = $request->currencies_id;
        $quotation->quotation_no = $this->generateUniqueCode();
        $quotation->sub_total = $request->total;
        $quotation->total_discount = $request->total_discount;
        $quotation->shipping_cost = $request->shipping;     
        $quotation->total_tax =$request->total; 
        $quotation->status = 1;
        $quotation->update();
       
        if(!empty($request->all())); 
        {
            $item_name  = $request->item_name;
            $quantity  = $request->quantity;
            $unit_price = $request->unit_price;
            $discount   = $request->discount;
            $amount = $request->amount;

            QuotationItem::where('quotation_id', $id)->delete(); 
              

            foreach($item_name as $key => $value ){
                $data = [
                    'item_name'  =>  $value,
                    'quantity' => $quantity[$key],
                    'unit_price' => $unit_price[$key],
                    'discount' => $discount[$key],
                    'item_cost' => $amount[$key],
                    'quotation_id'   => $id,
                ];
                QuotationItem::create($data);
            }
        }

        return redirect()->route('quotation.index')->with('success', 'Quotation Update successfully');
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         //    
    }
    public function DeleteQuotation(Request $request)
    {
        if (Quotation::where('quotation_id',$request->quotation_id)->exists()) {
        $quotation = Quotation::where('quotation_id',$request->quotation_id)->delete();
        $quotationitem = Quotationitem::where('quotation_id', $request->quotation_id)->delete(); 
            return response()->json(['quotation','quotationitem' => $quotation, $quotationitem, 'success' => 'Quotation Deleted Successfully']);
        }else{
            return response()->json(['success' => "Quotation can't beDeleted"]);
        }
    }

    
}
