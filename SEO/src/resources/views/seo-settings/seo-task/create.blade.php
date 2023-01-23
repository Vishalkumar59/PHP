<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
            <form action="{{route('seo-task.store')}}" id="userForm" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card-header bg-transparent px-4 py-3">
                    <h5 class="text-md-start text-center  d-inline">{{ __('seo.add_task_title') }} </h5>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.task_title') }}  <span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                               
                                <input name="seo_task_title" value="{{old('seo_task_title')}}"  id="seo_task_title"  type="text" class="form-control " placeholder="{{ __('seo.task_title_placeholder') }}" required>
                                <div class="invalid-feedback">
                                    <p>{{ __('seo.task_title_error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.task_priority') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="task_priority" aria-label="Default select example" required>
                                <option selected disabled value="">{{ __('seo.select_task_priority') }} </option>
                                @for($priority = 1; $priority <= 20; $priority++)
                                <option value="{{$priority}}">{{$priority}}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                    <p>{{ __('seo.task_priority_error') }}</p>
                                </div>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.task_frequency') }} <span class="text-danger">*</span></label>
                            <select class="form-select form-control"  name="task_frequency" aria-label="Default select example" required>
                                
                                <option  selected disabled value="">{{ __('seo.select_task_frequency') }} </option>
                                <option value="1" >{{ __('seo.daily') }} </option>
                                <option value="2">{{ __('seo.weekly_once') }}</option>
                                <option value="3" >{{ __('seo.weekly_twice') }} </option>
                                <option value="4" >{{ __('seo.weekly_thrice') }} </option>
                            </select>
                            <div class="invalid-feedback">
                                    <p>{{ __('seo.task_frequency_error') }}</p>
                                </div>
                        </div>
                    </div><!--end col-->
                   
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.no_of_submission') }} </label>
                            <select class="form-select form-control" name="no_of_submission" aria-label="Default select example" >
                                <option selected disabled value="">{{ __('seo.select_no_of_submission') }} </option>
                                @for($sub = 1; $sub <= 100; $sub++)
                                <option value="{{ $sub}}" >{{$sub}}</option>
                                @endfor
                            </select>
                            </div>                    
                    </div><!--end col-->
                    
                </div><!--end row-->
                <div class="row">
                    <div class="col-sm-12 my-4 mx-4">
                        <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                        <a href="{{ route('workReport') }}" class="btn btn-light mx-1 "> <i class="fas fa-backward" aria-hidden="true"></i>{{ __('common.goback') }} </a>
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