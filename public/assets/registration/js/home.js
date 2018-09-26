$(document).ready(function () {
    
    $('#menu_home').addClass('active');
    
    $('select').formSelect();

    $('#exportToCSVBtn').click(function () {
        $('#search_clients_form_actionType').val('export');
        $("form[name=search_clients_form]").submit();
    });

    $('#formSubmitBtn').click(function () {
        $('#search_clients_form_offset').val(0);
        submitSearchForm();
    });

    activatePagination();

    $(".pager").click(function () {
        var offset = parseInt($(this).attr('page_offset'));
        $('#search_clients_form_offset').val(offset);
        submitSearchForm();
    });
    
    $("#pageLeft").click(function(){
        var offset = parseInt($("#page_offset").val());
        var pageLimit = parseInt($("#page_limit").val());
        if (offset > 0) {
            $('#search_clients_form_offset').val(offset - pageLimit);
            submitSearchForm();
        }
    });
    
    $("#pageRight").click(function(){
        var totalCount = parseInt($("#total_count").val());
        var currentOffset = parseInt($("#page_offset").val());
        var pageLimit = parseInt($("#page_limit").val());
        if ((currentOffset + pageLimit) < totalCount) {
            $('#search_clients_form_offset').val(currentOffset + pageLimit);
            submitSearchForm();
        }
    });

});

function activatePagination() {
    var offset = $("#page_offset").val();
    $("li[page_offset='" + offset + "']").addClass("active");
}

function submitSearchForm() {
    $('#search_clients_form_actionType').val('submit');
    $("form[name=search_clients_form]").submit();
}