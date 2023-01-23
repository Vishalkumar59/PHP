<x-app-layout>
    @endphp
    <div class="container-fluid">
        <div class="layout-specing">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="card rounded shadow pb-1">
                            <div class=" border-0 quotation_form">
                                <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                    <h5 class="mb-0">{{ __('user-manager.designation_list') }}</h5>
                                    <div >
                                        <button class="btn btn-md btn-primary" id="add_modal"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('user-manager.add_designation') }}</button></a>
                                    </div>
                                </div>  
                            </div>
                            <div class="p-4 mt-1">
                                <div class="table-responsive shadow rounded" id="department">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                                <th class="border-bottom p-3" style="min-width: 220px;">{{ __('user-manager.designation') }}</th>
                                                <th class=" border-bottom p-3">{{ __('common.status') }}</th>
                                                <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- Start -->
                                            @if(!empty($designation_list))
                                            @foreach($designation_list as $key=>$designation)
                                            <tr>
                                                <td class="p-3">{{$key+1}}</td>
                                                <td class="p-3">{{$designation->designation_name}}</td>
                                                <td class="p-3">
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{$designation->designation_id}}"
                                                        class="form-check-input toggle-class" type="checkbox"
                                                        data-toggle="toggle" data-on="Active" data-off="InActive" {{ $designation->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td class="text-center d-flex justify-content-center p-3">
                                                    <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn " id="editmodal" value="{{$designation->designation_id}}" data-toggle="modal"
                                                        data-target="#designation_edit"><i class="uil uil-edit"></i></button>
                                                    <button type="button" id="delete_btn" value="{{$designation->designation_id}}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody><!-- End -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!--end row-->             
        </div>
    </div> <!--end container-->

     <!-- Add MOdal start -->
        <div class="modal fade" id="designation_add" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('user-manager.add_designation') }}</h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                    </div>
                    <div class="modal-body ">
                        <form id="add_userForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="md-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('user-manager.designation') }}<span class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input name="designation_name" id="designation_name"
                                            type="text" class="form-control"
                                            placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                            <span style="color:red;">
                                                @error('designation_name')
                                                {{$message}}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                {{ __('user-manager.designation_name_error') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-sm-12" required>
                                    <input type="submit" id="add_submit_btn" name="send" class="btn btn-primary" value=" {{ __('common.submit') }}">
                                </div>
                            </div> <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- add modal end --> 

        <!-- Edit MOdal start -->
        <div class="modal fade" id="designation_edit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('user-manager.update_designation') }}</h5>
                        <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal"
                        id="close-modal"><i class="uil uil-times fs-4 text-dark"></i></button>
                    </div>
                    <div class="modal-body ">
                        <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input name="designation_id" id="design_id" type="hidden"
                            class="form-control ps-5">
                            <span style="color:red;">
                                @error('designation_name')
                                {{$message}}
                                @enderror
                            </span>
                            <div class="row">
                                <div class="md-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('user-manager.designation') }}<span
                                            class="text-danger">*</span></label>
                                        <div class="form-icon position-relative">
                                            <input name="designation_name" id="design_name"
                                            type="text" class="form-control"
                                            placeholder="{{ __('user-manager.designation_placeholder') }}" required>
                                            <span style="color:red;">
                                                @error('designation_name')
                                                {{$message}}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                {{ __('user-manager.designation_name_error') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end row-->
                            <div class="row">
                                <div class="col-sm-12" required>
                                    <input type="submit" id="update_btn" class="btn btn-primary" value="{{__('common.update')}}">
                                </div>
                            </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit modal end -->

        <!--start delete modal-->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('user-manager.delete_designation') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ __('user-manager.are_you_sure') }}</h5>
                        <input type="hidden" id="delete_designation_id" name="input_field_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('common.no') }}</button>
                        <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                    </div>
                </div>
            </div>
        </div><!--end delete modal-->
        
    @push('scripts')
    <script>
         // modal add in ajax
         $(document).ready(function () {
            $("#add_modal").on('click', function (e) {
                e.preventDefault();
                $("#designation_add").modal('show');
            });

            $('#close-modal').on('click', function (e) {
                e.preventDefault();
                $("#designation_add").modal('hide');
            });

            $('#add_submit_btn').on('submit', function () {

                var data = {
                    designation_name: $("#designation_name").val(),
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('designation.store')}}",
                    data: data,
                    dataType: "json",

                    success: function (response) {

                        $('#add_modal').trigger("reset");
                        $('#designation_add').modal('hide');
                        $('.flash-message').html(response.msg1);
                        $('.flash-message').addClass('alert alert-success');
                    },
                    error: function (response) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
        });
    //  modal add closed ajax
</script>

<script>
        // Edit ajax start
        $(document).on("click", "#editmodal", function (e) {
            e.preventDefault();
            var designation_id = $(this).val();
            $('#designation_edit').modal('show');

            $.ajax({
                url: "designation/" + designation_id + "/edit",
                type: "GET",
                success: function (response) {

                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').append('<li>' + response.message + '</li>');

                    }
                    else {
                        $('#design_name').val(response.designation_name);
                        $('#design_id').val(designation_id);
                    }
                }
            });
        });
        // Edit ajax end 

        // update ajax start
        $(document).on("click", "#update_btn", function (e) {

            e.preventDefault();
            $('#update_userForm').addClass('was-validated');
            if ($('#update_userForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var data = {
                    designation_id: $("#design_id").val(),
                    designation_name: $("#design_name").val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{url('designation/Update')}}",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        Toaster(response.success);
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#designation_edit').modal('hide');
                        $("#department").load(location.href + " #department");
                        
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                    }
                });
            }
        });
        // update ajax end

        //  toggle ajax start
        $('.toggle-class').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let designation_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('changedesignationStatus')}}",
                data: { 'status': status, 'designation_id': designation_id },
                success: function (data) {
                    Toaster('Designation Status Changed Successfully')
                }
            });
        });


    </script> 

    <!-- start delete ajax-->
    <script>
        $(document).ready(function () {

            $(document).on("click", "#delete_btn", function () {
                var designation_id = $(this).val();

                $('#delete_designation_id').val(designation_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function () {
                var designation_id = $('#delete_designation_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{url('designationDestroy')}}/"+designation_id,
                    data: {
                        designation_id: designation_id
                    },
                    dataType: "json",
                    success: function (response) {
                        Toaster(response.success);
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#delete_modal').modal('hide');
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