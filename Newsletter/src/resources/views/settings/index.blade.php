<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{
                    __('sender-list.sender_list')
                    }}</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{
                    __('sender-list.mail_server')
                    }}</button>
            </div>
            <!-- 1Tabs content -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <!-- Tabs content -->
                    <div class="col-md-12 col-lg-12 my-4 lead_list">
                        <div class="card rounded shadow pb-5">
                            <div class=" border-0 quotation_form">
                                <div
                                    class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">

                                    <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('sender-list.sender_list')
                                        }}</h5>
                                    <div>
                                        <button class="btn-sm  btn-primary " id="add_modal"><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{ __('sender-list.add_sender')
                                            }}</button></a>

                                        <!--- start modal store -->
                                        <div class="modal fade" id="sender_add" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{
                                                            __('sender-list.add_sender') }}
                                                        </h5>
                                                        <button type="button" class="btn btn-icon btn-close"
                                                            data-bs-dismiss="modal" id="close-modal"><i
                                                                class="uil uil-times fs-4 text-dark"></i></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form id="sender_add_form" method="POST"
                                                            class="needs-validation" novalidate>
                                                            @csrf
                                                            <div class="row">
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('sender-list.sender_name') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="sender_name" id="sender_name"
                                                                                type="text" class="form-control"
                                                                                placeholder="{{ __('sender-list.enter_sender_name') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('sender-list.sender_name_error')
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('sender-list.sender_email') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="sender_email" id="sender_email"
                                                                                type="email" class="form-control"
                                                                                placeholder="{{ __('sender-list.enter_sender_email') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('sender-list.sender_email_error')
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label">{{__('sender-list.server_name')}}<span
                                                                                class="text-danger"></span></label>

                                                                        <div class="form-icon position-relative">

                                                                            <select class="form-select form-control"
                                                                                name="select_server_name"
                                                                                id="select_server_name"
                                                                                aria-label="Default select example">
                                                                                <option selected disabled value="">
                                                                                    {{__('sender-list.select_server_name')}}
                                                                                </option>

                                                                                @foreach($server_list as $server_name)


                                                                                <option value="{{$server_name->id}}">
                                                                                    {{$server_name->name}}
                                                                                </option>
                                                                                @endforeach

                                                                            </select>
                                                                            <span style="color:red;">
                                                                                @error('stutas')
                                                                                {{$message}}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{__('sender-list.server_name')}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-sm-12" required>
                                                                    <input type="submit" id="Add_Source_Submit"
                                                                        name="send" class="btn-primary"
                                                                        value="{{ __('common.submit') }}">
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end store modal-->
                                        <!--modal edit code start -->
                                        <div class="modal fade" id="source_edit" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel"> {{
                                                            __('sender-list.update_sender') }}
                                                        </h5>
                                                        <button type="button" class="btn btn-icon btn-close"
                                                            data-bs-dismiss="modal" id="close-modal"><i
                                                                class="uil uil-times fs-4 text-dark"></i></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form id="update_sender_data" method="POST"
                                                            class="needs-validation" novalidate>
                                                            <input type="hidden" name="sender_edit_id" id="hidden_id">
                                                            <div class="row">
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('sender-list.sender_name') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="edit_sender_name"
                                                                                id="edit_sender_name" type="text"
                                                                                class="form-control"
                                                                                placeholder="{{ __('sender-list.enter_sender_name') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('sender-list.sender_name_error')
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('sender-list.sender_email') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="edit_email" id="edit_email"
                                                                                type="email" class="form-control"
                                                                                placeholder="{{ __('sender-list.enter_sender_email') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('sender-list.sender_email_error')
                                                                                }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="form-label">{{__('sender-list.server_name')}}<span
                                                                                class="text-danger">*</span></label>

                                                                        <div class="form-icon position-relative">

                                                                            <select class="form-select form-control"
                                                                                name="edit_server_name_id"
                                                                                id="edit_server_name_id"
                                                                                aria-label="Default select example">
                                                                                <option selected disabled value="">
                                                                                    {{__('sender-list.select_server_name')}}
                                                                                </option>

                                                                                @foreach($server_list as $server_name)


                                                                                <option value="{{$server_name->id}}">
                                                                                    {{$server_name->name}}
                                                                                </option>
                                                                                @endforeach

                                                                            </select>
                                                                            <span style="color:red;">
                                                                                @error('stutas')
                                                                                {{$message}}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{__('sender-list.server_name')}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--end row-->
                                                            <div class="row">
                                                                <div class="col-sm-12" required>
                                                                    <input type="submit" id="update_btn" name="send"
                                                                        class="btn-primary"
                                                                        value="{{ __('common.update') }}">
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!--modal edit code end -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline">
                                <!-- {{-- <div class="col-lg-12 px-4" id="form1">
                                    <div class="row align-item-center">
                                        <div class="col-sm-2" id="option"><select class="form-select"
                                                aria-label="Default select example">
                                                <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}} -->
                                <div class="p-4 mt-3">
                                    <div class="table-responsive shadow rounded " id="sender_data_reload">
                                        @if(!empty($sender_list) && sizeof($sender_list)>0)
                                        <table class="table table-center bg-white mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom " style="width: 150px">{{
                                                        __('common.sl_no')
                                                        }}</th>
                                                    <th class="border-bottom w-25"> {{
                                                        __('sender-list.sender_name') }}
                                                    </th>
                                                    <th class="border-bottom" style="min-width: 150px;"> {{
                                                        __('sender-list.sender_email') }}
                                                    <th class="border-bottom" style="min-width: 100px;">{{
                                                        __('common.status') }}</th>
                                                    <th class="text-center border-bottom me-0 "
                                                        style="min-width: 150px;">
                                                        {{__('common.action')}}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Start -->
                                                @if (!empty($sender_list))
                                                @foreach ($sender_list as $key => $sender)
                                                <tr>
                                                    <td class="">{{ $key + 1 }}</td>
                                                    <td class="">{{ $sender->sender_name }}</td>
                                                    <td class="">{{ $sender->sender_email }}</td>
                                    </div>
                                    <td class="p-3">
                                        <div class="form-check form-switch">
                                            <input data-id="{{ $sender->id }}" class="form-check-input toggle-class"
                                                type="checkbox" data-toggle="toggle" data-on="Active"
                                                data-off="InActive" {{ $sender->status ? 'checked' : '' }}>
                                        </div>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                            id="source_editmodal" value="{{ $sender->id }}" data-toggle="modal"
                                            data-target="#open_modal_edit">
                                            <i class="uil uil-edit">
                                            </i>
                                        </button>

                                        <button href="javascript:void(0)" id="delete_btn" data-id="{{$sender->id }}"
                                            data-toggle="modal" data-target="#delete_modal"
                                            class="btn btn-danger btn-xs btn-icon del_button"><i
                                                class="uil uil-trash-alt"></i></button>
                                    </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    </table>
                                    @else

                                    <div class="s-b-n-header" id="website_listing">
                                        <h4 class="text-center">No Record Found !. </h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <!--paginaion open -->
                            <div class="row text-center px-2  mb-4" id="sender_data_reload1">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$sender_list->currentPage();}} -
                                            {{$sender_list->lastItem();}} out of {{$sender_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $sender_list->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!-- PAGINATION END -->
                            </div>
                            <!--paginaion close -->
                        </div>
                    </div>
                </div><!-- tab1 contentend closed-->
            </div>





            <!-- tab2 open-->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">

                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('sender-list.server_list') }}</h5>
                                <div>
                                    <button class="btn-sm  btn-primary " id="status_add_modal"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{ __('sender-list.add_server') }}</button>

                                    <!-- MOdal start -->
                                    <div class="modal fade" id="status_add" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"> {{
                                                        __('sender-list.add_server') }}
                                                    </h5>
                                                    <button type="button" class="btn btn-icon btn-close"
                                                        data-bs-dismiss="modal" id="close-modal"><i
                                                            class="uil uil-times fs-4 text-dark"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="add_server_data" method="POST" class="needs-validation"
                                                        novalidate>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.server_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="server_name" id="server_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_server_name') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.server_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.provider_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="provider_name" id="provider_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_provider_name') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.provider_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label">{{__('sender-list.driver')}}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <select class="form-select form-control"
                                                                            name="driver" id="driver"
                                                                            aria-label="Default select example"
                                                                            required>
                                                                            <option selected disabled value="">
                                                                                {{__('sender-list.select_driver')}}
                                                                            </option>
                                                                            <option value="smtp">
                                                                                {{__('sender-list.smtp')}}
                                                                            </option>
                                                                            <option value="send_mail">
                                                                                {{__('sender-list.send_mail')}}
                                                                            </option>
                                                                        </select>
                                                                        <span style="color:red;">
                                                                            @error('stutas')
                                                                            {{$message}}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{__('sender-list.driver_error')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="hide_username">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.username')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="username" id="username" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_username') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.username_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="hide_password">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.password')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="add_password" id="add_password"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_password') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.password_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="hide_host">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('sender-list.host')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="host" id="host" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_host') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.host_message_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="hide_port">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('sender-list.port')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="port" id="port" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_port') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.port_message_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6" id="hide_encryption">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label">{{__('sender-list.encryption_method')}}<span
                                                                            class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <select class="form-select form-control"
                                                                            name="encryption" id="encryption"
                                                                            aria-label="Default select example">
                                                                            <option selected disabled value="">
                                                                                {{__('sender-list.select_encryption')}}
                                                                            </option>
                                                                            <option value="ssl">
                                                                                {{__('sender-list.ssl')}}
                                                                            </option>
                                                                            <option value="tls">
                                                                                {{__('sender-list.tls')}}
                                                                            </option>
                                                                        </select>
                                                                        <span style="color:red;">
                                                                            @error('stutas')
                                                                            {{$message}}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{__('sender-list.encryption_message_error')}}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.from_name')
                                                                        }}</label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="from_name" id="from_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_from_name') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.from_name_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.from_email')
                                                                        }}</label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="from_email" id="from_email"
                                                                            type="email" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_from_email') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.from_email_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.sendmail')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="sendmail" id="sendmail" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_sendmail') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.sendmail_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.pretend')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="pretend" id="pretend" type="number"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_pretend') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.pretend_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="industry_submit" name="send"
                                                                    class="btn-primary"
                                                                    value="{{ __('common.submit') }}">
                                                            </div>
                                                            <!--end col-->
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- modal store end -->

                                    <!-- modal edit code start -->
                                    <div class="modal fade" id="status_edit" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{
                                                        __('crm.update_lead_ststus') }}
                                                    </h5>
                                                    <button type="button" class="btn btn-icon btn-close"
                                                        data-bs-dismiss="modal" id="close-modal"><i
                                                            class="uil uil-times fs-4 text-dark"></i></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="update_server_data" method="POST" class="needs-validation"
                                                        novalidate>
                                                        <input type="hidden" name="server_hidden_id"
                                                            id="server_hidden_id">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.server_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_server_name"
                                                                            id="edit_server_name" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_server_name') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.server_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.provider_name')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_provider_name"
                                                                            id="edit_provider_name" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_provider_name') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.provider_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label">{{__('sender-list.driver')}}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <select class="form-select form-control"
                                                                            name="edit_driver" id="edit_driver"
                                                                            aria-label="Default select example"
                                                                            required>
                                                                            <option selected disabled value="">
                                                                                {{__('sender-list.select_driver')}}
                                                                            </option>
                                                                            <option value="smtp">
                                                                                {{__('sender-list.smtp')}}
                                                                            </option>
                                                                            <option value="send_mail">
                                                                                {{__('sender-list.send_mail')}}
                                                                            </option>
                                                                        </select>
                                                                        <span style="color:red;">
                                                                            @error('stutas')
                                                                            {{$message}}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{__('sender-list.status_error')}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="edit_hide_username">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.username')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_username" id="edit_username"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_username') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.username_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="edit_hide_password">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.password')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_password" id="edit_password"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_password') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.password_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="edit_hide_host">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('sender-list.host')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_host" id="edit_host"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_host') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.host_message_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="edit_hide_port">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('sender-list.port')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_port" id="edit_port"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_port') }}">
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.port_message_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6" id="edit_hide_encryption">
                                                                <div class="mb-3">
                                                                    <label
                                                                        class="form-label">{{__('sender-list.encryption_method')}}<span
                                                                            class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <select class="form-select form-control"
                                                                            name="edit_encryption" id="edit_encryption"
                                                                            aria-label="Default select example">
                                                                            <option selected disabled value="">
                                                                                {{__('sender-list.select_encryption')}}
                                                                            </option>
                                                                            <option value="ssl">
                                                                                {{__('sender-list.ssl')}}
                                                                            </option>
                                                                            <option value="tls">
                                                                                {{__('sender-list.tls')}}
                                                                            </option>
                                                                        </select>
                                                                        <span style="color:red;">
                                                                            @error('stutas')
                                                                            {{$message}}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{__('sender-list.encryption_message_error')}}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.from_name')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_from_name" id="edit_from_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_from_name') }}"
                                                                            >
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.from_name_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.from_email')
                                                                        }}<span class="text-danger"></span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_from_email"
                                                                            id="edit_from_email" type="email"
                                                                            class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_from_email') }}"
                                                                    >
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.from_email_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.sendmail')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_sendmail" id="edit_sendmail"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_sendmail') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.sendmail_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="col-md-4">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{
                                                                        __('sender-list.pretend')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="edit_pretend" id="edit_pretend"
                                                                            type="number" class="form-control"
                                                                            placeholder="{{ __('sender-list.enter_pretend') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('sender-list.pretend_message_error')
                                                                            }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="update_btn" name="send"
                                                                    class="btn-primary"
                                                                    value="{{ __('common.update') }}">
                                                            </div>
                                                            <!--end col-->
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--modal update code end -->

                                </div>
                            </div>

                        </div>
                        <div class="form-outline" id="server_mail_table">
                            {{-- <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2" id="option"><select class="form-select"
                                            aria-label="Default select example">
                                            <option>10</option>

                                        </select>
                                    </div>

                                </div>


                            </div> --}}
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded ">
                                    @if(!empty($server_list) && sizeof($server_list)>0)
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')
                                                    }}
                                                </th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('sender-list.name') }}</th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('sender-list.driver') }}</th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('sender-list.host') }}</th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('sender-list.port') }}</th>
                                                <th class="border-bottom" style="min-width: 100px;">{{
                                                    __('common.status')
                                                    }}</th>

                                                <th class="text-center border-bottom" style="min-width: 150px;">
                                                    {{ __('common.action') }}
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- Start -->
                                            @if (!empty($server_list))
                                            @foreach ($server_list as $key => $server)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $server->name }}</td>
                                                <td class="">{{ $server->driver }}</td>
                                                <td class="">{{ $server->host }}</td>
                                                <td class="">{{ $server->port }}</td>

                                                <td class="p-3">
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $server->id }}"
                                                            class="form-check-input toggle-classes" type="checkbox"
                                                            id="status_reload" data-toggle="toggle" data-on="Active"
                                                            data-off="InActive" {{ $server->active ? 'checked' : '' }}>
                                                    </div>
                                                <td class="text-center">

                                                    <button
                                                        class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                                        id="edit_server_modal" value="{{ $server->id }}"
                                                        data-toggle="modal" data-target="#open_modal_edit">
                                                        <i class="uil uil-edit">
                                                        </i>
                                                    </button>
                                                    <button type="button" id="detete_server_id"
                                                        value="{{ $server->id }}"
                                                        class="btn btn-danger btn-xs btn-icon"><i
                                                            class="uil uil-trash-alt"></i></button>
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

                            <!--paginaion open -->
                            <div class="row text-center px-2  mb-4" id="reload_pagination_server">

                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$server_list->currentPage();}} -
                                            {{$server_list->lastItem();}} out of {{$server_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $server_list->links() }}
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!--paginaion close -->

                        </div>

                    </div>
                </div>
                <!-- tab2 contentend closed-->
            </div>


        </div>
    </div>
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('sender-list.delete_sender')}}</h5>
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
    <div class="modal fade" id="delete_server_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('sender-list.delete_server')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{__('user-manager.are_you_sure')}}</h5>
                    <input type="hidden" id="delete_server_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.no')}}</button>
                    <button type="submit" class="btn btn-primary delete_server_submit">{{__('common.yes')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->
    @push('scripts')

    <script>
        $(document).ready(function() {

            $(document).on("click", "#detete_server_id", function() {
                var delete_server_id = $(this).val();

                $('#delete_server_id').val(delete_server_id);
                $('#delete_server_modal').modal('show');
            });
            $(document).on('click', '.delete_server_submit', function() {
                var delete_server_id = $('#delete_server_id').val();


                $('#delete_server_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('server-mail')}}/" + delete_server_id,
                    data: {
                        delete_server_id: delete_server_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_server_modal').modal('hide');
                        $("#server_mail_table").load(location.href + " #server_mail_table");
                        $("#reload_pagination_server").load(location.href + " #reload_pagination_server");

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
        $("#driver").on('change',function(){
            var getdriver = $(this).val();
            if(getdriver == "send_mail"){
                $("#hide_encryption").hide();
                $("#hide_username").hide();
                $("#hide_password").hide();
                $("#hide_port").hide();
                $("#hide_host").hide();

            }else{
                $("#hide_encryption").show();
                $("#hide_username").show();
                $("#hide_password").show();
                $("#hide_port").show();
                $("#hide_host").show();
            }
           
        });
    </script>

    <script>
        $("#edit_driver").on('change',function(){
        var getdriver = $(this).val();
        if(getdriver == "send_mail"){
            $("#edit_hide_encryption").hide();
            $("#edit_hide_username").hide();
            $("#edit_hide_password").hide();
            $("#edit_hide_port").hide();
            $("#edit_hide_host").hide();

        }else{
            $("#edit_hide_encryption").show();
            $("#edit_hide_username").show();
            $("#edit_hide_password").show();
            $("#edit_hide_port").show();
            $("#edit_hide_host").show();
        }
       
    });
    </script>



    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var sender_id = $(this).data('id');


                $('#delete_department_id').val(sender_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var sender_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ url('sender-list')}}/" + sender_id,
                    data: {
                        sender_id: sender_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $("#sender_data_reload").load(location.href + " #sender_data_reload");
                        $("#sender_data_reload1").load(location.href + " #sender_data_reload1");


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
            $("#add_modal").on('click', function(e) {
                e.preventDefault();
                $("#sender_add").modal('show');
            });
        });
    </script>
    <script>
        $(document).on("submit", "#sender_add_form", function(e) {
            e.preventDefault();
            // add sender ajax open
            var formData = {
                sender_name: $("#sender_name").val(),
                sender_email: $("#sender_email").val(),
                server_name: $("#select_server_name").val(),
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('sender-list.store')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    Toaster(response.success);
                    $('#sender_add').modal('hide');
                    $('#sender_add_form').trigger('reset');
                    $("#sender_data_reload").load(location.href + " #sender_data_reload");
                    $("#sender_data_reload1").load(location.href + " #sender_data_reload1");
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });

                },
                error: function(response) {

                    var errors = response.responseJSON.errors.sender_email;
                    Toaster(errors);
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });
                }

            });

        });

        //  modal add closed ajax

        $(document).on("click", "#source_editmodal", function(e) {
            e.preventDefault();
            var sender_edit_id = $(this).val();

            // alert(source_id);
            $('#source_edit').modal('show');
            $.ajax({
                url: "sender-list/" + sender_edit_id + "/edit",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    $('#edit_sender_name').val(response.edit_sender.sender_name);
                    $('#edit_email').val(response.edit_sender.sender_email);
                    $('#edit_server_name_id').val(response.edit_sender.email_server_id);
                    // $('#edit_status').val(response.edit_sender.status);
                    $('#hidden_id').val(response.edit_sender.id);


                }
            });

        });
        //  modal update code start ajax
        // edit modal ajax 

        $(document).on("submit", "#update_sender_data", function(e) {
            e.preventDefault();

            var formData = {
                edit_sender_name: $("#edit_sender_name").val(),
                edit_email: $("#edit_email").val(),
                edit_server_name: $("#edit_server_name_id").val(),
                // edit_status: $("#edit_status").val(),
                edit_hidden_id: $("#hidden_id").val(),
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{url('sender-update')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    Toaster(response.success);
                    $("#sender_data_reload").load(location.href + " #sender_data_reload");
                    $('#source_edit').modal('hide');
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });

                },

            });
        });


        //  modal update code end ajax

        // change status in ajax code start
        $('.toggle-class').change(function() {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let sender_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('sender-status') }}",
                data: {
                    status: status,
                    sender_id: sender_id
                },
                success: function(response) {

                    Toaster(response.success);


                }
            });
        });
        // chenge status in ajax code end
    </script> <!-- 1tab source closed -->

    <!--  2tab status ajax open  -->
    <script>
        $(document).ready(function() {
            $("#status_add_modal").on('click', function(e) {
                e.preventDefault();
                $("#status_add").modal('show');
            });
        });
    </script>


    <script>
        $(document).on("submit", "#add_server_data", function(e) {
            e.preventDefault();
            var formData = {
                name: $("#server_name").val(),
                provider: $("#provider_name").val(),
                driver: $("#driver").val(),
                host: $("#host").val(),
                port: $("#port").val(),
                username: $("#username").val(),
                encryption: $("#encryption").val(),
                sendmail: $("#sendmail").val(),
                password: $("#add_password").val(),
                from_name: $("#from_name").val(),
                from_email: $("#from_email").val(),
                send_mail: $("#send_mail").val(),
                pretend: $("#pretend").val(),
                status: $("#status_string").val(),
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('server-mail.store')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    Toaster(response.success);
                    $('#status_add').modal('hide');
                    $('#add_server_data').trigger('reset');
                    $("#server_mail_table").load(location.href + " #server_mail_table");


                    $("#reload_pagination_server").load(location.href + " #reload_pagination_server");
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });

                },

            });
        });
    </script>




    <script>
        $(document).on("click", "#edit_server_modal", function(e) {
            e.preventDefault();
            var server_edit_id = $(this).val();

            // alert(source_id);
            $('#status_edit').modal('show');
            $.ajax({
                url: "server-mail/" + server_edit_id + "/edit",
                type: "GET",
                success: function(response) {
                    console.log(response.edit_server);
                    $('#edit_server_name').val(response.edit_server.name);
                    $('#edit_provider_name').val(response.edit_server.provider_name);
                    $('#edit_driver').val(response.edit_server.driver);
                    if(response.edit_server.driver == "send_mail"){
                            $("#edit_hide_encryption").hide();
                            $("#edit_hide_username").hide();
                            $("#edit_hide_password").hide();
                            $("#edit_hide_port").hide();
                            $("#edit_hide_host").hide();
                    }else{
                            $("#edit_hide_encryption").show();
                            $("#edit_hide_username").show();
                            $("#edit_hide_password").show();
                            $("#edit_hide_port").show();
                            $("#edit_hide_host").show();
                    }
                    $('#edit_host').val(response.edit_server.host);
                    $('#edit_port').val(response.edit_server.port);
                    $('#edit_username').val(response.edit_server.username);
                    $('#edit_password').val(response.edit_server.password);
                    $('#edit_encryption').val(response.edit_server.encryption);
                    $('#edit_from_name').val(response.edit_server.from_name);
                    $('#edit_from_email').val(response.edit_server.from_email);
                    $('#edit_sendmail').val(response.edit_server.sendmail);
                    $('#edit_pretend').val(response.edit_server.pretend);
                    $('#server_hidden_id').val(response.edit_server.id);
                }
            });

        });
        // modal edit closed ajax

        // modal update code open ajax
        $(document).on("submit", "#update_server_data", function(e) {
            e.preventDefault();


            var formData = {
                name: $("#edit_server_name").val(),
                provider: $("#edit_provider_name").val(),
                driver: $("#edit_driver").val(),
                host: $("#edit_host").val(),
                port: $("#edit_port").val(),
                username: $("#edit_username").val(),
                encryption: $("#edit_encryption").val(),
                sendmail: $("#edit_sendmail").val(),
                password: $("#edit_password").val(),
                from_name: $("#edit_from_name").val(),
                from_email: $("#edit_from_email").val(),
                pretend: $("#edit_pretend").val(),
                server_hidden_id: $("#server_hidden_id").val(),
            };
            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{route('server-update')}}",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(response) {
                    Toaster(response.success);
                    $("#server_mail_table").load(location.href + " #server_mail_table");
                    $("#reload_pagination_server").load(location.href + " #reload_pagination_server");
                    $('#status_edit').modal('hide');
                    $('.flash-message').fadeOut(3000, function() {
                        location.reload(true);
                    });

                },

            });


        });
        //  modal update code end ajax

        // change status in ajax code start
        $('.toggle-classes').change(function() {
            let server_status = $(this).prop('checked') === true ? 1 : 0;
            let server_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('server-status') }}",
                data: {
                    server_status: server_status,
                    server_id: server_id
                },
                success: function(response) {
                    Toaster(response.success);



                }
            });
        });
        // chenge status in ajax code end
    </script> <!-- 2tab status closed -->
    @endpush
    {{-- 3tab Industry closed ajax --}}
</x-app-layout>