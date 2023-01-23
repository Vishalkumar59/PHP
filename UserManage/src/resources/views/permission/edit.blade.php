<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="col-md-12">
                <div class="card rounded shadow">
                    <form action="{{ route('permission.update',$permission->permissions_id) }}" id="userForm" method="POST" class="needs-validation" novalidate>
                        @csrf
                        {{ @method_field('put') }}
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('user-manager.edit_permission')}}</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('user-manager.permission_name')}} <span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">
                                        <input name="permissions_name" id="permissions_name" type="text" class="form-control" value="{{$permission->permissions_name}}" placeholder="{{__('user-manager.permission_name_placeholder')}}" required>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('user-manager.permission_slug')}}<span class="text-danger">*</span></label>
                                    <div class="form-icon position-relative">                                      
                                        <input name="permissions_slug" value="{{$permission->permissions_slug}}" id="permissions_slug" type="text" class="form-control" placeholder="{{__('user-manager.permission_slug_placeholder')}}" required>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('user-manager.sort_order')}}</label>
                                    <div class="form-icon position-relative">                                       
                                        <input type="text" name="sort_order" value="{{$permission->sort_order}}" id="sort_order" class="form-control" placeholder="{{__('user-manager.sort_order_placeholder')}}" required>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-md-6">
                                <div class="px-4 py-2">
                                    <label class="form-label">{{__('common.status')}}</label>
                                    <div class="form-icon position-relative">
                                        <select class="form-select form-control" id="status" name="status" aria-label="Default select example">
                                            <option>{{__('user-manager.status_select')}}</option>
                                            <option value="1" {{ $permission->status == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $permission->status == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                        <div class="row">
                            <div class="col-sm-12 my-4 mx-4" required>
                                <input type="submit" id="submit" name="send" class="btn btn-primary" value="{{__('common.update')}}">
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>