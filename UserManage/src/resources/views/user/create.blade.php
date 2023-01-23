<style>
    .btn_size {
        font-size: 12px !important;
        margin-right: 7px !important;
    }
</style>
<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{ route('user.store') }}" id="userForm" method="POST" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('user-manager.add_user')}}</h5>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="bg-transparent px-4 py-2">
                                    <label class="form-label">{{__('user-manager.user_name')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        {{-- <i data-feather="user" class="fea icon-sm icons"></i> --}}
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="  {{__('user-manager.enter_name')}}" value="{{old('name')}}"
                                            required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.please_enter_name')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="bg-transparent px-4 py-2">
                                    <label class="form-label">{{__('user-manager.user_email')}}<span
                                            class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="email" id="email" type="email" class="form-control"
                                            placeholder="{{__('user-manager.enter_email')}}" value="{{old('email')}}"
                                            required>
                                        <div class="invalid-feedback">
                                            {{__('user-manager.please_enter_email')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="bg-transparent px-4 py-2">
                                    <label class="form-label">{{__('user-manager.password')}}</label>
                                    <div class="form-icon position-relative">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder=" {{__('user-manager.enter_password')}}"
                                            value="{{old('password')}}"  pattern=".{6,}"    required title="8 to 12 characters"  >
                                        <div class="invalid-feedback">
                                            {{__('user-manager.please_enter_pass')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="bg-transparent px-4 py-2">
                                    <label class="form-label">{{__('user-manager.role')}}</label>
                                    <div class="form-icon position-relative">
                                        @if (!empty($role_list))
                                        <select class="form-select form-control" id="role" name="role"
                                            aria-label="Default select example" value="{{old('role')}}" required>
                                            <div class="invalid-feedback">
                                                {{__('user-manager.please_select_role')}}
                                            </div>
                                            <option value=""> {{__('user-manager.select_role')}}</option>
                                            @foreach ($role_list as $role)
                                            <option value="{{ $role->roles_id }}">{{ $role->roles_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary btn_size"
                                    value="{{__('common.submit')}}">
                                <a href="{{route('user.index')}}"
                                    class="btn btn-light btn_size">{{__('common.goback')}}</a>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

    @endpush


</x-app-layout>