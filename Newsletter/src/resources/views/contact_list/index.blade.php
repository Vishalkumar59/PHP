<style>
    .select2-selection {
        height: 39px !important;
    }

    #select2-country-container {
        line-height: 36px !important;
    }
</style>
<x-app-layout>
    {{ session()->put('contactgroup',$contactData->id)}}
    <div class="container-fluid">
        <div class="layout-specing">

            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center ">
                                <h5 class="tx-uppercase tx-semibold mg-b-0 d-inline">{{$contactData->group_name}}
                                </h5>
                                {{-- this is the dropdown group list --}}

                                {{-- <div class="d-inline m-auto me-2 group_dropdown" id="group_dropdown">
                                    <select class="form-select d-inline check_select_box" style="width: 150px; "
                                        name="edit_template" id="edit_template" aria-label="Default select example">
                                        <option selected disabled value="">Select Group</option>
                                        @foreach($contact_group as $group)
                                        <option value="{{$group->id}}" {{$contactData->id == $group->id ? "selected" :
                                            '' }}>{{$group->group_name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" name="send" id="clicktomove" class="btn btn-secondary my-4 "
                                        value="Copy">
                                </div> --}}


                                <div class="d-inline m-auto me-2">
                                    <button class="btn btn-primary d-inline" data-bs-target="#add_contact_modal"
                                        data-bs-toggle="modal"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{__('newsletter.add_contact')}}</button>

                                    <a href="{{route('importcreate')}}" class="ms-3">
                                        <button class="btn btn-danger" id="addbu">Import</button>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="p-4 mt-3">
                                <div class="table-responsive">
                                    @if(!empty($contact_to_group) && sizeof($contact_to_group)>0)
                                    <table class="table table-center bg-white mb-0 dataTableShow">
                                        <thead>
                                            <tr>

                                                <th class="border-bottom col-sm-1">
                                                    {{-- <input class="form-check-input group_check border-dark me-3"
                                                        onclick="toggle(this);" class="checkbox" type="checkbox"> --}}
                                                    {{__('common.sl_no')}}</th>
                                                <th class="border-bottom text-center col-sm-4">
                                                    {{__('newsletter.contact_name')}}</th>
                                                <th class="border-bottom text-center col-sm-4">
                                                    {{__('newsletter.contact_email')}}
                                                </th>
                                                <th class="border-bottom text-center col-sm-1">
                                                    {{__('common.status')}}</th>
                                                <th class="text-center border-bottom col-sm-2">
                                                    {{__('common.action')}}
                                                </th>
                                            </tr>
                                        </thead>

                                        @if(!empty($contact_to_group))
                                        @foreach($contact_to_group as $key=>$contact)
                                       
                                        <tbody id="Search_Tr">
                                            <tr>
                                                <td class="text-center">
                                                    {{-- <input
                                                        class="form-check-input group_check checkbox border-dark me-3"
                                                        value="{{$contact->id}}" id="checkboxname" name=checkname[]
                                                        type="checkbox"> --}}
                                                    {{ $key+1 }}
                                                </td>
                                                <td class="text-center">{{$contact->ContactList->contact_name}}</td>
                                                <td class="text-center">{{$contact->ContactList->contact_email}}</td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch">
                                                        <input id="loader" data-id="{{$contact->id}}"
                                                            class="form-check-input toggle-class" type="checkbox"
                                                            data-toggle="toggle" data-on="Yes" data-off="No" {{
                                                            $contact->status  ? 'checked' : '' }}>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <button type="button"
                                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                                        value="{{$contact->id}}" id="edit_btn" data-toggle="modal"
                                                        data-target="#edit_contact_modal">
                                                        <i class="uil uil-edit"></i>
                                                    </button>

                                                    <button type="button" id="delete_btn" data-id="{{$contact->id }}"
                                                        data-toggle="modal" data-target="#delete_modal"
                                                        class="btn btn-danger btn-xs btn-icon"><i
                                                            class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                        @endif
                                    </table>
                                    @else
                                    <div class="s-b-n-header my-4" id="website_listing">
                                        <h4 class="text-center">No Record Found !. </h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
    <!--end row-->


    <!-- Add Contact List Start -->
    <div class="modal fade" id="add_contact_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('newsletter.add_contact_list')}}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="add_contact_list_form" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_name')}}<span class="text-danger">*
                                    </span></label>
                                <input type="text" class="form-control" id="name"
                                    placeholder="{{__('newsletter.contact_name_placeholder')}}" name="name">
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_name_error')}}
                                </div>
                                <span style="color:red;">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_email')}}<span class="text-danger">*
                                    </span></label>
                                <input type="email" class="form-control" id="email"
                                    placeholder="{{__('newsletter.contact_email_placeholder')}}" name="email" required>
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_email_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_group')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="contact_group" id="contact_group"
                                        aria-label="Default select example" required>
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>
                                        @foreach($contact_group as $group)
                                        <option value="{{$group->id}}" {{$contactData->id == $group->id ? "selected" :
                                            '' }}>{{$group->group_name}}</option>
                                        @endforeach

                                    </select>
                                    <span style="color:red;">
                                        @error('country')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.contact_group_error')}}
                                    </div>
                                </div>
                            </div>




                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.company')}}</label>
                                <input type="text" class="form-control" id="company"
                                    placeholder="{{__('newsletter.company_name_placeholder')}}" name="company">
                                <div class="invalid-feedback">
                                    {{__('newsletter.company_name_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('company')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>


                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.website')}}</label>
                                <input type="text" class="form-control" id="website"
                                    placeholder="{{__('newsletter.website_name_placeholder')}}" name="website">
                                <div class="invalid-feedback">
                                    {{__('newsletter.website_name_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('website')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.country')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="country" id="country"
                                        aria-label="Default select example">
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>
                                        @foreach($country_name as $country)
                                        <option value="{{$country->countries_iso_code_3}}">
                                            {{$country->countries_name}}
                                        </option>
                                        @endforeach

                                    </select>
                                    <span style="color:red;">
                                        @error('country')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.country_code_error')}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.phone')}}</label>
                                <input type="text" class="form-control" id="phone"
                                    placeholder="{{__('newsletter.phone_placeholder')}}" name="phone">
                                <div class="invalid-feedback">
                                    {{__('newsletter.phone_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('phone')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-icon position-relative">
                                    <label class="form-label">{{__('newsletter.address')}}<span
                                            class="text-danger"></span></label>
                                    <textarea name="address" id="address"
                                        placeholder="{{__('newsletter.address_placeholder')}}" class="form-control"
                                        cols="82" rows="3"></textarea>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.address_error')}}
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 ">
                            <input type="submit" name="send" class="btn btn-primary my-4 " value="Submit">
                        </div>
                    </form>
                    <!--end form-->
                </div>
            </div>
        </div>
    </div>
    <!-- Add Contact List End-->


    <!-- Edit Contact List Start -->
    <div class="modal fade" id="edit_contact_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('newsletter.update_contact_list')}}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body">
                    <form name="form" id="edit_contact_list_form" class="needs-validation" novalidate>
                        <input type="hidden" name="hidden_id" id="hidden_id">
                        <div class="row g-3">
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_name')}}<span class="text-danger">*
                                    </span></label>
                                <input type="text" class="form-control" id="update_name"
                                    placeholder="{{__('newsletter.contact_name_placeholder')}}" name="name">
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_name_error')}}
                                </div>
                                <span style="color:red;">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_email')}}<span class="text-danger">*
                                    </span></label>
                                <input type="email" class="form-control" id="update_email"
                                    placeholder="{{__('newsletter.contact_email_placeholder')}}" name="email" required>
                                <div class="invalid-feedback">
                                    {{__('newsletter.contact_email_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.contact_group')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="edit_contact_group" id="edit_contact_group"
                                        aria-label="Default select example" required>
                                        <option selected disabled value="">
                                            {{__('sender-list.select_country_name')}}
                                        </option>
                                        @foreach($contact_group as $group)
                                        <option value="{{$group->id}}" {{$contactData->id == $group->id ? "selected" :
                                            '' }}>{{$group->group_name}}</option>
                                        @endforeach

                                    </select>
                                    <span style="color:red;">
                                        @error('country')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.contact_group_error')}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.company')}}</label>
                                <input type="text" class="form-control" id="update_company"
                                    placeholder="{{__('newsletter.company_name_placeholder')}}" name="company">
                                <div class="invalid-feedback">
                                    {{__('newsletter.company_name_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('company')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>


                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.website')}}</label>
                                <input type="text" class="form-control" id="update_website"
                                    placeholder="{{__('newsletter.website_name_placeholder')}}" name="website">
                                <div class="invalid-feedback">
                                    {{__('newsletter.website_name_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('website')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.country')}}</label>
                                <div class="form-icon position-relative">
                                    <select class="form-select form-control" name="country" id="update_country"
                                        aria-label="Default select example">
                                        @foreach($country_name as $country)
                                        <option value="{{$country->countries_iso_code_3}}">
                                            {{$country->countries_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;">
                                        @error('country')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.country_code_error')}}
                                    </div>
                                </div>
                            </div>




                            {{-- <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.country')}}</label>
                                <input type="text" class="form-control" id="update_country"
                                    placeholder="{{__('newsletter.country_code_placeholder')}}" name="country">
                                <div class="invalid-feedback">
                                    {{__('newsletter.country_code_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('country')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div> --}}

                            <div class="col-lg-6 col-sm-12">
                                <label class="form-label">{{__('newsletter.phone')}}</label>
                                <input type="text" class="form-control" id="update_phone"
                                    placeholder="{{__('newsletter.phone_placeholder')}}" name="phone">
                                <div class="invalid-feedback">
                                    {{__('newsletter.phone_error')}}
                                </div>

                                <span style="color:red;">
                                    @error('phone')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-icon position-relative">
                                    <label class="form-label">{{__('newsletter.address')}}<span
                                            class="text-danger"></span></label>
                                    <textarea name="address" id="update_address"
                                        placeholder="{{__('newsletter.address_placeholder')}}" class="form-control"
                                        cols="82" rows="3"></textarea>
                                    <span style="color:red;">
                                        @error('stutas')
                                        {{$message}}
                                        @enderror
                                    </span>
                                    <div class="invalid-feedback">
                                        {{__('newsletter.address_error')}}
                                    </div>

                                </div>
                        </div>



                        </div>

                        <div class="col-lg-2 col-sm-12 ">
                            <input type="submit" name="send" class="btn btn-primary my-4 " value="Submit">
                        </div>
                    </form>
                    <!--end form-->
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Contact List End-->

    <!--strat delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('newsletter.contact_list')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{__('common.delete_confirmation')}}</h5>
                    <input type="hidden" id="delete_contact_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{
                        __('common.no')}}</button>
                    <button type="submit" class="btn btn-primary contact_delete">{{ __('common.yes')}} </button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->

    @push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        // $('#country').select2({
        //     dropdownParent: $('#add_contact_modal'),
        //     width : '100%',
        //     height : '20px'
        // });
        // $('#update_country').select2({
        //     dropdownParent: $('#edit_contact_modal'),
        //     width : '100%',
        //     height : '20px'
        // });
    </script>


    <script>
        function toggle(source) {
    var checkboxes = document.querySelectorAll('.checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }
}
    </script>

    <script>
        $(document).on("click", "#clicktomove", function(e) {
            e.preventDefault();
                var group_id = $("#edit_template").val();
                if ($(".group_check").is(':checked')) {
                var contact_id = [];
                    $('input[name="checkname[]"]').each(function () {
                        if(this.checked) contact_id.push($(this).val())
                    });  
                }else{
                    toastr.error("Please Select Checkbox.");
                }
                   
                const url = "{{route('checkgroupbox')}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            $.ajax({
                url:url,
                type: "GET",
                data: {
                    group_id: group_id,
                    contact_id : contact_id,
                },
                dataType: "json",
                success: function(result) {
                    console.log(result);
                    if(result.success){
                        Toaster(result.success);
                        setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                    }else{
                        toastr.error(result.error);
                        setTimeout(function() {
                        location.reload(true);
                    }, 3000);
                    }
                   

                }

            });
     });
    
   
    </script>

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

    <script>
        //add contact list modal ajax start
        $(document).on("submit", "#add_contact_list_form", function(e) {
            e.preventDefault();

            // alert('hello');
            var data = {
                name: $("#name").val(),
                email: $("#email").val(),
                company: $("#company").val(),
                website: $("#website").val(),
                country: $("#country").val(),
                phone: $("#phone").val(),
                address: $("#address").val(),
                contact_group : $('#contact_group').val(),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('add-contact.store')}}",
                data: data,
                dataType: "json",

                success: function(response) {
                    console.log(response);
                    $("#reload_pagination_contact_list").load(location.href + " #reload_pagination_contact_list");
                    Toaster(response.success);
                    setTimeout(function() {
                        window.location.href = response.contact_to_group.group_id;
                    }, 2000);
                    $('#add_contact_modal').modal('hide');
                }
            });
        });
        //add contact list modal ajax start


        //edit modal ajax code
        $(document).on("click", "#edit_btn", function(e) {
            e.preventDefault();
            var contact_id = $(this).val();

            // alert(source_id);
            $('#edit_contact_modal').modal('show');
            $.ajax({
                url: "{{url('add-contact')}}"+'/' + contact_id + "/edit",
                type: "GET",
                success: function(response) {
                    $('#update_name').val(response.contact.contact_name);
                    $('#update_email').val(response.contact.contact_email);
                    $('#update_company').val(response.contact.company);
                    $('#update_website').val(response.contact.website);
                    $('#update_country').val(response.contact.country_code);
                    $('#update_phone').val(response.contact.phone);
                    $('#update_address').val(response.contact.address);
                    $('#hidden_id').val(response.contact.id);


                }
            });

        });
        // edit ajax code end

        //update ajax code start
        $(document).on("submit", "#edit_contact_list_form", function(e) {
            e.preventDefault();

            var data = {
                name: $("#update_name").val(),
                email: $("#update_email").val(),
                company: $("#update_company").val(),
                website: $("#update_website").val(),
                country: $("#update_country").val(),
                phone: $("#update_phone").val(),
                address: $("#update_address").val(),
                contact_group : $('#edit_contact_group').val(),
                hidden_id: $("#hidden_id").val(),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('updateContact')}}",
                type: "POST",
                data: data,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    Toaster(response.success);
                    setTimeout(function() {
                        window.location.href = response.templategroup.group_id;
                    }, 2000);
                    $('#edit_contact_modal').modal('hide');

                },

            });
        });
    </script>
    <script type="text/javascript">
        //  toggle ajax start
        $('.toggle-class').change(function() {
            let blocked = $(this).prop('checked') === true ? 1 : 0;
            let id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('changeContactListStatus')}}",
                data: {
                    'blocked': blocked,
                    'id': id
                },
                success: function(data) {
                    Toaster(data.success);
                }
            });
        });
        //  toggle ajax end
    </script>


    <script>
        //start delete ajax
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var contact_id = $(this).data('id');
                $('#delete_contact_id').val(contact_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.contact_delete', function() {

                var contact_id = $('#delete_contact_id').val();
                $('#delete_modal').modal('show');


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('add-contact')}}/" + contact_id,
                    data: {
                        contact_id: contact_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        $("#reload_pagination_contact_list").load(location.href + " #reload_pagination_contact_list");
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


    @endpush
</x-app-layout>
<!--end row-->