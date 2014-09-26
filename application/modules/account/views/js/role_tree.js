/*global $, Jquery  */
/*global setTimeout, Jquery  */
/*global alert, Jquery  */
/*global confirm, Jquery  */
/*global self, Jquery  */
/*global jQuery, Jquery  */

// ******** Class BackBone, used to make AJAX request *************
var backbone_class = function () {
};
//TODO refactor create and update functions into one
backbone_class.prototype.create = function (options) {
    //Make request to controller to render an input form partial view
    var role_tree = options.role_tree;
    var selected_roles = role_tree.get_selected(true);
    var roles_id = [];
    jQuery.each(selected_roles, function (index, item) {
        roles_id.push(item.a_attr.entity_id);
    });

    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'roles_id': roles_id,
            'account_name': options.account_name,
            'staff_name': options.staff_name,
            'password': options.password,
            'address': options.address
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.update = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_roles = tree.get_selected(true);
    var roles_id = [];
    jQuery.each(selected_roles, function (index, item) {
        roles_id.push(item.a_attr.entity_id);
    });

    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'roles_id': roles_id,
            'account_name': options.account_name,
            'staff_name': options.staff_name,
            'password': options.password,
            'address': options.address,
            'id': options.id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
//Load data for rendering view to allow user filling update information
backbone_class.prototype.preupdate = function (options) {
    //Make request to controller to render an input form partial view
    var tree = options.tree;
    var selected_roles = tree.get_selected(true);
    var roles_id = [];
    jQuery.each(selected_roles, function (index, item) {
        roles_id.push(item.a_attr.entity_id);
    });

    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'roles_id': roles_id,
            'account_name': options.account_name,
            'staff_name': options.staff_name,
            'password': options.password,
            'address': options.address,
            'id': options.id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.get_node = function (options) {
  return options.id;
};

// ***************** Class View, used to implement class Backbone ***************
//--------------
var create_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.create_acc, this);
    $('#btn_create').click(proxy);
}
create_view.prototype.create_acc = function () {
    var that = this;
    this.backbone.create({
        'role_tree': $('#role_tree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/create',
        'account_name': $("input[name='account_name']").val(),
        'staff_name': $("input[name='staff_name']").val(),
        'password': $("input[name='password']").val(),
        'address': $("input[name='address']").val(),
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
    var proxy = $.proxy(this.update_acc, this);
    $('#btn_update').click(proxy);
}
update_view.prototype.update_acc = function () {
    var that = this;
    this.backbone.update({
        'tree': $('#role_tree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/update',
        'account_name': $("input[name='account_name']").val(),
        'staff_name': $("input[name='staff_name']").val(),
        'password': $("input[name='password']").val(),
        'address': $("input[name='address']").val(),
        'id': $("input[name='id']").val(),
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

//var get_saved = function (acc_id) {
//    $.ajax({
//        'url': base_url +
//            'index.php/account/account_controller/view_update_ajax/' +
//            acc_id,
//        'type': 'GET',
//        'success': function (ids) {
//            var ids_obj = jQuery.parseJSON(ids);
//            $('#event_result').html('success: ' + ids_obj);
//            var node = $(this).find("[entity_id='" + ids_obj[0] + "']");
//            $('#role_tree').jstree(true).select_node(node.attr('id'));
//        },
//        'error': function (ids) {
//            $('#event_result').html('error: ' + ids);
//        }
//    });
//    return true;
//};

//**************** Entry point, main program function ****************
$(function () {
    "use strict";
    $('#role_tree').jstree({
        "core" : {
            "animation" : 0,
            "check_callback" : true
        },
        "plugins" : [
            "checkbox"
        ]
    });
    var backbone = new backbone_class();
    new create_view({
        'backbone': backbone
    });
    new update_view({
        'backbone': backbone
    });

//    var acc_id = $("input[name='id']").val();
//    get_saved(acc_id);
});