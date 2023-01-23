<style>
    .btn-size {
        margin-right: 5px !important;
        font-size: 12px !important;
    }
</style>
<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row fieldset_form">
                <div class="col-lg-12">
                    <div class="card border-0 rounded shadow ">
                        <form action="{{ route('employee.store') }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            <div class="card-header bg-transparent px-4 py-2">
                                <h5 class="text-md-start text-center mb-0">{{__('user-manager.add_employee')}}</h5>
                            </div>
                            <div class="row px-4 pb-4">
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.employee_id')}}</label>
                                    <input type="text" class="form-control" name="employee_id" id="employeeName" placeholder="{{__('user-manager.employee_id_placehlder')}}" value="" required>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_id_error')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.user')}}</label>
                                    <select class="form-select form-control" name="user_id" id="user_id" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.user_select')}}</option>
                                        @foreach ($user_list as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.user_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.department')}}</label>
                                    <select class="form-select form-control" name="department_id" id="" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.department_select')}}</option>
                                        @foreach ($department_list as $department)
                                        <option value="{{ $department->department_id }}">
                                            {{ $department->dept_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.department_name_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.designation')}}</label>
                                    <select class="form-select form-control" name="designation_id" id="" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.designation_select')}}</option>
                                        @foreach ($designation_list as $designation)
                                        <option value="{{ $designation->designation_id }}">
                                            {{ $designation->designation_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.designation_name_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.gender')}}</label>
                                    <select class="form-select form-control" name="gender" id="" required="">
                                        <option value="">{{__('user-manager.gender_select')}}</option>
                                        <option value="1">Male</option>
                                        <option value="0">Female</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.gender_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.married_status')}}</label>
                                    <select class="form-select form-control" name="marital_status" id="" required="">
                                        <option value="">{{__('user-manager.marriel_status_select')}}</option>
                                        <option value="1">Married</option>
                                        <option value="0">Unmarried</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.marriel_status_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.name')}}</label>
                                    <input type="text" class="form-control" name="staff_name" id="customerName" placeholder="{{__('user-manager.name_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_name_placeholder')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.email')}}</label>
                                    <input type="emial" class="form-control" name="staff_email" id="customerName" placeholder="{{__('user-manager.email_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_email_placeholder')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.phone')}}</label>
                                    <input type="number" class="form-control" name="staff_phone" id="customerName" placeholder="{{__('user-manager.no_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_phone_placeholder')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.dateofbirth')}}</label>
                                    <input type="date" class="form-control" name="dataOfBirth" id="customerName" placeholder="{{__('user-manager.dob_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.dob_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.dateofjoin')}}</label>
                                    <input type="date" class="form-control" name="dateOfJoining" id="customerName" placeholder="{{__('user-manager.doj_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.doj_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.salary')}}</label>
                                    <input type="text" class="form-control" name="salary" id="customerName" placeholder="{{__('user-manager.salary_placeholder')}}" value="" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.salary_error')}}
                                    </div>
                                </div>
                            </div>  <!--end row-->   
                            <div class="col-lg-12 mt-4">
                                <div class="card border-0 rounded shadow">
                                    <div class="card-header bg-transparent px-4 py-2">
                                        <h5 class="text-md-start text-center mb-0">{{__('user-manager.address')}}</h5>
                                    </div>
                                    <div class="row px-4 pb-4 needs-validation" novalidate>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.street_address')}}</label>
                                            <input name="street_address" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.street_address_placeholder')}}" value="" required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.street_address_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.city')}}</label>
                                            <input name="city" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.city_placeholder')}}" value="" required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.city_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.state')}}</label>
                                            <input name="state" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.state_placeholder')}}" value="" required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.state_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="" class="form-label">{{__('user-manager.country')}}</label>
                                            <select name="country" class="form-select form-control" id="" required="">
                                                <option selected disabled value="" disabled>{{__('user-manager.country_select')}}
                                                </option>
                                                @foreach ($country_list as $countries)
                                                <option value="{{ $countries->countries_id }}">
                                                    {{ $countries->countries_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                {{__('user-manager.country_select')}}
                                            </div>

                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="" class="form-label">{{__('user-manager.pincode')}}</label>
                                            <input name="pincode" type="number" class="form-control" id="customerName" placeholder="{{__('user-manager.pincode_placeholder')}}" value="" required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.pincode_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="" class="form-label">{{__('user-manager.phone')}}</label>
                                            <input name="phone_no" type="number" class="form-control" id="customerName" placeholder="{{__('user-manager.phone_no_placeholder')}}" value="" required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.phone_no_error')}}
                                            </div>
                                        </div>
                                    </div><!--end row-->
                                    <div class="row">
                                        <div class="col-sm-12 my-4 mx-4" required>
                                            <input type="submit" id="submit" name="send" class="btn btn-primary d-inline btn-size" value="{{__('common.submit')}}">
                                            <a href="{{route('employee.index')}}" class="btn btn-light btn-size">{{__('common.goback')}}</a>
                                        </div>     
                                    </div><!--end row-->
                        </form>
                    </div>
                </div>
            </div> <!--end row-->
        </div>   
</x-app-layout>