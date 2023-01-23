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
                                <h5 class="mb-0">{{ __('user-manager.role_list') }}</h5>
                                <div>
                                    <a href="{{ route('role.create') }}">
                                        <button class="btn btn-md  btn-primary "><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('user-manager.add_role')
                                            }}</button></a>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3" >{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3" style="width:200px">
                                                {{ __('user-manager.role_name') }}
                                            </th>
                                            <th class="border-bottom p-3" style="width:200px">
                                                {{ __('user-manager.numberofuser') }}
                                            </th>
                                            <th class="text-center border-bottom p-3" style="width:200px">{{ __('user-manager.sort_order') }}
                                            </th>
                                            <th class="text-center border-bottom p-3"  style="width:200px">
                                                {{ __('common.action') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($role_list) && count($role_list) > 0)
                                        @foreach ($role_list as $index => $role)
                                        <tr class="border-bottom">
                                            <th class="p-3">{{ ++$index }}</th>
                                            <td class="p-3">{{ $role->roles_name }}</td>
                                            <td class="p-3">{{ $role->user->count() }}</td>
                                            <td class="text-center p-3">
                                                <input type="number" class="sort_Order" style="width: 50px; text-align: center;" value="{{ $role->sort_order }}" data-id="{{ $role->roles_id }}" name="sort_order">
                                            </td>

                                            @if ($role->is_editable == '1')
                                            <td class=" float-end me-5 p-3">
                                                <a href="{{ url('role/' . $role->roles_id . '/edit') }}" class="btn btn-primary btn-xs btn-icon table_btn">
                                                    <i class="uil uil-edit"></i>
                                                </a>

                                                <button type="button" id="delete_btn" value="{{ $role->roles_id }}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>

                                            </td>
                                            @endif
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
            <!--end row-->

        </div>
    </div>
    <!--end container-->
    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('user-manager.delete_role')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{__('user-manager.are_you_sure')}}</h5>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no') }}</button>
                    <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->




    <!--section sort order update-->
    @push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var role_id = $(this).val();

                $('#delete_department_id').val(role_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var role_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('role')}}/" + role_id,
                    data: {
                        role_id: role_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        Toaster(response.success);
                        setTimeout(function() {
                            location.reload(true);
                        }, 2000);
                        $('#delete_modal').modal('hide');


                    }
                });

            });
        });
    </script>
    <!--end delete ajax-->
    <script>
        $('.flash').fadeOut(5000);
        $(".sort_Order").on("blur", function(e) {
            e.preventDefault();
            var role_id = $(this).data('id');
            var sort_order = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('updatestatus') }}",
                data: {
                    role_id: role_id,
                    sort_order: sort_order
                },
                dataType: "json",
                success: function(data) {
                    Toaster(data.message);
                    $('#sort_Order').val(data.sort_order);
                }
            });
        });
    </script>
    @endpush
    <!--section end-->
</x-app-layout>