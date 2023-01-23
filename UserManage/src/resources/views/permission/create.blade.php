<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">

            <div class="card rounded shadow mt-3">
                <div class=" border-0 quotation_form">
                    <form action="{{route('role.store')}}" id="userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('user-manager.add_permission')}}</h5>
                        </div>
                        <div class="card rounded shadow">
                            <div class=" border-0 customer_form">
                                <div class="col-lg-11 col-sm-12 m-4">
                                    <label for="role_name" class="form-label">{{__('user-manager.role_name')}}</label>
                                    <input type="text" id="role_name" class="form-control" placeholder="{{__('user-manager.role_name_placeholder')}}">
                                </div>
                                <div class=" bg-transparent px-4 py-2">
                                    <h4 class="mb-0">{{__('user-manager.permission')}}</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3"></div>
                                    <div class="col-lg-9">
                                        <div class="row permission_form pt-4">
                                            <div class="col-lg-2 col-sm-6 fw-bold">{{__('user-manager.add')}}</div>
                                            <div class="col-lg-2 col-sm-6 fw-bold">{{__('user-manager.view')}}</div>
                                            <div class="col-lg-2 col-sm-6 fw-bold">{{__('user-manager.update')}}</div>
                                            <div class="col-lg-2 col-sm-6 fw-bold">{{__('user-manager.delete')}}</div>
                                            <div class="col-lg-2 col-sm-6 fw-bold">{{__('user-manager.export')}}</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <form class="needs-validation p-4 pt-0 pb-5" novalidate> -->
                                @foreach($module_name as $modulename)
                                <fieldset>
                                    <legend>{{__('common.crm')}}</legend>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-12 fw-bold">{{__('common.generalSetting')}}</div>
                                            <div class="col-lg-9 col-sm-12">
                                                <div class="row">
                                                    <div class="col-lg-2 col-sm-12">
                                                        <select class="form-select form-control my-1" id="" required>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-12">
                                                        <select class="form-select form-control my-1" id="" required>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-12">
                                                        <select class="form-select form-control my-1" id="" required>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                            <option value=""></option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-12">
                                                        <select class="form-select form-control my-1" id="" required>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 col-sm-12">
                                                        <select class="form-select form-control my-1" id="" required>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                            <option value="">{{__('user-manager.select')}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </fieldset>
                                @endforeach
                                <!-- </form> -->
                            </div>
                        </div>
                            <div class="row"><!--row open-->
                                           <div class="col-sm-12 my-4 mx-4" required>
                                            <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{__('common.submit')}}">
                                             </div>
                             </div><!--row end-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
</x-app-layout>