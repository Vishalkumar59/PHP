<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing" id="import_table">
            <form action="{{ route('work-report.import.store') }}" id="import-work-report-data-form" novalidate method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('seo.website_name') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="website_id" id="website_id" aria-label="Default select example" required>
                                @foreach($website_list as $website) 
                                    <option value="{{$website->website_id}}">{{$website->website_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                             <label class="form-label">{{ __('seo.seo_task') }}<span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="seo_task_id" id="seo_task_id" aria-label="Default select example" required>
                            @foreach($seo_task_list as $seo_list) 
                                <option value="{{$seo_list->id}}">{{$seo_list->seo_task_title}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                             <label class="form-label">{{ __('seo.users') }} <span class="text-danger">*</span></label>
                            <select class="form-select form-control" name="user_id" id="user_id" aria-label="Default select example" required>
                               @foreach($user_list as $list) 
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div><!--end col-->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">{{ __('seo.upload_file') }}(file must be a file of type: xls, xlsx, csv) </label>
                            <div class="form-icon position-relative">
                                <i data-feather="user" class="fea icon-sm icons"></i>
                                
                                <input type="file"  name="import_file" data-allowed-file-extensions="xls xlsx csv txt" id="work_report_import"  class="form-control ps-5 dropify" required>

                            </div>
                            </div>                    
                    </div><!--end col-->
                    
                <div class="row">
                    <div class="col-sm-12 mb-5">
                        <button id="import-work-report-form" type="submit" class="btn btn-primary">{{ __('seo.upload') }}</button>
                    </div><!--end col-->
                </div><!--end row-->
            </form>
        </div>
    </div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script>

    $(document).ready(function () {
       $("#work_report_import").dropify({
            messages: dropifyMessages
        });
       

        $('body').on('click', '#import-work-report-form', function () {
            const url = "{{ route('work-report.import.store') }}";
               
            $.ajax({
                url: url,
                container: '#import-work-report-data-form',
                type: "POST",
                disableButton: true,
                blockUI: true,
                buttonSelector: "#import-work-report-form", 
                file: true,
                data: $('#import-work-report-data-form').serialize(),
                success: function (response) {
                    if (response.status == 'success') {
                         console.log('hello');
                        $('#import_table').html(response.view);
                    }
                }
            });
        });
    });
</script> --}}

@endpush
</x-app-layout>