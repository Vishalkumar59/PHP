<style>
    .btn_size {
        margin-right: 5px;
        font-size: 12px;
    }
</style>
<x-app-layout>
    <!-- Top Header -->
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row fieldset_form">
                <div class="col-lg-12 ">
                    <div class="card border-0 rounded shadow ">
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('user-manager.edit_employee')}}</h5>
                        </div>
                        <form action="{{ route('employee.update', $staff->staff_id) }}" method="post" class="needs-validation" novalidate>
                            @csrf
                            {{ method_field('PUT') }}
                            <div class="row px-4 pb-4">
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.employee_id')}}</label>
                                    <input type="text" class="form-control" name="employee_id" id="employeeName" placeholder="Employee Id" value="@if (!empty($staff)) {{ $staff->employee_id }} @endif" required>
                                    <div class="invalid-feedback">
                                        Please enter employee Id.
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.user')}}</label>
                                    <select class="form-select form-control" name="user_id" value="@if (!empty($staff)) {{ $staff->user_id }} @endif" id="user_id" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.user_select')}}</option>
                                        @foreach ($user_list as $user)
                                        <option value="{{ $user->id }}" {{ $user->user_id == $staff->countries_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.user_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.department')}}</label>
                                    <select class="form-select form-control" value="@if (!empty($staff)) {{ $staff->department_id }} @endif" name="department_id" id="" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.department_select')}}</option>
                                        @foreach ($department_list as $department)
                                        <option value="{{ $department->department_id }}" {{ $department->department_id == $staff->department_id ? 'selected' : '' }}>
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
                                    <select class="form-select form-control" name="designation_id" value="@if (!empty($staff)) {{ $staff->designation_id }} @endif" id="" required="">
                                        <option selected disabled value="" disabled>{{__('user-manager.designation_select')}}</option>
                                        @foreach ($designation_list as $designation)
                                        <option value="{{ $designation->designation_id }}" {{ $designation->designation_id == $staff->designation_id ? 'selected' : '' }}>
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
                                        <option value="">{{__('user-manager.gender')}}</option>
                                        <option value="1" {{ $staff->gender == '1' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="0" {{ $staff->gender == '0' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.gender')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="" class="form-label">{{__('user-manager.married_status')}}</label>
                                    <select class="form-select form-control" name="marital_status" id="" required="">
                                        <option value="">{{__('user-manager.marriel_status_select')}}</option>
                                        <option value="1" {{ $staff->marital_status == '1' ? 'selected' : '' }}>
                                            Married</option>
                                        <option value="0" {{ $staff->marital_status == '0' ? 'selected' : '' }}>
                                            Unmarried</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{__('user-manager.marriel_status_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.name')}}</label>
                                    <input type="text" class="form-control" name="staff_name" id="customerName" placeholder="{{__('user-manager.name_placeholder')}}" value="{{ $staff->staff_name }}" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_name_placeholder')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.email')}}</label>
                                    <input type="emial" class="form-control" name="staff_email" id="customerName" placeholder="{{__('user-manager.email_placeholder')}}" value="{{ $staff->staff_email }}" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_email_placeholder')}}
                                    </div>

                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.phone')}}</label>
                                    <input type="number" class="form-control" name="staff_phone" id="customerName" placeholder="{{__('user-manager.no_placeholder')}}" value="{{ $staff->staff_phone }}" required="">

                                    <div class="invalid-feedback">
                                        {{__('user-manager.employee_phone_placeholder')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.dateofbirth')}}</label>
                                    <input type="date" class="form-control" name="dataOfBirth" id="customerName" placeholder="{{__('user-manager.dob_placeholder')}}" value="{{ $staff->date_of_birth }}" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.dob_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.dateofjoin')}}</label>
                                    <input type="date" class="form-control" name="dateOfJoining" id="customerName" placeholder="{{__('user-manager.doj_placeholder')}}" value="{{ $staff->date_of_joining }}" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.doj_select')}}
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-12 mt-4">
                                    <label for="customerName" class="form-label">{{__('user-manager.salary')}}</label>
                                    <input type="text" class="form-control" name="salary" id="customerName" placeholder="{{__('user-manager.salary_placeholder')}}" value="{{ $staff->salary }}" required="">
                                    <div class="invalid-feedback">
                                        {{__('user-manager.salary_error')}}
                                    </div>
                                </div>
                            </div> <!--end row-->     
                            <div class="col-lg-12 mt-4">
                                <div class="card border-0 rounded shadow">
                                    <div class="card-header bg-transparent px-4 py-2">
                                        <h5 class="text-md-start text-center mb-0">{{__('user-manager.address')}}</h5>
                                    </div>
                                    <div class="row px-4 pb-4">
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.street_address')}}</label>
                                            <input name="street_address" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.street_address_placeholder')}}" value="{{ $staff_address->street_address }} " required>
                                            <div class="invalid-feedback">
                                                {{__('user-manager.street_address_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.city')}}</label>
                                            <input name="city" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.city_placeholder')}}" value="{{ $staff_address->city }} " required="">
                                            <div class="invalid-feedback">
                                                {{__('user-manager.city_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="customerName" class="form-label">{{__('user-manager.state')}}</label>
                                            <input name="state" type="text" class="form-control" id="customerName" placeholder="{{__('user-manager.state_placeholder')}}" value="{{ $staff_address->state }} " required>
                                            <div class="invalid-feedback">
                                                {{__('user-manager.state_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="" class="form-label">{{__('user-manager.country')}}</label>
                                            <select name="country" class="form-select form-control" id="" value=" {{ $staff_address->countries_name }}" required="">
                                                <option selected disabled value="" disabled>{{__('user-manager.country_select')}}
                                                </option>
                                                @foreach ($country_list as $countries)
                                                <option value="{{ $countries->countries_id }}" {{ $countries->countries_id == $staff_address->countries_id ? 'selected' : '' }}>
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
                                            <input name="pincode" type="number" class="form-control" id="customerName" placeholder="Pincode" value="{{ $staff_address->postcode }}" required>
                                            <div class="invalid-feedback">
                                                {{__('user-manager.pincode_error')}}
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-12 mt-4">
                                            <label for="" class="form-label">{{__('user-manager.phone')}}</label>
                                            <input name="phone_no" type="number" class="form-control" id="customerName" placeholder="{{__('user-manager.pincode_placeholder')}}" value="{{ $staff_address->phone_no }}" required="">
                                            <div class="invalid-feedback"> 
                                                {{__('user-manager.phone_no_error')}}
                                            </div>
                                        </div>
                                    </div><!--end row-->                                    
                                    <div class="row">
                                        <div class="col-sm-12 my-4 mx-4" required>
                                            <input type="submit" id="submit" name="send" class="btn btn-primary btn_size" value=" {{__('common.update')}}">
                                            <a href="{{route('employee.index')}}" class="btn btn-light btn_size">{{__('common.goback')}}</a>
                                        </div>                                      
                                    </div><!--end col-->
                        </form>
                    </div>
                </div>
            </div>
        </div><!--end col-->       
</x-app-layout>