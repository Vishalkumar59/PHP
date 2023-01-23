<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('campaign.campaign_list') }}</h5>
                                <div>
                                    <button class="btn btn-md btn-primary" id="add_modal"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{ __('campaign.add_campaign') }}</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" id="department">
                                @if(!empty($Campaign_list) && sizeof($Campaign_list)>0)
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.campaign_name') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.campaign_subject') }}</th>
                                            {{-- <th class="border-bottom p-3">{{ __('campaign.template') }}</th> --}}
                                            {{-- <th class="border-bottom p-3">{{ __('campaign.smtp') }}</th> --}}
                                            <th class="border-bottom p-3">{{ __('campaign.campaign_group') }}</th>
                                            <th class=" border-bottom p-3">{{ __('common.status') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if(!empty($Campaign_list))
                                        @foreach($Campaign_list as $key=>$campaign)
                                        {{-- @dd($campaign->GroupList->group_name); --}}
                                        <tr>
                                            <td class="p-3">{{$key+1}}</td>
                                            <td class="p-3">{{$campaign->campaign_name}}</td>
                                            <td class="p-3">{{$campaign->campaign_subject}}</td>
                                            {{-- <td class="p-3">@if(!empty($campaign->template->subject)){{$campaign->template->subject}}@endif</td> --}}
                                            {{-- <td class="p-3">@if(!empty($campaign->SMTPServer->driver)){{$campaign->SMTPServer->driver}}@endif</td> --}}
                                            <td class="p-3">@if(!empty($campaign->GroupList->group_name)){{$campaign->GroupList->group_name}}@endif</td>

                                            <td class="p-3">
                                                <div class="form-check form-switch">
                                                    <input data-id="{{$campaign->id}}"
                                                        class="form-check-input toggle-class" type="checkbox"
                                                        data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                        $campaign->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td class="text-center d-flex justify-content-center p-3">

                                                <button class="btn btn-primary  table_btn btn-xs btn-icon view_btn "
                                                    id="campaign_view" value="{{$campaign->id}}" data-toggle="modal"
                                                    data-target="#campaign_view_modal"><i class="uil uil-eye"></i></button>

                                                {{-- <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn "
                                                    id="editmodal" value="{{$campaign->id}}" data-toggle="modal"
                                                    data-target="#designation_edit"><i class="uil uil-edit"></i></button> --}}
                                                    <a href="{{ route('campaign.edit', $campaign->id) }}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>

                                                <button type="button" id="delete_btn" value="{{$campaign->id}}"
                                                    class="btn btn-danger btn-xs btn-icon"><i
                                                        class="uil uil-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody><!-- End -->
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
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end container-->

    <!-- Add MOdal start -->
    <div class="modal fade" id="designation_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('campaign.add_campaign') }}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body ">
                    <form id="add_userForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('campaign.campaign_name') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="{{ __('campaign.campaign_name_placeholder') }}" required>
                                        <span style="color:red;">
                                            @error('designation_name')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{ __('campaign.campaign_name_error') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('campaign.campaign_subject') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="subject" id="subject" type="text" class="form-control"
                                            placeholder="{{ __('campaign.campaign_subject_placeholder') }}" required>
                                        <span style="color:red;">
                                            @error('designation_name')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{ __('campaign.campaign_subject_error') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('campaign.template')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" name="campaign_template"
                                            id="campaign_template" aria-label="Default select example"required >
                                            <option selected disabled value="">
                                                {{__('campaign.select_template')}}
                                            </option>
                                            @foreach($template_list as $template)
                                            <option value="{{$template->id}}">
                                                {{$template->subject}}
                                            </option>
                                            @endforeach

                                        </select>
                                        <span style="color:red;">
                                            @error('stutas')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{__('campaign.template_error')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('campaign.smtp_server')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" name="smtp_server" id="smtp_server"
                                            aria-label="Default select example" required>
                                            <option selected disabled value="">
                                                {{__('campaign.smtp_error')}}
                                            </option>
                                            @foreach($server_mail as $smtp_server)
                                            <option value="{{$smtp_server->id}}">
                                                {{$smtp_server->driver}}
                                            </option>
                                            @endforeach

                                        </select>
                                        <span style="color:red;">
                                            @error('stutas')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{__('campaign.smtp_error')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{__('campaign.campaign_group')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control group" multiple name="group[]" id="group"
                                        required>
                                            {{-- <option selected disabled value="">
                                                {{__('campaign.select_group')}}
                                            </option> --}}
                                            @foreach($contactgroup as $group)
                                            <option value="{{$group->id}}">
                                                {{$group->group_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                        <span style="color:red;">
                                            @error('stutas')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{__('campaign.group_error')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-icon position-relative">
                                            <label class="form-label">{{__('campaign.description')}}<span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" id="description"
                                                placeholder="{{ __('campaign.enter_description') }}" class="form-control"
                                                cols="82" rows="3" required></textarea>
                                            <span style="color:red;">
                                                @error('stutas')
                                                {{$message}}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                                {{__('campaign.description_error')}}
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <div class="form-icon position-relative">
                                        <label class="form-label">{{__('campaign.description')}}<span
                                                class="text-danger">*</span></label>
                                        <textarea name="description" id="description"
                                            placeholder="{{ __('campaign.enter_description') }}" class="form-control"
                                            cols="82" rows="3" required></textarea>
                                        <span style="color:red;">
                                            @error('stutas')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            {{__('campaign.description_error')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" id="add_submit_btn" name="send" class="btn btn-primary"
                                    value=" {{ __('common.submit') }}">
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- add modal end -->







  



    <!-- campaign view modal -->
    
    <!-- end campaign view modal  -->

   

@push('scripts')
   <!-- Edit MOdal start -->
   <div class="modal fade" id="designation_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom p-3">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('campaign.update_campaign') }}</h5>
                <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                        class="uil uil-times fs-4 text-dark"></i></button>
            </div>
            <div class="modal-body ">
                <form id="update_userForm" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="campaign_hidden_id" id="campaign_hidden_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('campaign.campaign_name') }}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input name="edit_name" id="edit_name" type="text" class="form-control"
                                        placeholder="{{ __('campaign.campaign_name_placeholder') }}" required>
                                    <span style="color:red;">
                                        @error('designation_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('campaign.campaign_name_error') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('campaign.campaign_subject') }}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <input name="edit_subject" id="edit_subject" type="text" class="form-control"
                                        placeholder="{{ __('campaign.campaign_subject_placeholder') }}" required>
                                    <span style="color:red;">
                                        @error('designation_name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ __('campaign.campaign_subject_error') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{__('campaign.template')}}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="edit_template"
                                        id="edit_template" aria-label="Default select example" required>
                                        <option selected disabled value="">
                                            {{__('campaign.select_template')}}
                                        </option>
                                        @foreach($template_list as $template)
                                        @if(!empty($template->subject))
                                        <option value="{{$template->id}}">
                                            {{$template->subject}}
                                        </option>
                                        @endif
                                        @endforeach

                                    </select>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('campaign.template_error')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{__('campaign.smtp_server')}}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="edit_smtp_server" id="edit_smtp_server"
                                        aria-label="Default select example" required>
                                        <option selected disabled value="">
                                            {{__('campaign.smtp_error')}}
                                        </option>
                                        @foreach($server_mail as $smtp_server)
                                        @if(!empty($smtp_server->driver))
                                        <option value="{{$smtp_server->id}}">
                                            {{$smtp_server->driver}}
                                        </option>
                                        @endif
                                        @endforeach

                                    </select>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('campaign.smtp_error')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{__('campaign.campaign_group')}}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control group edit_group" multiple="" name="edit_group[]" id="edit_group"
                                        aria-label="Default select example"required >
                                       
                                        @foreach($contactgroup as $group)
                                        {{-- @php
                                        $selected = '';
                                        foreach($adminrolelist as $adminrole){
                                            if($adminrole->section_id == $adminsection->id){
                                                $selected ='selected';
                                            }
                                        }

                                        @endphp --}}


                                        <option value="{{$group->id}}">
                                            {{$group->group_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('campaign.group_error')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <div class="form-icon position-relative">
                                    <label class="form-label">{{__('campaign.description')}}<span
                                            class="text-danger">*</span></label>
                                    <textarea name="edit_description" id="edit_description"
                                        placeholder="{{ __('campaign.enter_description') }}" class="form-control"
                                        cols="82" rows="3"required ></textarea>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('campaign.description_error')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" id="update_btn" class="btn btn-primary"
                                    value="{{__('common.update')}}">
                            </div>
                        </div>
                        <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit modal end -->
  

 <!-- Edit MOdal start -->
 <div class="modal fade" id="campaign_view_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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





     <!--start delete modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">{{ __('campaign.delete_campaign') }}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
             </div>
             <div class="modal-body">
                 <h5>{{ __('user-manager.are_you_sure') }}</h5>
                 <input type="hidden" id="delete_designation_id" name="input_field_id">
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                     }}</button>
                 <button type="submit" class="btn btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
             </div>
         </div>
     </div>
 </div>
 <!--end delete modal-->

  <!-- start delete ajax-->
  <script>
    $(document).ready(function () {

        $(document).on("click", "#delete_btn", function () {
            var campaign_id = $(this).val();
            $('#delete_designation_id').val(campaign_id);
            $('#delete_modal').modal('show');
        });
        $(document).on('click', '.delete_submit_btn', function () {
            var campaign_id = $('#delete_designation_id').val();

            $('#delete_modal').modal('show');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{url('campaign')}}/"+campaign_id,
                data: {
                    campaign_id: campaign_id,
                    _method : "DELETE"
                },
                dataType: "json",
                success: function (response) {
                    Toaster(response.success);
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




    <script>
        // modal add in ajax
         $(document).ready(function () {
            $("#add_modal").on('click', function (e) {
                e.preventDefault();
                $("#designation_add").modal('show');
                $('#group').select2({
                    dropdownParent: $('#designation_add'),
                    width:'370px'
                });
            });

            $('#close-modal').on('click', function (e) {
                e.preventDefault();
                $("#designation_add").modal('hide');
            });

            $('#add_submit_btn').on('click', function () {
                $("#group :selected").each(function() {
                     var group_list = (this.value);
                  }); 
                var data = {
                    name: $("#name").val(),
                    subject: $("#subject").val(),
                    template: $("#campaign_template").val(),
                    smtp_server: $("#smtp_server").val(),
                    group : group_list,
                    description: $("#description").val(),

                };
                console.log(group);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('campaign.store')}}",
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
            var campaign_edit_id = $(this).val();
            $('#designation_edit').modal('show');
            $('#edit_group').select2({
                    dropdownParent: $('#designation_edit'),
                    width:'380px'
                });

            $.ajax({
                url: "campaign/" + campaign_edit_id + "/edit",
                type: "GET",
                success: function (response) {
                        // console.log(response);
                    if (response.status == 400) {
                        $('#errorlist').html("");
                        $('#errorlist').addClass("alert alert-danger");
                        $('#errorlist').append('<li>' + response.message + '</li>');

                    }
                    else {
                        var arrayArea = response.edit_campaign.group_ids.split(',');
                        console.log(response.edit_campaign.group_ids);
                        // $('#edit_group').val(arrayArea);
                        $(function(){
                                $("#edit_group").select2().val([7,9,10]).trigger('change.select2');
                        });

                        // $('#edit_name').val(response.edit_campaign.campaign_name);
                        // $('#edit_subject').val(response.edit_campaign.campaign_subject);
                        // $('#edit_template').val(response.edit_campaign.template_id);
                        // $('#edit_smtp_server').val(response.edit_campaign.smtp_server_id);
                        // $('#edit_group').val(response.edit_campaign.group_ids);
                        // $(".edit_group").select2("val", ["7", "8","9"]);
                        // $('#edit_group').select2('val',response.edit_campaign.group_ids);
                        



                        // $('#edit_description').val(response.edit_campaign.description);
                        // $('#campaign_hidden_id').val(response.edit_campaign.id);
                    }
                }
            });
        });


         // Edit ajax start
        $(document).on("click", "#campaign_view", function (e) {
            e.preventDefault();
            var campaign_view_id = $(this).val();
            $('#campaign_view_modal').modal('show');
             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });
           $.ajax({
                type:'POST',
                url: "{{route('campaign-view')}}",
                data:{campaign_view_id:campaign_view_id},
                success:function(response){
                    console.log(response);
                    var html = ``;
                    html += `<table class="table"><tr><th>Name :</th><td>${response.view_campaign.campaign_name }</td></tr><tr><tr><th>Subject :</th><td>${response.view_campaign.campaign_subject }</td></tr><tr><tr><th>Template :</th><td>${response.templateName[0] == null ? '' : response.templateName[0].subject }</td></tr><tr><tr><th>SMTP Server :</th><td>${response.GetServerName[0].driver }</td></tr><tr><tr><th>Group :</th><td>${response.GetGroupName[0] }</td></tr><tr><tr><th>Description :</th><td>${response.view_campaign.description }</td></tr><tr><tr><th>Status :</th><td>${ (response.view_campaign.status == 1) ? "<p class='text-success'>active</p>" : "<p class='text-danger'>inactive</p>" }</td></tr><tr></table>`; 
                  $("#table_view").html(html);
                  $("#campaign_view_modal").modal('show');
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
                        edit_name: $("#edit_name").val(),
                        edit_subject: $("#edit_subject").val(),
                        edit_template: $("#edit_template").val(),
                        edit_smtp_server: $("#edit_smtp_server").val(),
                        edit_group: $("#edit_group").val(),
                        edit_description: $("#edit_description").val(),
                        campaign_hidden_id: $("#campaign_hidden_id").val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{route('campaign-update')}}",
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
            let campaign_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('campaign-status')}}",
                data: { 'status': status, 'campaign_id': campaign_id },
                success: function (data) {
                    Toaster(data.success);
                }
            });
        });


    </script>

  
    @endpush
</x-app-layout>