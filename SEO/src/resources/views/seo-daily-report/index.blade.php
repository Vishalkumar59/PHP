@php
$indexurl = Request::segment(1);
$role = App\Helper\Helper::role_slug();
@endphp
<style>
    .pull-left button {
        float: right;
        margin: 1rem 0 0.6rem;
    }

    .btns {
        margin: 0 10px !important;
    }

    .table_btn {
        margin: 0 4px;
    }
</style>
<x-app-layout>
        {{-- @foreach ($countrylist as $country)
         
            {{ $country }}
            @dd($country);
          @endforeach
        @endforeach --}}
    @push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    @endpush

    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div
                                class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">{{ __('seo.daily_work') }}</h5>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded">
                                <table class="table table-center bg-white mb-0" id="table">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom px-3">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom px-3" style="min-width: 150px;">{{
                                                __('seo.website_name') }}</th>
                                            <th class="border-bottom px-3" style="min-width: 150px;"> {{
                                                __('seo.website_url') }}</th>
                                            <th class=" border-bottom px-3" style="min-width: 80px;">{{ __('seo.country') }}</th>
                                            <th class="text-center border-bottom px-3" style="min-width: 150px;">{{ __('seo.start_date') }}</th>
                                            <th class="text-center border-bottom px-3">{{ __('common.status') }}</th>
                                            @if($role == "super_admin")
                                            <th class="text-center border-bottom px-3">{{ __('common.action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if(!empty($website_listing))
                                        @foreach($website_listing as $key => $web)
                                        <tr>
                                            <td class="px-3">{{$key+1}}</td>
                                            <td class="px-3">{{$web->website_name}}</td>
                                            <td class="px-3">{{$web->website_url}}</td>
                                            <td class="px-3">@if(!empty($web->Country->countries_name)){{$web->Country->countries_name}}@endif</td>
                                            <td class="px-3">{{$web->start_date}}</td>
                                            <td class="px-3" >
                                                

                                            <div class="form-check form-switch">
                                                <input data-id="{{$web->id}}"
                                                class="form-check-input toggle-class" type="checkbox"
                                                data-toggle="toggle" data-on="Active" data-off="InActive" {{ $web->status ? 'checked' : '' }}>
                                            </div>
                                            </td>

                                            
                                            @if($role == "super_admin")
                                            <td >
                                                <div class="d-flex align-items-center px-3">
                                                <a href="{{url('daily-work/'.$web->id.'/edit')}}"
                                                    class="btn btn-primary   table_btn">{{ __('common.update') }}</a>

                                                </div>
                                            </td>
                                            @endif

                                        </tr>
                                        @endforeach
                                        @endif
                                        <!-- End -->

                                    </tbody>
                                </table>
                            </div>


                            <div class="row text-center">
                                <!--paginaion open -->
                                {{-- <div class="row text-center px-2  mb-4" id="reload_pagination_contact">
                                    <div class="col-12 mt-4">
                                        <div class="d-md-flex align-items-center text-center justify-content-between">
                                            <span class="text-muted me-3">Showing {{$website_listing->currentPage();}} -
                                                {{$website_listing->lastItem();}} out of {{$website_listing->total()}}</span>
                                            <ul class="pagination mb-0 justify-content-center mt-4 mt-sm-0">
                                                {{ $website_listing->links() }}
                                            </ul>
                                        </div>
                                    </div>
                                </div> --}}
                                <!--paginaion close -->
                                <!-- PAGINATION END -->
                            </div>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end container-->
        </div>
    </div>

    @push('scripts')
   {{--  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script> --}}


    <script type="text/javascript">
          //  website status ajax start
        $('.toggle-class').change(function () {
            let status = $(this).prop('checked') === true ? 1 : 0;
            let website_id = $(this).data('id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{route('dailyWorkStatus')}}",
                data: { 'status': status, 'website_id': website_id },
                success: function (response) {
                   // console.log(response);
                   Toaster(response.success);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>