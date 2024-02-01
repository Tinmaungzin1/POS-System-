@extends("layouts.backend.master")
@section('title', 'Admin Shift')
@section('content')


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
                        <form action="" method="POST" enctype="multipart/form-data"
                            novalidate>
                            <span class="section">Item Create</span>
                            <div class="field item form-group">
                                <label for="name" class="col-form-label col-md-3 col-sm-3  label-align">Item
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="name" class="form-control" name="name" value="" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Category List<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select class="select2_group form-control" name="category_id">
                                        <option value="">Choose Category</option>
                                        <option value="0" >
                                            Parent Category</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label id="price" class="col-form-label col-md-3 col-sm-3  label-align">Price<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="price" class="form-control" type="number" value=""
                                        class='number' name="price">
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label id="quantity" class="col-form-label col-md-3 col-sm-3  label-align">Quantity
                                    <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="quantity" type="number" value=""
                                        class='number' name="quantity">
                                </div>
                            </div>


                            <div class="field item form-group">
                                <label for="image" class="col-form-label col-md-3 col-sm-3  label-align">
                                    Category Item Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div id="preview-wrapper">
                                        <div class="vertical-center">
                                            <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                File</label>
                                        </div>
                                    </div>
                                    <div id="preview-wrapper-img" style="display:none;">
                                        <div class="vertical-center">
                                            <img src="" id="image-preview" style="width:100%">
                                            <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                File</label>
                                        </div>
                                    </div>
                                </div>
                                <input class="hide img-upload" type="file" name="file" onchange='SelectFile(this)' />

                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
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


@include('layouts.backend.partial.html_end')
@endsection
