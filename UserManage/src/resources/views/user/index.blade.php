<x-app-layout>
    @php
    $main_arr = [
    'title' => ' ',
    'sublist' => [
    [
    'name' => '',
    'link' => url(''),
    ],
    [
    'name' => '',
    'link' => url(''),
    ],
    ],
    ];
    @endphp

    <div class="container-fluid">
        <div class="layout-specing">

            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mb-0">{{__('user-manager.user_list')}}</h5>
                                <div>
                                    <a href="{{ route('user.create') }}">
                                        <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('user-manager.add_user')}}</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="pull-left d-flex justify-content-between align-items-center mt-3">
                    <h5 class="mb-0">User List</h5>
                    <a href="{{ route('user.create') }}">
                        <button class="btn btn-primary btns">Add User</button>
                    </a>
                </div> -->
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" id="department">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{__('common.sl_no')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 200px;">{{__('user-manager.name')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{__('user-manager.email')}}</th>
                                            <th class=" border-bottom p-3">{{__('user-manager.role')}}</th>
                                            <th class="border-bottom p-3">{{__('common.status')}}</th>
                                            <th class="text-center border-bottom p-3">{{__('common.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if (!empty($user_list))
                                        @foreach ($user_list as $key => $user)
                                        {{-- @dd($user->role) --}}
                                        <tr>
                                            <th class="px-3 ">{{ $key + 1 }}</th>
                                            <td class="px-3 ">{{ $user->name }}</td>
                                            <td class="px-3 ">{{ $user->email }}</td>
                                            <td class="px-3 ">

                                                @foreach ($user->role as $rolesdata)
                                                {{$rolesdata->roles->roles_name}}
                                                @endforeach
                                            </td>
                                            <td class="px-3 ">
                                                <div class="form-check form-switch">
                                                    <input data-id="{{ $user->id }}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                                                </div>
                                                {{-- <div class="form-check form-switch">
                                                        <input data-id="{{ $user->id }}"
                                                class="form-check-input toggle-class"
                                                onclick=" return swal('Are yo sure want to change status?',{
                                                buttons: ['No!', 'Yes!'],
                                                });"
                                                type="checkbox" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                            </div> --}}
                            </td>
                            <td class="text-center d-flex justify-content-center  p-3">
                                <a href="{{ url('user/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                <button type="button" id="delete_btn" value="{{ $user->id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                {{-- <form action="{{ url('user/' . $user->id) }}" method="POST"
                                class="">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs btn-icon" onclick="return confirm ('Are you sure you want to delete')"><i class="uil uil-trash-alt"></i></button>


                                </form> --}}
                            </td>
                            </tr>
                            @endforeach
                            @endif
                            <!-- End -->
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row text-center px-4 mb-4">
                        <!-- PAGINATION START -->
                        <div class="col-12">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$user_list->currentPage();}} - {{$user_list->lastItem();}} out of {{$user_list->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-sm-0">
                                    {{ $user_list->links() }}
                                </ul>
                            </div>
                        </div>
                        <!-- PAGINATION END -->
                    </div>
                    <!--end row-->
                </div>

            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    </div>
    <!--end container-->
    <!-- delete modal open -->
    <div class="modal fade confirmationModal " id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.cencel_subscription')}}</h5>
                    <button type="button" class="close modal-dismiss" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="cancel">
                    <h5>{{__('user-manager.are_you_sure')}}</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-dismis" data-dismiss="modal">{{__('common.no')}}</button>
                    <button type="button" class="btn btn-primary cancel_cnf ">{{__('common.yes')}}</button>
                </div>
            </div>
        </div>
    </div><!-- delete modal closed -->

    <!--start delete modal-->

    {{-- <div class="modal fade" id="change_status" tabindex="-1" role="dialog" aria-labelledby="   exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('user-manager.user_status_change')}} </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
    </div>
    <div class="modal-body">
        <h5> {{__('user-manager.are_you_sure_change_status')}}</h5>
        <input type="text" id="change" name="input_field_id">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.no')}}</button>
        <button type="submit" class="btn btn-primary delete_temp">{{__('common.yes')}}</button>
    </div>
    </div>
    </div>
    </div> --}}
    <!--end delete modal-->
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
    </div>
    <!--end delete modal-->
    @push('scripts')

    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var department_id = $(this).val();

                $('#delete_department_id').val(department_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var user_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    // url: "{{ url('departmentDestroy') }}/" + department_id,
                    url: "{{ url('user')}}/" + user_id,
                    data: {
                        user_id: user_id,
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
    <!--end delete ajax-->





    <script>
        $(document).ready(function() {

            $(document).on("click", "#deletebtn", function(e) {
                e.preventDefault();
                var TXNId = $(this).attr('value');
                $('#DeleteModal').modal('show');
            });

            $(document).on('click', '.cancel_cnf', function(e) {
                e.preventDefault();
                var data = {
                    'subscription_unique_id': $('#cancel').val(),
                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('cancel-subscription') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $.each(response.error, function(key, err_val) {
                                $('#enq_' + key).text(err_val);
                            });
                        } else {
                            swal("Send Successfully", "Thank You", "success");
                            $('#RequestDemoForm').trigger("reset");
                            $('#enquiry-popup').modal('hide');
                        }
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        // change status in ajax code start
        $('.toggle-class').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('user-status-chenge') }}",
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {

                    // location.reload();
                    Toaster(' User Status Changed ');

                }
            });
        });
        // chenge status in ajax code end  
    </script>
    @endpush
</x-app-layout>