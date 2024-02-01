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
                                        <th class="column-title">Category id </th>
                                        <th class="column-title">Price</th>
                                        <th class="column-title">Quantity</th>
                                        <th class="column-title">Code Number</th>
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

                                    @foreach ($items as $item)

                                    <tr class="even pointer">
                                        <td class="a-center ">
                                            <input type="checkbox" class="flat" name="table_records">
                                        </td>
                                        <td class="">{{$item->name}}</td>
                                        <td class=" ">{{$item->category_id}}</td>
                                        <td class=" ">{{$item->price}}</td>
                                        <td class=" ">{{$item->quantity}}</td>
                                        <td class=" ">{{$item->code_no}}</td>
                                        <td class=" ">
                                            @if($item['status'] == 0)
                                                <span class="badge badge-primary">enable</span>
                                            @else
                                                <span class="badge badge-secondary">disabled</span>
                                            @endif
                                        </td>
                                        <td class=" ">
                                            <div>
                                                <img src="{{asset('storage/upload/item/' . $item->id . '/' . $item->image)}}"
                                                    style="width: 100px; height: auto; object-fit: cover;">

                                            </div>
                                        </td>
                                        <td class=" last">
                                            <a href="{{url('sg-backend/item/edit/' . $item->id)}}" class="btn btn-info btn-xs"><i
                                                    class="fa fa-pencil"></i> Edit
                                            </a>
                                            <form action="{{ url('sg-backend/item/delete') }}" method="POST" id="deleteForm">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
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
