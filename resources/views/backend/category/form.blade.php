@extends("layouts.backend.master")
@section('title', isset($category) ? 'Category Update' : 'Category Create')
@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Category</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @if(isset($category))
                        <form action="{{route('updateFormCategory')}}" method="POST" enctype="multipart/form-data" novalidate>
                        <input type="hidden" name="id" value="{{$category->id}}">
                        @else
                        <form action="{{route('storeFormCategory')}}" method="POST" enctype="multipart/form-data" novalidate>
                        @endif

                            @csrf
                            <span class="section">{{ isset($category) ? 'Category Update' : 'Category Create'}}</span>
                            <div class="field item form-group">
                                <label for="name" class="col-form-label col-md-3 col-sm-3  label-align">Category
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    @if(isset($category))
                                    <input id="name" class="form-control" name="name" value="{{old('name', isset($category->name) ? $category->name : '')}}" />
                                    @else
                                    <input id="name" class="form-control" name="name" value="{{old('name')}}" />
                                    @endif

                                    @if ($errors->has('name'))
                                        <span class="error">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Category List<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="select2_group form-control" name="parent_id">
                                        <option value="">Choose Category</option>

                                        <option value="0" {{ isset($category) ? ($category->parent_id == 0 ? 'selected' : '') : '' }}>Parent Category</option>
                                        {{getParentCategory(old('parent_id', isset($category) ? $category->parent_id : ''))}};
                                    </select>
                                    @if ($errors->has('parent_id'))
                                        <span class="error">{{$errors->first('parent_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="select2_group form-control" name="status">
                                        <option value="0" {{ isset($category) ? ($category->status == 0 ? 'selected' : '') : ''}}>Enable</option>
                                        <option value="1"  {{ isset($category) ? ($category->status == 1 ? 'selected' : '') : ''}}>Disable</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label for="image" class="col-form-label col-md-3 col-sm-3  label-align">
                                    Category Item Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <div id="preview-wrapper" style="display:{{isset($category) ? 'none' : 'block'}}">
                                            <div class="vertical-center">
                                                <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                    File</label>
                                            </div>
                                        </div>
                                        <div id="preview-wrapper-img" style="display:{{isset($category) ? 'block' : 'none'}}">
                                            <div class="vertical-center">
                                                <img src="{{ isset($category) ? asset('storage/upload/category/' . $category->id . '/' . $category->image) : '' }}" id="image-preview" style="width:100%">
                                                <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                    File</label>
                                            </div>
                                        </div>
                                        @if ($errors->has('image'))
                                            <span class="error">{{$errors->first('image')}}</span>
                                        @endif
                                    </div>
                                <input class="hide img-upload" type="file" name="image" accept="image/*" onchange='SelectFile(this)' />
                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                        <button type='reset' class="btn btn-success">Reset</button>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.backend.partial.footer_start')
@include('layouts.backend.partial.footer_end')

<script>
    function fileBrowse() {
        $('.img-upload').click();
    }

    function SelectFile(input) {
        const file = input.files[0];

        if (file) {
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
            // Check if the selected file type is in the allowedTypes array
            if (!allowedTypes.includes(file.type)) {

                alert("Only JPG, JPEG, PNG, and webp files are allowed!");
            } else {
                let reader = new FileReader();
                reader.onload = function(e) {
                    var imageDataUrl = e.target.result;
                    $('#image-preview').attr('src', imageDataUrl);
                }
                reader.readAsDataURL(file);
                $('#preview-wrapper').hide();
                $('#preview-wrapper-img').show();
            }
        }
    }
    </script>
@include('layouts.backend.partial.html_end')
@endsection
