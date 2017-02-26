



jQuery( document ).ready(function( $ ) {;
    
    GeoCountyIndex();
    $(document).on('pjax:success', GeoCountyIndex);
    $(document).on('pjax:end', GeoCountyIndex);
    
});

function GeoCountyIndex()
{
    
    /**
     * Delete button
     */
    $('#geo-county-dynagrid .btn-delete-geo-counties').off('click').on('click',function(e){
        e.preventDefault();
        var $this = $(this),
            grid = $('#'+$this.data('grid')),
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
            $.pjax.reload({container:'#geo-county-dynagrid-pjax'});
        });
    });
    /**
     * Status dropdown button
     */
    $('#geo-county-dynagrid .btn-update-status-geo-counties').off('click').on('click', function(e){
        e.preventDefault();
        var $this = $(this),
            grid = $('#'+$this.data('grid')),
            csrfParam = $this.data('csrf-param'),
            csrfToken = $this.data('csrf-token'),
            keys = grid.yiiGridView('getSelectedRows'),
            status = $this.data('status'),
            data = {'ids[]': keys, 'status': status};
        
        data[csrfParam] = csrfToken;
        var posting = $.post( $this.data('url'), data );
        
        posting.done(function( data ) {
            $("body").append( data );
            $.pjax.reload({container:'#geo-county-dynagrid-pjax'});
        });
        return false;
    });
}

