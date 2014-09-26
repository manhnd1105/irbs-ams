/*global $, Jquery  */
/*global setTimeout, Jquery  */
/*global alert, Jquery  */
/*global confirm, Jquery  */
/*global self, Jquery  */

// ******** Class BackBone, used to make AJAX request *************
var backbone_class = function () {
};
backbone_class.prototype.create = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_node = tree.get_selected(true)[0];

    //If there is no other nodes except root => create new node with parent id = 1
    var title = "";
    var entity_id = "1"; // 1 is id of root node
    //Else assign title and id to selected node and then pass it into controller
    if (typeof selected_node !== "undefined") {
        title = selected_node.text;
        entity_id = selected_node.a_attr.entity_id;
    }
    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'title': title,
            'entity_id': entity_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.update = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_node = tree.get_selected(true)[0];
    var entity_id = selected_node.a_attr.entity_id;
    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'entity_id': entity_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.delete = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_node = tree.get_selected(true)[0];
    var entity_id = selected_node.a_attr.entity_id;
    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'entity_id': entity_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.list_perm = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_node = tree.get_selected(true)[0];
    var entity_id = selected_node.a_attr.entity_id;
    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'role_id': entity_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
}

// ***************** Class View, used to implement class Backbone ***************
//--------------
var create_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.create_role, this);
    $('#btn_create').click(proxy);
}
create_view.prototype.create_role = function () {
    var that = this;
    this.backbone.create({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/rbac/role_controller/view_create',
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
create_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
}
create_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//---------------
var update_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.update_role, this);
    $('#btn_update').click(proxy);
}
update_view.prototype.update_role = function () {
    var that = this;
    this.backbone.update({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/rbac/role_controller/view_update',
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
update_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
}
update_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//---------------
var delete_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.delete_role, this);
    $('#btn_delete').click(proxy);
}
delete_view.prototype.delete_role = function () {
    var that = this;
    this.backbone.delete({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/rbac/role_controller/delete',
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
delete_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
    self.location = base_url + 'index.php/rbac/role_controller/';
}
delete_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//---------------
var list_perms_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.list_perms, this);
    $('#btn_list_perms').click(proxy);
}
list_perms_view.prototype.list_perms = function () {
    var that = this;
    this.backbone.list_perm({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/rbac/role_controller/list_assigned_perms',
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
list_perms_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
}
list_perms_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}


//**************** Entry point, main program function ****************
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
    });
    var backbone = new backbone_class();
    new create_view({
        'backbone': backbone
    });
    new update_view({
        'backbone': backbone
    });
    new delete_view({
        'backbone': backbone
    });
    new list_perms_view({
        'backbone': backbone
    });
});