<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                    type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ __('crm.lead_source')
                    }}</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                    type="button" role="tab" aria-controls="nav-profile" aria-selected="false">{{ __('crm.lead_status')
                    }}</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact"
                    type="button" role="tab" aria-controls="nav-contact" aria-selected="false">{{
                    __('crm.lead_industry') }}
                </button>
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

                                    <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('crm.lead_source_list') }}</h5>
                                    <div>
                                        <button class="btn-sm  btn-primary " id="add_modal"><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{ __('crm.add_lead_source')
                                            }}</button></a>

                                        <!--- start modal store -->
                                        <div class="modal fade" id="source_add" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header border-bottom p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel">{{
                                                            __('crm.add_lead_source') }}
                                                        </h5>
                                                        <button type="button" class="btn btn-icon btn-close"
                                                            data-bs-dismiss="modal" id="close-modal"><i
                                                                class="uil uil-times fs-4 text-dark"></i></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form id="source_add_userForm" method="POST"
                                                            class="needs-validation" novalidate>
                                                            @csrf
                                                            <div class="row">
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('crm.source_name') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="source_name"
                                                                                id="addsource_name" type="text"
                                                                                class="form-control"
                                                                                placeholder="{{ __('crm.source_name_placeholder') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('crm.source_name_error') }}
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
                                                            __('crm.update_lead_source') }}
                                                        </h5>
                                                        <button type="button" class="btn btn-icon btn-close"
                                                            data-bs-dismiss="modal" id="close-modal"><i
                                                                class="uil uil-times fs-4 text-dark"></i></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <form id="update_userForm" method="POST"
                                                            class="needs-validation" novalidate>
                                                            @csrf
                                                            <input name="source_id" id="hiddensource_id" type="hidden"
                                                                class="form-control ps-5">
                                                            <div class="row">
                                                                <div class="md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">{{
                                                                            __('crm.source_name') }}<span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="form-icon position-relative">
                                                                            <input name="source_name"
                                                                                id="editsource_name" type="text"
                                                                                class="form-control"
                                                                                placeholder="{{ __('crm.source_name_placeholder') }}"
                                                                                required>
                                                                            <span style="color:red;">
                                                                                @error('source_name')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </span>
                                                                            <div class="invalid-feedback">
                                                                                {{ __('crm.source_name_error') }}
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
                                <div class="col-lg-12 px-4" id="form1">
                                    <div class="row align-item-center">
                                        <div class="col-sm-2" id="option"><select class="form-select"
                                                aria-label="Default select example">
                                                <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 mt-3">
                                    <div class="table-responsive shadow rounded " id="source_id">
                                        <table class="table table-center bg-white mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom" style="min-width:70px;">{{
                                                        __('common.sl_no')
                                                        }}</th>
                                                    <th class="border-bottom" style="min-width: 150px;"> {{
                                                        __('crm.source_name') }}
                                                    </th>
                                                    <th class="border-bottom" style="min-width: 100px;">{{
                                                        __('common.status') }}</th>
                                                    <th class="text-center border-bottom" style="min-width: 150px;">
                                                        {{__('common.action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Start -->
                                                @if (!empty($source_list))
                                                @foreach ($source_list as $key => $source)
                                                <tr>
                                                    <td class="">{{ $key + 1 }}</td>
                                                    <td class="">{{ $source->source_name }}</td>
                                    </div>
                                    <td class="p-3">
                                        <div class="form-check form-switch">
                                            <input data-id="{{ $source->source_id }}"
                                                class="form-check-input toggle-class" type="checkbox"
                                                data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                $source->status ? 'checked' : '' }}>
                                        </div>
                                    <td class="text-center"> <button
                                            class="btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                            id="source_editmodal" data-id="{{ $source->source_id }}"
                                            data-bs-toggle="modal" data-bs-target="#source_edit"><i
                                                class="uil uil-edit"></i></button>
                                    </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--paginaion open -->
                            <div class="row text-center px-2  mb-4">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$source_list->currentPage();}} -
                                            {{$source_list->lastItem();}} out of {{$source_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $source_list->links() }}
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

                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('crm.lead_status_list') }}</h5>
                                <div>
                                    <button class="btn-sm  btn-primary " id="status_add_modal"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{ __('crm.add_lead_status') }}</button></a>

                                    <!-- MOdal start -->
                                    <div class="modal fade" id="status_add" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"> {{
                                                        __('crm.add_lead_status') }}
                                                    </h5>
                                                    <button type="button" class="btn btn-icon btn-close"
                                                        data-bs-dismiss="modal" id="close-modal"><i
                                                            class="uil uil-times fs-4 text-dark"></i></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form id="status_add_userForm" method="POST"
                                                        class="needs-validation" novalidate>
                                                        @csrf
                                                        <div class="row">
                                                            <div class="md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('crm.status_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="status_name" id="addstatus_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('crm.status_name_placeholder') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('crm.status_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--end row-->
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="Add_status_submit" name="send"
                                                                    class="btn-primary"
                                                                    value="{{ __('common.submit') }}">
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- modal store end -->

                                    <!-- modal edit code start -->
                                    <div class="modal fade" id="status_edit" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{
                                                        __('crm.update_lead_ststus') }}
                                                    </h5>
                                                    <button type="button" class="btn btn-icon btn-close"
                                                        data-bs-dismiss="modal" id="close-modal"><i
                                                            class="uil uil-times fs-4 text-dark"></i></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form id="status_update_userForm" method="POST"
                                                        class="needs-validation" novalidate>
                                                        @csrf
                                                        <input name="source_id" id="hidden_status_id" type="hidden"
                                                            class="form-control ps-5">
                                                        <div class="row">
                                                            <div class="md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('crm.status_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="status_name" id="edit_status_name"
                                                                            type="text" class="form-control"
                                                                            placeholder="{{ __('crm.status_name_placeholder') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('status_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('crm.status_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end row-->
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="status_update_btn" name="send"
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
                                    <!--modal update code end -->

                                </div>
                            </div>

                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2" id="option"><select class="form-select"
                                            aria-label="Default select example">
                                            <option>10</option>

                                        </select>
                                    </div>

                                </div>


                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded " id="store_status_id">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')
                                                    }}
                                                </th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('crm.status_name') }}</th>

                                                <th class="border-bottom" style="min-width: 100px;">{{
                                                    __('common.status')
                                                    }}</th>

                                                <th class="text-center border-bottom" style="min-width: 150px;">
                                                    {{ __('common.action') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- Start -->
                                            @if (!empty($status_list))
                                            @foreach ($status_list as $key => $status)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $status->status_name }}</td>
                                                <td class="p-3">
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $status->status_id }}"
                                                            class="form-check-input toggle-classes" type="checkbox"
                                                            data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                            $status->status ? 'checked' : '' }}>
                                                    </div>
                                                <td class="text-center"> <button
                                                        class="btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                                        id="status_editmodal" data-id="{{ $status->status_id }}"
                                                        data-bs-toggle="modal" data-bs-target="#status_edit"><i
                                                            class="uil uil-edit"></i></button></td>

                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!--paginaion open -->
                            <div class="row text-center px-2  mb-4">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$status_list->currentPage();}} -
                                            {{$status_list->lastItem();}} out of {{$status_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $status_list->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!-- PAGINATION END -->
                            </div>
                            <!--paginaion close -->

                        </div>

                    </div>
                </div>
                <!-- tab2 contentend closed-->
            </div>

            <!-- 3tab open -->
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                <div class="col-md-12 col-lg-12 my-4 lead_list">
                    <div class="card rounded shadow pb-5">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">

                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('crm.lead_industry_list') }}</h5>
                                <div>
                                    <button class="btn-sm  btn-primary " id="industry_add_modal"><i data-feather="plus"
                                            class="lead_icon mg-r-5"></i>{{ __('crm.add_lead_industry') }}
                                    </button></a>

                                    <!--  start modal store -->
                                    <div class="modal fade" id="industry_add" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{
                                                        __('crm.add_lead_industry') }}
                                                        <button type="button" class="btn btn-icon btn-close"
                                                            data-bs-dismiss="modal" id="close-modal"><i
                                                                class="uil uil-times fs-4 text-dark" style="margin-left: 360px;"></i></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form id="industry_add_userForm" method="POST"
                                                        class="needs-validation" novalidate>
                                                        @csrf
                                                        <div class="row">
                                                            <div class="md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('crm.industry_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="industry_name"
                                                                            id="add_industry_name" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('crm.industry_name_placeholder') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('industry_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('crm.industry_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="industry_submit" name="send"
                                                                    class="btn-primary"
                                                                    value="{{ __('common.submit') }}">
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- modal store end -->

                                    <!-- modal edit code start -->
                                    <div class="modal fade" id="industry_edit" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom p-3">
                                                    <h5 class="modal-title" id="exampleModalLabel"> {{
                                                        __('crm.update_lead_industry') }}</h5>
                                                    <button type="button" class="btn btn-icon btn-close"
                                                        data-bs-dismiss="modal" id="close-modal"><i
                                                            class="uil uil-times fs-4 text-dark"></i></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <form id="industry_update_userForm" method="POST"
                                                        class="needs-validation" novalidate>
                                                        @csrf
                                                        <input name="industry_id" id="hidden_industry_id" type="hidden"
                                                            class="form-control ps-5">
                                                        <div class="row">
                                                            <div class="md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">{{ __('crm.industry_name')
                                                                        }}<span class="text-danger">*</span></label>
                                                                    <div class="form-icon position-relative">
                                                                        <input name="industry_name"
                                                                            id="edit_industry_name" type="text"
                                                                            class="form-control"
                                                                            placeholder="{{ __('crm.industry_name_placeholder') }}"
                                                                            required>
                                                                        <span style="color:red;">
                                                                            @error('industry_name')
                                                                            {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                        <div class="invalid-feedback">
                                                                            {{ __('crm.industry_name_error') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                        <div class="row">
                                                            <div class="col-sm-12" required>
                                                                <input type="submit" id="industry_update_btn"
                                                                    name="send" class="btn-primary"
                                                                    value="{{ __('common.update') }}">
                                                            </div>
                                                            <!--end col-->
                                                        </div>
                                                        <!--end row-->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- modal update code end -->
                                </div>
                            </div>
                        </div>
                        <div class="form-outline">
                            <div class="col-lg-12 px-4" id="form1">
                                <div class="row align-item-center">
                                    <div class="col-sm-2" id="option"><select class="form-select"
                                            aria-label="Default select example">
                                            <option>10</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 mt-3">
                                <div class="table-responsive shadow rounded" id="industry_table">
                                    <table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom" style="min-width:70px;">{{ __('common.sl_no')
                                                    }}
                                                </th>
                                                <th class="border-bottom" style="min-width: 150px;"> {{
                                                    __('crm.industry_name') }}
                                                </th>
                                                <th class="border-bottom" style="min-width: 100px;">{{
                                                    __('common.status')
                                                    }}</th>
                                                <th class="text-center border-bottom" style="min-width: 150px;">
                                                    {{ __('common.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Start  listing-->
                                            @if (!empty($industry_list))
                                            @foreach ($industry_list as $key => $industry)
                                            <tr>
                                                <td class="">{{ $key + 1 }}</td>
                                                <td class="">{{ $industry->industry_name }}</td>
                                                <td class="p-3">
                                                    <div class="form-check form-switch">
                                                        <input data-id="{{ $industry->industry_id }}"
                                                            class="form-check-input toggle-classed" type="checkbox"
                                                            data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                            $industry->status ? 'checked' : '' }}>
                                                    </div>
                                                <td class="text-center"> <button
                                                        class="btn-primary btn-xs btn-icon table_btn edit_temp_btn"
                                                        id="industry_editmodal" data-id="{{ $industry->industry_id }}"
                                                        data-bs-toggle="modal" data-bs-target="#industry_edit"><i
                                                            class="uil uil-edit"></i></button></td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--paginaion open -->
                            <div class="row text-center px-2  mb-4">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$industry_list->currentPage();}} -
                                            {{$industry_list->lastItem();}} out of {{$industry_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $industry_list->links() }}
                                        </ul>
                                    </div>
                                </div>
                                <!-- PAGINATION END -->
                            </div>
                            <!--paginaion close -->
                        </div>
                    </div>
                </div>
                <!-- 3tab closed-->
            </div>
        </div>
    </div>
    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
                $("#add_modal").on('click', function(e) {
                    e.preventDefault();
                    $("#source_add").modal('show');
                });
                // add source ajax open
                $('#Add_Source_Submit').on('submit', '#source_add_userForm', function(e) {
                    e.preventDefault();
                    var data = {
                        source_name: $("#addsource_name").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('lead-setting.store') }}",
                        data: data,
                        dataType: "json",

                        success: function(response) {
                            // console.log(response);

                            $('#add_modal').trigger("reset");
                            $('#source_add').modal('hide')
                        },
                        error: function(response) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });
            //  modal add closed ajax
            // edit modal ajax 
            $(document).on("click", "#source_editmodal", function(e) {
                e.preventDefault();
                var source_id = $(this).data('id');
                // alert(source_id);
                $('#source_edit').modal('show');
                $.ajax({
                    url: "lead-setting/" + source_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass("alert alert-danger");
                            $('#errorlist').append('<li>' + response.message + '</li>');

                        } else {
                            $('#editsource_name').val(response.source.source_name);
                            $('#hiddensource_id').val(source_id);
                        }
                    }
                });

            });
            //  modal update code start ajax

            $(document).on("click", "#update_btn", function(e) {
                e.preventDefault();
                $('#update_userForm').addClass('was-validated');
                if ($('#update_userForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        source_id: $("#hiddensource_id").val(),
                        source_name: $("#editsource_name").val(),
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('lead-setting-update') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $('#source_edit').modal('hide');
                        $("#source_id").load(location.href + " #source_id");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                        }
                    });
                }
            });
            //  modal update code end ajax

            // change status in ajax code start
            $('.toggle-class').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let source_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('lead-setting-source') }}",
                    data: {
                        'status': status,
                        'source_id': source_id
                    },
                    success: function(data) {
                        // location.reload();
                        Toaster('Lead Source Status Changed Successfully');
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
        // modal add in ajax

            $(document).ready(function() {
                $("#status_add_userForm").submit(function(e) {
                    e.preventDefault();
                    var data = {
                        status_name: $("#addstatus_name").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('lead-setting-store-status') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                          
                            // toaster
                        Toaster(response.success);
                        $('#status_add').modal('hide');
                        $('#status_add_userForm').trigger('reset')
                        $("#store_status_id").load(location.href + " #store_status_id");
                        $('.flash-message').fadeOut(3000, function() {
                            location.reload(true);
                        });
                            // location.reload();
                            // console.log(response);
                            // Toaster('Status Name Added ');

                        },
                        error: function(response) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });
            //  modal add closed ajax

            // modal edit open ajax

            $(document).on("click", "#status_editmodal", function(e) {
                e.preventDefault();
                var status_id = $(this).data('id');
                $('#status_edit').modal('show');
                $.ajax({
                    url: "lead-setting/" + status_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass("alert alert-danger");
                            $('#errorlist').append('<li>' + response.message + '</li>');
                        } else {
                            $('#edit_status_name').val(response.status.status_name);
                            $('#hidden_status_id').val(status_id);
                        }
                    }
                });
            });
            // modal edit closed ajax

            // modal update code open ajax
            $(document).on("click", "#status_update_btn", function(e) {
                e.preventDefault();
                $('#status_update_userForm').addClass('was-validated');
                if ($('#status_update_userForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        status_id: $("#hidden_status_id").val(),
                        status_name: $("#edit_status_name").val(),
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('lead-setting-update-status') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            $('#status_edit').modal('hide');
                            $("#store_status_id").load(location.href + " #store_status_id");
                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });

                            }
                    });
                }
            });
            //  modal update code end ajax

            // change status in ajax code start
            $('.toggle-classes').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let status_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('lead-setting-status') }}",
                    data: {
                        'status': status,
                        'status_id': status_id
                    },
                    success: function(data) {
                        // location.reload();
                        Toaster('Lead  Status Changed Successfully');
                    }
                });
            });
            // chenge status in ajax code end
    </script> <!-- 2tab status closed -->

    <!-- 3tab Industry open in jquery-->
    <script>
        $(document).ready(function() {
                $("#industry_add_modal").on('click', function(e) {
                    e.preventDefault();
                    $("#industry_add").modal('show');
                });
            });
    </script><!-- 3tab Industry closed in jquery-->

    <!-- 3tab Industry openin ajax -->
    <script>
        // modal add industry open ajax
            $(document).ready(function() {
                $("#industry_add_userForm").submit(function(e) {
                    e.preventDefault();
                    var data = {
                        industry_name: $("#add_industry_name").val(),
                    };
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ url('lead-setting-store-industry') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            // $('#industry_add_modal').trigger("reset");
                            Toaster(response.success);
                            $('#industry_add').modal('hide');
                            $('#industry_add_userForm').trigger('reset')
                            $("#industry_table").load(location.href + " #industry_table");
                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });



                        },
                        error: function(response) {
                            var errors = data.responseJSON;
                            console.log(errors);
                        }
                    });
                });
            });
            //  modal add industry closed ajax

            // modal edit open ajax

            $(document).on("click", "#industry_editmodal", function(e) {
                e.preventDefault();
                var industry_id = $(this).data('id');
                $('#industry_edit').modal('show');
                $.ajax({
                    url: "lead-setting/" + industry_id + "/edit",
                    type: "GET",
                    success: function(response) {
                        console.log(response);
                        if (response.status == 400) {
                            $('#errorlist').html("");
                            $('#errorlist').addClass("alert alert-danger");
                            $('#errorlist').append('<li>' + response.message + '</li>');

                        } else {
                            $('#edit_industry_name').val(response.industry.industry_name);
                            $('#hidden_industry_id').val(industry_id);
                        }
                    }
                });

            });
            // modal edit closed ajax

            // modal update code open ajax
            $(document).on("click", "#industry_update_btn", function(e) {

                e.preventDefault();
                $('#industry_update_userForm').addClass('was-validated');
                if ($('#industry_update_userForm')[0].checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var data = {
                        industry_id: $("#hidden_industry_id").val(),
                        industry_name: $("#edit_industry_name").val(),
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: "{{ url('lead-setting-update-industry') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            Toaster(response.success);
                            $('#industry_edit').modal('hide');
                            $("#industry_table").load(location.href + " #industry_table");
                            $('.flash-message').fadeOut(3000, function() {
                                location.reload(true);
                            });


                        }
                    });
                }
            });
            // modal update code closed ajax

            // change status in ajax code start
            $('.toggle-classed').change(function() {
                let status = $(this).prop('checked') === true ? 1 : 0;
                let industry_id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ url('lead-setting-industry') }}",
                    data: {
                        'status': status,
                        'industry_id': industry_id
                    },
                    success: function(data) {
                        // location.reload();
                        Toaster('Lead Industry Status Changed Successfully');
                    }
                });
            });
            // chenge status in ajax code end
    </script>
    @endpush
    {{-- 3tab Industry closed ajax --}}
</x-app-layout>