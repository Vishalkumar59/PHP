<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
            <form action="{{ route('seo-website.update',$web_setting->id) }}" id="userForm" method="POST" class="needs-validation" novalidate>
                @csrf
                 {{method_field('PUT')}}
                 <div class="card-header bg-transparent px-4 py-3">
                    <h5 class="text-md-start text-center  d-inline">{{ __('seo.seo_website_edit') }}</h5>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="px-4 py-3">
                            <label class="form-label">{{ __('seo.website_name') }} <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                
                                <input name="website_name" id="website_name" 
                                value="{{$web_setting->website_name}}"  type="text" class="form-control " placeholder="{{ __('seo.website_name_placeholder') }}" required>
                                <div class="invalid-feedback">
                                   <p>{{ __('seo.website_name_error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                    
                    <!--end col-->
                    <div class="col-md-6">
                        <div class="px-4 py-3">
                            <label class="form-label">{{ __('seo.website_url') }}<span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                                
                                <input name="website_url"  value="{{$web_setting->website_url}}" id="website_url"  type="text" class="form-control " placeholder="{{ __('seo.website_url_placeholder') }}" required>
                                <div class="invalid-feedback">
                                   <p>{{ __('seo.website_url_error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                    
                    <div class="col-md-6">
                        <div class="px-4 py-3">
                            <label class="form-label">{{ __('seo.start_date') }} </label>
                                <div class="form-icon position-relative">
                               
                                <input name="start_Date"  value="{{$web_setting->start_date}}" id="datepicker"  type="date" class="form-control " placeholder="{{ __('seo.start_date_placeholder') }}" >
                               
                            </div>
                            </div>                    
                    </div><!--end col-->
                                        
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.country') }} </label>
                            <select class="form-select form-control" name="country"
                                aria-label="Default select example" >

                                <option selected disable value="">{{ __('seo.select_country') }}</option>
                                @foreach($country as $count)
                                <option value="{{$count->countries_id}}" {{$count->countries_id == $web_setting->countries_id ? 'selected' : ''}}>{{$count->countries_name}}</option>
                               @endforeach
                            </select>
                            
                        </div>
                    </div>

                     <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.customer') }} </label>
                                    <select class="form-select form-control" name="customer"
                                        aria-label="Default select example" >

                                        <option selected disable value="">{{ __('seo.select_customer') }}</option>
                                        @if(!empty($customerlist))
                                            @foreach($customerlist as $customer)
                                                @foreach ($customer->role as $rolesdata)
                                                    @if(!empty($rolesdata))
                                                        @if($rolesdata->roles_id=='2')
                                                            <option value="{{$customer->id}}" {{($web_setting->user_id == $customer->id) ? 'selected' : ''}}>{{$customer->name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                        @endforeach
                                       @endif
                                    </select>
                                    
                                </div>
                            </div>
                </div><!--end row-->
                <div class="row">
                    <div class="col-sm-12 my-4 mx-4">
                        <input type="submit" id="submit" name="send" class="btn btn-primary" value="Update">
                        <a href="{{ route('workReport') }}" class="btn btn-light mx-1"> <i class="fas fa-backward" aria-hidden="true"></i>{{ __('common.goback') }} </a>
                    </div><!--end col-->
                </div><!--end row-->
            </form>
        </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
        </script>
    @endpush
</x-app-layout>