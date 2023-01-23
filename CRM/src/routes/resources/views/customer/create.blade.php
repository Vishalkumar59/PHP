<x-app-layout>

<div class="container-fluid">
    <div class="layout-specing">       
        <div class="row fieldset_form">
            <form class="needs-validation" action="{{route('customer.store')}}" method="post" id="form" novalidate>
                @csrf
                <div class="col-lg-12">
                    <div class="card border-0 rounded shadow ">
                        <div class="card-header bg-transparent px-4 py-2">
                         <h5 class="text-md-start text-center mb-0">{{ __('crm.primary_contact_info')}}</h5>
                        </div>

                        <div class="row px-4 pb-4">
                            <div class="col-lg-6 col-sm-12">
                                <label for="" class="form-label">{{__('crm.lead')}}</label>
                                <select class="form-select form-control"  name="lead_id" required="">
                                    <option selected disabled value="" disabled>{{ __('crm.lead_select')}}</option>   
                                    @foreach ($lead_list as $lead)
                                    <option value="{{ $lead->lead_id }}">{{ $lead->contact_name }}</option>
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
                                    <option  value="1">Male</option>
                                    <option  value="2">Female</option>
                                    <option  value="3">Other</option>
                                   
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.gender_select')}} 
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="contactName" class="form-label">{{ __('crm.customer_name')}}</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="{{ __('crm.customer_name_placeholder')}}" value="" required="">
                                
                                <div class="invalid-feedback">
                                {{ __('crm.customer_name_error')}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="contactEmail" class="form-label">{{ __('crm.email')}}</label>
                                <input type="email" class="form-control" id="customer_email" placeholder="{{ __('crm.customer_email_placeholder')}}" name="customer_email" value="" required="">
                                <div class="invalid-feedback">
                                {{ __('crm.customer_emial_error')}}
                                </div>
                                
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="companyName" class="form-label">{{ __('crm.company_name')}}</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="{{ __('crm.company_name_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.company_name_error')}} 
                                </div>
                               
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label for="website" class="form-label">{{ __('crm.website')}}</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="{{ __('crm.website_placeholder')}}" value="" required>
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
                                    <option value="1">BOTH</option>
                                    <option value="2">BILLING</option>
                                    <option value="3">Shipping</option>
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.address_type_select')}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="streetAddress" class="form-label">{{ __('crm.street_address')}}</label>
                                <input type="text" class="form-control" id="street_address" name="street_address" placeholder="{{ __('crm.street_address_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.street_address_error')}}
                                </div> 
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="city" class="form-label">{{ __('crm.city')}}</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('crm.city_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.city_error')}} 
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="state" class="form-label">{{ __('crm.state')}}</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="{{ __('crm.state_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.state_error')}}
                                </div> 
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="zipcode" class="form-label">{{ __('crm.zip')}}</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="{{ __('crm.zip_placeholder')}}" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.zip_error')}}
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label for="country" class="form-label">{{ __('crm.country')}}</label>
                                <select class="form-select form-control" id="country_code" name="country_id" required>
                                    <option selected disable value="" disabled>{{ __('crm.country_select')}}</option>
                                    @foreach ($country_list as $countries)
                                    <option value="{{ $countries->countries_id }}">{{ $countries->countries_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                {{ __('crm.country_select')}}
                                </div>
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
                                <input type="text" class="form-control contact" id="contact_name" placeholder="{{ __('crm.contact_name_placeholder')}}" name="contact_name" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.contact_name_error')}}
                                </div>
                            </div>
                            
                            <div class="col-lg-5 col-sm-12 mb-3">
                                <label for="contactEmail" class="form-label">{{ __('crm.contact_email')}}</label>
                                <input type="email" class="form-control" id="contact_email" placeholder="{{ __('crm.contact_email_placeholder')}}" name="contact_email" value="" required>
                                <div class="invalid-feedback">
                                {{ __('crm.contact_email_error')}}
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-12 m-auto mb-3">
                                <button class="btn btn-primary" type="button" id="add_contact"><i class="ti ti-plus"></i></button>
                            </div>
                        </div>
                        <div class="row g-3 m-2">
                            <div class="col-lg-3 col-sm-12" >   
                                <button type="submit" id="bt" class="btn btn-primary  w-50 mb-2" style="background-color: background-color: #2f55d4;">{{ __('common.submit')}}</button>
                            </div> 
                        </div>
                        
                    </div>
                </div><!--end col-->
               
            </form><!--end form-->
        </div><!--end row-->    
    </div>
</div><!--end container-->

@push('scripts')
<!--start append code -->
<script>
    $(document).ready(function(){
        $("#add_contact").click(function(e){
            e.preventDefault();
            $("#address").append(` <div class="col-lg-12">
                <div class="row" id="add">
                <div class="col-lg-5 col-sm-12 mb-3">
                <label for="customerName" class="form-label contact">Contact Name</label>
                <input type="text" class="form-control contact" id="contact_name" placeholder="{{ __('crm.contect_name_Placeholder')}}" value="" name="add_contact_name[]" 
                required>
                    <div class="invalid-feedback">
                    {{ __('crm.contact_name_error')}}
                    </div>
               </div>

                <div class="col-lg-5 col-sm-12 mb-3">
                <label for="customerEmail" class="form-label">Contact Email</label>
                <input type="email" class="form-control" id="contact_email" placeholder="{{ __('crm.contect_email_Placeholder')}}" value="" name="add_contact_email[]" 
                required>
                    <div class="invalid-feedback">
                    {{ __('crm.contact_email_error')}}
                    </div>
               </div>
                <div class="col-lg-1 col-sm-12 mb-3 remove" style="margin-top:auto;margin-bottom:20px" >
                <div class="btn_remove" >X</div>
                </div>
                </div>
                </div>`);
        });
       
        $(document).on('click','.remove',function(e){
            e.preventDefault();
             $(this).parent('div').remove();
        });

    });
</script>
<!--end append code -->

@endpush

</x-app-layout><!-- End layout -->