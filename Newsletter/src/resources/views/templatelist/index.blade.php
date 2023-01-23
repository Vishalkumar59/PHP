<x-app-layout>
    <style>
        .form-check .form-check-input {
            float: inherit;
        }

        .form-check {
            margin-right: 150px;
        }
    </style>
 
    {{ session()->put('temlategroup',$templategroup->id)}}
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-2 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{$templategroup->group_name}}</h5>
                                <a href="{{ route('template-list.create') }}">
                                <button class="btn btn-primary" id="addbu"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('newsletter.add_template_list')}}</button>
                                </a>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                     <div class="col-sm-0">
                                        <!--<select class="form-select" aria-label="Default select example">
                                            <option>10</option>
                                            <option>20</option>
                                            <option>30</option>
                                            <option>40</option>
                                            <option>50</option>
                                        </select> -->
                                    </div>
                                    <div class="col-lg-4 float-end"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="{{ __('newsletter.search_placeholder')}}" aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    @if(!empty($TemplateToGroup) && sizeof($TemplateToGroup)>0)
                                    <table class="table table-center bg-white mb-0" id="template_list_data_reload">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom ps-3 col-sm-1">{{ __('common.sl_no')}}</th>
                                                <th class=" border-bottom text-center col-sm-7">{{ __('newsletter.subject')}}</th>
                                                <th class=" border-bottom text-center col-sm-2">{{ __('common.status')}}</th>
                                                <th class="text-center border-bottom col-sm-2">{{ __('common.action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="Search_Tr">
                                            <!-- Start -->
                                            @if (!empty($TemplateToGroup))
                                           
                                            @foreach ($TemplateToGroup as $key => $templategroup)
                                            <tr>
                                                <td class="ps-4">{{ $key + 1 }}</td>
                                                <td class="text-center">{{ $templategroup->templatecontent->subject ?? '' }}</td>
                                                <td>
                                                    <div class="form-check form-switch mx-auto pl-0 ps-5">
                                                        <input id="loader" data-id="{{ $templategroup->id }}" class="form-check-input mx-auto toggle_class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $templategroup->status ? 'checked' : '' }}>
                                                    </div>
                                                </td>
                                                <td class="p-3 d-flex justify-content-center">
                                                <a href="{{ route('template-list.edit', $templategroup->id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>
                                                    <button href="javascript:void(0)" id="delete_btn" data-id="{{ $templategroup->id }}" data-toggle="modal" data-target="#delete_modal" class="btn btn-danger btn-xs btn-icon del_button"><i class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    @else
                                    <div class="s-b-n header">
                                        <h4 class="text-center"> No Record Found !.</h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--paginaion open -->
                    <div class="row text-center px-2  mb-4" id="reload_pagination_template_list">
                        <div class="col-12 mt-4">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{$template_list->currentPage();}} -
                                    {{$template_list->lastItem();}} out of {{$template_list->total()}}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $template_list->links() }}
                                </ul>
                            </div>
                        </div>
                    </div><!--paginaion close -->                 
                </div>
            </div><!--end col-->        
        </div>
    </div><!--end row-->

    <!--start add modal-->
    <div class="modal fade" id="open_modal" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="    true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel"> {{ __('newsletter.add_template_list')}}
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>

            </div>
        </div>
    </div><!--end add modal-->
    
    <!-- start edit modal-->
    <div class="modal fade" id="open_modal_edit" tabindex="-1" aria-labelledby="  exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.update_template_list')}} </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>

            </div>
        </div>
    </div> <!-- end updated mpdal-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.delete_template_list')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>  {{ __('settings.deleted_data')}}</h5>
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
                url: "{{ url('template-list-status') }}",
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    // $("#template_list_data_reload").load(location.href + " #template_list_data_reload");
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
                    url: "{{ url('template-list-delete') }}",
                    data: {
                        id: id,
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        $("#template_list_data_reload").load(location.href + " #template_list_data_reload");
                        $("#reload_pagination_template_list").load(location.href + " #reload_pagination_template_list");
                        $('#delete_modal').modal('hide');
                        Toaster('Template Deleted Successfully!');
                        try {
                            ClassicEditor.delete(document.querySelector('.del_button'))
                                .catch(error => {
                                    console.error(error);
                                });
                        } catch (err) {

                        }
                    },
                });
            });
        });
        // end delete modal ajax
    </script>
    @endpush
</x-app-layout>
