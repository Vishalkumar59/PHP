<x-app-layout>
<div class="container-fluid">
    <div class="layout-specing">            
        <div class="row fieldset_form">
            <form class="needs-validation" action="{{route('customer.update',$customer->customer_id)}}" method="post" id="form" novalidate>
            @method('PUT')
                <div class="col-lg-12 ">
                    <div class="card border-0 rounded shadow ">
                        <div class="card-header bg-transparent px-4 py-2">
                         <h5 class="text-md-start text-center mb-0">{{ __('crm.primary_contact_info')}}</h5>
                        </div>
                        <div class="row px-4 pb-4">
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">{{ __('crm.lead')}}</label>
                                <select class="form-select form-control"  name="lead_id" required="">
                                    <option selected disabled value="" disabled>{{ __('crm.lead_select')}}</option>
                                       
                                            @foreach ($lead_list as $lead)
                                    <option value="@if(!empty($lead)){{ $lead->lead_id }}@endif" {{$customer->lead_id == $lead->lead_id ? 'selected' : '' }}>{{ $lead->contact_name }}</option>
                                    @endforeach
                                 
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.lead_select')}} 
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">{{ __('crm.gender')}}</label>
                                <select class="form-select form-control" name="gender" id="gender" required="">
                                    <option selected disable value="" disabled>{{ __('crm.gender_select')}}</option>
                                    <option  value="1" {{  ($customer->gender == '1') ? 'selected' : '' }}>Male</option>
                                    <option  value="2" {{  ($customer->gender == '2') ? 'selected' : '' }}>Female</option>
                                    <option  value="3" {{  ($customer->gender == '3') ? 'selected' : '' }}>Other</option>
                                   
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.gender_select')}} 
                                </div>
                               
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="contactName" class="form-label">{{ __('crm.customer_name')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($customer)){{$customer->first_name}}@endif" id="customer_name" name="customer_name" placeholder="{{ __('crm.customer_name_placeholder')}}"  required="">
                                
                                <div class="invalid-feedback">
                                {{ __('crm.customer_name_error')}}  
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="contactEmail" class="form-label">{{ __('crm.email')}}</label>
                                <input type="email" class="form-control" value="@if(!empty($customer)){{$customer->email}}@endif" id="customer_email" placeholder="{{ __('crm.customer_email_placeholder')}}" name="customer_email"  required="">
                                <div class="invalid-feedback">
                                {{ __('crm.customer_emial_error')}}
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="companyName" class="form-label">{{ __('crm.company_name')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($customer)){{$customer->company_name}}@endif" id="company_name" name="company_name" placeholder="{{ __('crm.company_name_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.company_name_error')}} 
                                </div>
                                
                            </div>
                            
                            <div class="col-lg-6 col-sm-12">
                                <label for="website" class="form-label">{{ __('crm.website')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($customer)){{$customer->website}}@endif" id="website" name="website" placeholder="{{ __('crm.website_placeholder')}}" required>
                                <div class="invalid-feedback">
                                {{ __('crm.website_error')}}
                                </div>
                                
                            </div>
                            
                        </div><!--end row-->
                    </div>
                </div><!--end col-->

                <div class="col-lg-12 mt-4">
                    <div class="card border-0 rounded shadow">
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{ __('crm.address')}}</h5>
                        </div>
                        <div class="row px-4 pb-4">
                            <div class="col-lg-6 col-sm-12">
                                <label for="Address Type" class="form-label">{{ __('crm.address_type')}}</label>
                                <select id="ADDRESS_TYPE" placeholder="Select Address Type" class="form-control form-select" name="address_type" required>
                                    <option selected disable value="" disabled>{{ __('crm.address_type_select')}}</option>
                                    <option value="1" {{  ($address->address_type == '1') ? 'selected' : '' }}>BOTH</option>
                                    <option value="2" {{ ($address->address_type == '2') ? 'selected' : '' }}>BILLING</option>
                                    <option value="3" {{ ($address->address_type == '3') ? 'selected' : '' }}>Shipping</option>
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.address_type_select')}}
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="streetAddress" class="form-label">{{ __('crm.street_address')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($address)){{$address->street_address}}@endif" id="street_address" name="street_address" placeholder="{{ __('crm.street_address_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.street_address_error')}}
                                </div> 
                               
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="city" class="form-label">{{ __('crm.city')}}</label>
                                <input type="text" class="form-control" id="city" value="@if(!empty($address)){{$address->city}}@endif" name="city" placeholder="{{ __('crm.city_placeholder')}}" required>
                                <div class="invalid-feedback">
                                {{ __('crm.city_error')}} 
                                </div>
                               
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="state" class="form-label">{{ __('crm.state')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($address)){{$address->state}}@endif" id="state" name="state" placeholder="{{ __('crm.state_placeholder')}}" required>
                                <div class="invalid-feedback">
                                {{ __('crm.state_error')}}
                                </div> 
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="zipcode" class="form-label">{{ __('crm.zip')}}</label>
                                <input type="text" class="form-control" value="@if(!empty($address)){{$address->zipcode}}@endif" id="zip_code" name="zip_code" placeholder="{{ __('crm.zip_placeholder')}}" required>
                                <div class="invalid-feedback">
                                {{ __('crm.zip_error')}}
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="country" class="form-label">{{ __('crm.country')}}</label>
                                <select class="form-select form-control" id="country_code" name="country_id" required>
                                    <option selected disable value="" disabled>{{ __('crm.country_select')}}</option>
                                    @foreach ($country_list as $countries)
                                    <option value="{{ $countries->countries_id }}" {{$address->countries_id == $countries->countries_id ? 'selected' : ''}}>{{ $countries->countries_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.country_select')}}
                                
                            </div>
                        </div><!--end row-->
                    </div>
                </div><!--end col-->

                <div class="col-lg-12 mt-4" >
                    <div class="card border-0 rounded shadow" >
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{ __('crm.additional_contact_info')}}</h5>
                        </div>
                        <div class="row px-4" id="address">
                            <div class="col-lg-5 col-sm-12 mb-3">
                                <label for="contactName" class="form-label contact">{{ __('crm.contact_name')}}</label>
                                <input type="text" class="form-control contact" id="contact_name" placeholder="{{ __('crm.customer_name_placeholder')}}" name="contact_name[]" value="@if(!empty($customer)){{$customer->customerContact->contact_name}}@endif" required>
                                <div class="invalid-feedback">
                                {{ __('crm.contact_name_error')}}
                                </div>
                                
                            </div>
                            
                            <div class="col-lg-5 col-sm-12">
                                <label for="contactEmail" class="form-label">{{ __('crm.contact_email')}}</label>
                                <input type="email" class="form-control" id="contact_email" placeholder="{{ __('crm.customer_email_placeholder')}}" name="contact_email[]" value="@if(!empty($customer)){{$customer->customerContact->contact_email}}@endif " required>
                                <div class="invalid-feedback">
                                {{ __('crm.contact_email_error')}} 
                                </div>
                                
                            </div>
                            <div class="col-lg-2 col-sm-12 m-auto mb-3">
                                <button class="btn btn-primary" type="button" id="add_contact"><i class="ti ti-plus"></i></button>
                            </div>
                        </div><!--end row-->
                        @php 
                            $calc =0;
                        @endphp
                        @if(!empty($contacts))
                        @foreach($contacts as $contact)
                        @php
                            $calc++;
                            if($calc ==1) continue;
                        @endphp
                        <!-- start by default append code -->
                            <div class="row px-4" id="add">
                                <div class="col-lg-5 col-sm-12 mb-3">
                                    <label for="customerName" class="form-label contact">{{ __('crm.contact_name')}}</label>
                                    <input type="text" class="form-control contact" id="contact_name" placeholder="{{ __('crm.contect_name_Placeholder')}}" value="{{$contact->contact_name}}" name="contact_name[]" required>
                                    <div class="invalid-feedback">
                                    {{ __('crm.contact_name_error')}}
                                    </div>
                                    
                                </div>

                                <div class="col-lg-5 col-sm-12">
                                    <label for="customerEmail" class="form-label">{{ __('crm.contact_email')}}</label>
                                    <input type="email" class="form-control" id="contact_email" placeholder="{{ __('crm.contect_email_Placeholder')}}" value="{{$contact->contact_email}}" name="contact_email[]" required>
                                    <div class="invalid-feedback">
                                    {{ __('crm.contact_email_error')}}
                                    </div>
                                    
                                </div>
                                <div class="col-lg-1 col-sm-12" id="remove" style="margin-top:auto;margin-bottom:20px">
                                    <div class="btn_remove">X</div>
                                </div>
                            </div>
                        <!-- end by default append code -->
                        @endforeach
                        @endif
                        <div class="row g-3 m-2">
                            <div class="col-lg-3 col-sm-12" >   
                                <button type="submit" id="bt" class="btn btn-primary  w-50" style="background-color: background-color: #2f55d4;">{{ __('common.update')}}</button>
                            </div> 
                        </div>
                    </div>
                </div><!--end col-->        
            </form><!--end form-->
        </div><!--end row-->    
    </div>
</div><!--end container-->

@push('scripts')
<!-- start append code -->
<script>
    $(document).ready(function(){
        $("#add_contact").click(function(e){
            e.preventDefault();
            $("#address").append(` <div class="row mb-3" id="add">
                <div class="col-lg-5 col-sm-12">
                <label for="customerName" class="form-label contact">{{ __('crm.contact_name')}}</label>
                <input type="text" class="form-control contact" id="contact_name" placeholder="{{ __('crm.contact_name_placeholder')}}"  name="contact_name[]" 
                required>
                    <div class="invalid-feedback">
                    {{ __('crm.contact_name_error')}}
                    </div>
                    
               </div>

                <div class="col-lg-5 col-sm-12" style="margin-left:10px;">
                <label for="customerEmail" class="form-label">{{ __('crm.contact_email')}}</label>
                <input type="email" class="form-control" id="contact_email" placeholder="{{ __('crm.contact_email_placeholder')}}"  name="contact_email[]" 
                required>
                    <div class="invalid-feedback">
                    {{ __('crm.contact_email_error')}}
                    </div>
                    
               </div>
                <div  style="margin-top:auto;margin-botton:15px" class="col-lg-1 col-sm-12 remove" >
                <div class="btn_remove">X</div>
                </div>
                </div>`);
        });
         $(document).on('click','.remove',function(e){
            e.preventDefault();
             $(this).parent('div').remove();
        });

         
    });
</script>
<!-- end append code -->
@endpush
</x-app-layout> 