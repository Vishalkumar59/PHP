@php
$indexurl = Request::segment(1);
$role = App\Helper\Helper::role_slug();
@endphp
<x-app-layout>

    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row mb-3">
                <div class="col-md-12 col-lg-12 ">
                    <div class="card rounded shadow ">
                        <div class=" card-header quotation_form bg-white rounded py-2">
                                <div class="position-relative  d-flex justify-content-between" >
                                    <div class="mb-0 position-relative d-flex" >
                                    <p class="mb-0 pr-3 f-14 d-flex text-dark-grey align-items-center">{{ __('seo.date') }}</p>
                                    <input type="text" id="datatableRange" name="datatableRange" class="form-control mx-3" placeholder="Start Date To End Date"/> 
                                    
                                    <p class="mb-0 pr-3 f-14 d-flex text-dark-grey align-items-center">{{ __('seo.website') }}</p>
                                    <select class="form-select form-control mx-3"   name="website_name" id="website_name">
                                        <option selected value="" >{{ __('seo.all_website') }}</option>

                                        @foreach ($seo_task as $key=> $website)

                                        <option value="{{$website->id}}">{{($website->website_name)}}</option>
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
                                <h5 class="mb-0">{{ __('seo.work_report') }}</h5>
                                @if($role == "super_admin")
                                <div class="pull-left">
                                    <a href="{{route('work-report.import')}}">
                                        <button class="btn btn-primary btns"> {{ __('seo.import') }}</button>
                                    </a>
                                </div>
                                @endif
                            </div>  
                        </div>
                        <div class="p-4">
                            <div>                     
                                <div class="s-b-n-header allWebsite" id="website_listing">
                                    <h5 class="text-center mb-0">{{ __('seo.record_not_found') }}</h5>
                                </div>
                            </div><!--end col-->
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div><!--end container-->  



    



@push('scripts')

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>


    <script type="text/javascript">
        $(document).ready(function() {
                inputData();
        });
        $(function() {
            // tableWebContent();
            

                var start = moment();
                var end = moment();
               
                function cb(start, end) {
                    $('#datatableRange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    
                }

                $('#datatableRange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last 6 Month': [moment().subtract(6, 'month'), moment()],
                    'Last Year': [moment().subtract(1, 'year'), moment()]
                    },
                    locale: {
                    format: 'YYYY-MM-D'
                    }
                }, cb);

                cb(start, end);


            });


        $(document).ready(function() {
            
            const website_id = $('#website_name').val();
           

           
            $('#datatableRange,#website_name').on('change', function(e,data) { 
                
                var dateRangePicker = $('#datatableRange').data('daterangepicker');
                var startDate = $('#datatableRange').val();
                var website_id = $('#website_name').val();
               
                if (startDate == '') {
                    startDate = null;
                    endDate = null;
                } else {
                    startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                }
            
            
                if(startDate != '' && website_id != '' && endDate != '')
                $("#website_listing").html('');

        

                $('#reset-filters').click(function() {
                    $('#filter-form')[0].reset();
                    $('.filter-box .select-picker').selectpicker("refresh");
                    $('#reset-filters').addClass('d-none');  
                });

            $("#website_listing").html('');

            
            tableWebContent(website_id,startDate,endDate);
                
            });
        });


            function tableWebContent(website_id,startDate,endDate){
                    
            const url = "{{ route('work-report-url') }}";
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        website_id:website_id,
                        startDate:startDate,
                        endDate:endDate,                  

                    },
                    dataType: "json",                              
                   success: function(result) {
                   
             
                       
                             
                    var html=   `
                                <div class="table-responsive p-20">
                                <table class="table table-center bg-white mb-0">
                               
                                <thead>
                                <th class="border-bottom p-3" style="">Date</th>
                                <th class="border-bottom p-3" style="">Task</th>
                                                                  
                                <th class=" border-bottom" style="">Posting URL</th>
                                <th class=" border-bottom ">Landing URL</th>
                                <thead>
                                    `;
                    
                      console.log(result);
                        $.each(result.work_report, function(key, value) {

                            // console.log(value.seo_setting.seo_task_title);
                                // if(value.website_id == website_id ||website_id != ''){
                            if(result.work_report != ''){
                                
                                html +=  `<tr>
                                        <td>${value.formattedDate}</td>
                                        <td>${value.seo_setting.seo_task_title}</td>
                                        <td>${(value.submission_website != null) ? value.submission_website.website_url : ''}</td>
                                        <td>${value.landing_url}</td>
                                        </tr>`;
                                
                            }else{
                                    html += `<tr>
                                        <td>no record found</td>
                                        </tr>`;
                                }
                        });
                 
                    html +=`</table>
                        </div>`;
            
                $("#website_listing").html(html);
                                         
                   
                    }
            
                });

        }

        function inputData(){
            var website_id = '';
            // alert(startDate);
            var currentDate = new Date();
               
                function pad2(n) {
                  return (n < 10 ? '0' : '') + n;
                }
                var date = new Date();
                var month = pad2(date.getMonth()+1);//months (0-11)
                var day = pad2(date.getDate());//day (1-31)
                var year= date.getFullYear();

                var formattedDate =  year+"-"+month+"-"+day;

             const url = "{{ route('work-report-url') }}";
            $.ajax({
                    url:url,
                    type: "POST",
                    data: {
                        website_id:website_id,
                        startDate:formattedDate,                 

                    },
                    dataType: "json",                              
                   success: function(result) {
                    // console.log(result);
                        
                     var html=   `
                                <div class="table-responsive p-20">
                                <table class="table table-center bg-white mb-0">
                               
                                <thead>
                                <th class="border-bottom px-3" style="width:150px">Date</th>
                                <th class="border-bottom px-3" style="width:150px">Task</th>
                                                                  
                                <th class=" border-bottom px-3" style="width:150px">Posting URL</th>
                                <th class=" border-bottom px-3">Landing URL</th>
                                <thead>
                                    `;
                        
                      
                        $.each(result.work_report, function(key, value) {
                           
                                // if(value.website_id == website_id ||website_id != ''){
                            
                                html +=  `<tr>
                                        <td class="px-3">${value.formattedDate}</td>
                                        <td class="px-3">${value.seo_setting.seo_task_title}</td>
                                       
                                        <td class="px-3">${(value.submission_website != null) ? value.submission_website.website_url : ''}</td>
                                        <td class="px-3">${value.landing_url}</td>
                                        </tr class="px-3">`;
                                
                        });
                        $(".allWebsite").html(html);
                        
                   
                   }
            });
        }
</script>
@endpush        
</x-app-layout> 