var TableDatatablesResponsive = function () {

    var initTable1 = function () {
        var table = $('#sample_1');

        var oTable = table.dataTable({
            "info": true,//左下角信息禁用
          	"paging": true,//禁用分页
          	"processing": true,//显示加载进度条
          	"serverSide": true,//开启服务器端处理数据，分页，获取数据等等
        	"ajax":function (data, callback, settings) {                
                $.ajax({
                    "url":"getCenterReviewTravels",
                    "type": "POST",
                    "data":data,
                    "success": function (resp) {
                        callback(resp);
                    }
                })
           },
            "columns": [
                { "data": "id","defaultContent": "<i>暂无</i>" },
                { "data": "serial_number","defaultContent": "<i>暂无</i>" },
                { "data": "from_place","defaultContent": "<i>暂无</i>" },
                { "data": "to_place","defaultContent": "<i>暂无</i>" },
                { "data": "departure_time" ,"defaultContent": "<i>暂无</i>","render":function(data,type,full,meta){
                    if(data!=""&&data!=null){
                        return new Date(data*1000).format("yyyy-MM-dd hh:mm");
                    }

                }},
                { "data": "id","defaultContent": "<i>暂无</i>" ,"render":function (data,type,full,meta) {
                    var txt='';
                    return txt;
                    }}
            ],
            "columnDefs": [
                { "orderable": false, "targets": 0 }//禁用第一列排序功能
            ],

            buttons: [
//              { extend: 'print', className: 'btn dark btn-outline' },
//              { extend: 'pdf', className: 'btn green btn-outline' },
//              { extend: 'csv', className: 'btn purple btn-outline ' }
            ],
            responsive: {
                details: {

                }
            },
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "暂无数据",
                "info": "显示 _START_ 至 _END_ 共 _TOTAL_ 条数据",
                "infoEmpty": "暂无数据",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },




            "order": [
                [0, 'asc']
            ],
            
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,

            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row' <'col-md-12'T>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
        });
    }

    

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable1();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesResponsive.init();
});


