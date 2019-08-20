function ToolManager() {

    this.tools = [];

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
                    window.location.reload();
                }
            });
        }
    });

}

/**
 * Description: Add new tool
 */
ToolManager.prototype.addTool = function (e) {


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
            '                    <td>' + tool.tool_group_name + '</td>\n' +
            '                    <td>' + tool.user_name + '</td>\n' +
            '                    <td>' + tool.cost_price + '</td>\n' +
            '                    <td>' + tool.purchase_date + '</td>\n' +
            '                    <td>\n' +
            '                        <a href="#editToolModal" tool-id="' + tool.id + '" class="edit" data-toggle="modal"><i\n' +
            '                                class="material-icons"\n' +
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

    $("#tool-add-form").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                console.log(data); // show response from the php script.
                window.location.reload();
            }
        });

    });

});
