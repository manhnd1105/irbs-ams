/**
 * Created by dell on 10/1/14.
 */
/*global $, Jquery  */
/*global setTimeout, Jquery  */
/*global alert, Jquery  */
/*global confirm, Jquery  */
/*global self, Jquery  */
/*global jQuery, Jquery  */

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
            'account_name': title,
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
}

backbone_class.prototype.assign = function (options) {
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
}

backbone_class.prototype.list_assigned = function (options) {
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
}

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
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/view_create_ajax',
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
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/view_update',
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
    var proxy = $.proxy(this.delete_acc, this);
    $('#btn_delete').click(proxy);
}
delete_view.prototype.delete_acc = function () {
    var that = this;
    this.backbone.update({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/delete',
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
    self.location = base_url + 'index.php/account/account_controller/';
}
delete_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//---------------
var assign_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.assign, this);
    $('#btn_assign_roles').click(proxy);
}
assign_view.prototype.assign = function () {
    var that = this;
    this.backbone.assign({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/rbac/rbac_controller/view_assign_acc_role',
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

//---------------
var list_view = function (options) {
    this.backbone = options.backbone;
    var proxy = $.proxy(this.list_assigned, this);
    $('#btn_list_roles').click(proxy);
}
list_view.prototype.list_assigned = function () {
    var that = this;
    this.backbone.list_assigned({
        'tree': $('#jstree').jstree(true),
        'url': base_url + 'index.php/account/account_controller/list_roles',
        'success': function (data) {
            that.display_success(data);
        },
        'error': function (data) {
            that.display_error(data);
        }
    });


    //var dialog = new BootstrapDialog(
    //    {
    //        title: 'confirm',
    //        message: function (var_dialog) {
    //            var result = $('<div></div>');
    //            var pageToLoad = var_dialog.getData('page_to_load');
    //            result.load(pageToLoad);
    //
    //            return result;
    //        },
    //        data: {
    //            'page_to_load': base_url + 'application/modules/account/views/remote.html'
    //        },
    //        type: BootstrapDialog.TYPE_INFO,
    //        closable: true,
    //        buttons: [{
    //            label: 'Cancel',
    //            action: function(dialog) {
    //                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
    //                dialog.close();
    //            }
    //        }, {
    //            label: 'OK',
    //            cssClass: 'btn-primary',
    //            action: function(dialog) {
    //                typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
    //                dialog.close();
    //            }
    //        }]
    //    },
    //    function(result){
    //        if(result) {
    //            alert('Yup.');
    //        } else {
    //            alert('Nope.');
    //        }
    //    }
    //);
    //dialog.open();
}

list_view.prototype.display_success = function (html_form) {
    $('#event_result').html('success: ' + html_form);
    self.location = base_url + 'index.php/account/account_controller/';
}
list_view.prototype.display_error = function (html_form) {
    $('#event_result').html('error: ' + html_form);
}

//**************** Entry point, main program function ****************
$(function () {
    "use strict";
    $('#jstree').jstree({
        "core" : {
            "animation" : 0,
            "check_callback" : true
        },
        "plugins" : [
            "wholerow"
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
    new assign_view({
        'backbone': backbone
    });
    new list_view({
        'backbone': backbone
    });

    $('#create').click(function(event){
        event.preventDefault();
        var dialog = new BootstrapDialog(
            {
                title: 'Create Account',
                message: function (var_dialog) {
                    var result = $('<div></div>');
                    var pageToLoad = var_dialog.getData('page_to_load');
                    result.load(pageToLoad);

                    return result;
                },
                data: {
                    'page_to_load': base_url + 'application/modules/account/views/create_form.php'
                },
                type: BootstrapDialog.TYPE_INFO,
                closable: true,
                buttons: [{
                    label: 'Cancel',
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                        dialog.close();
                    }
                }, {
                    label: 'Submit',
                    cssClass: 'btn-primary',
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                        var info=$('#form2').serialize();
                        alert(info);

                        //$.ajax({
                        //    type: "POST",
                        //    url: "home_controller.php",
                        //    data: info,
                        //    success: function(data){
                        //        alert(data);
                        //    }
                        //});
                        dialog.close();
                    }
                }]
            },
            function(result){
                if(result) {
                    alert('Yup.');
                } else {
                    alert('Nope.');
                }
            }
        );
        dialog.open();
    });

    //set event for update button

    $('#update').click(function(event){
        event.preventDefault();
        var dialog = new BootstrapDialog(
            {
                title: 'Update Account',
                message: function (var_dialog) {
                    var result = $('<div></div>');
                    var pageToLoad = var_dialog.getData('page_to_load');
                    result.load(pageToLoad);

                    return result;
                },
                data: {
                    'page_to_load': base_url + 'application/modules/account/views/create_form.php'
                },
                type: BootstrapDialog.TYPE_INFO,
                closable: true,
                buttons: [{
                    label: 'Cancel',
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(false);
                        dialog.close();
                    }
                }, {
                    label: 'Submit',
                    cssClass: 'btn-primary',
                    action: function(dialog) {
                        typeof dialog.getData('callback') === 'function' && dialog.getData('callback')(true);
                        var info=$('#form2').serialize();
                        alert(info);

                        //$.ajax({
                        //    type: "POST",
                        //    url: "home_controller.php",
                        //    data: info,
                        //    success: function(data){
                        //        alert(data);
                        //    }
                        //});
                        dialog.close();
                    }
                }]
            },
            function(result){
                if(result) {
                    alert('Yup.');
                } else {
                    alert('Nope.');
                }
            }
        );
        dialog.open();
    });
});

