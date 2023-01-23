<style>
    .end_action {
        text-align: end !important;
        padding-right: 50px !important;
    }

    .end_action1 {
        text-align: end !important;
    }
</style>
<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow ">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('newsletter.contact_group') }}</h5>
                                <div>
                                    <button class="btn btn-primary" data-bs-target="#add_contact_modal"
                                        data-bs-toggle="modal"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{
                                        __('newsletter.add_group') }}</button>
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
                                    <div class="col-lg-4" style="margin-top:-20px !important;"><input type="text" id="Search" class="form-control col-lg-3 fas fa-search" placeholder="{{ __('newsletter.search_placeholder')}}" aria-label="Search">
                                    </div>
                                </div>
                            </div>


                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded " id="table_reload">
                                    @if(!empty($contactData) && sizeof($contactData)>0)
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">
                                                    {{ __('common.sl_no') }}</th>
                                                <th class="border-bottom text-end" style="min-width: 118px;">
                                                    {{ __('newsletter.group_name') }}
                                                </th>
                                                {{-- <th class="border-bottom" style="min-width: 150px;">
                                                    {{ __('newsletter.description') }}</th> --}}
                                                <th class="border-bottom text-center" style="min-width: 230px;">
                                                    {{ __('newsletter.No_of_contact') }}</th>
                                                <th class="border-bottom">{{ __('common.status') }}</th>
                                                <th class="text-center border-bottom" style="padding-left:6em;">
                                                    {{ __('common.action') }}
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Start -->

                                            @if (!empty($contactData))
                                            @foreach ($contactData as $key => $contact)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class=" text-end">{{ $contact->group_name }}</td>
                                                {{-- <td class="">{{ $contact->description }}</td> --}}
                                                <td class="ms-4 text-center" style="padding-left: 40px">
                                                    {{ count($contactgroupcount->where('group_id', $contact->id)) }}
                                                </td>

                                </div>
                                <td class="p-3">
                                    <div class="form-check form-switch">
                                        <input data-id="{{ $contact->id }}" class="form-check-input toggle-class"
                                            type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                            $contact->status ? 'checked' : '' }}>
                                    </div>
                                </td>
                                @if (count($contactgroupcount->where('group_id', $contact->id)) == 0)
                                <td class=" end_action1">
                                    <a href="{{ route('contact-list',$contact->id) }}"><button
                                            class="btn btn-primary  table_btn btn-xs btn-icon view_btn "
                                            value="{{ $contact->id }}"><i class="uil uil-eye"></i></button></a>
                                    <button type="button"
                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                        value="{{ $contact->id }}" id="edit_btn" data-toggle="modal"
                                        data-target="#edit_contact_modal">
                                        <i class="uil uil-edit"></i>
                                    </button>
                                    <button type="button" id="delete_btn" value="{{ $contact->id }}"
                                        class="btn btn-danger btn-xs btn-icon del_button"><i
                                            class="uil uil-trash-alt"></i></button>

                                </td>
                                @else
                                <td class="end_action">
                                    <a href="{{ route('contact-list',$contact->id) }}"><button
                                            class="btn btn-primary  table_btn btn-xs btn-icon view_btn "
                                            value="{{ $contact->id }}"><i class="uil uil-eye"></i></button></a>
                                    <button type="button"
                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                        value="{{ $contact->id }}" id="edit_btn" data-toggle="modal"
                                        data-target="#edit_contact_modal">
                                        <i class="uil uil-edit"></i>
                                    </button>


                                </td>
                                @endif
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                                </table>
                                @else
                                    <div class="s-b-n-header my-4" id="website_listing">
                                        <h4 class="text-center">No Record Found !. </h4>
                                    </div>
                                    @endif

                            </div>

                        </div>
                    </div>
                    <!--paginaion open -->
                    <div class="row text-center px-2  mb-4" id="reload_pagination_contact">
                        <div class="col-12 mt-4">
                            <div class="d-md-flex align-items-center text-center justify-content-between">
                                <span class="text-muted me-3">Showing {{ $contactData->currentPage() }} -
                                    {{ $contactData->lastItem() }} out of {{ $contactData->total() }}</span>
                                <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                    {{ $contactData->links() }}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--paginaion close -->
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
    <!--end row-->

    <!--start add modal-->
    <div class="modal fade" id="add_contact_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="    true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.add_contact') }}
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-1">
                                <label class="form-label">{{ __('newsletter.group_name') }}
                                    <span class="text-danger">*
                                    </span>
                                </label>
                                <div class="form-icon position-relative">
                                    <input name="group_name" id="group_name" type="text" class="form-control"
                                        placeholder="{{ __('newsletter.group_name_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        {{ __('newsletter.group_name_error') }}
                                    </div>
                                    <span style="color:red;">
                                        @error('group_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                    <br>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">{{ __('newsletter.details') }}
                                    <span class="text-danger">
                                    </span>
                                </label>
                                <div class="form-icon position-relative">
                                    <input name="details" id="details" type="text" class="form-control"
                                        placeholder="{{ __('newsletter.details_placeholder') }}">
                                    <div class="invalid-feedback">
                                        {{ __('newsletter.details_error') }}
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
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" name="send" class="btn btn-primary contact_submit" value="Submit">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end add modal-->

    <!--start edit modal-->
    <div class="modal fade" id="edit_contact_modal" tabindex="-1" aria-labelledby="  exampleModalLabel"
        aria-hidden="    true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.update_contact') }} group_name
                    </h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" value=""
                        id="close-modal">
                        <i class="uil uil-times fs-4 text-dark">
                        </i>
                    </button>
                </div>
                <div class="modal-body ">
                    <form class="needs-validation" novalidate>
                        <input name="input_field" id="input_field" type="hidden" class="form-control ps-5"
                            placeholder="">
                        <div class="row">
                            <div class="mb-1">
                                <label class="form-label">{{ __('newsletter.group_name') }}
                                    <span class="text-danger">*
                                    </span>
                                </label>
                                <div class="form-icon position-relative">
                                    <input name="group_name" id="update_group_name" type="text" class="form-control"
                                        placeholder="{{ __('newsletter.group_name_placeholder') }}" required>
                                    <div class="invalid-feedback">
                                        {{ __('newsletter.group_name_error') }}
                                    </div>
                                    <span style="color:red;">
                                        @error('group_name')
                                        {{ $message }}
                                        @enderror
                                    </span>
                                    <br>
                                </div>
                            </div>
                            <div class="mb-1">
                                <label class="form-label">{{ __('newsletter.details') }}
                                    <span class="text-danger">
                                    </span>
                                </label>
                                <div class="form-icon position-relative">
                                    <input name="details" id="update_details" type="text" class="form-control"
                                        placeholder="{{ __('newsletter.details_placeholder') }}">
                                    <div class="invalid-feedback">
                                        {{ __('newsletter.details_error') }}
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
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12" required>
                                <input type="submit" name="send" id="contact_update" class="btn btn-primary "
                                    value="Update">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end edit modal-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('newsletter.contact_group') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5> {{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_contact_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                        }}</button>
                    <button type="submit" class="btn btn-primary contact_delete">{{ __('common.yes') }} </button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    <!-- campaign view modal -->
    <!-- Edit MOdal start -->
    <div class="modal fade" id="campaign_view_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('campaign.view_campaign') }}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body ">
                    <div class="row text-center" id="table_view">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit modal end -->
    <!-- end campaign view modal  -->
    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
                $("#Search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#Search_Tr tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
    </script>

    {{-- <script>
        // Edit ajax start
    $(document).on("click", "#campaign_view", function () {
            var contact_group_id = $(this).val();
            alert(contact_group_id);
            // $('#campaign_view_modal').modal('show');
             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });
           $.ajax({
                url: "{{url('get-contact-id')}}/"+contact_group_id+"/GetContact",
    type:'GET',
    data:{contact_group_id:contact_group_id},
    success:function(response){
    console.log(response);

    }
    });
    });
    // Edit ajax end
    </script> --}}

    <script>
        $(document).ready(function() {
                $('.contact_submit').on('submit', function(e) {

                    e.preventDefault();

                    var data = {
                        group_name: $("#group_name").val(),
                        details: $("#details").val(),
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('contact-group-list.store') }}",
                        data: data,
                        dataType: "json",

                        success: function(response) {
                            $("#reload_pagination_contact").load(location.href +
                                " #reload_pagination_contact");
                            Toaster(response.success);
                            setTimeout(function() {
                                location.reload(true);
                            }, 3000);


                        }
                    });
                });
            });


            $(document).on("click", "#edit_btn", function(e) {
                e.preventDefault();

                var group_id = $(this).val();
                $('#edit_contact_modal').modal('show');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "contact-group-list/" + group_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);

                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass("alert alert-danger");
                            $('#errorlist').aapend('<li>' + response.message + '</li>');
                        } else {
                            $('#update_group_name').val(response.contactGroup.group_name);
                            $('#update_details').val(response.contactGroup.description);
                            $('#input_field').val(response.contactGroup.id);
                        }
                    }
                });
            });

            // end edit modal ajax
    </script>

    <script>
        // update ajax start
            $("#contact_update").on("click", function(e) {
                e.preventDefault();
                var data = {
                    group_name: $("#update_group_name").val(),
                    details: $("#update_details").val(),
                    contact_id: $('#input_field').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('contactGroupUpdate') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $("#table_reload").load(location.href + " #table_reload");
                        $('#edit_contact_modal').modal('hide');
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });



                    }
                });
            });
            // update ajax end
    </script>

    <script type="text/javascript">
        //  toggle ajax start
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let contact_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('changeContactGroupStatus') }}",
                    data: {
                        'status': status,
                        'contact_id': contact_id
                    },
                    success: function(data) {
                        Toaster('Contact Group Status Changed Successfully')
                    }
                });
            });
            //  toggle ajax end
    </script>

    <!-- start delete ajax-->
    <script>
        $(document).ready(function() {

                $(document).on("click", "#delete_btn", function() {
                    var group_id = $(this).val();



                    $('#delete_contact_id').val(group_id);
                    $('#delete_contact_modal').modal('show');
                });
                $(document).on('click', '.contact_delete', function() {
                    var group_id = $('#delete_contact_id').val();

                    $('#delete_contact_modal').modal('hide');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('deleteContactGroup') }}/" + group_id,
                        data: {
                            group_id: group_id,

                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            $('#delete_contact_modal').modal('hide');
                            $("#table_reload").load(location.href + " #table_reload");
                            $("#reload_pagination_contact").load(location.href +
                                " #reload_pagination_contact");
                            $("#website_table1").load(location.href + " #website_table1");
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