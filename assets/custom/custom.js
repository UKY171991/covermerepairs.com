$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

 //Initialize Select2 Elements
	$('.select2bs4').select2({
	  theme: 'bootstrap4'
	})


  $( function() {
    $( "#date1" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#date2" ).datepicker({ dateFormat: 'yy-mm-dd' });
  } );

 $(document).ready(function(){
    jQuery('.toastsDefaultDanger,.toastsDefaultWarning').click();
 });



$('.toastsDefaultDanger').click(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });

 $('.toastsDefaultWarning').click(function() {
  var text_data ="hhhhhhhhh";
      $(document).Toasts('create', {
        class: 'bg-warning',
        title: 'Toast Title',
        subtitle: 'Subtitle',
        body: text_data, //'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
      })
    });





 // $(document).ready(function ()
 //    {
 //        $('#all_data thead th').each(function () {
 //            var title = $(this).text();
 //            $(this).html(title+' <input type="text" class="col-search-input" placeholder="Search ' + title + '" />');
 //        });
        
 //        table.columns().every(function () {
 //            var table = this;
 //            $('input', this.header()).on('keyup change', function () {
 //                if (table.search() !== this.value) {
 //                     table.search(this.value).draw();
 //                }
 //            });
 //        });
 //    });

//  new DataTable('#all_data', {
//     initComplete: function () {
//         this.api()
//             .columns()
//             .every(function () {
//                 let column = this;
//                 let title = column.header().textContent;
 
//                 // Create input element
//                 let input = document.createElement('input');
//                 input.placeholder = title;
//                 column.header().replaceChildren(input);
 
//                 // Event listener for user input
//                 input.addEventListener('keyup', () => {
//                     if (column.search() !== this.value) {
//                         column.search(input.value).draw();
//                     }
//                 });
//             });
//     }
// });

// Prevent Select2 on /job page, allow globally elsewhere

$(document).ready(function() {
  if (window.location.pathname === '/job' || window.location.pathname === '/job/') {
    // Remove Select2 from all selects on job page if present
    $('select.select2').each(function() {
      if ($(this).hasClass('select2-hidden-accessible')) {
        $(this).select2('destroy');
        $(this).removeClass('select2');
      }
    });
    // Also on modal show, in case dynamic
    $('#edit_data, #found_issue, #status, #assign, #couriereStatus').on('shown.bs.modal', function () {
      $(this).find('select.select2').each(function() {
        if ($(this).hasClass('select2-hidden-accessible')) {
          $(this).select2('destroy');
          $(this).removeClass('select2');
        }
      });
    });
  } else {
    // Global Select2 initialization for all other pages
    $('select.form-control').addClass('select2');
    if ($.fn.select2) {
      $('select.select2').select2({ theme: 'bootstrap4' });
    }
  }
});