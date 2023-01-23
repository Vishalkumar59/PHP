<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0 flash-message">
                    <div class="card rounded shadow pb-1 ">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">{{__('user-manager.permission_list')}}</h5>
                                <!-- <div >
                                    <a href="{{route('permission.create')}}">
                                    <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{__('user-manager.add_permission')}}</button></a>
                                </div> -->
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{__('common.sl_no')}}</th>
                                            <th class="border-bottom p-3">{{__('user-manager.permission_name')}}</th>
                                            <th class="border-bottom p-3">{{__('user-manager.permission_slug')}}</th>
                                            <th class=" border-bottom p-3">{{__('user-manager.sort_order')}}</th>
                                            <th class=" border-bottom p-3">{{__('common.status')}}</th>
                                            <th class=" border-bottom p-3">{{__('common.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if(!empty($userpermissionlist))
                                        @foreach($userpermissionlist as $key=>$userpermission)
                                        <tr>
                                            <td class="p-3">{{$key +1}}</td>
                                            <td class="p-3">{{$userpermission->permissions_name}}</td>
                                            <td class="p-3">{{$userpermission->permissions_slug}}</td>
                                            <td class="p-3">
                                                <input type="number" class="col-xs-1 permission_sort_order width1 text-center" data-id="{{ $userpermission->permissions_id }}" value="{{ $userpermission->sort_order }}" placeholder="" style="width:50px;">
                                            </td>
                                            <td class="p-3">
                                                <div class="form-check form-switch">
                                                    <input data-id="{{ $userpermission->permissions_id }}" class="form-check-input toggle_class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $userpermission->status ? 'checked' : '' }}>
                                                </div>
                                            <td class="p-3 d-flex">
                                                <a href="{{url('permission/'.$userpermission->permissions_id.'/edit')}}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                                <button type="button" id="delete_btn" value="{{$userpermission->permissions_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
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
    <!--end container-->
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.delete_permission')}}</h5>
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
                var permission_id = $(this).val();
                $('#delete_department_id').val(permission_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var permission_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('permission')}}/" + permission_id,
                    data: {
                        permission_id: permission_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {

                        $('#delete_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-danger');
                        $('.flash-message').fadeOut(1000, function() {
                            location.reload();
                        });
                    }
                });

            });
        });
    </script>
    <!--end delete ajax-->
    <script type="text/javascript">
        // change status in ajax code start
        $('.toggle_class').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let permissions_id = $(this).data('id')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('permission-status-change') }}",
                data: {
                    'status': status,
                    'permissions_id': permissions_id
                },
                success: function(data) {
                    console.log(data);
                    // location.reload();
                    Toaster(' Permission Status Changed ');
                }
            });
        });
        // change status in ajax code end  

        $(".permission_sort_order").on("blur", function(e) {
            e.preventDefault();
            var permissions_id = $(this).data('id');
            var sort_order = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('permission-sortorder') }}",
                data: {
                    permissions_id: permissions_id,
                    sort_order: sort_order
                },
                dataType: "json",
                success: function(data) {

                    Toaster('Sort order updated ');
                    $('#permission_sort_order').val(data.sort_order);
                    $('#permission_sort_order').val(data.sort_order);
                }
            });
        });
        // end sortoreder ajax
    </script>
    @endpush
</x-app-layout>