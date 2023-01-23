<x-app-layout>
    
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12 py-3">
                <div class="card rounded shadow">

                    <form action="{{ route('work-report.import.store') }}" id="import-work-report-data-form" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-3">
                            <h5 class="text-md-start text-center  d-inline">{{ __('seo.import_work_report') }}</h5>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.website_name') }}<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="website_id" id="website_id" aria-label="Default select example" required>
                                        <option selected disabled value="">{{ __('seo.select_website') }}</option>
                                        @foreach($website_list as $website)
                                        <option value="{{$website->id}}">{{$website->website_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select website</p>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.seo_task') }}<span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="seo_task_id" id="seo_task_id" aria-label="Default select example" required>
                                    <option selected disabled value="">Select Task</option>
                                        @foreach($seo_task_list as $seo_list)
                                        <option value="{{$seo_list->id}}">{{$seo_list->seo_task_title}}</option>
                                        @endforeach
                                    </select>
                                     <div class="invalid-feedback">
                                        <p>Please select task</p>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            {{-- <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.users') }} <span class="text-danger">*</span></label>
                                    <select class="form-select form-control" name="user_id" id="user_id" aria-label="Default select example" required>
                                        <option selected disabled value="">{{ __('seo.select_user') }}</option>
                                        @foreach($user_list as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        <p>Please select user</p>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.customer') }} </label>
                                    <select class="form-select form-control" name="user_id" id="user_id"
                                        aria-label="Default select example" >

                                        <option selected disable value="">{{ __('seo.select_customer') }}</option>
                                        @if(!empty($user_list))
                                            @foreach($user_list as $customer)
                                                @foreach ($customer->role as $rolesdata)
                                                    @if(!empty($rolesdata))
                                                        @if($rolesdata->roles_id=='2')
                                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                        @endforeach
                                       @endif
                                    </select>
                                    
                                </div>
                            </div>








                            <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{ __('seo.upload_file') }}({{ __('seo.field_type') }}) </label>
                                    <div class="form-icon position-relative">
                                        <i data-feather="user" class="fea icon-sm icons"></i>

                                        <input type="file" name="import_file" data-allowed-file-extensions="xls xlsx csv txt" id="work_report_import" class="form-control ps-5 dropify" >

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end col-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4" required>
                                <button id="import-work-report-form" type="submit" class="btn btn-primary">{{ __('seo.upload') }}</button>
                                <a href="{{ route('seo-work.index') }}" class="btn btn-light mx-1"> <i class="fas fa-backward" aria-hidden="true"></i>{{ __('common.goback') }} </a>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('scripts')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}
   {{-- <script>
    $(document).ready(function() {
    $('#seo_task_id').select2({
     heght : '20px !important',
     class : 'form-control'
    });
    });
   </script> --}}
    

    @endpush
</x-app-layout>