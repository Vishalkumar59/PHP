<x-app-layout>

    <div class="container-fluid">
        <div class="layout-specing">

            <div class="row ">
                <div class="col-md-12 col-lg-12 my-0 lead_list">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('crm.customer_list') }}</h5>
                                <div>
                                
                                    <a href="{{route('customer.create')}}">
                                        <button class="btn btn-md  btn-primary "><i data-feather="plus"
                                                class="lead_icon mg-r-5"></i>{{ __('crm.add_customer') }}</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- searchbar -->
                        <div class="row px-4" id="search">
                            <div class="col-sm-1">
                                <select class="form-select form-control ">
                                    <option>1</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" id="searchbar" class="form-control" placeholder="Search Here"
                                    aria-label="Search" />
                            </div>
                        </div>
                        <!-- end searchbar -->
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded " id="customer_table">
                                <!-- Start table -->
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="" style="min-width:70px;">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom text-center" style="min-width: 150px;">{{
                                                __('crm.company_name') }}</th>
                                            <th class="text-center border-bottom" style="min-width: 200px;">{{
                                                __('crm.website') }}</th>
                                            <th class="text-center border-bottom" style="min-width: 100px;">{{
                                                __('crm.customer_name') }}</th>
                                            <th class="text-center border-bottom" style="min-width: 100px;">{{
                                                __('crm.email') }}</th>
                                            <th class="text-center border-bottom" style="min-width: 150px;"> {{
                                                __('common.action') }}</th>

                                        </tr>
                                    </thead>
                                    <tbody id="table">

                                        @if(!empty($customer_list))
                                        @foreach($customer_list as $key=>$customer)
                                        <tr>
                                            <td class="text-left ">{{$key+1}}</td>
                                            <td class="text-left ">{{$customer->company_name}}</td>
                                            <td class="text-left ">{{$customer->website}}</td>
                                            <td class="text-left ">{{$customer->first_name}}</td>
                                            <td class="text-left ">{{$customer->email}}</td>
                                            <td class="text-center d-flex justify-content-center p-3 data">
                                                <a href="{{ route('customer.edit',$customer->customer_id) }}"
                                                    class="btn btn-primary btn-xs btn-icon table_btn"><i
                                                        class="uil uil-edit"></i></a>

                                                <button type="button" id="delete_btn" value="{{ $customer->customer_id}}"
                                                    class="btn btn-danger btn-xs btn-icon"><i
                                                        class="uil uil-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table><!-- end table -->
                            </div>
                            <div class="row text-center px-2 md-4 mb-4">
                                <!-- PAGINATION START -->
                                <div class="col-12 mt-4">
                                    <div class="d-md-flex align-items-center text-center justify-content-between">
                                        <span class="text-muted me-3">Showing {{$customer_list->currentPage();}} - {{$customer_list->lastItem();}} out of {{$customer_list->total()}}</span>
                                        <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                            {{ $customer_list->links() }}
                                        </ul>
                                    </div>
                                </div>
                                    <!-- PAGINATION END -->
                            </div><!--end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!--start delete modal-->
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
            <h5>Are you sure want to delete ?</h5>
            <input type="hidden" id="delete_department_id" name="input_field_id">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-primary delete_submit_btn">Yes</button>
        </div>
    </div>
</div>
</div>
<!--end delete modal-->
    @push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var customer_id = $(this).val();
                $('#delete_department_id').val(customer_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '.delete_submit_btn', function() {
                var customer_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                 
                $.ajax({
                    type: "POST",
                    // url: "{{ url('departmentDestroy') }}/" + department_id,
                    url : "{{ url('customer')}}/"+customer_id,
                    data: {
                        customer_id: customer_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        Toaster(response.success);
                        $('#delete_modal').modal('hide');
                        $('.flash-message').html(response.success);
                        $('.flash-message').addClass('alert alert-success');
                        $('#department_edit').modal('hide');
                        $("#customer_table").load(location.href + " #customer_table");
                        
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
        //searchbar ajax
    $(document).ready(function(){
      $("#searchbar").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });

    </script>
    @endpush
</x-app-layout>