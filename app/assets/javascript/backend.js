/**
 * @created 27.10.14 - 12:52
 * @author stefanriedel
 */

$('[data-confirm]').click(function(e){
    e.preventDefault();
    if(window.confirm($(this).attr('data-confirm'))) {
        $.ajax({
            url: $(this).prop('href'),
            type: $(this).attr('data-method').toUpperCase(),
            success: function() {
                location.reload();
            }
        });
        return false;
    }
    return false;
});