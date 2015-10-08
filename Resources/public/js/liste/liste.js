$( document ).ready(function() {
	$('#events-table').bootstrapTable();
});
    $(function () {
        $('#events-table').next().click(function () {
            $(this).hide();
            var $result = $('#events-result');
            $('#events-table').bootstrapTable({"order": [[0,'desc']]});
		});
    });


    function operateFormatter(value, row, index) {
        return [
            '<a class="edit ml10" href="javascript:void(0)" title="Éditer">',
                '<i class="glyphicon glyphicon-edit"></i>',
            '</a>'
        ].join('');
    }

    window.operateEvents = {
        'click .edit': function (e, value, row, index) {
		   document.location.href = Routing.generate( 'edit_template' , { 'name' : row.fichiertemplate });
        }
	};
	