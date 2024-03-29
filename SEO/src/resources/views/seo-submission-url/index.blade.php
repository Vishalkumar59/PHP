<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card rounded shadow ">
                        <div class=" border-0 quotation_form">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="m-2 position-relative  d-flex" >
                                    <select class="form-select form-control mx-2" name="website_name" id="website_name">
                                        <option value="0">{{__('seo.select_website')}}</option>
                                        @foreach ($websitelist as $website=>$websitename)
                                            <option value="{{ $websitename->id }}">{{ ucfirst($websitename->website_name) }}</option>
                                        @endforeach 
                                    </select>

                                    <select class="form-select form-control"   name="seolist" id="seolist">
                                        <option value="0">{{__('seo.select_task')}}</option>
                                        @foreach ($seotasklist as $seotask)
                                            <option data-content="{{ ucfirst($seotask->seo_task_title) }}" value="{{ $seotask->id }}">{{ ucfirst($seotask->seo_task_title) }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">{{__('seo.submission_list')}}</h5>
                                <div class="pull-left">
                                    <a href="{{route('submission.create')}}">
                                        <button class="btn btn-primary btns">{{__('seo.add_submission')}}</button>
                                       
                                    </a>
                                </div>
                            </div>  
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" > 
                                <div class="s-b-n-header" id="seo_title">
                                    <h4 class="text-center">{{__('seo.record_not_found')}}</h4>
                                </div>                    
                                {{-- <table class="table table-center bg-white mb-0">                       
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{__('seo.task_title')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{__('seo.date')}}</th>
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{__('seo.website_url')}}</th>                                  
                                            <th class="text-center border-bottom p-3">{{__('seo.username')}}</th>
                                            <th class="text-center border-bottom p-3">{{__('seo.password')}}</th>
                                            <th class="text-center border-bottom p-3">{{__('common.status')}}</th>
                                            <th class="text-center border-bottom p-3" >{{__('common.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if(!empty($seotasklist))
                                        @foreach($seotasklist as $seotask)
                                        <tr>
                                            <td class="p-3">{{$seotask->seo_task_title}}</td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>

                                            <td class="text-center p-3" style="size:10px;"></td>
                                        </tr>
                                        
                                         @foreach ($seosubmissionwebsites as $seosubmission)
                                        <tr >
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>
                                            <td class="p-3"></td>

                                            <td class="text-cente d-flex  p-3">
                                            
                                            <a href="" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>

                                             <form action="" method="POST" class="">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" class="btn btn-primary btn-xs btn-icon" onclick="return confirm ('Are you sure you want to delete')"><i class="uil uil-trash-alt"></i></button> 
                                            </form>   


                                            </td>                           
                                        </tr> 
                                       @endforeach 
                                        
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table> --}}
                            </div>
                            
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
            </div>
        </div>
    </div><!--end container--> 

    <!--start delete modal-->
     <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('common.delete_submission')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <h5>{{__('common.delete_confirmation')}}</h5>
                    <input type="hidden" id="delete_department_id" name="input_field_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('common.no')}}</button>
                    <button type="submit" class="btn btn-primary " id="delete_submit_btn">{{__('common.yes')}}</button>
                </div>
            </div>
        </div>
    </div>
    <!--end delete modal-->


    @push('scripts')
 <!--delete ajax start-->

<script type="text/javascript">
    //  website status ajax start
    $(document).on("change", "#toggle-class", function() {
      let status = $(this).prop('checked') === true ? 1 : 0;
      let id = $(this).data('id');
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
          type: "POST",
          dataType: "json",
          url: "{{route('submission-status-chenge')}}",
          data: { 'status': status, 'id': id },
          success: function (response) {
             // console.log(response);
             Toaster(response.success);
          }
      });
  });
</script>







    <script>
        $(document).ready(function() {

            $(document).on("click", "#delete_btn", function() {
                var submission_id = $(this).val();
               
             

                $('#delete_department_id').val(submission_id);
                $('#delete_modal').modal('show');
            });
            $(document).on('click', '#delete_submit_btn', function() {

                var submission_id = $('#delete_department_id').val();

                $('#delete_modal').modal('show');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                 
                $.ajax({
                    type: "POST",
                    url : "{{ url('submission')}}/"+submission_id,
                    data: {
                        submission_id: submission_id,
                        _method: 'DELETE'
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        Toaster(response.success);
                        // $('#row_id_'+submission_id).hide();
                        $('#delete_modal').modal('hide');
                    }
                });

            });
        });
    </script>
    <!--end delete ajax-->

    <script type="text/javascript">
        $(document).ready(function() {
            
            $('#website_name, #seolist').on('change', function() {
                var website_id = $('#website_name').val();
                var seo_task_id= $('#seolist').val();
                $("#seo_title").html('');
                
                tableContent(website_id, seo_task_id);
               
                
            });
        });



        function tableContent(website_id, seo_task_id){
            const url = "{{ route('get-subission-url') }}";
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        website_id: website_id,
                        seo_task_id:seo_task_id,
                    },
                    dataType: "json",
                    beforeSend: function() {
                        var html= `<div class="preloader-container d-flex justify-content-center align-items-center">
                                <div class="spinner-border" role="status" aria-hidden="true"></div>
                            </div>`;
                         
                        $("#seo_title").append(html);
                    },
                    
                    success: function(result) {
                                console.log(result);
                                var html=   `<div class="table-responsive p-20">
                                             <table class="table table-center bg-white mb-0">
                                             <thead>
                                            <th class="border-bottom p-3">{{__('seo.task_title')}}</th>
                                            
                                            <th class="border-bottom p-3" style="min-width: 220px;">{{__('seo.website_url')}}</th>                                  
                                            <th class="text-center border-bottom p-3">{{__('seo.username')}}</th>
                                            <th class="text-center border-bottom p-3">{{__('seo.password')}}</th>
                                            <th class="text-center border-bottom p-3">{{__('common.status')}}</th>
                                            <th class="text-center border-bottom p-3" >{{__('common.action')}}</th>
                                             <thead>`;

                        $.each(result.seotasklist, function(key, value) {
                           
                            if(value.id == seo_task_id || seo_task_id == '0'){ 
                                 // console.log(value.id);
                                //console.log(value.seo_task_title);
                                html+=  `<tr>
                                        <td>${value.seo_task_title}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>`;

                                    $.each(result.seosubmissionwebsites, function(seosubmissionlist, seosubmission) {
                                        // console.log(seosubmission.website_id);
                                        // console.log(seosubmission.seo_task_id);
                                        //console.log(editUrl);
                                    if(value.id == seosubmission.seo_task_id){
                                        var id = [seosubmission.id, seosubmission.website_id, seosubmission.seo_task_id];
                                        var editUrl = 'submission/'+id+'/edit';
                                        var deleteUrl=seosubmission.id;
                                        //console.log(seosubmission.id);
                                        html+=
                                        `<tr>
                                        <td><input type="hidden" value="${seosubmission.website_id}">
                                        <input type="hidden" value="${seosubmission.seo_task_id}"></td>
                                        
                                        <td class="text-break">${seosubmission.website_url}</td>
                                        <td>${seosubmission.website_username}</td>
                                        <td>${seosubmission.website_password}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input data-id="${seosubmission.id}"
                                                class="form-check-input toggle-class" id="toggle-class" type="checkbox"
                                                data-toggle="toggle" data-on="Active" data-off="InActive"${ seosubmission.status == 1 ? 'checked' : '' }>
                                            </div>
                                        </td>

                                        <td class="d-flex ">
                                            <a href="${editUrl}" class="btn btn-primary btn-xs btn-icon table_btn"><i class="uil uil-edit"></i></a>

                                            <button type="button" id="delete_btn" value="${ deleteUrl}"
                                            class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button> 
                                        </td>
                                        </tr>`;
                                    }
                                    });

                            } 
                            
                        });


                         html+=`</table>
                                </div>`;
                        
                        $("#seo_title").html(html);
                                         
                     }
                     
                });

        }
    </script>
    

    @endpush             
</x-app-layout> 