/*global $, Jquery  */
/*global setTimeout, Jquery  */
/*global alert, Jquery  */
/*global confirm, Jquery  */
/*global self, Jquery  */

//var Func_class = function () {
//    "use strict";
//};
//Func_class.prototype.myfunc = function (options) {
//    "use strict";
//    $.ajax({
//        url: '/status',
//        type: 'POST',
//        dataType: 'json',
//        data: { text: options.text },
//        success: options.success
//    });
//};
//var FuncView = function (func_obj) {
//    "use strict";
//    func_obj.myfunc({
//        text: 'aaa',
//        success: function (data) {
//            alert(data.text);
//        }
//    });
//};
//var creatingFolder = false;
//var creatingFile = false;
//function updateItem() {
//    var tree = $('#jstree').jstree(true);
//    var selected_node = tree.get_selected();
//    if (!selected_node.length) { return false; }
//    tree.edit(selected_node);
//    return true;
//}
//function deleteItem() {
//    var tree = $('#jstree').jstree(true);
//    var selected_node = tree.get_selected();
//    if (!selected_node.length) { return false; }
//    tree.delete_node(selected_node);
//    return true;
//}
//function createItem() {
//    var tree = $('#jstree').jstree(true);
//    var selected_node = tree.get_selected();
//    if (!selected_node.length) { return false; }
//    selected_node = tree.create_node(selected_node, {"type": "file"});
//    if(selected_node) {
//        tree.edit(selected_node);
//        creatingFolder = false;
//        creatingFile = true;
//    }
//    return true;
//}
//function customMenu(node) {
//    // The default set of all items
//    var items = {
//        updateItem: { // The "rename" menu item
//            label: "Update",
//            action: updateItem
//        },
//        deleteItem: { // The "delete" menu item
//            label: "Delete",
//            action: deleteItem
//        },
//        createItem: { // The "delete" menu item
//            label: "Create",
//            action: createItem
//        }
//    };
////    if ($(node).hasClass("folder")) {
////        // Delete the "delete" menu item
////        delete items.deleteItem;
////    }
//    return items;
//}
//function request_update (NODE, REF_NODE, event, data) {
//    //Find the parent entity id that matches the parent item id
//    var parent_item_id = REF_NODE.node.parent;
//    var parent_entity_id = parent_item_id.a_attr.entity_id;
//
//    //Make AJAX request
//    $.ajax({
//        'url': 'http://localhost/irbs/index.php/rbac/role_controller/update',
//        'type': 'POST',
//        'data': {
//            'item_id': REF_NODE.node.id,
//            'new_name': REF_NODE.node.text,
//            'entity_id': REF_NODE.node.a_attr.entity_id,
//            'parent_item_id': parent_item_id,
//            'parent_entity_id': parent_entity_id
//        },
//        'success': function (data) {
//            $('#event_result').html('success: ' + data);
//        },
//        'error': function (data) {
//            $('#event_result').html('error: ' + data);
//        }
//    });
//}
//function request_delete (NODE, REF_NODE, event, data) {
//    if (confirm('Are you sure want to delete?')) {
//        $.ajax({
//            'url': 'http://localhost/irbs/index.php/rbac/role_controller/delete',
//            'type': 'POST',
//            'data': {
//                'item_id': REF_NODE.node.id,
//                'href': REF_NODE.node.a_attr.href,
//                'entity_id': REF_NODE.node.a_attr.entity_id
//            },
//            'success': function (data) {
//                $('#event_result').html('success: ' + data);
//            },
//            'error': function (data) {
//                $('#event_result').html('error: ' + data);
//            }
//        });
//    }
//}
//function request_create (NODE, REF_NODE, event, data) {
//    $.ajax({
//        'url': 'http://localhost/irbs/index.php/rbac/role_controller/create',
//        'type': 'POST',
//        'data': {
//            'parent_item_id': REF_NODE.node.parent,
//            'title': REF_NODE.node.text,
//            'parent_entity_id': REF_NODE.node.a_attr.parent_entity_id
//        },
//        'success': function (data) {
//            $('#event_result').html('success: ' + data);
//        },
//        'error': function (data) {
//            $('#event_result').html('error: ' + data);
//        }
//    });
//}
//function request_move (NODE, REF_NODE, event, data) {
//    $.ajax({
//        'url': 'http://localhost/irbs/index.php/rbac/role_controller/move',
//        'type': 'GET',
//        'data': {
//            'old_parent_item_id': REF_NODE.old_parent,
//            'new_parent_item_id': REF_NODE.parent,
//            'item_id': REF_NODE.node.id,
//            'old_parent_id': REF_NODE.old_parent.node.a_attr.entity_id,
//            'parent_id': REF_NODE.parent.node.a_attr.entity_id
//        },
//        'success': function (data) {
//            $('#event_result').html('success: ' + data);
//        },
//        'error': function (data) {
//            $('#event_result').html('error: ' + data);
//        }
//    });
//}
//function request_copy (NODE, REF_NODE, event, data) {
//    $.ajax({
//        'url': 'http://localhost/irbs/index.php/rbac/role_controller/copy',
//        'type': 'GET',
//        'data': {
//            'OldFolder': REF_NODE.old_parent,
//            'NewFolder': REF_NODE.parent,
//            'ID_Item': REF_NODE.node.id
//        },
//        'success': function (data) {
//            $('#event_result').html('success: ' + data);
//        },
//        'error': function (data) {
//            $('#event_result').html('error: ' + data);
//        }
//    });
//}
//function DoFct(NODE, REF_NODE, event, data)
//{
//    if (NODE.type === 'rename_node')
//    {
//        if (REF_NODE.node.type == 'folder')
//        {
//            $.post("/RenameDir", {'OldName':REF_NODE.node.id, 'NewName':REF_NODE.node.text});
//            self.location='/';              // have the tree refreshed by rebuilding the page
//        }
//        else if (creatingFile == true && REF_NODE.node.type == "file")
//        {
//            $.post("/CreateFile", {'Folder':REF_NODE.node.parent, 'Name':REF_NODE.node.text});
//            creatingFile = false;
//            self.location='/';            // have the tree refreshed by rebuilding the page
//        }
//        else if (creatingFolder == true && REF_NODE.node.type == "folder")
//        {
//            $.post("/CreateDir", {'Folder':REF_NODE.node.parent, 'Name':REF_NODE.node.text});
//            creatingFolder = false;
//            self.location='/';           // have the tree refreshed by rebuilding the page
//        }
//        else
//        {
//            //$.post("http://localhost/irbs/index.php/rbac/role_controller/view_update", {'ID_Item':REF_NODE.node.id, 'NewName':REF_NODE.node.text});
//            $.ajax({
//                'url': 'http://localhost/irbs/index.php/rbac/role_controller/view_update',
//                'type': 'POST',
//                'data': {'ID_Item':REF_NODE.node.id, 'NewName':REF_NODE.node.text},
//                'success': function (data) {
//                    $('#event_result').html(data);
//                },
//                'error': function (data) {
//                    $('#event_result').html(data);
//                }
//            });
//        }
//    }
//    else if (NODE.type === 'delete_node')
//    {
//        if (REF_NODE.node.type == 'folder')
//        {
//            if (confirm('Are you sure you want to delete this folder and all its files?'))
//                $.post("/DelDir", {'Name':REF_NODE.node.id});
//            else
//                self.location='/';         // have the tree refreshed by rebuilding the page
//        }
//        else
//        {
//            if (confirm('Are you sure?'))
//            {
//                $.post("/DelFile", {'ID_Item':REF_NODE.node.id});
//            }
//        }
//    }
//    else if (NODE.type === 'move_node')
//    {
//        if (REF_NODE.node.type == 'file')
//            $.post("/MoveFile", {'OldFolder': REF_NODE.old_parent, 'NewFolder': REF_NODE.parent, 'ID_Item':REF_NODE.node.id});
//        else if (REF_NODE.node.type == 'folder')
//            $.post("/MoveDir", {'OldFolder': REF_NODE.old_parent, 'NewFolder': REF_NODE.parent, 'Name':REF_NODE.node.id});
//    }
//    else if (NODE.type === 'copy_node')
//    {
//        if (REF_NODE.node.type == 'file')
//            $.post("/CopyFile", {'OldFolder': REF_NODE.old_parent, 'NewFolder': REF_NODE.parent, 'ID_Item':REF_NODE.node.id});
//        else if (REF_NODE.node.type == 'folder')
//            $.post("/CopyDir", {'OldFolder': REF_NODE.old_parent, 'NewFolder': REF_NODE.parent, 'Name': REF_NODE.node.id});
//    }
//}
$(function () {
    "use strict";
    $('#jstree').jstree({
        "core" : {
            "animation" : 0,
            "check_callback" : true,
            "themes" : { "stripes" : true }
        },
        "plugins" : [
            "contextmenu", "dnd", "search",
            "state", "types", "wholerow"
        ]
//        "contextmenu" : {
//            items: customMenu
//        }
    });
//    $('#jstree').bind("rename_node.jstree", function (NODE, REF_NODE, event, data) {
//        request_update(NODE, REF_NODE, event, data);
//    });
//    $('#jstree').bind("delete_node.jstree", function (NODE, REF_NODE, event, data) {
//        request_delete(NODE, REF_NODE, event, data);
//    });
//    $('#jstree').bind("create_node.jstree", function (NODE, REF_NODE, event, data) {
//        request_create(NODE, REF_NODE, event, data);
//    });
//    $('#jstree').bind("move_node.jstree", function (NODE, REF_NODE, event, data) {
//        request_move(NODE, REF_NODE, event, data);
//    });
    $('#btn_create').click(function () {
        //$('#event_result').html('Add node button clicked');
        //Make request to controller to render an input form partial view
        var tree = $('#jstree').jstree(true);
        var selected_node = tree.get_selected(true)[0];

        //If there is no other nodes except root => create new node with parent id = 1
        var title = "";
        var entity_id = "1"; // 1 is id of root node
        //Else assign title and id to selected node and then pass it into controller
        if (typeof selected_node !== "undefined") {
            title = selected_node.text;
            entity_id = selected_node.a_attr.entity_id;
        }

        //if (!selected_node.length) { return false; }
        //tree.edit(selected_node);
        $.ajax({
            'url': base_url + 'index.php/rbac/role_controller/view_create',
            'type': 'POST',
            'data': {
                //'item_id': item_id,
                'title': title,
                'entity_id': entity_id
            },
            'success': function (data) {
                $('#event_result').html('success: ' + data);
            },
            'error': function (data) {
                $('#event_result').html('error: ' + data);
            }
        });
        return true;
    });
    $('#btn_update').click(function () {
        //$('#event_result').html('Modify node button clicked');
        //$('#event_result').html('Add node button clicked');
        //Make request to controller to render an input form partial view
        var tree = $('#jstree').jstree(true);
        var selected_node = tree.get_selected(true)[0];
        var entity_id = selected_node.a_attr.entity_id;

        //if (!selected_node.length) { return false; }
        //tree.edit(selected_node);
        $.ajax({
            'url': base_url + 'index.php/rbac/role_controller/view_update',
            'type': 'POST',
            'data': {
                'entity_id': entity_id
            },
            'success': function (data) {
                $('#event_result').html('success: ' + data);
            },
            'error': function (data) {
                $('#event_result').html('error: ' + data);
            }
        });
        return true;
    });
    $('#btn_delete').click(function () {
        //$('#event_result').html('Remove node button clicked');
        var tree = $('#jstree').jstree(true);
        var selected_node = tree.get_selected(true)[0];
        var entity_id = selected_node.a_attr.entity_id;

        //if (!selected_node.length) { return false; }
        //tree.edit(selected_node);

        $.ajax({
            'url': base_url + 'index.php/rbac/role_controller/delete',
            'type': 'POST',
            'data': {
                'entity_id': entity_id
            },
            'success': function (data) {
                //$('#event_result').html('success: ' + data.status);
                self.location = base_url + 'index.php/rbac/role_controller/';
            },
            'error': function (data) {
                $('#event_result').html('error: ' + data.status);
            }
        });
        return true;
    });
    //Bootstrap
//    var func_obj = new Func_class();
//    new FuncView({func: func_obj });
//    $('#submit').click(function (e) {
//        e.preventDefault;
//        $.ajax({
//            url: 'http://localhost/irbs/index.php/rbac/role_controller/test',
//            type: 'GET',
////            dataType: 'json',
////            data: { text: $('#name').val() },
//            success: function (data) {
//                $('#event_result').html('success: ' + data);
//
//            },
//            error: function (xhr) {
//                $('#event_result').html('error' + xhr.text);
//                alert(xhr.status);
//            }
//        });
//    });
//    var dialog, form,
//        title = $("#title"),
//        desc = $("#desc"),
//        allFields = $([]).add(title).add(desc),
//        tips = $(".validateTips");
//
//    function updateTips(t) {
//        tips
//            .text(t)
//            .addClass("ui-state-highlight");
//        setTimeout(function () {
//            tips.removeClass("ui-state-highlight", 1500);
//        }, 500);
//    }
//
//    function checkLength(o, n, min, max) {
//        if (o.val().length > max || o.val().length < min) {
//            o.addClass("ui-state-error");
//            updateTips("Length of " + n + " must be between " +
//                min + " and " + max + ".");
//            return false;
//        }
//        return true;
//    }
//
//    function addNode() {
//        var valid = true;
//        allFields.removeClass("ui-state-error");
//        valid = valid && checkLength(title, "title", 3, 16);
//        valid = valid && checkLength(desc, "desc", 3, 20);
//        if (valid) {
//            $("#users tbody").append("<tr>" +
//                "<td>" + title.val() + "</td>" +
//                "<td>" + desc.val() + "</td>" +
//                "</tr>");
//            dialog.dialog("close");
//        }
//        return valid;
//    }
//
//    dialog = $("#dialog-form").dialog({
//        autoOpen: false,
//        height: 300,
//        width: 350,
//        modal: true,
//        buttons: {
//            "Create node": addNode,
//            "Cancel": function () {
//                dialog.dialog("close");
//            }
//        },
//        close: function () {
//            form[0].reset();
//            allFields.removeClass("ui-state-error");
//        }
//    });
//    form = dialog.find("form").on("submit", function (event) {
//        event.preventDefault();
//        addNode();
//    });
//    $("#create-user").button().on("click", function () {
//        dialog.dialog("open");
//    });
});