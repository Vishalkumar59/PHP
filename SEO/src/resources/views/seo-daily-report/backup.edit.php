<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="d-md-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ __('seo.daily_work') }}</h5>

                <nav aria-label="breadcrumb" class="d-inline-block">
                    <ul class="breadcrumb bg-transparent rounded mb-0 p-0">
                        <li class="breadcrumb-item text-capitalize"><a href="index.html">{{ __('seo.home') }}</a></li>
                        <li class="breadcrumb-item text-capitalize"><a href="#">{{ __('seo.daily_work_list') }}</a></li>
                    </ul>
                </nav>
            </div>
            @foreach($seo_task_listing as $key => $listing)
            @php

            $sl_no=0;
            $count_report=0;
            @endphp
            <form id="save-website-data-{{$listing->id}}" method="post" class="ajax-form mt-5">
                <input type="hidden" name="website_id" value="{{$website_listing['website_id']}}">
                <input type="hidden" name="seo_task_id" value="{{$listing->id}}">
                <table class="table-bordered">
                    <thead>
                        <tr>
                            <th>{{$listing->seo_task_title}}</th>
                            <th>{{ __('seo.website_url') }}</th>
                            <th>{{ __('seo.posting_website') }}</th>
                            <th>{{ __('seo.landing_url') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listing->work_report as $report)
                        @php

                        $sl_no++;
                        $count_report =$report->count();

                        @endphp

                        <tr>


                            <td style="padding-left: 110px;">{{$sl_no}}</td>
                            <td>
                                <input type="hidden" name="update_id[]" value="{{$report->id}}">
                                <input class="form-control" type="text" name="website_url[]" value="{{$report->website_url}}">
                            </td>
                            <td>

                                <select class="form-select form-control select-picker" id="status" name="submission_url[]" aria-label="Default select example">
                                    <option selected for="Select">{{ __('seo.select')}}</option>
                                    @foreach($listing->website_submission as $submission )
                                    <option @if ($report->submission_websites_id == $submission->id) selected @endif value="{{$submission->id}}">{{$submission->website_url}}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td><input class="form-control" type="text" name="landing_url[]" value="{{$report->landing_url}}"></td>

                        </tr>
                        @endforeach
                        @php
                        $submission_no = $listing->no_of_submission-$count_report;
                        @endphp
                        @for($a = 1; $a <= $submission_no; $a++) <tr>
                            <td style="padding-left: 110px;">{{$a}}</td>

                            <td><input class="form-control" type="text" name="website_url[]" /></td>

                            <td>
                                <select class="form-select form-control select-picker" id="status" name="submission_url[]" aria-label="Default select example">
                                    <option selected for="Select">Select</option>
                                    @foreach($listing->website_submission as $submission )
                                    <option value="{{$submission->id}}"> {{$submission->website_url}} </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input class="form-control " type="text" name="landing_url[]" /></td>
                            </tr>
                            @endfor

                    </tbody>
                </table>



                <div class="mb-3 text-center">
                    <input type="button" class="btn btn-primary mt-3 save-website-form" form-id="{{$listing->id}}" value="{{ __('common.update')}}" />
                </div>
            </form>
            @endforeach
        </div>
    </div>


    @push('scripts')


    <!-- Latest compiled and minified JavaScript -->
    <script src="{{asset('assets/js/pages/tagify.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.save-website-form').click(function() {

                const url = "{{ route('work-report-update', $website_listing->id) }}";
                var formID = $(this).attr('form-id');
                //console.log(formID);

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
                        location.reload();

                    }
                })
            });


        });
    </script>
    @endpush
</x-app-layout>