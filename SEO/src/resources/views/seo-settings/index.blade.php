<x-app-layout>
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">


    @endpush
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <div class="container-fluid">
        <div class="layout-specing tab_table">
            <!-- Tabs navs -->
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab"
                        aria-controls="ex1-tabs-1" aria-selected="true">{{ __('seo.website') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab"
                        aria-controls="ex1-tabs-2" aria-selected="false">{{ __('seo.task_setting') }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#ex1-tabs-3" role="tab"
                        aria-controls="ex1-tabs-3" aria-selected="false">{{ __('seo.result_title') }}</a>
                </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">

                    <div class="card shadow rounded" id="website_table">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('seo.website_list') }}</h5>
                                <div>

                                    <a href="{{ route('seo-website.create') }}">
                                        <button class="btn-md btn-primary "><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{__('seo.add_website')}}</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive">
                                <table class="table table-center bg-white mb-0" id="website_datatable">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3" style="min-width: 200px;">{{
                                                __('seo.website_name') }}
                                            </th>
                                            <th class="border-bottom p-3" style="min-width: 200px;">{{
                                                __('seo.website_url') }}
                                            </th>
                                            <!-- <th class="text-center border-bottom p-3">{{ __('seo.country') }}</th> -->
                                            <th class="text-center border-bottom p-3">{{ __('seo.start_date') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.status') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if (!empty($web_setting))
                                        @foreach ($web_setting as $key => $web)
                                        <tr>
                                            <th class="p-3">{{ $key + 1 }}</th>
                                            <td class="p-3">{{ $web->website_name }}</td>
                                            <td class="p-3">{{ $web->website_url }}</td>
                                            <!-- <td class="text-center p-3">{{ $web->countries_id }}</td> -->
                                            <td class="text-center p-3">{{ $web->start_date }}</td>
                                            <td class="p-3">
                                                <div class="form-check form-switch">
                                                    <input data-id="{{$web->id}}" class="form-check-input toggle-class"
                                                        type="checkbox" data-toggle="toggle" data-on="Active"
                                                        data-off="InActive" {{ $web->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center p-3">
                                                    <a href="{{ url('seo-website/' . $web->id . '/edit') }}"
                                                        class="btn btn-primary btn-xs btn-icon table_btn"><i
                                                            class="uil uil-edit"></i></a>
                                                    <button type="button" id="delete_btn" value="{{ $web->id }}"
                                                        class="btn btn-danger btn-xs btn-icon"><i
                                                            class="uil uil-trash-alt"></i></button>
                                                </div>
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


                    <!--end row-->
                </div>
                <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <div class="card shadow rounded " id="seo-task-table">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('seo.task_list') }}</h5>
                                <div>
                                    <a href="{{ route('seo-task.create') }}" class="btn-primary">
                                        <i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('seo.add_task') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive">
                                <table class="table table-center bg-white mb-0 " id="task_table">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3" style="min-width: 80px;">{{
                                                __('seo.task_priority') }}</th>
                                            <th class="border-bottom p-3" style="min-width: 180px;">{{
                                                __('seo.task_title') }}
                                            </th>
                                            <th class="border-bottom p-3" style="min-width: 180px;">
                                                {{ __('seo.no_of_submission') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('seo.task_frequency') }}
                                            </th>
                                            <th class="text-center border-bottom p-3">{{ __('common.status') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if (!empty($seotask))
                                        @foreach ($seotask as $key => $task)
                                        <tr>
                                            <th class="p-3">{{ ++$key }}</th>
                                            <td class="p-3">{{ ucwords($task->task_priority) }}</td>
                                            <td class="p-3">{{ ucwords($task->seo_task_title) }}</td>
                                            <td class="p-3">{{ ucwords($task->no_of_submission) }}</td>
                                            <td class="text-center p-3">
                                                @if (!empty($task->task_frequency == 1))
                                                Daily
                                                @elseif(!empty($task->task_frequency == 2))
                                                Weekly Once
                                                @elseif(!empty($task->task_frequency == 3))
                                                Weekly Twice
                                                @elseif(!empty($task->task_frequency == 4))
                                                Weekly Thrice
                                                @endif
                                            </td>
                                            {{-- <td class="text-center p-3"><i
                                                    class="{{ $task->status == '1' ? 'badge bg-primary' : 'badge bg-danger' }}">
                                                    {{ $task->status == '1' ? 'Active' : 'Inactive' }}</i>
                                            </td> --}}

                                            <td>
                                                <div class="form-check form-switch">
                                                    <input data-id="{{$task->id}}"
                                                        class="form-check-input toggle-class1" type="checkbox"
                                                        data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                        $task->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center p-3">
                                                    <a href="{{ url('seo-task/' . $task->id . '/edit') }}"
                                                        data-task-id="{{ $task->id }}"
                                                        class="btn btn-primary btn-xs btn-icon table_btn planLoginbtn"><i
                                                            class="uil uil-edit"></i></a>
                                                    <button type="button" id="task_id" value="{{ $task->id }}"
                                                        class="btn btn-danger btn-xs btn-icon"><i
                                                            class="uil uil-trash-alt"></i></button>
                                                </div>
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
                <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <div class="table-responsive shadow rounded " id="store_status_id">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('seo.result_list') }}</h5>
                                <div>
                                    
                                    <button data-bs-toggle="modal" data-bs-target="#add_title_modal"
                                        class=" btn-md btn-primary" id="add_result_title"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{ __('seo.add_result_title') }}</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-center bg-white mb-0">
                            <thead>
                                <tr>
                                    <th class="border-bottom col-sm-3 text-center">{{ __('seo.title') }}</th>
                                    <th class="border-bottom col-sm-6 text-center">{{ __('seo.sub_title') }}</th>
                                    <th class="border-bottom col-sm-1 text-center">{{ __('common.status') }}</th>
                                    <th class="text-center border-bottom col-sm-2">{{ __('common.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Start -->
                                @if (!empty($seoresult))
                                @foreach ($seoresult as $key => $result)
                                <tr>
                                    <td class="text-center">{{ ucwords($result->title_name) }}</td>
                                    <td></td>
                                    
                                    <td class="p-3">

                                        <div class="form-check form-switch">
                                            <input data-id="{{$result->id}}" class="form-check-input toggle-class2"
                                                type="checkbox" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $result->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-cente text-center d-flex  p-3">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit_title_modal" data-id="{{$result->id}}"
                                            class="btn btn-primary btn-xs btn-icon table_btn edit_btn"
                                            style="margin-left: 50px;"><i class="uil uil-edit"></i></a>
                                        <button type="button" id="parent_delete_id" value="{{ $result->id }}"
                                            class="btn btn-danger btn-xs btn-icon delete_result_id"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </td>

                                </tr>
                                @foreach ($result->child as $key => $child)
                                <tr>
                                    <td class="p-3"></td>
                                    <td class="text-center">{{ ucwords($child->title_name) }}</td>
                                    <td class="p-3">
                                           
                                        <div class="form-check form-switch">
                                            <input data-id="{{$result->id}}"
                                            class="form-check-input toggle-class2" type="checkbox"
                                            data-toggle="toggle" data-on="Active" data-off="InActive" {{ $result->status ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-cente text-center d-flex p-3">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#edit_title_modal" data-id="{{$child->id}}"
                                            class="btn btn-primary btn-xs btn-icon table_btn edit_btn"
                                            style="margin-left: 50px;"><i class="uil uil-edit planLoginbtn"></i></a>
                                        <button type="button" id="delete_child" value="{{ $child->id }}"
                                            class="btn btn-danger btn-xs btn-icon delete_result_id"><i
                                                class="uil uil-trash-alt "></i></button>
                                    </td>

                                </tr>
                                @endforeach
                                @endforeach
                                @endif
                                <!-- End -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Tabs content -->
        </div>
    </div>

    <!-- Add title modal start -->
    <div class="modal fade" id="add_title_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.add_title') }}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body ">

                    <form class="needs-validation" id="add_result_title_form" novalidate>

                        <div class="row">
                            <div class="md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('seo.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="title" id="title" type="text" class="form-control"
                                            placeholder="Enter title" required>
                                        <span style="color:red;">
                                            @error('title')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            Please enter title
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="md-3">
                                        <label for="section_type" class="form-label">{{ __('seo.section_type')
                                            }}</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input section_type is-invalid" type="radio"
                                                name="section_type" id="section_type" value="0" checked>
                                            <label class="form-check-label" for="inlineRadio1">{{ __('seo.parent')
                                                }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input section_type1 is-invalid" type="radio"
                                                name="section_type" id="section_type1" value="1">
                                            <label class="form-check-label" for="inlineRadio2">{{ __('seo.child')
                                                }}</label>
                                        </div>
                                        
                                    </div>

                                    <div class="md-3 parent" style="display:none;">
                                        <label for="parent_section" class="form-label">{{ __('seo.parent_title')
                                            }}</label>
                                        <select class="form-control" id="parent_section" name="parent_section">
                                            <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                            </option>

                                        </select>

                                        <div class="invalid-feedback">
                                            Please choose a parent section
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row mt-4">
                            <div class="col-sm-12" required>
                                <input type="submit" id="addstoreform" class=" btn-primary " value="Submit">
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- add title modal end -->
    {{-- @dd($result->title); --}}

    <!-- edit title modal start -->
    <div class="modal fade" id="edit_title_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" id="edit_title_reload">
            <div class="modal-content">
                <div class="modal-header border-bottom p-3">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.update_title') }}</h5>
                    <button type="button" class="btn btn-icon btn-close" data-bs-dismiss="modal" id="close-modal"><i
                            class="uil uil-times fs-4 text-dark"></i></button>
                </div>
                <div class="modal-body ">
                    <form class="needs-validation" novalidate>

                        <input type="hidden" name="input_field_id" id="edit_input_field">
                        <div class="row">
                            <div class="md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('seo.title') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="title" id="update_title" type="text" class="form-control"
                                            placeholder="Enter title" required>
                                        <span style="color:red;">
                                            @error('title')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            Please enter title
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-6">
                                    <div class="md-3">
                                        <label for="section_type" class="form-label">{{ __('seo.section_type')
                                            }}</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  section_type is-invalid type"
                                                type="radio" name="section_type" id="update_section_type" value="0">
                                            <label class="form-check-label" for="inlineRadio1">{{ __('seo.parent')
                                                }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input  section_type1 is-invalid type" type="radio"
                                                name="section_type" id="update_section_type1" value="1">
                                            <label class="form-check-label" for="inlineRadio2">{{ __('seo.child')
                                                }}</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Please choose a section type
                                        </div>
                                    </div>

                                    <div class="md-3 parent" style="display:none;">
                                        <label for="parent_section" class="form-label">{{ __('seo.parent_title')
                                            }}</label>
                                        <select class="form-control " id="update_parent_section" name="parent_section">
                                            <option selected disabled value="">{{ __('seo.select_parent_title') }}
                                            </option>
                                            {{--
                                            <!-- <option selected disabled value="">Select Parent Title</option>
                                            @foreach($seoresult as $result)

                                            <option value="{{$result->id}}" >{{$result->title_name}}</option>
                                            @endforeach --> --}}
                                        </select>

                                        <div class="invalid-feedback">
                                            Please choose a parent section
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="my-3">
                                    <label class="form-label">{{ __('common.status') }}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" name="status" id="update_status"
                                            aria-label="Default select example" required>
                                            <option selected disabled value="">{{ __('seo.select_status') }}</option>
                                            <option value="1">{{ __('common.active') }}</option>
                                            <option value="0">{{ __('common.inactive') }}</option>
                                        </select>
                                        <span style="color:red;">
                                            @error('stutas')
                                            {{$message}}
                                            @enderror
                                        </span>
                                        <div class="invalid-feedback">
                                            Please select status
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row mt-4">
                            <div class="col-sm-12" required>
                                <input type="submit" id="edit_title_submit" class=" btn-primary " value="UPDATE">
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--edit title modal end -->


    <!--start delete modal-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.delete_website') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_designation_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                        }}</button>
                    <button type="submit" class=" btn-primary delete_submit_btn">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->
    <!--start task delete modal-->
    <div class="modal fade" id="delete_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.delete_task') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_task_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                        }}</button>
                    <button type="submit" class=" btn-primary delete_submit_btn1">{{ __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end delete result -->

    <!-- delete result  parent-->
    <div class="modal fade" id="delete_modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.delete_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_parent_modal" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                        }}</button>
                    <button type="submit" class=" btn-primary delete_submit_btn2" id="delete_parent_id">{{
                        __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- child delte modal --}}
    <!-- delete modal open -->
    <div class="modal fade" id="child_delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('seo.delete_title') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{ __('common.delete_confirmation') }}</h5>
                    <input type="hidden" id="delete_child_modal" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('common.no')
                        }}</button>
                    <button type="submit" class=" btn-primary delete_submit_btn2" id="delete_child_submit">{{
                        __('common.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    {{-- parent delete modal --}}





    @push('scripts')
    <!-- data table start-->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#task_table').DataTable();
            $('#website_datatable').DataTable();
        } );
    </script>
    <!--data table end-->
    <script>
        // modal add in ajax
        $(document).ready(function() {
            $("#add_result_title").on('click', function(e) {
                    e.preventDefault();
                    $("#add_title_modal").modal('show');
                });

           $('#close-modal').on('click', function (e) {
               e.preventDefault();
               $("#add_title_modal").modal('hide');
           });
        });
    </script>

    {{-- result section --}}
    <script>
        $(document).ready(function() {
                $(document).on("click", "#parent_delete_id", function() {
                    var parent_delete_id = $(this).val();
                  
                    $('#delete_parent_modal').val(parent_delete_id);
                    $('#delete_modal2').modal('show');
                });
                $(document).on('click', '#delete_parent_id', function() {
                    var parent_delete_id = $('#delete_parent_modal').val();
                 
                    $('#delete_modal2').modal('show');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo-results-data') }}/" + parent_delete_id,
                        data: {
                            parent_delete_id: parent_delete_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal2').modal('hide');
                        $("#store_status_id").load(location.href + " #store_status_id");
                        location.reload(true);
                        

                        }
                    });

                });
            });
    </script>
    {{-- child delte ajax --}}
    <script>
        $(document).ready(function() {
                $(document).on("click", "#delete_child", function() {
                    var delete_child = $(this).val();
                    
                    $('#delete_child_modal').val(delete_child);
                    $('#child_delete_modal').modal('show');
                });
                $(document).on('click', '#delete_child_submit', function() {
                    var delete_child = $('#delete_child_modal').val();
                    $('#child_delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('child-delete') }}/" + delete_child,
                        data: {
                            delete_child: delete_child
                        },
                        dataType: "json",
                        success: function(response) {
                        Toaster(response.success);
                        $('#child_delete_modal').modal('hide');
                        $("#store_status_id").load(location.href + " #store_status_id");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });

                        }
                    });

                });
            });
    </script>

    <!--DEPENDENT DROPDOWN-->
    <script>
        $(document).ready(function() {
            $('#add_result_title').click( function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url:"{{ route('dropdown') }}",
                    type: "POST",
                    success: function(result) 
                    {
                        // console.log(result.seoresult);
                        $.each( result.seoresult, function( key, value ) {
                            // console.log(value.title_name);
                              let option_html = "<option value='"+value.id+"'>"+ value.title_name +"</option>"
                                $("#parent_section").append(option_html);
                            });
                    }
                });
            });
        });
    </script>
    <!--END DROPDOWN-->
    <script>
        $(document).on("submit","#add_result_title_form",function(e){
               e.preventDefault();
               
               let section_type = $("#section_type:checked").val();
               var formData = {
                title: $("#title").val(),
                parent_section_id : $("#parent_section").val()??0,
                status: $("#status").val(),
               };
               console.log(formData);
               $.ajaxSetup({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   }
               });
                $.ajax({
                   url:"{{route('seo-results-data.store')}}",
                   type:"POST",
                   data: formData,
                   dataType: "json",
                   success: function(response){
                    
                    console.log(response);
                    Toaster(response.success);
                        $('#add_title_modal').modal('hide');
                        $('#add_result_title_form').trigger('reset');
                         $('.nav-item').removeClass('active');
                        $(this).addClass('active');
                        location.reload(true);
                        $("#store_status_id").load(location.href + " #store_status_id");
                         
                        
                   },

               });
           });
    </script>


    <!-- hide show section radio button start-->
    <script>
        $(document).ready(function(){
          $(".section_type").click(function(){
            $(".parent").hide();
          });
          $(".section_type1").click(function(){
            $(".parent").show();
          });
        });
    </script>
    <!-- hide show section end-->
    <script>
        //modal edit title ajax
        $(document).ready(function() {
            
            $('.edit_btn').on('click',function (e) {
                e.preventDefault();
                var result_id =  $(this).data('id');
               
                
                
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    url: "{{url('seo-results-data')}}/"+result_id+"/edit",
                    data: {result_id:result_id},
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        var sec = response.section;
                        // var mod = response.result;
                            $("#edit_input_field").val(sec.id);
                            $("#update_title").val(sec.title_name);
                            if(sec.parent_id == 0){
                                $('#update_section_type').prop('checked', 'true');
                            }
                            else{
                                $('#update_section_type1').prop('checked', 'true');
                                
                            }
                            console.log(sec.parent_id);
                            if(sec.parent_id != '0'){
                               
                                $("#update_title").val(sec.title_name);
                                $("#update_parent_section").html('');

                            // console.log(response.result);
                                $.each(response.result, function( key, value ) {
                                    // console.log(value);
                                  let option_html = "<option value='"+value.id+"'>"+ value.title_name +"</option>";
                                    $("#update_parent_section").append(option_html);
                                    $("#update_parent_section").val(sec.parent_id);
                                    $('.parent').show();
                                });
                            
                            }
                            else{
                               
                                $('.parent').hide();

                            }

                            
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        console.log(errors);
                    }
                });
            });
        });
       
    //   Edit title closed ajax
    </script>
    <!-- update title ajax -->
    <script>
        $(document).ready(function(){
            $("#edit_title_submit").click(function(e){
                e.preventDefault();
                
                var data = {
                     id: $("#edit_input_field").val(),
                     title: $("#update_title").val(),
                     parent_id: $("#update_parent_section").val(),
                     section_type: $('.type').prop('checked') === true ? 0 : 1,
                    
                }
                // alert(data.id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{route('seo-results-update')}}",
                    data: data,
                    success: function (response) {
                        // console.log(response);
                        $('#edit_title_modal').modal('hide');
                        Toaster(response.success);
                        $("#store_status_id").load(location.href + " #store_status_id");
                        location.reload(true);
                       
                    }
                });
               
            });
        });
    </script>
    <!-- update title end-->

    <!-- start delete ajax-->
    <script>
        $(document).ready(function() {
                $(document).on("click", "#delete_btn", function() {
                    var seo_id = $(this).val();
                    $('#delete_designation_id').val(seo_id);
                    $('#delete_modal').modal('show');
                });
                $(document).on('click', '.delete_submit_btn', function() {
                    var seo_id = $('#delete_designation_id').val();

                    $('#delete_modal').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo-website') }}/" + seo_id,
                        data: {
                            seo_id: seo_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $("#website_table").load(location.href + " #website_table");
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


    <script>
        $(document).ready(function() {
                $(document).on("click", "#task_id", function() {
                    var task_id = $(this).val();
                    $('#delete_task_id').val(task_id);
                    $('#delete_modal1').modal('show');
                });
                $(document).on('click', '.delete_submit_btn1', function() {
                    var task_id = $('#delete_task_id').val();

                    $('#delete_modal1').modal('show');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('seo-task') }}/" + task_id,
                        data: {
                            task_id: task_id,
                            _method: 'DELETE'
                        },
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                        $('#delete_modal1').modal('hide');
                        $("#seo-task-table").load(location.href + " #seo-task-table");
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
        $(document).ready(function() {
                $(".planLoginbtn").click(function() {
                    $("#login-popup").modal('show');
                });
            });
            // $(window).on("load",function(){
            //     $("#add_task").window.stop();
            // });
            $(window).on("load", function() {
                $("#add_website").show();
                $("#add_task").hide();
                $("#add_title").hide();
            });

            $("#ex1-tab-1").click(function() {
                $("#add_website").show();
                $("#add_task").hide();
                $("#add_title").hide();
            });

            $("#ex1-tab-2").click(function() {
                $("#add_website").hide();
                $("#add_task").show();
                $("#add_title").hide();
            });

            $("#ex1-tab-3").click(function() {
                $("#add_website").hide();
                $("#add_task").hide();
                $("#add_title").show();
            });
    </script>

    <script type="text/javascript">
        //  website status ajax start
        $('.toggle-class').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let website_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('changeWebsiteStatus')}}",
                data: { 'status': status, 'website_id': website_id },
                success: function (response) {
                   // console.log(response);
                   Toaster(response.success);
                }
            });
        });
    </script>

    <script type="text/javascript">
        //  Task status ajax start
        $('.toggle-class1').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let task_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('changeTaskStatus')}}",
                data: { 'status': status, 'task_id': task_id },
                success: function (response) {
                   console.log(response);
                   Toaster(response.success);
                }
            });
        });
    </script>
     <script type="text/javascript">
        //  Task status ajax start
      $('.toggle-class2').change(function () {
          let status = $(this).prop('checked') === true ? 1 : 0;
          let result_id = $(this).data('id');

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $.ajax({
              type: "POST",
              dataType: "json",
              url: "{{route('changeResultStatus')}}",
              data: { 'status': status, 'result_id': result_id },
              success: function (response) {
                 console.log(response);
                 Toaster(response.success);
              }
          });
      });
  </script>
    @endpush
</x-app-layout>