<x-app-layout>
        <!-- Top Header -->
        <div class="container-fluid">
            <div class="layout-specing">
                <div class="row fieldset_form">
                    <div class="col-lg-12">
                        <div class="card border-0 rounded shadow p-4">
                            <div class="card-header bg-transparent px-4 py-2">
                                <h5 class="text-md-start text-center mb-0">{{__('campaign.update_campaign')}}</h5>
                            </div>
                              
                            <form action="{{ route('campaign.update', $edit_campaign->id) }}"  method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                {{method_field('put')}}
                               
                                {{-- <input type="hidden" name="campaign_hidden_id" id="campaign_hidden_id"> --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('campaign.campaign_name') }}<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input name="edit_name" id="edit_name" type="text" class="form-control" value="{{$edit_campaign->campaign_name}}"
                                                    placeholder="{{ __('campaign.campaign_name_placeholder') }}">
                                                <span style="color:red;">
                                                    @error('designation_name')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{ __('campaign.campaign_name_error') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('campaign.campaign_subject') }}<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <input name="edit_subject" id="edit_subject" type="text" class="form-control" value="{{$edit_campaign->campaign_subject}}"
                                                    placeholder="{{ __('campaign.campaign_subject_placeholder') }}" >
                                                <span style="color:red;">
                                                    @error('designation_name')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{ __('campaign.campaign_subject_error') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('campaign.template')}}<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <select class="form-select form-control" name="edit_template"
                                                    id="edit_template" aria-label="Default select example" >
                                                    <option selected disabled value="">
                                                        {{__('campaign.select_template')}}
                                                    </option>
                                                    @foreach($template_list as $template)
                                                    @if(!empty($template->subject))
                                                    <option value="{{$template->id}}" {{ $template->id == $edit_campaign->template_id ? 'selected' : '' }}>
                                                        {{$template->subject}}
                                                    </option>
                                                    @endif
                                                    @endforeach
            
                                                </select>
                                                <span style="color:red;">
                                                    @error('stutas')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('campaign.template_error')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('campaign.smtp_server')}}<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <select class="form-select form-control" name="edit_smtp_server" id="edit_smtp_server"
                                                    aria-label="Default select example" >
                                                    <option selected disabled value="">
                                                        {{__('campaign.smtp_error')}}
                                                    </option>
                                                    @foreach($server_mail as $smtp_server)
                                                    @if(!empty($smtp_server->driver))
                                                    <option value="{{$smtp_server->id}}" {{ $smtp_server->id == $edit_campaign->smtp_server_id ? 'selected' : '' }}>
                                                        {{$smtp_server->driver}}
                                                    </option>
                                                    @endif
                                                    @endforeach
            
                                                </select>
                                                <span style="color:red;">
                                                    @error('stutas')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('campaign.smtp_error')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                   

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{__('campaign.campaign_group')}}<span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <select class="form-select form-control group edit_group select2" multiple="" name="edit_group[]" id="edit_group"
                                                    aria-label="Default select example" >
                                                   
                                                    @foreach($contactgroup as $group)
                                                    @php
                                                    $selected = '';
                                                    foreach($arraygroup as $adminrole){
                                                        if($adminrole == $group->id){
                                                            $selected ='selected';
                                                        }
                                                    }
            
                                                    @endphp
            
            
                                                    <option value="{{$group->id}}" {{$selected}}>
                                                        {{$group->group_name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span style="color:red;">
                                                    @error('stutas')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('campaign.group_error')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="form-icon position-relative">
                                                <label class="form-label">{{__('campaign.description')}}<span
                                                        class="text-danger">*</span></label>
                                                <textarea name="edit_description" id="edit_description"
                                                     class="form-control"
                                                    cols="82" rows="3" >{{$edit_campaign->description}}</textarea>
                                                <span style="color:red;">
                                                    @error('stutas')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                <div class="invalid-feedback">
                                                    {{__('campaign.description_error')}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              
                                
                                <!--end row-->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" id="update_btn" class="btn btn-primary"
                                                value="{{__('common.update')}}">
                                        </div>
                                    </div>
                                    <!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--end col-->
            @push('scripts')
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function(){
             
              $('#edit_group').select2();
              // Set option selected onchange
              $('#user_selected').change(function(){
                var value = $(this).val();
              
                // Set selected 
                $('#edit_group').val(value);
                $('#edit_group').select2().trigger('change');
              
              });
              });
              </script>
            @endpush
   
</x-app-layout>