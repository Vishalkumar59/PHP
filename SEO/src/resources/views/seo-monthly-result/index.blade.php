@php
$indexurl = Request::segment(1);
$role = App\Helper\Helper::role_slug();
@endphp
<x-app-layout>
    <div class="container-fluid">
        <div class="layout-specing">
            <form  id="save-website-data"  class="row g-3 needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-12 col-lg-12 ">
                        <div class="card rounded shadow ">
                            <div class=" border-0 quotation_form px-3 py-1">
                                    <div class="m-2 position-relative d-flex align-items-center justify-content-between">
                                                <div class="mb-0 position-relative d-flex">

                                                    <p class="mb-0 pr-3 f-14 d-flex text-dark-grey align-items-center">
                                                        {{ __('seo.website') }}</p>
                                                    <select class=" form-control mx-3" name="website_id"
                                                        id="website_id" required>
                                                        <option selected="" value="" disabled>{{ __('seo.select') }}</option>
                                                        @foreach ($web_setting as $web)
                                                        <option data-content="{{ ucfirst($web->website_name) }}"
                                                            value="{{ $web->id }}">{{
                                                            ucfirst($web->website_name) }}</option>
                                                        @endforeach
                                                    </select>

                                                    <p class="mb-0 pr-3 f-14 d-flex text-dark-grey align-items-center">
                                                        {{ __('seo.month') }}</p>
                                                    <select class="form-select form-control mx-3" name="month"
                                                        id="month" required>
                                                        <option selected="" value="" disabled>select</option>
                                                        <option @if ($month=='1' ) selected @endif value="1">{{
                                                            __('seo.january') }}</option>
                                                        <option @if ($month=='2' ) selected @endif value="2">{{
                                                            __('seo.february') }}</option>
                                                        <option @if ($month=='3' ) selected @endif value="3">{{
                                                            __('seo.march') }}</option>
                                                        <option @if ($month=='4' ) selected @endif value="4">{{
                                                            __('seo.april') }}</option>
                                                        <option @if ($month=='5' ) selected @endif value="5">{{
                                                            __('seo.may') }}</option>
                                                        <option @if ($month=='6' ) selected @endif value="6">{{
                                                            __('seo.june') }}</option>
                                                        <option @if ($month=='7' ) selected @endif value="7">{{
                                                            __('seo.july') }}</option>
                                                        <option @if ($month=='8' ) selected @endif value="8">{{
                                                            __('seo.august') }}</option>
                                                        <option @if ($month=='9' ) selected @endif value="9">{{
                                                            __('seo.september') }}</option>
                                                        <option @if ($month=='10' ) selected @endif value="10">{{
                                                            __('seo.october') }}</option>
                                                        <option @if ($month=='11' ) selected @endif value="11">{{
                                                            __('seo.november') }}</option>
                                                        <option @if ($month=='12' ) selected @endif value="12">{{
                                                            __('seo.december') }}</option>
                                                    </select>
                                                    <p class="mb-0 pr-3 f-14 d-flex text-dark-grey align-items-center">
                                                        {{ __('seo.year') }}</p>
                                                    <select class="form-select form-control mx-3" name="year" id="year" required>
                                                        <option selected="" value="" disabled>{{ __('seo.select') }}</option>

                                                        @for($i = 2021; $i<= $year; $i++) <option {{$year==$i
                                                            ? 'selected' : '' }}>{{$i}}</option>

                                                            @endfor
                                                    </select>
                                                    



                                                </div>
                                                
                                        {{-- <button  type="submit" id="get_details" class="btn m-0 ms-5 my-1 btn-primary get_details">Get Details</button> --}}


                                        <input type="submit" id="get_details" class="btn m-0 ms-5 my-1 btn-primary get_details" value="Get Details">
                                    
                                    



                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12 my-0">
                        <div class="card rounded shadow pb-1">
                            <div class="p-4" id="show_no_record">
                                <div id="table_bind">
                                    <h5 class="text-center mb-0">{{ __('seo.record_not_found') }}</h4>
                                </div>

                                @if($role == 'super_admin')
                                <div class="mb-3 tab_table d-none" id="date-hide">
                                    {{-- <button type="sumit" class="btn btn-primary website-form mt-3">Update</button> --}}

                                    <input type="submit"  class="btn btn-primary website-form mt-3" value="Update">
                                </div>
                                @elseif($role == 'editor')
                                <div class="mb-3 tab_table d-none" id="date-hide">
                                    {{-- <button type="sumit" class="btn btn-primary website-form mt-3">Update</button> --}}

                                    <input type="submit"  class="btn btn-primary website-form mt-3" value="Update">
                                </div>
                                @else
                                
                                @endif
                          
                            </div>
                            <!--end col-->
                            {{-- @if($role == "super_admin") --}}
                            
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <!--end container-->






    @push('scripts')

  
    <script>

            $(document).ready(function() {
                $('.get_details').on('click', function(e) {
                    e.preventDefault();
                    var data = {
                        website_id: $("#website_id").val(),
                        month: $("#month").val(),
                        year: $("#year").val(),

                    };
                    if(data.website_id != null){
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('get-monthly-result') }}",
                        data: data,
                        dataType: "json",
                        success: function(response) {
                            console.log(response);
                        
                            var html = `<table class="table table-center bg-white mb-0">
                                        <thead>
                                            <tr>
                                                <th class="  border-bottom p-3 col-sm-4">{{ __('seo.title') }}</th>
                                                <th class=" text-centerborder-bottom p-3 col-sm-4">{{
                                                    __('seo.sub_title') }}</th>
                                                <th class=" text-centerborder-bottom p-3 col-sm-2">{{
                                                    __('common.result') }}</th>
                                            </tr>
                                        </thead><tbody>`; 


                    $.each(response.seo_title, function(key, parentData) {

                        html += `<tr>
                                    <td>${parentData.title_name}</td>
                                    <td></td>
                                    <td></td>
                                </tr>`;
                        if (parentData.child != '') {
                            $.each(parentData.child, function(childKey, child) {
                               
                               
                             
                                if (parentData.id == child.parent_id) {
                                    var result_value = '';
                                    if (child.id != null)
                                    result_value = response.seo_result[child.id];
                                  
                             html += `<tr>
                                        <td></td>
                                        <td>${child.title_name} </td>
                                        <td>`;
                            if(response.editable == '1'){

                            html += `<input type="number" id="result_value${child.id}"class="w-75  result_value" name="result_change${child.id}" value="${result_value == undefined ? '' : result_value}">
                                                    <input type="hidden" name="title_id[]" value="${child.id}">`;
                                 
                            }else{
                             html += `${result_value == undefined ? '' : "<span style='color:black;font-weight:bold;'>"+result_value+"</span>"}`;
                            }
                            html += `</td>
                                    </tr>`;
                                }
                            });
                        }
                    });
                        html += `</tbody>
                         </table>
                         `;
                         $('#date-hide').removeClass("d-none");
                         $("#table_bind").html(html);
                       
                        }
                    });
                    }else{
                        toastr.error('Please Select Website');
                    }
                   
                    
                });
            });
    </script>

    <script>
       
$('.website-form').on('click', function(e) {
            e.preventDefault();
    const url = "{{ route('save-website-update') }}";
    $.ajax({
        url: url,
        container: '#save-website-data',
        type: "POST",
        data: $('#save-website-data').serialize(),
        success: function(response) {
            if(response.success)
            {
                Toaster(response.success);
            }else{
                toastr.error(response.error);
            }
           
            
            // location.reload();
        }
    })
});
    

</script>

    @endpush
</x-app-layout>