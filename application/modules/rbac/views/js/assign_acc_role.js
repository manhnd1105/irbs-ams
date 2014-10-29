/*global $, Jquery  */
/*global setTimeout, Jquery  */
/*global alert, Jquery  */
/*global confirm, Jquery  */
/*global self, Jquery  */

// ******** Class BackBone, used to make AJAX request *************
var backbone_class = function () {
};
backbone_class.prototype.assign = function (options) {
    //Make request to controller to render an input form partial view
    var role_tree = options.role_tree;
    var selected_role = role_tree.get_selected(true)[0];

    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'role_id': selected_role.a_attr.entity_id,
            'acc_id': options.acc_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};
backbone_class.prototype.unassign = function (options) {
    //Make request to controller to render an input form partial view
    var role_tree = options.role_tree;
    var selected_role = role_tree.get_selected(true)[0];

    $.ajax({
        'url': options.url,
        'type': 'POST',
        'data': {
            'role_id': selected_role.a_attr.entity_id,
            'acc_id': options.acc_id
        },
        'success': options.success,
        'error': options.error
    });
    return true;
};

// ***************** Class View, used to implement class Backbone ***************
//--------------
var assign_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.assign_acc, this);
    $('#btn_assign').click(proxy);
}
assign_view.prototype.assign_acc = function () {
    var that = this;
    this.backbone.assign({
        'role_tree': $('#role_tree').jstree(true),
        'url': base_url + 'index.php/rbac/rbac_controller/assign_acc_role',
        'acc_id': $("input[name='selected_acc']").val(),
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
assign_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
}
assign_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//--------------
//var link_clicked_view = function (options) {
//    this.backbone = options.backbone;
//    $('.acc_list').click(function () {
//        var id = $(this).attr('id');
//        $('#event_result').html('clicked id: ' + id);
//        $("input[name='selected_acc']").val(id);
//    });
//}

//--------------
var unassign_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.unassign_acc, this);
    $('#btn_unassign').click(proxy);
}
unassign_view.prototype.unassign_acc = function () {
    var that = this;
    this.backbone.unassign({
        'role_tree': $('#role_tree').jstree(true),
        'url': base_url + 'index.php/rbac/rbac_controller/unassign_acc_role',
        'acc_id': $("input[name='selected_acc']").val(),
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });
}
unassign_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
}
unassign_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//**************** Entry point, main program function ****************
$(function () {
    "use strict";
    $('#role_tree').jstree({
        "core" : {
            "animation" : 0,
            "check_callback" : true
        },
        "plugins" : [
            "types", "wholerow"
        ]
    });
    var backbone = new backbone_class();
    new assign_view({
        'backbone': backbone
    });
    new unassign_view({
        'backbone': backbone
    });
    //new link_clicked_view({
    //    'backbone': backbone
    //});
});