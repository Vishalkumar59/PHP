
<x-app-layout>
      
    <div class="container-fluid">
        <div class="layout-specing">
           
            <div class="row ">
                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">Contact Group</h5>
                                <div>
                                    <button class="btn btn-primary"><i data-feather="plus" class="lead_icon mg-r-5"></i>Contact List</button>
                                    <button class="btn btn-primary" data-bs-target="#add_contact_modal" data-bs-toggle="modal"><i data-feather="plus" class="lead_icon mg-r-5"></i>Add Group</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2">
                                        <select class="form-select" aria-label="Default select example">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 float-end"><input type="text" id="Search"
                                            class="form-control col-lg-3 fas fa-search" placeholder="Search..." aria-label="Search">
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>

                                                <th class="border-bottom" style="min-width:70px;">Sl. No.</th>
                                                <th class="border-bottom" style="min-width: 150px;">Group Name</th>
                                                <th class="border-bottom" style="min-width: 150px;">Description
                                                </th>
                                                <th class="border-bottom" style="min-width: 100px;">Status</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;"> Action
                                                </th>
                                            </tr>
                                        </thead>
                                        @if(!empty($contactData))
                                        @foreach($contactData as $key=>$contact)
                                        <tbody id="Search_Tr">
                                             <tr>
                                                <td class="">{{$key + 1}}</td>
                                                <td class="">{{$contact->name}}</td>
                                                <td class="">{{$contact->description}}</td>
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input id="loader"
                                                            data-id=""
                                                            class="form-check-input toggle-class"
                                                            type="checkbox" data-toggle="toggle"
                                                            data-on="Active" data-off="InActive">
                                                    </div>
                                                </td>

                                                <td class="p-3 d-flex">
                                                    <button type="button" 
                                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn" value="{{$contact->id}}" 
                                                        id="edit_btn"
                                                        data-toggle="modal" data-target="#edit_contact_modal">
                                                        <i class="uil uil-edit"></i>
                                                    </button>

                                                    <button href="javascript:void(0)"  data-id=""
                                                        data-bs-toggle="modal" data-bs-target="#delete_contact_modal"
                                                        class="btn btn-danger btn-xs btn-icon del_button"><i
                                                         class="uil uil-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                        @endif
                                    </table>
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

     <!--start add modal-->
        <div class="modal fade" id="add_contact_modal" tabindex="-1" aria-labelledby="  exampleModalLabel"
            aria-hidden="    true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header border-bottom p-3">
                        <h5 class="modal-title" id="exampleModalLabel"> Add Contact
                        </h5>
                        <button type="button" class="btn btn-icon btn-close"
                            data-bs-dismiss="modal" id="close-modal">
                            <i class="uil uil-times fs-4 text-dark">
                            </i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                    <div class="mb-1">
                                        <label class="form-label">Group Name
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="group_name" id="group_name"
                                                type="text" class="form-control"
                                                placeholder="Enter Group Name" required>
                                            <div class="invalid-feedback">
                                                Please Enter Group Name
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
                                        <label class="form-label">Details
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="details" id="details"
                                                type="text" class="form-control"
                                                placeholder="Enter Details" required>
                                            <div class="invalid-feedback">
                                                Please Enter Details
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
                                    <input type="submit" name="send"
                                        class="btn btn-primary contact_submit" value="Submit">
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
                        <h5 class="modal-title" id="exampleModalLabel"> Update Contact
                        </h5>
                        <button type="button" class="btn btn-icon btn-close"
                            data-bs-dismiss="modal" value="" id="close-modal">
                            <i class="uil uil-times fs-4 text-dark">
                            </i>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <form  class="needs-validation" novalidate>
                            <input name="input_field" id="input_field" type="hidden" class="form-control ps-5" placeholder="">
                            <div class="row">
                                    <div class="mb-1">
                                        <label class="form-label">Group Name
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="group_name" id="group_name"
                                                type="text" class="form-control"
                                                placeholder="Enter Group Name" required>
                                            <div class="invalid-feedback">
                                                Please Enter Group Name
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
                                        <label class="form-label">Details
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="details" id="details"
                                                type="text" class="form-control"
                                                placeholder="Enter Details" required>
                                            <div class="invalid-feedback">
                                                Please Enter Details
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
                                    <input type="submit" name="send"
                                        class="btn btn-primary contact_update" value="Update">
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
        <div class="modal fade" id="delete_contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('settings.delete_setting_group')}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <h5> Are you sure want to delete ?</h5>
                        <input type="hidden" id="delete_id" name="input_field_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')}}</button>
                        <button type="submit" class="btn btn-primary delete_gkey">{{ __('common.yes')}} </button>
                    </div>
                </div>
            </div>
        </div>
        <!--end delete modal-->

@push('script')

<script>
    $(document).ready(function(){
        $('.contact_submit').on('submit', function(e){

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
                    url: "{{route('contact.store')}}",
                    data: data,
                    dataType: "json",

                    success: function (response) {
                        
                       console.log(response);
                        Toaster('Group Added Successfully!');
                              setTimeout(function () {
                                location.reload(true);
                                }, 3000);

                        
                    }
                });
        });
    });
   

    $(document).on("click","#edit_btn", function(e) {
            e.preventDefault();
            
            var group_id = $(this).val();
            $('#edit_contact_modal').modal('show');
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: "contact/"+group_id+"/edit",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    // if (response.status == 400) {
                    //     $('#errorlist').html("");
                    //     $('#errorlist').addClass("alert alert-danger");
                    //     $('#errorlist').aapend('<li>' + response.message + '</li>');
                    // } else {
                    //     $('#update_group_name').val(response.group_name);
                    //     $('#update_access_privilege').val(response.access_privilege);
                    //     $('#group_id').val(group_id);
                    // }
                }
            });
        });
    
        // end edit modal ajax
    </script>
@endpush

  
</x-app-layout>
