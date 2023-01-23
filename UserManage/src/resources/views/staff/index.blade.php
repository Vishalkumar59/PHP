<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12  lead_list">
                    <div class="card rounded shadow">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mb-0">{{__('user-manager.employee_list')}}</h5>
                                <div>
                                    <a href="{{ route('employee.create') }}">
                                        <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i> {{__('user-manager.add_employee')}}</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                       {{--  <div class="form-outline">
                            <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2 pt-4"><select class="form-select" aria-label="Default select example">
                                            <option>10</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 float-end pt-4"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="Search..." aria-label="Search">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="p-4 mt-1">
                                <div class="table-responsive">
                                    <table class="table table-center bg-white mb-0 dataTableShow">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom ">{{__('common.sl_no')}}</th>
                                                <th class="border-bottom" >{{__('user-manager.employee')}}</th>
                                                <th class="border-bottom" >{{__('user-manager.designation')}}</th>
                                                <th class="border-bottom" >{{__('user-manager.department')}}</th>
                                                <th class="border-bottom" >{{__('common.status')}}</th>
                                                <th class="text-center border-bottom" >{{__('common.action')}}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($staff_list))
                                            @foreach ($staff_list as $key => $staff)
                                            <tr>
                                                <td class="px-3">{{ $key + 1 }}</td>
                                                <td class="px-3">{{ $staff->staff_name }}<br> {{ $staff->staff_email }}</td>

                                                <td class="px-3">
                                                    @if (!empty($staff->designation))
                                                    {{ $staff->designation->designation_name }}
                                                    @endif
                                                </td>
                                                <td class="px-3">
                                                    @if (!empty($staff->department))
                                                    {{ $staff->department->dept_name }}
                                                    @endif
                                                </td>
                                                <td class="px-3">
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $staff->staff_id }}" class="form-check-input toggle_status" data-on="Active" data-off="InActive" type="checkbox" role="switch" {{ $staff->status ? 'checked' : '' }} id="flexSwitchCheckDefault" checked>
                                                    </div>
                                                </td>
                                                <td class="px-3 text-center">
                                                    <a href="{{ route('employee.edit', $staff->staff_id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                                    <button type="button" id="delete_btn" value="{{ $staff->staff_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div> <!--end col-->          
        </div><!--end row-->
        
        <!--start delete modal-->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.delete_user')}}</h5>
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
        <!-- it is for toastr success message-->
        
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
                    var staff_id = $(this).val();

                    $('#delete_department_id').val(staff_id);
                    $('#delete_modal').modal('show');
                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var staff_id = $('#delete_department_id').val();

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('employee')}}/" + staff_id,
                        data: {
                            staff_id: staff_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);
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
            $('.toggle_status').change(function(e) {
                e.preventDefault();
                // alert('hihyu');
                let status = $(this).prop('checked') === true ? 1 : 0;
                let staff_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('employee-status-change') }}",
                    data: {
                        'status': status,
                        'staff_id': staff_id
                    },
                    success: function(data) {
                        // location.reload();
                        Toaster(' Employee Status Change Successfully');
                    }
                });
            });
            // chenge status in ajax code end  
        </script>
        @endpush
        <!-- closed -->
</x-app-layout>