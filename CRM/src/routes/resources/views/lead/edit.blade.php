<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row fieldset_form">
                @if(!empty($lead) && !empty($industry) && !empty($leadSource) && !empty($country) && !empty($socialLink))
                    <!-- form start here-->
                    <form action="{{route('leads.update',$lead->lead_id)}}" method="post" name="form" id="form" class="needs-validation" novalidate>
                        @csrf
                        {{method_field('put')}} 
                        <div class="col-lg-12 mt-4">
                            <div class="card border-0 rounded shadow ">
                                <div class="card-header bg-transparent px-4 py-2">
                                   <h5 class="text-md-start text-center mb-0">{{ __('crm.primary_contact_info') }}</h5>
                                </div>
                                <div class="row px-4 pb-4">
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="" class="form-label">{{ __('crm.source') }}</label>
                                        <select class="form-select form-control" id="source" name="source" required="">
                                            <option selected disable value="" disabled>{{ __('crm.source_select') }}</option>
                                            @foreach($leadSource as $cls)
                                                <option  value="{{$cls->source_id}}" {{ ($cls->source_id == $lead->source_id) ? 'selected' : '' }}> {{$cls->source_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('crm.source_error') }} 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label for="" class="form-label">{{ __('crm.industry_type_group') }}</label>
                                        <select class="form-select form-control" name="industry" id="industry" required="">
                                            <option selected disable value="" disabled>{{ __('crm.industry_select') }}</option>
                                            @foreach($industry as $ci)
                                                <option  value="{{$ci->industry_id}}" {{ ($ci->industry_id == $lead->industry_id) ? 'selected' : '' }}>{{$ci->industry_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                        {{ __('crm.industry_error') }} 
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="contact_name" class="form-label">{{ __('crm.contact_name') }}</label>
                                        <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="{{ __('crm.contact_placeholder') }}" value="{{$lead->contact_name}}" required="">
                                        
                                        <div class="invalid-feedback">
                                        {{ __('crm.name_error') }}  
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="contact_email" class="form-label">{{ __('crm.contact_email') }}</label>
                                        <input type="text" class="form-control" id="contact_email" placeholder="{{ __('crm.email_placeholder') }}" name="contact_email" value="{{$lead->contact_email}}" required="">
                                        
                                        <div class="invalid-feedback">
                                        {{ __('crm.email_error') }}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="company_phone" class="form-label">{{ __('crm.contact_phone') }}</label>
                                        <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="{{ __('crm.phone_placeholder') }}" value="{{$lead->phone}}" required="">
                                        <div class="invalid-feedback">
                                            {{ __('crm.contact_name_error') }}
                                            </div>
                                    </div>
                                </div><!--end row-->
                            </div>
                        </div><!--end col-->
                        @if(!empty($lead->leadcontact))
                        <div class="col-lg-12 mt-4"> 
                            <div class="card border-0 rounded shadow">
                                    <div class="card-header bg-transparent px-4 py-2">
                                     <h5 class="text-md-start text-center mb-0">{{ __('crm.additional_contact_info') }}</h5>
                                  </div>
                                  <div class="row px-4 pb-4">
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="website" class="form-label">{{ __('crm.website') }}</label>
                                          <input type="text" class="form-control" id="website" name="website" placeholder="{{ __('crm.website_placeholder') }} " value="{{$lead->leadcontact->website}}" required="">
                                          <div class="invalid-feedback">
                                            {{ __('crm.website_error') }}
                                            </div>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="street_address" class="form-label">{{ __('crm.street_address_placeholder') }}</label>
                                          <input type="text" class="form-control" id="street_address" name="street_address" placeholder="{{ __('crm.street_address_placeholder') }}" value="{{$lead->leadcontact->street_address}}" required="">
                                          <div class="invalid-feedback">
                                            {{ __('crm.street_address_error') }}
                                            </div>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="city" class="form-label">{{ __('crm.city') }}</label>
                                          <input type="text" class="form-control" id="city" name="city" placeholder="{{ __('crm.city_placeholder') }}" value="{{$lead->leadcontact->city}}"  required="">
                                          <div class="invalid-feedback">
                                            {{ __('crm.city_error') }}
                                            </div>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="state" class="form-label">{{ __('crm.state') }}</label>
                                          <input type="text" class="form-control" id="state" name="state" placeholder="{{ __('crm.state_placeholder') }}" value="{{$lead->leadcontact->state}}" required="">
                                          <div class="invalid-feedback">
                                            {{ __('crm.state_error') }}
                                            </div>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="zipcode" class="form-label">{{ __('crm.zip') }}</label>
                                          <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="{{ __('crm.zip_placeholder') }}" value="{{$lead->leadcontact->zipcode}}"  required="">
                                          <div class="invalid-feedback">
                                            {{ __('crm.zip_error') }}
                                            </div>
                                      </div>
                                      <div class="col-lg-6 col-sm-12">
                                          <label for="" class="form-label">{{ __('crm.country') }}</label>
                                          <select class="form-select form-control" id="country_code" name="country_code" required="">
                                              <option selected disable value="" disabled>{{ __('crm.country_select') }}</option>
                                                @foreach($country as $countries)
                                                    <option  value="{{$countries->countries_id}}" {{($countries->countries_id == $lead->leadcontact->country_code) ? 'selected' : '' }}> {{$countries->countries_name }}</option>
                                                @endforeach
                                          </select>
                                          <div class="invalid-feedback">
                                            {{ __('crm.country_error') }}
                                            </div>
                                      </div>
                                  </div><!--end row-->
                            </div>
                        </div><!--end col-->
                        @endif
                        <div class="col-lg-12 mt-4" >
                            <div class="card border-0 rounded shadow" >
                                <div class="card-header bg-transparent px-4 py-2">
                                    <h5 class="text-md-start text-center mb-0">{{ __('crm.social_contact_info') }}</h5>
                                 </div>
                                @if(!empty($lead->leadsociallink))
                                <div class="row px-4" id="dynamic">
                                    <div class="col-lg-5 col-sm-12 mb-3">
                                        <label for="" class="form-label">{{ __('crm.social_type') }} </label>
                                        <select class="form-select form-control" name="social_type[]" id="social_type" required="">
                                            <option value="" disabled>{{ __('crm.social_type_select') }}</option>
                                            <option value="1" {{$lead->leadsociallink->social_type == 1 ? 'selected' : '' }}>WHATSAPP</option>
                                            <option value="2" {{$lead->leadsociallink->social_type == 2 ? 'selected' : '' }}>FACEBOOK</option>
                                            <option value="3" {{$lead->leadsociallink->social_type == 3 ? 'selected' : '' }}>INSTAGRAM</option>
                                            <option value="4" {{$lead->leadsociallink->social_type == 4 ? 'selected' : '' }}>LINKEDIN</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            {{ __('crm.social_type_select') }}
                                            </div>
                                    </div>
                                    <div class="col-lg-5 col-sm-12">
                                        <label for="customerName" class="form-label">{{ __('crm.social_link') }} </label>
                                        <input type="text" class="form-control" id="social_link" placeholder="Social Link" name="social_link[]" value="{{$lead->leadsociallink->social_link}}" required="">
                                        <div class="invalid-feedback">
                                            {{ __('crm.social_link_select') }}
                                            </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-12 m-auto">
                                        <button class="btn btn-primary" type="submit" id="add_more"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div><!--end row-->
                                @endif
                                @php 
                                    $calc =0;
                                @endphp
                                @if(!empty($socialLink))
                                    @foreach($socialLink as $leadSocialLimk)
                                        @php
                                            $calc++;
                                            if($calc ==1) continue;
                                        @endphp
                                        <div class="row dynamic-add remove1 px-4 " id="row'+i+'">
                                            <div class="col-lg-5 col-sm-12 mb-3">
                                                <select class="form-select form-control" id="social_type" name="social_type[]" required>
                                                    <option selected disable value="" disabled>Select Social Type</option>
                                                    <option value="1" {{$leadSocialLimk->social_type == 1 ? 'selected' : '' }}>WHATSAPP</option>
                                                    <option value="2" {{$leadSocialLimk->social_type == 2 ? 'selected' : '' }}>FACEBOOK</option>
                                                    <option value="3" {{$leadSocialLimk->social_type == 3 ? 'selected' : '' }}>INSTAGRAM</option>
                                                    <option value="4" {{$leadSocialLimk->social_type == 4 ? 'selected' : '' }}>LINKEDIN</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.social_type_select') }}
                                                    </div>
                                            </div>
                                            <div class="col-lg-5 col-sm-12">
                                                <input type="text" class="form-control" id="social_link" placeholder="Social Link" name="social_link[]" value="{{$leadSocialLimk->social_link}}" required>
                                                <div class="invalid-feedback">
                                                    {{ __('crm.social_link_select') }}
                                                    </div>
                                            </div>
                                            <div class="col-lg-1 col-sm-12 ">
                                                <div class="btn_remove btn-submit" data-id="{{$leadSocialLimk->social_link_id}}" {{-- id="'+i+'" --}} type="button">X</div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="row g-3 m-2 mb-3">
                                  <div class="col-lg-3 col-sm-12" >   
                                     <button type="submit" id="submit" class="btn btn-primary  w-50" style="background-color: background-color: #2f55d4;">{{ __('common.update')}}</button>
                                  </div> 
                                </div>
                            </div>
                        </div>
                    </form><!-- form end -->
                @endif
            </div><!--end row-->
        </div><!-- layout spacing end-->
    </div><!--end container-->

    <!-- script start -->
    @push('scripts')

    <script> 
        $(document).ready(function(){
            var postUrl = "{{route('leads.store')}}";
            var i=1; 

            $('#add_more').click(function(e){  
                e.preventDefault(); 
                i++;  
               $('#dynamic').append(
                '<div class="col-lg-12">'+
                '<div class="row dynamic-add mb-3" id="row'+i+'" >'+
                '<div class="col-lg-5 col-sm-12">'+
                    '<select class="form-select form-control" id=""  name="social_type[]" required>'+
                    '<option value="" >Select Social Type</option>'+
                    '<option value="1" >WHATSAPP</option>'+
                    '<option value="2" >FACEBOOK</option>'+
                    '<option value="3" >INSTAGRAM</option>'+
                    '<option value="4" >LINKEDIN</option>'+
                    '</select>'+
                '</div>'+
                '<div class="col-lg-5 col-sm-12">'+
                '<input type="text" class="form-control" id="social_link" placeholder="Social Link" name="social_link[]" value="" required>'+
                '</div>'+
                '<div class="col-lg-1 col-sm-12 ">'+
                '<div class="btn_remove btn-submit" id="'+i+'" type="button">X</div>'+
                '</div>'+
                '</div>'+
                '</div>');  
            });

          $(document).on('click','.btn_remove', function(){ 
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });  

          $(document).on('click','.remove', function(){ 
               var button_id = $(this).attr("id");   
               $('#row'+button_id+'').remove();  
          });
        });
    </script>  
    <script>
        $(document).ready(function(){
            $(".btn-submit").click(function(e){
            e.preventDefault();
             var social_link_id = $(this).data('id');
             $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            $.ajax({
               type:"POST",
               url:"{{route('remove')}}", 
               data:{social_link_id:social_link_id,},
               success:function(data){
                    Command: toastr["success"](data.message)
                        toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "newestOnTop": true,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "preventDuplicates": false,
                          "hideDuration": "1000",
                          "timeOut": "1000",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        }
                    }
                });
            });
        });
    </script>
    <script>
         $(document).ready(function(){
             $(".btn_remove").click(function(e){
                e.preventDefault();
                $(this).parents('.remove1').hide();
             });
         });
    </script>
    @endpush
    
    <!-- script end-->
</x-app-layout> 
