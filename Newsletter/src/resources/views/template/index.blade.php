<x-app-layout>
    <style>
        .form-check .form-check-input {
            float: inherit;
        }
    </style>

    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-2 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('newsletter.template_group')}}</h5>
                                <div>
                                    <button class="btn btn-primary" id="addbutton"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('newsletter.add_group')}}</button>
                                    {{-- <a href="{{route('template-list.index')}}"> <button class="btn btn-primary" id="addbutton"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('newsletter.template_list')}}</button></a> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12  p-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2">
                                        <select class="form-select" aria-label="Default select example" id="reload_pagination_template">
                                            <option>10</option>
                                            <option>20</option>
                                            <option>30</option>
                                            <option>40</option>
                                            <option>50</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 float-end"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="{{ __('newsletter.search_placeholder')}}" aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    @if(!empty($template_group_list) && sizeof($template_group_list)>0)
                                    <table class="table table-center bg-white mb-0" id="template_data_reload">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom col-sm-1 text-center" >{{ __('common.sl_no')}}</th>
                                                <th class="border-bottom text-center col-sm-7" >{{ __('newsletter.group_name')}}</th>
                                                <th class=" border-bottom col-sm-2 text-center">{{ __('common.status')}}</th>
                                                <th class="border-bottom col-sm-2 text-center" >{{ __('common.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($template_group_list))
                                            @foreach ($template_group_list as $key => $template_group)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $template_group->group_name }}</td>
                                                <td>
                                                    <div class="form-check form-switch mx-auto pl-0">
                                                        <input id="loader" data-id="{{ $template_group->id }}" class="form-check-input mx-auto toggle_class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $template_group->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td class="p-3 d-flex justify-content-center">
                                                    {{-- <a href="{{route('template-list.index',$template_group->id)}}"class="btn btn-primary  table_btn btn-xs btn-icon view_btn "
                                                   ><i class="uil uil-eye"></i></a> --}}
                                                   <a href="{{ route('TemplateLists', $template_group->id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-eye"></i></a>

                                                    <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn" id="editbutton" value="{{ $template_group->id }}" data-toggle="modal" data-target="#open_modal_edit">
                                                        <i class="uil uil-edit">
                                                        </i>
                                                    </button>

                                                    <button href="javascript:void(0)" id="delete_btn" data-id="{{ $template_group->id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-danger btn-xs btn-icon del_button"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                        @else
                                             <div class="s-b-n-header" id="">
                                                 <h4 class="text-center">No Record Found !. </h4>
                                            </div>
                                       @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--paginaion open -->
                    <div class="row text-center px-2  mb-4" id="reload_pagination_template">
                        <div class="col-12 mt-4">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$template_group_list->currentPage();}} -
                                    {{$template_group_list->lastItem();}} out of {{$template_group_list->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $template_group_list->links() }}
                                </ul>
                            </div>
                        </div>
                    </div><!--paginaion close -->                   
                </div><!--end col-->
            </div><!--end row-->        
        </div>
    </div>
    
    <!--start add modal-->
    <div class="modal fade" id="open_modal" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="    true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('newsletter.add_template_group')}}
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
                                    <label class="form-label">{{ __('newsletter.group_name')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="group_name" id="add_group_name" type="text" class="form-control" placeholder="{{ __('newsletter.group_name_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('newsletter.group_name_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('group_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div>                          
                        </div><!--end row-->                     
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('newsletter.details')}}
                                        <span class="text-danger">
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="details" id="add_details" type="text" class="form-control" placeholder="{{ __('newsletter.details_placeholder')}}" >
                                        <div class="invalid-feedback">
                                            {{ __('newsletter.details_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('details')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div>                           
                        </div><!--end row-->                       
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{ __('common.submit')}}">
                            </div>                         
                        </div><!--end row-->                      
                    </form>
                </div>
            </div>
        </div>
    </div><!--end add modal-->
    
    <!-- start edit modal-->
    <div class="modal fade" id="open_modal_edit" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.update_template_group')}} </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form id="update_userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <input name="hidden_id" id="hidden_id" type="hidden" class="form-control ps-5" placeholder="">
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('newsletter.group_name')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="group_name" id="update_group_name" type="text" class="form-control" placeholder="{{ __('newsletter.group_name_placeholder')}}" required>
                                        <div class="invalid-feedback">
                                            {{ __('newsletter.group_name_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('group_name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div><!--end col-->                          
                        </div><!--end row-->                       
                        <div class="row">
                            <div class="">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('newsletter.details')}}
                                        <span class="text-danger">*
                                        </span>
                                    </label>
                                    <div class="form-icon position-relative">
                                        <input name="details" id="update_details" type="text" class="form-control" placeholder="{{ __('newsletter.details_placeholder')}}">
                                        <div class="invalid-feedback">
                                            {{ __('newsletter.details_error')}}
                                        </div>
                                        <span style="color:red;">
                                            @error('details')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                        <br>
                                    </div>
                                </div>
                            </div><!--end col-->                          
                        </div><!--end row-->                      
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" id="update_btn" name="send" class="btn btn-primary" value="{{ __('common.update')}}">
                            </div>                         
                        </div><!--end row-->                      
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end updated mpdal-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.delete_template_group')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5> {{ __('settings.deleted_data')}}</h5>
                    <input type="hidden" id="delete_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')}}</button>
                    <button type="submit" class="btn btn-primary delete_gkey">{{ __('common.yes')}} </button>
                </div>
            </div>
        </div>
    </div> <!--end delete modal-->


    @push('scripts')
    <script>
        // start jquery
        $(document).ready(function() {
            $("#Search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#Search_Tr tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $(document).ready(function() {
                setTimeout(function() {

                    $("div.alert").remove();
                }, 3000);
            });
            $(document).ready(function() {
                $("#addbutton").on('click', function(e) {
                    e.preventDefault();
                    $("#open_modal").modal('show');
                });
            });
        });

        // start add modal ajax
        $(document).ready(function() {
            $('#submit').on('submit', function(e) {
                e.preventDefault();
                var data = {
                    name: $("#add_group_name").val(),
                    description: $("#add_details").val(),
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('template-group-list.store') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $("#reload_pagination_template").load(location.href + " #reload_pagination_template");
                        $('#addbutton').trigger("reset");
                        $('#open_modal').modal('hide')
                    },
                    error: function(response) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
        });

        // end add modal ajax

        // start edit modal ajax
        $(document).on("click", "#editbutton", function(e) {
            e.preventDefault();
            var id = $(this).val();
            $('#open_modal_edit').modal('show');
            $.ajax({
                url: "template-group-list/" + id + "/edit",
                type: "GET",
                success: function(response) {
                    console.log(response)
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').aapend('<li>' + response.message + '</li>');
                    } else {
                        $('#update_group_name').val(response.group_name);
                        $('#update_details').val(response.description);
                        $('#hidden_id').val(response.id);
                    }
                }
            });
        });
        // end edit modal ajax

        // start update ajax
        $(document).on("click", "#update_btn", function(e) {
            e.preventDefault();
            $('#update_userForm').addClass('was-validated');
            if ($('#update_userForm')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                var id = $("#hidden_id").val();
                // alert(id);
                var data = {
                    name: $('#update_group_name').val(),
                    description: $('#update_details').val(),
                    id: $('#hidden_id').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('template-update') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        // location.reload();
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $('#open_modal_edit').modal('hide');
                        Toaster(response.success);
                    }
                });
            }
        });
        // end update ajax

        // change status in ajax code start
        $('.toggle_class').change(function(e) {
            e.preventDefault();
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
                url: "{{ url('template-status') }}",
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    // location.reload();
                    Toaster(data.success);
                }
            });
        });
        // chenge status in ajax code end  


        $(document).ready(function() {
            $('.del_button').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var id = $('#delete_id').val(id);

                $('#delete_modal').modal('show');
            });

            $(document).on("click", ".delete_gkey", function() {
                var id = $('#delete_id').val();
                $('#delete_modal').modal('hide');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('template-delete') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#template_data_reload").load(location.href + " #template_data_reload");
                        $("#reload_pagination_template").load(location.href + " #reload_pagination_template");
                        $('#delete_modal').modal('hide');
                        Toaster(response.success);

                    }
                });
            });
        });
        // end delete modal ajax
    </script>
    @endpush
</x-app-layout>
