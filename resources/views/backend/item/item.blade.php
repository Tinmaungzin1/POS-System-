@extends("layouts.backend.master")
@section('title', isset($item) ? 'Item Update' : 'Item Create')
@section('content')

{{-- {{ dd($item);}} --}}
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Item</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        @if(isset($item))
                        <form action="{{route('updateFormItem')}}" method="POST" enctype="multipart/form-data"
                            novalidate>
                            <input type="hidden" name="id" value="{{$item->id}}">
                        @else
                        <form action="{{route('storeFormItem')}}" method="POST" enctype="multipart/form-data"
                            novalidate>
                        @endif
                            @csrf
                            <span class="section">{{isset($item) ? 'Item Update' : 'Item Create'}}</span>
                            <div class="field item form-group">
                                <label for="name" class="col-form-label col-md-3 col-sm-3  label-align">Item
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="name" class="form-control" name="name" value="{{old('name', isset($item) ? $item->name : '')}}" />
                                    @if ($errors->has('name'))
                                        <span class="error">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Category List<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="select2_group form-control" name="category_id">
                                        <option value="">Choose Category</option>
                                        <option value="0" {{ isset($item) ? ($item->category_id == 0 ? 'selected' : '') : '' }}>Parent Category</option>
                                        {{getParentCategory(old('category', isset($item) ? $item->category_id : ''), true)}};
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="error">{{$errors->first('category_id')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label id="price" class="col-form-label col-md-3 col-sm-3  label-align">Price<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="price" class="form-control" type="number" value="{{old('price', isset($item) ? $item->price : '')}}"
                                        class='number' name="price">
                                        @if ($errors->has('price'))
                                        <span class="error">{{$errors->first('price')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label id="quantity" class="col-form-label col-md-3 col-sm-3  label-align">Quantity
                                    <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="quantity" type="number" value="{{old('quantity', isset($item) ? $item->quantity : '')}}"
                                        class='number' name="quantity">
                                        @if ($errors->has('quantity'))
                                        <span class="error">{{$errors->first('quantity')}}</span>
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
                                        <div id="preview-wrapper" style="display:{{isset($item) ? 'none' : 'block'}}">
                                            <div class="vertical-center">
                                                <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                    File</label>
                                            </div>
                                        </div>
                                        <div id="preview-wrapper-img" style="display:{{isset($item) ? 'block' : 'none'}}">
                                            <div class="vertical-center">
                                                <img src="{{ isset($item) ? asset('storage/upload/item/' . $item->id . '/' . $item->image) : '' }}" id="image-preview" style="width:100%">
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
