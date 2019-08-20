@extends('base.base')
@section('title')
    Homepage
@endsection
@section('content')
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Tools</b></h2>
                </div>
                <div class="col-sm-6">
                    <a href="#addToolModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i>
                        <span>Add New Tool</span></a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th width="20%">Tool Name</th>
                <th>Tool Group</th>
                <th>User</th>
                <th>Cost</th>
                <th>Purchase Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody id="toolListTableRow">
            {{--            To be filled by get api--}}
            </tbody>
        </table>
    </div>

@endsection
@section('modals')
    <!-- Edit Modal HTML -->
    <div id="addToolModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tool-add-form" method="POST" action="/tools/add">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <h4 class="modal-title">Add Tool</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tool Name</label>
                            <input type="text" name="tool_name" class="form-control" na required>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <input type="text" name="user_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Cost Price</label>
                            <input type="number" name="cost_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tool Group</label>
                            <select name="tool_group" class="form-control" required>
                                <option class="form-control" selected>Choose...</option>
                                @foreach($toolGroups as $group)
                                    <option class="form-control" value="{{$group['id']}}">{{$group['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div id="editToolModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="tool-edit-form" method="POST" action="/tools/edit">
                    <input type="hidden" id="tool_id_edit_form" value="">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Tool</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tool Name</label>
                            <input id="tool_name_edit_form" type="text" name="tool_name" class="form-control" na
                                   required>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <input id="user_name_edit_form" type="text" name="user_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Cost Price</label>
                            <input id="tool_price_edit_form" type="number" name="cost_price" class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label>Tool Group</label>
                            <select id="tool_group_edit_form" name="tool_group" class="form-control" required>
                                <option class="form-control" selected>Choose...</option>
                                @foreach($toolGroups as $group)
                                    <option class="form-control" value="{{$group['id']}}">{{$group['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
