<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card rounded shadow">
                        <form action="{{ route('quotation.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-header bg-transparent px-4 py-2">
                                <h4 class="mb-0">{{ __('crm.add_quotation')}}</h4>
                            </div>
                            <div class=" border-0 customer_form">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label for="country" class="form-label">
                                            {{ __('crm.select_customer')}}
                                        </label>
                                        <select class="form-select form-control" name="customer_id" id="" required="">
                                            <option selected disabled value="" disabled>{{ __('crm.select_customer')}}</option>
                                            @foreach ($customer_list as $customer)
                                            <option value="{{ $customer->customer_id }}">
                                                {{ $customer->first_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.select_customer')}}
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="country" class="form-label">{{ __('crm.select_currency')}}</label>
                                        <select class="form-select form-control" name="currencies_id" id="" required>
                                            <option selected disabled value="" disabled>{{ __('crm.select_currency')}}</option>
                                            @foreach ($currencies_list as $currencies)
                                            <option value="{{ $currencies->currencies_code }}">
                                                {{ $currencies->currencies_code }}-{{ $currencies->currencies_name }}
                                            </option>
                                            
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.select_currency')}}
                                        </div>
                                    </div>
                                </div>
                                <!--add more start--->
                                <div class="row fieldset_form ps-3">
                                    <div class="col-lg-12 mt-4">
                                        <div class="card border-0  ">
                                            <div class="table-responsive add-more" id="add">
                                                <table class="table table-center bg-white mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom text-left" style="min-width: 250px;">
                                                                {{ __('crm.description')}}
                                                            </th>
                                                            <!-- <th class="text-center border-bottom" style="min-width: 100px;">Hsn/Sac
                                                            </th> -->
                                                            <th class="text-center border-bottom" style="min-width: 100px;">{{ __('crm.qty')}}</th>
                                                            <th class="text-center border-bottom" style="min-width: 100px;">
                                                                {{ __('crm.unit_price')}}
                                                            </th>
                                                            <th class="text-center border-bottom" style="min-width: 200px;">{{ __('crm.discount')}}</th>
                                                            <th class="text-center border-bottom" style="min-width: 100px;"> {{ __('crm.amount')}}
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- Start -->
                                                        <tr>
                                                            <td>
                                                                <input name="item_name[]" type="text" class="form-control" id="" placeholder="Item Name" value="" required>

                                                                <div class="invalid-feedback">
                                                                    {{ __('crm.item_name_error')}}
                                                                </div>
                                                            </td>

                                                            <td class="text-center ">
                                                                <input name="quantity[]" type="number" class="form-control quantity" id="quantity" placeholder="" value="" required>

                                                                <div class="invalid-feedback">
                                                                    {{ __('crm.quantity_error')}}
                                                                </div>
                                                            </td>

                                                            <td class="text-center ">
                                                                <input name="unit_price[]" type="number" class="form-control unit_price" id="unit_price" placeholder="" value="" required>

                                                                <div class="invalid-feedback">
                                                                    {{ __('crm.unit_price_error')}}
                                                                </div>
                                                            </td>

                                                            <td class="text-center">
                                                                <input name="discount[]" type="number" class="form-control discount" id="discount" placeholder="" value="" required>

                                                                <div class="invalid-feedback">
                                                                    {{ __('crm.discount_error')}}
                                                                </div>
                                                            </td>

                                                            <td class="text-center ">
                                                                <input name="amount[]" type="number" class="form-control amount" id="amount" placeholder="" value="" required>
                                                                <div class="invalid-feedback">
                                                                    {{ __('crm.amount_error')}}
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div><!--end col-->                                   
                                    <div class="col-lg-12 my-4">
                                        <a href="javascript:void(0)" class="fw-bold addbuttom" id="addbuttom"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus lead_icon mg-r-5">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                            </svg>{{ __('crm.add_item')}} </a>
                                    </div><!--end col-->                                 
                                </div> <!--end row-->
                               
                                <div class="row border-top">                                  
                                    <div class="col-lg-6 pt-3 ps-4"> 
                                    </div><!--end row-->                                  
                                    <div class="col-lg-6">
                                        <div class="table-responsive ">
                                            <table class="table table-center bg-white mb-0 border" style="border-top:none">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ __('crm.sub_total')}} </td>
                                                        <td colspan="2">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="border:none; width:50%">
                                                                            <input name="sub_total" type="number" class="form-control addsub_total" id="sub_total" placeholder="" value="" required>

                                                                            <div class="invalid-feedback">
                                                                                {{ __('crm.sub_tatal_error')}}
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('crm.discount')}}</td>
                                                        <td colspan="2">
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style="border:none; width:50%">
                                                                            <input name="total_discount" type="number" class="form-control totalDiscount" id="" placeholder="" value="" required>

                                                                            <div class="invalid-feedback">
                                                                                {{ __('crm.discount_error')}}
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('crm.shipping')}}</td>
                                                        <td colspan="2">
                                                            <input name="shipping" type="number" class="form-control" id="shipping" placeholder="" value="" required>

                                                            <div class="invalid-feedback">
                                                                {{ __('crm.shipping_error')}}
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('crm.tax')}}</td>
                                                        <td>GST 27%</td>
                                                        <td style="text-align: right;">0.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ __('crm.payment_term')}}</td>
                                                        <td colspan="2"><select class="form-select form-control" name="payment_term" id="" >
                                                                <option value="">Select</option>
                                                                <option value="">Select </option>
                                                            </select>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><b>{{ __('crm.total')}}</b></td>
                                                        <td style="border:none; width:50%">
                                                            <input name="total" type="number" class="form-control" id="grandtotal" placeholder="" value="" >
                                                            
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 my-4 mx-4" required>
                                        <input type="submit" id="submit" name="send" class="btn btn-primary d-inline btn-size" value="{{__('common.submit')}}">
                                        <a href="{{route('quotation.index')}}" class="btn btn-light btn-size">{{__('common.goback')}}</a>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </form>
                    </div>                   
                </div><!--end col-->              
            </div> <!--end row-->
        </div> <!--end container-->
       
        <!-- this is use toggle button -->
        @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#addbuttom").on("click", function() {
                    $("#add").append(`
                    <div class="col-lg-12 mt-4 addmore">
                        <div class="card border-0  ">
                            <div class="table-responsive" id="add">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom text-left" style="min-width: 250px;">
                                                Description</th>
                                            
                                            <th class="text-center border-bottom" style="min-width: 100px;">Qty</th>
                                            <th class="text-center border-bottom" style="min-width: 100px;">Unit
                                                Price</th>
                                            <th class="text-center border-bottom" style="min-width: 200px;">Discount</th>
                                            <th class="text-center border-bottom" style="min-width: 100px;"> Amount
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        <tr>
                                            <td>
                                                <input name="item_name[]" type="text" class="form-control" id="" placeholder="Item Name" value="" required="">
                                            
                                                <div class="invalid-feedback">
                                                    {{ __('crm.item_name_error')}}
                                                </div>
                                            </td>
                                                                                                                                                                                
                                            <td class="text-center ">
                                                <input name="quantity[]" type="number" class="form-control addquantity" placeholder="" value="" required="">
                                            
                                                <div class="invalid-feedback">
                                                    {{ __('crm.quantity_error')}}
                                                </div>
                                            </td>
                                            <td class="text-center ">
                                                <input name="unit_price[]" type="number" class="form-control addunit_price" placeholder="" value="" required="">
                                            
                                                <div class="invalid-feedback">
                                                    {{ __('crm.unit_price_error')}}
                                                </div>
                                                </td>
                                            <td class="text-center">
                                                <input name="discount[]" type="number" class="form-control adddiscount" placeholder="" value="" required="">
                                            
                                                <div class="invalid-feedback">
                                                    {{ __('crm.discount_error')}}
                                                </div>  
                                                </td>
                                            <td class="text-center ">
                                                <input name="amount[]" type="number" class="form-control addamount" placeholder="" value="" required="">
                                            
                                                <div class="invalid-feedback">
                                                    {{ __('crm.amount_error')}}
                                                </div>
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-1 col-sm-12 pt-3 mb-3 remove" style="margin-top:auto;margin-bottom:20px" >
                            <div class="btn_remove" >X</div>
                        </div>
                    </div>
               `);
                });
            });
            $(document).on('click', '.remove', function(e) {
                e.preventDefault();
                $(this).parent('div').remove();
            });
        </script>
        <script>
            $(document).ready(function() {
                $(".unit_price").keyup(function() {
                    var unit_price = $(this).val();

                    var quantity = $(".quantity").val();
                    var data = quantity * unit_price;

                    $(".amount").val(data);
                    $("#sub_total").val(data);
                });
                //for discount
                $(".discount").keyup(function() {
                    var discountValue = $(this).val();
                    var quantity = $(".quantity").val();
                    var unit_price = $(".unit_price").val();

                    var data = (quantity * unit_price);
                    var discount = Math.round(data * discountValue / 100);
                    data = data - discount;
                    $(".amount").val(data);
                    $("#sub_total").val(data);
                });
                $("#shipping").keyup(function() {
                    var shipping = parseInt($(this).val());
                    var discountValue = $('.totalDiscount').val();
                    var subTotal = $("#sub_total").val();
                    var Discount = Math.round(discountValue * 100 / subTotal);
                    var Total = parseInt(subTotal - Discount);
                    var GrandTotal = Total + shipping;
                    $("#grandtotal").val(GrandTotal);
                });
            });
        </script>

        <!-- add more jquery calculation start -->
        <script type="text/javascript">
            $(document).ready(function() {
                $(".addbuttom").click(function() {
                $(".addunit_price").keyup(function() {
                    var unit_price = $(this).val();
                   
                    var quantity = $(".addquantity").val();
                    var data = quantity * unit_price;
                   
                    $(".addamount").val(data);

                    // discount
                    $(".adddiscount").keyup(function() {
                    var discountValue = $(this).val();
                    var quantity = $(".addquantity").val();
                    var unit_price = $(".addunit_price").val();

                    var data = (quantity * unit_price);
                    var discount = Math.round(data * discountValue / 100);
                    data = data - discount;
                    $(".addamount").val(data);
                     
                    var add_data1 = parseInt($(".amount").val());
                    var add_data2 = parseInt($(".addamount").val());
                    var total_data = add_data1 + add_data2;
                    $("#sub_total").val(total_data);

                    // $("#sub_total").val(data);
                    // var unit_price_add =$(".amount").val();
                    // var add_data = unit_price_add + data;
                    // $("#sub_total").val(add_data);
                    });
            }); 
        });
    });

            
        </script>
        @endpush
</x-app-layout>