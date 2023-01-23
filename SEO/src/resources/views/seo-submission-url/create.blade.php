<x-app-layout>
@php
$main_arr = [
  'title'=>'',
  'sublist' => [
    [
    'name'=>'SEO',
    'link'=>url("/submission")
    ],
    [
    'name'=>'/Submission Url',
    'link'=>url("/role")
    ], 
  ]
];
@endphp
    <div class="container-fluid">
        <div class="layout-specing">
            <!-- Dyanamic breadcrumb throw component start here-->
           
            <!-- Dyanamic breadcrumb throw component here -->
            <div class="col-md-12 py-3">
                <div class="card rounded shadow">
                    
                    <form action="{{ route('submission.store') }}"  id="userForm" method="POST"      class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">{{__('seo.submission_form')}}</h5>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.website')}} <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="website" name="website" aria-label="Default select example" required>
                                            <option selected disabled value>{{__('seo.select_website')}}</option>
                                             @foreach ($websites as $website)
                                                <option value="{{ $website->id }}" >{{ $website->website_name }}</option>  
                                             @endforeach                        
                                        </select> 
                                        <div class="invalid-feedback">
                                    <p>Please select website</p>
                                </div> 
                                    </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.task_title')}}<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="seotask" name="seotask" aria-label="Default select example" required>
                                            <option selected disabled value>{{__('seo.select_task')}}</option>
                                             @foreach ($seotask as $seotasklist)
                                                <option value="{{ $seotasklist->id }}" >{{ $seotasklist->seo_task_title }}</option>  
                                             @endforeach                        
                                        </select> 
                                        <div class="invalid-feedback">
                                    <p>Please select task title</p>
                                </div>
                                    </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.website_url')}}<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="website_url" id="website_url" type="text" class="form-control" value="{{old('website_url')}}" placeholder="{{__('seo.website_url_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                    <p>Please enter website url</p>
                                </div>
                                    </div>
                                </div> 
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.username')}}</label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="username" value="{{old('username')}}" id="username" class="form-control" placeholder="{{__('seo.username_placeholder')}}" >
                                        
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.password')}}</label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="password" value="{{old('password')}}"  id="password" class="form-control" placeholder="{{__('seo.password_placeholder')}}" >
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('seo.da')}}</label>
                                    <div class="form-icon position-relative">
                                        <input type="number" name="da" value="{{old('da')}}"  id="da" class="form-control" placeholder="{{__('seo.da_placeholder')}}" >
                                    </div>
                                </div>   
                            </div>
                           
                        </div><!--end col-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                 <a href="{{ route('submission.index') }}" class="btn btn-light mx-1"> <i class="fas fa-backward" aria-hidden="true"></i>{{__('common.goback')}}</a> 
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