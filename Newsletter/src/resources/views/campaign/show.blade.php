<x-app-layout>

    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row">
                <div class="col-md-12 col-lg-12 my-0">
                    <div class="card rounded shadow pb-1">
                        <div class=" border-0 quotation_form">
                            <div class="card-header py-3 bg-transparent d-flex align-items-center justify-content-between">
                                <h5 class="tx-uppercase tx-semibold mg-b-0">{{ __('campaign.campaign_list') }}</h5>
                                <div>
                                    <button class="btn btn-md btn-primary" id="add_modal"><i data-feather="plus" class="lead_icon mg-r-5"></i>{{ __('campaign.add_campaign') }}</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mt-1">
                            <div class="table-responsive shadow rounded" id="department">
                                <table class="table table-center bg-white mb-0">
                                    <thead>
                                        <tr>
                                            <th class="border-bottom p-3">{{ __('common.sl_no') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.name') }}</th>
                                            <th class="border-bottom p-3">{{ __('campaign.subject') }}</th>
                                            {{-- <th class="border-bottom p-3">{{ __('campaign.template') }}</th> --}}
                                            {{-- <th class="border-bottom p-3">{{ __('campaign.smtp') }}</th> --}}
                                            <th class="border-bottom p-3">{{ __('campaign.group') }}</th>
                                            <th class=" border-bottom p-3">{{ __('common.status') }}</th>
                                            <th class="text-center border-bottom p-3">{{ __('common.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Start -->
                                        @if(!empty($Campaign_list))
                                        @foreach($Campaign_list as $key=>$campaign)
                                        <tr>
                                            <td class="p-3">{{$key+1}}</td>
                                            <td class="p-3">{{$campaign->name}}</td>
                                            <td class="p-3">{{$campaign->subject}}</td>
                                            {{-- <td class="p-3">@if(!empty($campaign->template->subject)){{$campaign->template->subject}}@endif</td> --}}
                                            {{-- <td class="p-3">@if(!empty($campaign->SMTPServer->driver)){{$campaign->SMTPServer->driver}}@endif</td> --}}
                                            <td class="p-3">@if(!empty($campaign->GroupList->name)){{$campaign->GroupList->name}}@endif</td>

                                            <td class="p-3">
                                                <div class="form-check form-switch">
                                                    <input data-id="{{$campaign->id}}" class="form-check-input toggle-class" type="checkbox" data-toggle="toggle" data-on="Active" data-off="InActive" {{
                                                        $campaign->status ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td class="text-center d-flex justify-content-center p-3">
                                                <a href="{{route('campaign-view')}}" class="btn btn-primary btn-xs btn-icon view_btn"><i class="uil uil-eye"></i></a>
                                                <button class="btn btn-primary btn-xs btn-icon table_btn edit_temp_btn " id="editmodal" value="{{$campaign->id}}" data-toggle="modal" data-target="#designation_edit"><i class="uil uil-edit"></i></button>
                                                <button type="button" id="delete_btn" value="{{$campaign->id}}" class="btn btn-danger btn-xs btn-icon"><i class="uil uil-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody><!-- End -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</x-app-layout>