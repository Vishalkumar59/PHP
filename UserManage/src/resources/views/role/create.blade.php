<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="card rounded shadow mt-3">
                <div class=" border-0 quotation_form">
                    <form action="{{route('role.store')}}" id="userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('user-manager.add_role')}}</h5>
                        </div>
                        <div class="col-lg-11 col-sm-12 m-4">
                            <label for="role_name" class="form-label">{{__('user-manager.role_name')}}</label>
                            <input type="text" id="role_name" class="form-control" name="role_name" placeholder="{{__('user-manager.role_name_placeholder')}}" required>
                        </div>
                        <div class=" bg-transparent px-4 py-2">
                            <h4 class="mb-0">
                                {{__('user-manager.permission')}}
                            </h4>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-9">
                                <div class="row permission_form pt-4">
                                    @if(!empty($permission_list))
                                    @foreach($permission_list as $permission_name)
                                    @if($permission_name->status == '1')
                                    <div class="col-lg-3 col-sm-12 ml-2 fw-bold">
                                        {{$permission_name->permissions_name}}
                                    </div>
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @foreach($module_name as $module)
                        <fieldset>
                            <legend class="fs-5">
                                {{$module->module_name}}
                            </legend>
                            <div class="col-lg-12">
                                @foreach($module_section as $section)
                                @if($module->module_id == $section->module_id)
                                <div class="row align-items-center">
                                    <div class="col-lg-3 col-sm-12 fw-bold">
                                        {{$section->section_name}}
                                    </div>
                                    <div class="col-lg-9 col-sm-12">
                                        <div class="row">
                                            @foreach($permission_list as $permission)
                                            @if($permission->status == '1')
                                            <div class="col-lg-3 col-sm-12 mx-1 ">
                                                <select class="form-select form-control my-1" id="" name="permission[]" placeholder="{{__('user-manager.select')}}">
                                                    <option selected value="" disabled>{{__('user-manager.select')}} </option>
                                                    @php
                                                    $data = json_decode($permission->allow_permission);
                                                    @endphp
                                                    @foreach($data as $key=>$value)
                                                    <option value="{{$section->section_id}}.{{$permission->permissions_id}}.{{$value}}">
                                                        {{$key}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </fieldset>
                        @endforeach
                        <div class="row g-3 m-2">
                            <div class="col-lg-3 col-sm-12">
                                <button type="submit" id="submit" class="btn btn-primary  btn-block w-50 fs-5 mb-3" style="background-color: background-color: #2f55d4;">{{__('common.submit')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end container-->
</x-app-layout>