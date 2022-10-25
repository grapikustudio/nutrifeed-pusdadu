$(document).ready(function(){
    $('#modal-default').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var title = div.data('button-type');
        var id = div.data('id');
        var uid = div.data('id-user')
        var modal = $(this);
        if(title == "link"){
        modal.find('#modalDelete').attr("href","/dasbor/link/delete/"+id);
        } else if(title == "user"){
            modal.find('#modalDelete').attr("href","/dasbor/user/delete/"+id);
        }else if(title == "file"){
            modal.find('#modalDelete').attr("href","/dasbor/file/delete/"+id);
        }else if(title == "agen"){
            modal.find('#modalDelete').attr("href","/dasbor/agen/delete?id="+id+"&uid="+uid)
        }
    })
    $('#modal-add-folder').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var id = div.data('id');
        var modal = $(this);
        modal.find('#id').attr("value",id);
    })
    $('#modal-rename').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var id = div.data('id');
        var name = div.data('name');
        var modal = $(this);
        modal.find('#id').attr("value",id);
        modal.find('#folder').attr("value",name);
    })
    $('#modal-upload').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var id = div.data('id');
        var modal = $(this);
        modal.find('#id').attr("value",id);
        
    })
});