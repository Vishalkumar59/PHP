<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">        
            <div class="row fieldset_form">
              <!-- form start here -->
                <form method="post" action="{{ route('leads.store') }}" name="form" id="form"
                class="needs-validation" novalidate>
                    @csrf
                    <div class="col-lg-12 mt-4">
                        <div class="card border-0 rounded shadow ">
                            <div class="card-header bg-transparent px-4 py-2">
                                <h5 class="text-md-start text-center mb-0">{{ __('crm.primary_contact_info') }}</h5>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="" class="form-label">{{ __('crm.source') }}</label>
                                    <select class="form-select form-control" id="source" name="source"
                                        required>
                                        <option selected disable value="" disabled>{{ __('crm.source_select') }}</option>
                                        @if(!empty($leadSource))
                                        @foreach ($leadSource as $ls_data)
                                            <option value="{{ $ls_data->source_id }}"> {{ $ls_data->source_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    
                                    <div class="invalid-feedback">
                                    {{ __('crm.source_error') }}
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="" class="form-label">{{ __('crm.industry_type_group') }}</label>
                                    <select class="form-select form-control" name="industry" id="industry"
                                    required>
                                        <option selected disable value="" disabled>{{ __('crm.industry_select') }}</option>
                                        @foreach ($industry as $iData)
                                            <option value="{{ $iData->industry_id }}"> {{ $iData->industry_name }}</option>
                                        @endforeach
                                    </select>
                                    
                                    <div class="invalid-feedback">
                                    {{ __('crm.industry_error') }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <label for="contact_name" class="form-label">{{ __('crm.contact_name') }}</label>
                                    <input type="text" class="form-control" id="contact_name" name="contact_name"
                                        placeholder="{{ __('crm.contact_placeholder') }}" value="{{old('contact_name')}}" required>
                                    
                                    <div class="invalid-feedback">
                                    {{ __('crm.name_error') }} 
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <label for="contact_email" class="form-label">{{ __('crm.contact_email') }}</label>
                                    <input type="email" class="form-control" id="contact_email"
                                        placeholder="{{ __('crm.email_placeholder') }}" name="contact_email" value="{{old('contact_email')}}" required="">
                                    
                                    <div class="invalid-feedback">
                                    {{ __('crm.email_error') }}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    <label for="company_phone" class="form-label">{{ __('crm.contact_phone') }}</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone"     
                                placeholder="{{ __('crm.phone_placeholder') }}" value="{{old('contact_phone')}}" required>

                                <div class="invalid-feedback">
                                    {{ __('crm.contact_name_error') }}
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-12 mt-4">
                        <div class="card border-0 rounded shadow">
                            <div class="card-header bg-transparent px-4 py-2">
                                <h5 class="text-md-start text-center mb-0">{{ __('crm.additional_contact_info') }}</h5>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-lg-6 col-sm-12">
                                    <label for="website" class="form-label">{{ __('crm.website') }}</label>
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="{{ __('crm.website_placeholder') }} " value="{{old('website')}}" required>

                                        <div class="invalid-feedback">
                                            {{ __('crm.website_error') }}
                                            </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="street_address" class="form-label">{{ __('crm.street_address') }}</label>
                                    <input type="text" class="form-control" id="street_address"
                                        name="street_address" placeholder="{{ __('crm.street_address_placeholder') }}" value="{{old('street_address')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.street_address_error') }}
                                            </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="city" class="form-label">{{ __('crm.city') }}</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        placeholder="{{ __('crm.city_placeholder') }}" value="{{old('city')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.city_error') }}
                                            </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="state" class="form-label">{{ __('crm.state') }}</label>
                                    <input type="text" class="form-control" id="state" name="state"
                                        placeholder="{{ __('crm.state_placeholder') }}" value="{{old('state')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.state_error') }}
                                            </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="zipcode" class="form-label">{{ __('crm.zip') }}</label>
                                    <input type="text" class="form-control" id="zipcode" name="zipcode"
                                        placeholder="{{ __('crm.zip_placeholder') }}" value="{{old('zipcode')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.zip_error') }}
                                            </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label for="" class="form-label">{{ __('crm.country') }}</label>
                                    <select class="form-select form-control" id="country_code" name="country_code" required>
                                        <option selected disable value="" disabled>{{ __('crm.country_select') }}</option>
                                        @foreach ($country as $countries)
                                            <option value="{{ $countries->countries_id }}">
                                                {{ $countries->countries_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('crm.country_error') }}
                                        </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-12 mt-4">
                        <div class="card border-0 rounded shadow">
                            <div class="card-header bg-transparent px-4 py-2">
                                <h5 class="text-md-start text-center mb-0">{{ __('crm.social_contact_info') }}</h5>
                            </div>
                            <div class="row px-4" id="dynamic">
                                <div class="col-lg-5 col-sm-12 mb-3">
                                    <label for="" class="form-label">{{ __('crm.social_type') }} </label>
                                    <select class="form-select form-control" name="social_type[]" id="social_type" required>
                                        <option selected disable value="" disabled>{{ __('crm.social_type_select') }}</option>
                                        <option value="1">WHATSAPP</option>
                                        <option value="2">FACEBOOK</option>
                                        <option value="3">INSTAGRAM</option>
                                        <option value="4">LINKEDIN</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{ __('crm.social_type_select') }}
                                        </div>
                                </div>
                                <div class="col-lg-5 col-sm-12 mb-3">
                                    <label for="customerName" class="form-label">{{ __('crm.social_link') }}</label>
                                    <input type="text" class="form-control" id="social_link"
                                        placeholder="{{ __('crm.source') }}Social Link" name="social_link[]" value="" required>
                                        <div class="invalid-feedback">
                                            {{ __('crm.social_link_select') }}
                                            </div>
                                </div>
                                <div class="col-lg-2 col-sm-12 m-auto mb-3">
                                    <button class="btn btn-primary" type="submit" id="add_more"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            <!--end row-->
                            <div class="row g-3 m-2">
                                <div class="col-lg-3 col-sm-12">
                                    <button type="submit" id="submit" class="btn btn-primary  w-50 mb-2" style="background-color: background-color: #2f55d4;">
                                    {{ __('common.submit') }} 
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> <!-- form end -->
            </div>
        </div> <!--end col-->
    </div> <!--end container-->
    

    <!--script start-->
    @push('scripts')
        <script>
            $(document).ready(function() {
                var i = 1;

                $('#add_more').click(function(e) {
                    e.preventDefault();
                    i++;
                    $('#dynamic').append(
                        '<div class="col-lg-12">' +
                        '<div class="row  dynamic-add " id="row' + i + '" >' +
                        '<div class="col-lg-5 col-sm-12 mb-3">' +
                        '<select class="form-select form-control" id=""   name="social_type[]" required>' +
                        '<option value="">Select Social Type</option>' +
                        '<option value="1">WHATSAPP</option>' +
                        '<option value="2">FACEBOOK</option>' +
                        '<option value="3">INSTAGRAM</option>' +
                        '<option value="4">LINKEDIN</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="col-lg-5 col-sm-12 mb-3">' +
                        '<input type="text" class="form-control" id="social_link" placeholder="Social Link" name="social_link[]" value="" required>' +
                        '</div>' +
                        '<div class="col-lg-1 col-sm-12 mb-3">' +
                        '<div class="btn_remove" id="' + i + '" type="button">X</div>' +
                        '</div>' +
                        '</div>'+
                        '</div>');
                });

                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });

                $(document).on('click', '.remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });
        </script>
    @endpush
    <!-- script end-->
</x-app-layout>
