@extends("layouts.backend.master")
@section('title', 'Admin Shift')
@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Category Table</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Category List</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" id="check-all" class="flat">
                                        </th>
                                        <th class="column-title">Name </th>
                                        <th class="column-title">Pareant Category </th>
                                        <th class="column-title">Status </th>
                                        <th class="column-title">Image </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach ($categories as $category)
                                    <tr class="even pointer">
                                        <td class="a-center ">
                                            <input type="checkbox" class="flat" name="table_records">
                                        </td>
                                        <td class=" ">{{$category->name}}</td>
                                        <td class=" ">{{$category->parent_name}}</td> <!-- Display parent category name -->
                                        <td class=" ">
                                            @if ($category->status == 0)
                                            <span class="badge badge-primary">enable</span>
                                        @else
                                            <span class="badge badge-secondary">disable</span>
                                        @endif

                                        </td>
                                        <td class=" ">
                                            <div style="width: 100px; height: 100px;overflow:hidden">
                                                <img src="{{ asset('storage/upload/category/' . $category->id . '/' . $category->image) }}" style="width: 100%" alt="Image">

                                            </div>

                                        </td>
                                        <td class=" last">
                                            <a href="{{url('sg-backend/category/edit/' . $category->id)}}" class="btn btn-info btn-xs"><i
                                                    class="fa fa-pencil"></i> Edit
                                            </a>
                                            <form action="{{ url('sg-backend/category/delete') }}" method="POST" id="deleteForm">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <button type="button" class="btn btn-danger btn-xs" onclick="confirmDelete()">
                                                    <i class="fa fa-trash-o"></i>
                                                    Delete
                                                </button>
                                            </form>


                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


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
