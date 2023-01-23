<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">    
           <div class="row">
                <div class="col-md-12 col-lg-12 my-2">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">{{__('user-manager.department_list')}}</h5>
                                <div>
                                    <button class="btn btn-md  btn-primary " id="addmodal"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('user-manager.add_department')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" id="department">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3 col-sm-2">{{__('common.sl_no')}} </th>
                                            <th class="border-bottom p-3 col-sm-3">{{__('user-manager.department_name')}}</th>
                                            <th class="border-bottom p-3 col-sm-4">{{__('user-manager.department_details')}}</th>
                                            <th class=" border-bottom col-sm-1">{{__('common.status')}}</th>
                                            <th class="text-center border-bottom col-sm-2">{{__('common.action')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($department_list))
                                        @foreach ($department_list as $key => $department)
                                        <tr>
                                            <td class="p-3">{{ $key + 1 }}
                                            </td>
                                            <td class="p-3">{{ $department->dept_name }}
                                            </td>
                                            <td class="p-3">{{ $department->dept_details }}
                                            </td>
                                            <td class="p-2">
                                                <div class="form-check form-switch">
                                                    <input id="loader" data-id="{{ $department->department_id }}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                        $department->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td class=" text-center">
                                                <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn" id="editmodal" value="{{ $department->department_id }}" data-toggle="modal" data-target="#department_edit">
                                                    <i class="uil uil-edit">
                                                    </i>
                                                </button>
                                                <button type="button" id="delete_btn" value="{{ $department->department_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <!-- End -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end row-->

    <!--  start insert modal  -->
    <div class="modal fade" id="departmentadd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.add_department')}}
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label"> {{__('user-manager.department_name')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="department_name" id="department_name" type="text" class="form-control" placeholder="{{__('user-manager.department_name_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.name_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('dept_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label"> {{__('user-manager.department_details')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="department_details" id="department_details" type="text" class="form-control" placeholder="{{__('user-manager.department_details_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.details_error')}}
                                        </div>
                                        <!-- laravel velidation open -->
                                        <span style="color:red;">
                                            @error('dept_details')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                        <!-- laravel velidation end -->
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end insert modal  -->

    <!--start update modal-->
    <div class="modal fade dept_edit" id="department_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel"> {{__('user-manager.update_department')}}
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="department_id" id="department_id" type="hidden" class="form-control ps-5" placeholder="">
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label"> {{__('user-manager.department_name')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="dept_name" id="dept_name" type="text" class="form-control" placeholder="{{__('user-manager.department_name_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.name_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('dept_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label"> {{__('user-manager.department_details')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="dept_details" id="dept_details" type="text" class="form-control" placeholder="{{__('user-manager.department_details_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.details_error')}}
                                        </div>
                                        <!-- laravel velidation open -->
                                        <span style="color:red;">
                                            @error('dept_details')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                        <!-- laravel velidation end -->
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->

                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="Submit" id="update_btn" name="send" class="btn btn-primary" value="{{__('common.update')}}">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div><!-- end update modal -->
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.delete_department')}}</h5>
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
        // delete modal jquery
        $(document).ready(function() {
            $("#button").click(function() {});
            $(document).ready(function() {
                $("#addmodal").on('click', function(e) {
                    e.preventDefault();
                    $("#departmentadd").modal('show');
                });
            });
        });
    </script>

    <script>
        // start aad modal ajax
        $(document).ready(function() {
            $('#submit').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    dept_name: $("#department_name").val(),
                    dept_details: $("#department_details").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('department.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {

                        $('#addmodal').trigger("reset");
                        $('#departmentadd').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    },
                    error: function(response) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
        });

        //end add modal ajax

        // start edit modal ajax
        $(document).on("click", "#editmodal", function(e) {
            e.preventDefault();
            var department_id = $(this).val();
            $('#department_edit').modal('show');
            $.ajax({
                url: "department/" + department_id + "/edit",
                type: "GET",
                success: function(response) {
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').append('<li>' + response.message + '</li>');
                    } else {
                        $('#dept_name').val(response.dept_name);
                        $('#dept_details').val(response.dept_details);
                        $('#department_id').val(department_id);
                    }
                }
            });
        });

        //  end edit modal ajax

        //  modal update code start
        $(document).on("click", "#update_btn", function(e) {
            e.preventDefault();
            $('#update_userForm').addClass('was-validated');
            if ($('#update_userForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var department_id = $("#department_id").val();
                var data = {
                    dept_name: $('#dept_name').val(),
                    dept_details: $('#dept_details').val(),
                    department_id: $('#department_id').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('department/updateData') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // alert(response.success);
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#department_edit').modal('hide');
                        $("#department").load(location.href + " #department");

                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });

                        //     $('#addmodal').trigger("reset");
                        //     $('#department_edit').modal('hide');
                        //     $('.flash-message').html(response.success);
                        //     $('.flash-message').addClass('alert alert-success');
                        //     $('.flash-message').fadeOut(3000, function() {
                        //         location.reload(true);
                        //     });
                        // }
                        // , error: function(response) {
                        //     var errors = data.responseJSON;
                        //     console.log(errors);
                    }


                });
            }
        });

        //  modal update code end

        // change status open
        $('.toggle-class').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let department_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('changeStatus') }}",
                data: {
                    'status': status,
                    'department_id': department_id
                },
                success: function(data) {
                    Toaster('Department Status Change Successfully');
                }
            });
        });
    </script>
    <!-- start delete ajax-->
    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var department_id = $(this).val();

                $('#delete_department_id').val(department_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var department_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('departmentDestroy') }}/" + department_id,
                    data: {
                        department_id: department_id
                    },
                    dataType: "json",
                    success: function(response) {
                        // Toaster(response.success);
                        // setTimeout(function() {
                        //     location.reload(true);
                        // }, 3000);
                        // $('#delete_modal').modal('hide');
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
    @endpush
</x-app-layout>