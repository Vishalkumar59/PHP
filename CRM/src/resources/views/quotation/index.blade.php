<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{__('crm.quotation_list')}}</h5>
                                <div>
                                <a href="{{ route('quotation.create') }}">
                                        <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('crm.add_quotation')}}</button></a>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4 mt-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2"><select class="form-select" aria-label="Default select example">
                                            <option>10</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 float-end"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="Search..." aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{__('common.sl_no')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.date')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.quotation_no')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.customer_delails')}}</th>
                                                <th class="border-bottom" style="min-width: 150px;">{{__('crm.quote_price')}}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{__('common.status')}}</th>
                                                <th class="text-center border-bottom" style="min-width: 70px;">{{__('common.action')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($quotation_list))
                                            @foreach ($quotation_list as $key => $quotation)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $quotation->created_at->format('d/m/Y')}}</td>
                                                <td class="">{{ $quotation->quotation_no }}</td>               
                                                <td class="">
                                                    @if (!empty($quotation->customer_details))
                                                    {{ $quotation->customer_details->first_name }}<br>{{$quotation->customer_details->email}}
                                                    @endif
                                                </td>
                                                <td class="">{{ $quotation->final_cost }}</td>
                                                
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $quotation->quotation_id }}" class="form-check-input toggle_status" data-on="Active" data-off="InActive" type="checkbox" role="switch" {{ $quotation->status ? 'checked' : '' }} id="flexSwitchCheckDefault" checked>
                                                    </div>
                                                </td>
                                                <td class="text-center d-flex justify-content-center p-3">
                                                    <a href="{{ route('quotation.edit', $quotation->quotation_id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                                    <button type="button" id="delete_btn" value="{{ $quotation->quotation_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> <!--end col-->          
        </div><!--end row-->
        
        <!--start delete modal-->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('crm.delete_quotation')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <h5>{{__('user-manager.are_you_sure')}}</h5>
                        <input type="hidden" id="delete_department_id" name="input_field_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.no')}}</button>
                        <button type="submit" class="btn btn-primary delete_submit_btn">{{__('common.yes')}}</button>
                    </div>
                </div>
            </div>
        </div><!--end delete modal-->
        
        @push('scripts')
        <!-- search ajax-->
        <script>
            $(document).ready(function() {
                $("#Search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#Search_Tr tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>

        <!-- delete ajax start -->
        <script>
            $(document).ready(function() {

                $(document).on("click", "#delete_btn", function() {
                    var quotation_id = $(this).val();
                 
                    $('#delete_department_id').val(quotation_id);
                    $('#delete_modal').modal('show');
                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var quotation_id = $('#delete_department_id').val();

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('quotation-delete') }}",
                        data: {
                            quotation_id: quotation_id,
                            
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 300);
                            $('#delete_modal').modal('hide');

                        }
                    });

                });
            });
        </script>
        <!--end delete ajax-->

        <!--end status ajax-->
        <script type="text/javascript">
            // change status in ajax code start
            // $('.toggle_status').change(function(e) {
            //     e.preventDefault();
            //     // alert('hihyu');
            //     let status = $(this).prop('checked') === true ? 1 : 0;
            //     let staff_id = $(this).data('id');
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         type: "POST",
            //         dataType: "json",
            //         url: "{{ url('employee-status-change') }}",
            //         data: {
            //             'status': status,
            //             'staff_id': staff_id
            //         },
            //         success: function(data) {
            //             // location.reload();
            //             Toaster(' Employee Status Change Successfully');
            //         }
            //     });
            // });
            // chenge status in ajax code end  
        </script>
        @endpush
        <!-- closed -->
</x-app-layout>