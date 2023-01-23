<x-app-layout>

    <!-- Top Header -->
    <div class="container-fluid">
        <div class="layout-specing">

            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('crm.lead_list') }}</h5>
                                <div>
                                    <a href="{{route('leads.create')}}">
                                        <button class="btn  btn-primary "><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{__('user-manager.add_user')}}</button></a>
                                    <button class="btn  btn-primary mg-l-5"><i data-feather="arrow-down"
                                            class="lead_icon mg-r-5"></i>{{ __('crm.import_modal') }}</button>
                                    <button class="btn  btn-primary  mg-l-5"><i data-feather="mail"
                                            class="lead_icon mg-r-5"></i>{{ __('crm.send_mail') }}</button>
                                </div>
                            </div>
                            <div class="row  px-4">
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.talk_in_progress') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="4589">1</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->

                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.follow_up_scheduled') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="0">0</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.junk_lead') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="1">1</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}Total</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.not_interested') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="1">1</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.converted') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="1">1</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.quotation_send') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="0">0</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-sm-12 mt-4">
                                    <a href="#!"
                                        class="features feature-primary d-flex justify-content-between align-items-center rounded shadow p-2">
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-dark">{{ __('crm.cancelled') }}</h6>
                                            <p class="fs-5 text-dark fw-bold mb-0"><span class="counter-value"
                                                    data-target="0">0</span>
                                            </p>
                                            <span class="text-muted">{{ __('crm.total') }}</span>
                                        </div>
                                    </a>
                                </div>
                                <!--end col-->

                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded" id="department">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="" style="min-width:70px;">{{ __('common.sl_no') }}</th>
                                                <th class="border-bottom text-center" style="min-width: 150px;">{{
                                                    __('crm.lead_list') }}</th>
                                                <th class="text-center border-bottom" style="min-width: 100px;">{{
                                                    __('crm.priority') }}</th>
                                                <th class="text-center border-bottom" style="min-width: 100px;">{{
                                                    __('crm.follow_up') }}</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;">{{
                                                    __('crm.follow_date') }}</th>
                                                <th class="text-center border-bottom" style="min-width: 200px;"> {{
                                                    __('crm.follow_up_status') }}</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;">{{
                                                    __('common.action') }} </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Start -->
                                            @foreach($lead as $key =>$leadData)

                                            <tr>
                                                <input type="hidden" value="{{$leadData->lead_id}}" name="lead_id"
                                                    class="lead_id">
                                                <td class="text-center">{{$key+1}}</td>
                                                <td class="" style="text-align:left;">
                                                    {{$leadData->contact_name}}<br>{{$leadData->contact_email}}</td>
                                                {{-- <td class="text-center">{{$lead->phone}}</td> --}}
                                                <td class="text-center">
                                                    @if($leadData->priority == '1')
                                                    {{ 'Low'}}
                                                    @elseif($leadData->priority == '2')
                                                    {{'Medium'}}
                                                    @else($leadData->priority == '3')
                                                    {{'High'}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{($leadData->folllow_up == '1')?'Yes':'No'}}
                                                </td>
                                                <td class="text-center">-</td>
                                                <td>

                                                    <select class="form-select form-control follow_status"
                                                        name="follow_status" required>
                                                        <option value="">Select</option>
                                                        @foreach($leadStatus as $key => $status)
                                                        <option value="{{ $status->status_id }}">
                                                            {{ $status->status_name }}</option>
                                                        @endforeach
                                                        {{-- <option value="">Talk In Progress </option>
                                                        <option value="">Select </option> --}}
                                                    </select>
                                                </td>
                                                <td class="text-center d-flex justify-content-center p-3">
                                                    
                                                    <a href="{{ route('leads.edit',$leadData->lead_id)}}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                                    <button type="button" id="delete_btn" value="{{ $leadData->lead_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            <!-- End -->
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row text-center px-2  mb-4">
                                    <!-- PAGINATION START -->
                                    <div class="col-12 mt-4">
                                        <div class="d-md-flex align-items-center text-center justify-content-between">
                                            <span class="text-muted me-3">Showing {{$lead->currentPage();}} -
                                                {{$lead->lastItem();}} out of {{$lead->total()}}</span>
                                            <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                                {{ $lead->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- PAGINATION END -->
                                </div>
                                <!--end row-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end col-->

            <!--end col-->
        </div>
        <!--end row-->


        <!--end row-->
    </div>
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>Are you sure want to delete ?</h5>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->
    @push('scripts')
    <script type="text/javascript">
        $(function(){
        $(".alert").delay(2000).fadeOut("slow");
        });
        
    </script>
    <script>
        $('.lead_id').on('keyup',function(){
            var data = $('.lead_id').val();
            alert(data);
});
$(".lead_id").keyup(function(){  
       alert("g");
    });
    </script>

    <script type="text/javascript">
        // change status in ajax code start
        $('.follow_status').change(function() {
            let status = $(this).val();
            var lead_id = $('.lead_id').val();
            // alert(lead_id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('lead-followup') }}",
                data: {
                    status: status,
                    lead_id : lead_id
                },
                success: function(data) {

                    // location.reload();
                    Toaster(' User Status Changed ');

                }
            });
        });
        // chenge status in ajax code end  
    </script>
    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var lead_id = $(this).val();
                $('#delete_department_id').val(lead_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var lead_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                 
                $.ajax({
                    type: "POST",
                    url : "{{ url('leads')}}/"+lead_id,
                    data: {
                        lead_id: lead_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#department_edit').modal('hide');
                        $("#department").load(location.href + " #department");
                        
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    }
                });

            });
        });
    </script>

    @endpush

</x-app-layout>