<style>
</style>
<x-app-layout>
   
    <!-- Top Header -->
    <div class="container-fluid">
        <div class="layout-specing">
            <div class="row fieldset_form">
                <div class="col-lg-12 mt-4">
                    <div class="card border-0 rounded shadow ">
                        <div class="card-header bg-transparent px-4 py-2">
                            <h5 class="text-md-start text-center mb-0">{{__('newsletter.update_template_list')}}</h5>
                        </div>
                        <form action="{{ route('template-list.update', $template->id) }}" id="update_userForm"
                            method="POST" class="needs-validation" novalidate>
                            @csrf
                            {{method_field('put')}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3 ps-3">
                                        <label class="form-label">{{ __('newsletter.subject')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                        <div class="form-icon position-relative">
                                            <input name="subject" id="update_subject" value="{{ $template->subject }}"
                                                type="text" class="form-control"
                                                placeholder="{{ __('newsletter.subject_placeholder')}}" required>
                                            <div class="invalid-feedback">
                                                {{ __('newsletter.subject_error')}}
                                            </div>
                                            <span style="color:red;">
                                                @error('subject')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                            <br>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('newsletter.group_list')}}
                                            <span class="text-danger">*
                                            </span>
                                        </label>
                                            <select class="form-select form-control" id="group_list" name="group_list"
                                                required>
                                                <option selected disable value="" disabled>{{ __('newsletter.select_group') }}</option>
                                                @if(!empty($template_group_list))
                                                @foreach ($template_group_list as $group_list)
                                                    <option value="{{ $group_list->id }}"{{$edittemplategroup->id == $group_list->id  ? 'selected' : ''}}> {{ $group_list->group_name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <span style="color:red;">
                                                @error('source_id')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                            <div class="invalid-feedback">
                                            {{ __('newsletter.select_error_group') }}
                                            </div>
                                        
                                    </div>
                                </div><!--end col-->  

                            </div>
                            <div class="mb-3 ps-3 ">
                                <label class="form-label">{{ __('settings.templates_content')}}<span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative" id="outer_div">
                                    <textarea cols="80" rows="10" name="content" id="editor"
                                        class="form-control document" required>{{$template->content}}</textarea>

                                    <div class="invalid-feedback">
                                        {{ __('settings.template_contect_error')}}
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                            <div class="row ">
                                <div class="col-sm-12 pt-3 ps-4" required>
                                    <input type="submit" id="update_btn" name="send" class="btn btn-primary"
                                        value="{{ __('common.update')}}">
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        @push('scripts')
        <script type="text/javascript" src="{{asset('assets/js/ckeditor.js')}}"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
        </script>
        @endpush
</x-app-layout>