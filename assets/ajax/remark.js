$(document).ready(function() {
	var base_url = $(".base_url").val();
        $('#all_data').DataTable({
          "bSortCellsTop": true,
          "processing": true, //Feature control the processing indicator.
            ajax: {
                url: base_url+'remark/all_data_ajax', // URL to your PHP script for fetching data
                type: 'POST'
            },
            columns: [
                { data: 0 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                // Add more columns as needed
            ]
        });
    });

function reset(){
  $("#submit_data")[0].reset();
}