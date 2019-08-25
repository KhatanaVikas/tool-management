function ToolManager() {

    this.tools = [];
    this.tool_groups = [];
    this.editformSelectors = {
        'id': '#tool_id_edit_form',
        'name': '#tool_name_edit_form',
        // 'user': '#user_name_edit_form',
        'group': '#tool_group_edit_form',
        'cost_price': '#tool_price_edit_form',
    };

}

/**
 * Description: Delete a tool ajax call
 * @param tool_id
 */
ToolManager.prototype.delete = function (tool_id) {
    bootbox.confirm("Are you sure you want to delete this tool!", function (result) {
        if (result == true) {
            let url = 'http://local.toolmanager.com/tools/delete/' + tool_id;
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function (result) {
                    bootbox.alert(result, function(){
                        //window.location.reload();
                    });
                    toolMgr.loadData();
                }
            });
        }
    });

}

/**
 * Description: Add new tool
 *
 * @param form
 * @param url
 */
ToolManager.prototype.addTool = function (form, url) {

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function (data) {
            $("[data-dismiss=modal]").click();
            bootbox.alert(data, function(){
                //window.location.reload();
            });
            toolMgr.loadData();
        }
    });

}

/**
 *
 * @param form
 * @param url
 */
ToolManager.prototype.editTool = function (form, url) {

    var id = $(this.editformSelectors.id).val();
    url = url + '/' + id;
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function (data) {
            $("[data-dismiss=modal]").click();
            bootbox.alert(data, function(){
                //window.location.reload();
            });
            toolMgr.loadData();
        }
    });

}

ToolManager.prototype.showEditForm = function (element) {

    var id = element.getAttribute('tool_id');
    var toolName = element.getAttribute('tool_name');
    var groupName = element.getAttribute('tool_group');
    console.log(groupName);
    var tool_cost = element.getAttribute('tool_cost');
    // var userName = element.getAttribute('tool_username');
    $('#editToolModal').modal({show: true});

    $(''+this.editformSelectors.id+'').val(id);
    $(''+this.editformSelectors.name+'').val(toolName);
    $(''+this.editformSelectors.cost_price+'').val(tool_cost);
    // $(''+this.editformSelectors.user+'').val(userName);
    $("#tool_group_edit_form option:contains('"+ groupName +"')").attr('selected', 'selected');

}

/**
 *Description: Bind the tools list to view
 */
ToolManager.prototype.bindDataToGrid = function () {
    var listHtml = '';

    this.tools.forEach(prepareHtml);

    function prepareHtml(tool, index) {
        listHtml += '<tr>\n' +
            '                    <td width="20%">' + tool.name + '</td>\n' +
            '                    <td>' + tool.group.name + '</td>\n' +
            '                    <td>' + tool.user.name + '</td>\n' +
            '                    <td>' + tool.cost_price + '</td>\n' +
            '                    <td>' + tool.purchase_date + '</td>\n' +
            '                    <td>\n' +
            '                        <i tool_id="' + tool.id + '" tool_name="' + tool.name + '" tool_group="' + tool.group.name + '" ' +
            '                                   tool_cost="' + tool.cost_price + '" tool_username="' + tool.user.name + '"  ' +
            '                                   onclick="toolMgr.showEditForm(this)"\n' +
            '                                class="edit material-icons"\n' +
            '                                data-toggle="tooltip" title="Edit">&#xE254;</i></a>\n' +
            '                        <i onclick="toolMgr.delete(' + tool.id + ')" class=" delete material-icons"\n' +
            '                           data-toggle="tooltip"\n' +
            '                           title="Delete">&#xE872;</i></a>\n' +
            '                    </td>\n' +
            '                </tr>  ';

    }

    $('#toolListTableRow').html(listHtml);

}

/**
 * Load initial tools list data
 */
ToolManager.prototype.loadData = function () {
    let tmgr = this;

    $.get('http://local.toolmanager.com/tools/view', function (response) {
        tmgr.tools = response.tools;
        tmgr.bindDataToGrid();
    })
}

/**
 *Bind tool groups in forms
 */
ToolManager.prototype.bindToolGroupsInform = function () {
    var listHtml = '<option class="form-control" selected>Choose...</option>';

    this.tool_groups.forEach(prepareHtml);

    function prepareHtml(tool_group, index) {
        listHtml += '<option class="form-control" value="'+tool_group.id+'">'+tool_group.name+'</option>';

    }

    $('#tool_group_edit_form').html(listHtml);
    $('#tool_group_add_form').html(listHtml);
}

/**
 * Load initial tool groups list data
 */
ToolManager.prototype.getToolGroups = function () {
    let tmgr = this;

    $.get('http://local.toolmanager.com/tools/get-tool-groups', function (response) {
        tmgr.tool_groups = response;

        tmgr.bindToolGroupsInform();
    })
}

let toolMgr = new ToolManager();

/**
 * Call load data of tool manager on doc ready
 */
$(document).ready(function () {
    //for tackling 419 errors in ajax POST and DELETE
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    toolMgr.loadData();
    toolMgr.getToolGroups();

    $("#tool-add-form").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        toolMgr.addTool(form, url);

    });

    $("#tool-edit-form").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        toolMgr.editTool(form, url);
    });

});
