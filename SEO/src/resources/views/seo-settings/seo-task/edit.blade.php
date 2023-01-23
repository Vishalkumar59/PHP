<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
            <form action="{{route('seo-task.update',$seotask->id)}}" id="userForm" method="POST" class="needs-validation" novalidate>
                @csrf
                 {{method_field('PUT')}}
                <div class="card-header bg-transparent px-4 py-3">
                    <h5 class="text-md-start text-center  d-inline">{{ __('seo.update_task_title') }}</h5>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.task_title')}}<span class="text-danger">*</span></label>
                            <div class="form-icon position-relative">
                               
                                <input name="seo_task_title" id="seo_task_title" value="{{$seotask->seo_task_title}}"  type="text" class="form-control " placeholder="{{ __('seo.task_title_placeholder') }}" required>
                                <div class="invalid-feedback">
                                <p>{{ __('seo.task_title_error') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="px-4 py-2">
                            <label class="form-label">{{ __('seo.task_priority') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="task_priority" value="{{$seotask->task_priority}}" aria-label="Default select example" required>
                                <option selected disabled value="">{{ __('seo.select_task_priority') }}</option>
                                @for($priority = 1; $priority <= 20; $priority++)
                                @php
                                $selected = '';
                                if($priority == $seotask->task_priority){
                                    $selected = 'selected';
                                }
                                @endphp
                                <option value="{{$priority}}" {{$selected}}>{{$priority}}</option>
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
                                
                                <option  selected disabled value="">{{ __('seo.select_task_frequency') }}</option>
                                <option value="1" {{ $seotask->task_frequency == '1' ? 'selected' : '' }}>Daily</option>
                                <option value="2" {{ $seotask->task_frequency == '2' ? 'selected' : '' }}>Weekly Once</option>
                                <option value="3" {{ $seotask->task_frequency == '3' ? 'selected' : '' }}>Weekly Twice</option>
                                <option value="4" {{ $seotask->task_frequency == '4' ? 'selected' : '' }}>Weekly Thrice</option>
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
                                 <option selected disabled value="">{{ __('seo.select_no_of_submission') }}</option>
                                @for($sub = 1; $sub <= 100; $sub++)
                                @php
                                $selected = '';
                                if($sub == $seotask->no_of_submission){
                                    $selected = 'selected';
                                }
                                @endphp
                                <option value="{{ $sub}}" {{$selected}}>{{$sub}}</option>
                                @endfor
                                    </select>
                                    
                            </div>                    
                    </div><!--end col-->
                    
                </div><!--end row-->
                <div class="row">
                    <div class="col-sm-12 my-4 mx-4">
                        <input type="submit" id="submit" name="send" class="btn btn-primary" value="Submit">
                        <a href="{{ route('workReport') }}" class="btn btn-light mx-1 "> <i class="fas fa-backward" aria-hidden="true"></i>{{ __('common.goback') }}  </a>
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