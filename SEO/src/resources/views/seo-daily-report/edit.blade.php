<x-app-layout>   

 
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card rounded shadow ">
                        <div class=" border-0 quotation_form">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="position-relative m-2" >
                                    <h5 >{{$website_name}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @foreach($seo_task_listing as $key => $listing)
            @php

            $sl_no=0; 
            $count_report=0;
            @endphp
           
           
            <div class="row mt-3">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card rounded shadow">
                        
                        <form id="save-website-data-{{$listing->id}}" method="post" class="ajax-form mt-2">
                        <input type="hidden" name="website_id" value="{{$website_listing['id']}}">
                        <input type="hidden" name="seo_task_id" value="{{$listing->id}}">
                        <input type="hidden" name="total_report"  value="{{$listing->no_of_submission}}" ?>

                        
                        <div class="p-4">
                            <div class="table-responsive shadow rounded" id="department">
                                <table class="table table-center bg-white mb-0" >
                                    <thead>
                                        <tr> 
                                            
                                            <th class="border-bottom p-3">{{$listing->seo_task_title}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{ __('seo.website_url') }}
                                            </th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{ __('seo.posting_website') }}
                                            </th>
                                            <th class="border-bottom p-3">{{ __('seo.landing_url') }}</th>
                                            <!-- <th class="text-center border-bottom p-3">Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        @foreach($listing->work_report as $report)
                                            @php
                                            $sl_no++;
                                            $count_report =$listing->work_report->count()
                                            @endphp
                                        
                                            <tr>
                                                <td class="p-3">{{$sl_no}}</td>
                                                <td class="p-3">
                                                    <input type="hidden" name="update_id_{{$sl_no}}" value="{{$report->id ?? ''}}">
                                                    <input class="form-control" type="text" name="website_url_{{$sl_no}}" value="{{$report->website_url ?? ''}}">
                                                    @error('website_url')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td class="p-3">
                                                    <select class="form-select form-control select-picker" id="status" name="postingWebsite_{{$sl_no}}" aria-label="Default select example">
                                                        <option selected for="Select">{{ __('seo.select')}}</option>
                                                        @foreach($listing->website_submission as $submission )
                                                        <option @if ($report->submission_websites_id == $submission->id) selected @endif value="{{$submission->id}}">{{$submission->website_url}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="p-3">
                                                    <input class="form-control" type="text" name="landing_url_{{$sl_no}}" value="{{$report->landing_url ?? ''}}">
                                                </td>
                                        </tr>
                                        @endforeach

                                        @php
                                        $submission_no = $listing->no_of_submission-$count_report;
                                        @endphp
                                       
                                        @for($a = 1; $a <= $submission_no; $a++) 
                                        <tr>
                                            <td class="p-3">{{$a+$sl_no}}</td>
                                            <td class="p-3">
                                                <input class="form-control" type="text" name="website_url_{{$a+$sl_no}}">
                                                @error('website_url')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </td>
                                            <td class="p-3">
                                                <select class="form-select form-control select-picker" id="status" name="postingWebsite_{{$a+$sl_no}}" aria-label="Default select example">
                                                    <option selected disabled value="">{{ __('seo.select')}}</option>
                                                    @foreach($listing->website_submission as $submission )
                                                    <option value="{{$submission->id}}"> {{$submission->website_url}} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-3">
                                                <input class="form-control" type="text" name="landing_url_{{$a+$sl_no}}"/>
                                            </td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3 px-4 text-right">
                            <input type="button" class="btn btn-primary  save-website-form" form-id="{{$listing->id}}" value="{{ __('common.update')}}" />
                        </div>
                        </form>

                            
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
       
    

    @push('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <!-- <script src="{{asset('assets/js/pages/tagify.min.js') }}"></script> -->
   
  
   

    <script>
        $(document).ready(function() {

            $('.save-website-form').click(function() {
                
                const url = "{{ route('work-report-update', $website_listing->id) }}";
                var formID = $(this).attr('form-id');
                

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    formID: formID,
                    container: '#save-website-data-' + formID,
                    type: "POST",
                    data: $('#save-website-data-' + formID).serialize(),
                    success: function(response) {
                        if(response.success){
                            toastr.success(response.success);
                        }else{
                            toastr.error(response.error);
                        }
                        location.reload();

                    }
                })
            });


        });
    </script>
    @endpush
</x-app-layout>