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
                            <h5 class="text-md-start text-center  d-inline">Submission Form</h5>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Website <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="website" name="website" aria-label="Default select example">
                                            <option selected disabled value="">Select Website</option>
                                             @foreach ($websites as $website)
                                                <option value="{{ $website->id }}" >{{ $website->website_name }}</option>  
                                             @endforeach                        
                                        </select>  
                                    </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Task Title <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="seotask" name="seotask" aria-label="Default select example">
                                            <option selected disabled value="">Select Task Title</option>
                                             @foreach ($seotask as $seotasklist)
                                                <option value="{{ $seotasklist->id }}" >{{ $seotasklist->seo_task_title }}</option>  
                                             @endforeach                        
                                        </select>  
                                    </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Website URL <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="website_url" id="website_url" type="text" class="form-control"  placeholder="Enter Website Url :" required>
                                    </div>
                                </div> 
                            </div><!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Username</label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="username"  id="username" class="form-control" placeholder="Enter Username :" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Password</label>
                                    <div class="form-icon position-relative">
                                        <input type="text" name="password"  id="password" class="form-control" placeholder="Enter Password :" required>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">DA</label>
                                    <div class="form-icon position-relative">
                                        <input type="number" name="da"  id="da" class="form-control" placeholder="Enter DA :" required>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">Status</label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="status" name="status" aria-label="Default select example">
                                            <option selected disabled value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option> 
                                        </select>  
                                    </div>
                                </div>
                            </div> 
                        </div><!--end col-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                                 <a href="{{ route('submission.index') }}" class="btn btn-light mx-1"> <i class="fas fa-backward" aria-hidden="true"></i>Go Back  </a> 
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