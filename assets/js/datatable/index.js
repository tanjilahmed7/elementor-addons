var dataTable = function($scope, $) {
    var $_this = $scope.find(".ht-data-table-wrap"),
        $id = $_this.data("table_id");

    var responsive = $_this.data("custom_responsive");
    if (true == responsive) {
        var $th = $scope.find(".ht-data-table").find("th");
        var $tbody = $scope.find(".ht-data-table").find("tbody");

        $tbody.find("tr").each(function(i, item) {
            $(item)
                .find("td .td-content-wrapper")
                .each(function(index, item) {
                    $(this).prepend(
                        '<div class="th-mobile-screen">' +
                            $th.eq(index).html() +
                            "</div>"
                    );
                });
        });
    }
    $(document).ready(function() {
        var id = document.querySelector('.ht-data-table').id;

        var datatable_enable = $('.ht-data-table').data('datatable');
        
        if(datatable_enable == true){
            $('#'+id).DataTable({
                responsive: {
                    breakpoints: [
                      {name: 'bigdesktop', width: Infinity},
                      {name: 'meddesktop', width: 1480},
                      {name: 'smalldesktop', width: 1280},
                      {name: 'medium', width: 1188},
                      {name: 'tabletl', width: 1024},
                      {name: 'btwtabllandp', width: 848},
                      {name: 'tabletp', width: 768},
                      {name: 'mobilel', width: 480},
                      {name: 'mobilep', width: 320}
                    ]
                  }
            });
        }
    } );


};
jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/ht-data-table.default",
        dataTable
    );
});