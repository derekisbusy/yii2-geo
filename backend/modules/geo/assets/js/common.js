



jQuery( document ).ready(function( $ ) {;
    
    GeoIndex();
    $(document).on('pjax:success', GeoIndex);
    $(document).on('pjax:end', GeoIndex);
    
});

function GeoIndex()
{
    
    /**
     * Delete button
     */
    $('.btn-delete-items').off('click').on('click',function(e){
        e.preventDefault();
        var $this = $(this),
            grid = $('#'+$this.data('grid')),
            pjaxContainer = $this.data('pjax-container'),
            csrfParam = $this.data('csrf-param'),
            csrfToken = $this.data('csrf-token'),
            keys = grid.yiiGridView('getSelectedRows'),
            data = {'ids[]': keys},
            confirmMsg = $this.data('confirm-message');
        if(!confirm(confirmMsg))
            return false;
        data[csrfParam] = csrfToken;
        var posting = $.post( $this.prop('href'), data );
        
        posting.done(function( data ) {
            $("body").append( data );
            $.pjax.reload({container: pjaxContainer});
        });
        return false;
    });
    
    /**
     * Status dropdown button
     */
    $('.btn-update-status').off('click').on('click', function(e){
        e.preventDefault();
        var $this = $(this),
            grid = $('#'+$this.data('grid')),
            pjaxContainer = $this.data('pjax-container'),
            csrfParam = $this.data('csrf-param'),
            csrfToken = $this.data('csrf-token'),
            keys = grid.yiiGridView('getSelectedRows'),
            status = $this.data('status'),
            data = {'ids[]': keys, 'status': status};
        
        data[csrfParam] = csrfToken;
        var posting = $.post( $this.data('url'), data );
        
        posting.done(function( data ) {
            $("body").append( data );
            $.pjax.reload({container: pjaxContainer});
        });
        return false;
    });
}

