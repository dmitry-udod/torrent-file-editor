$(function(){
    $('#announces').on('click', '.remove', function() {
        $('#' + $(this).attr('data-remove-id')).remove();
    });

    $('#addAnnounce').click(function(e) {
        e.preventDefault();
        var uid = ("0000" + (Math.random()*Math.pow(36,4) << 0).toString(36)).slice(-4);
        $('#announces').append('<div id="'+uid+'">' +
         '<span data-remove-id="'+uid+'" class="remove pull-right glyphicon glyphicon-remove" style="position: relative;top: 25px; left: 25px; cursor: pointer"></span>' +
         '<input class="form-control" name="announces[]" type="text"></div>');
    });
});