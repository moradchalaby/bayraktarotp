 <!-- footer content -->

 <style type="text/css">
@media print {
    .gizle {
        display: none;
    }
}
 </style>

 <footer>
     <div class="pull-right">
         <a href="https://www.yuzaki.comp">YÜZAKI</a> EĞİTİM KURUMLARI
     </div>
     <div class="clearfix"></div>
 </footer>
 <!-- /footer content -->
 </div>
 </div>



 <!-- jQuery -->
 <script src="../vendors/jquery/dist/jquery.min.js"></script>
 <!-- surukle -->
 <!-- jquery kütüphanelerimizi ekliyoruz -->

 <!-- Mobil cihazlar ve tabletlerde sürükle bıark özelliğini aktif ediyoruz-->

 <!-- Bootstrap -->
 <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- Dropzone.js -->
 <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>
 <!-- bootstrap-progressbar -->
 <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
 <!-- FastClick -->
 <script src="../vendors/fastclick/lib/fastclick.js"></script>
 <!-- NProgress -->
 <script src="../vendors/nprogress/nprogress.js"></script>
 <!-- iCheck -->
 <script src="../vendors/iCheck/icheck.min.js"></script>
 <!-- Datatables -->
 <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
 <!-- input -->
 <script src="../vendors/jquery/dist/jquery-ui.min.js"></script> <!-- jquery kütüphanelerimizi ekliyoruz -->
 <script src="../vendors/jquery/dist/jquery.ui.touch-punch.min.js"></script>

 <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
 <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
 <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
 <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>

 <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
 <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
 <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
 <script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
 <script src="../vendors/jszip/dist/jszip.min.js"></script>
 <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
 <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

 <script src="../vendors/moment/moment.js"></script>
 <script src="../vendors/fullcalendar/dist/fullcalendar.js"></script>
 <script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript">
 </script>

 <!-- Custom Theme Scripts -->
 <script src="../build/js/custom.min.js"></script>

 <script src="js/colorPick.js"></script>
 <script src="../vendors/fullcalendar/dist/lang/tr.js"></script>
 <script src="../vendors/moment/locale/tr.js"></script>
 <script>
$(document).ready(function() {
    // Initialize Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 3,
        enableAllSteps: true,
        transitionEffect: 'fade',
        lang: { // Language variables for button
            next: 'İleri',
            previous: 'Geri'
        },


    });
});
$("#picker1").colorPick({
    'initialColor': '#8e44ad',
    'palette': ["#BF4565", "#93BFA3", "#F2EFC4", "#F2B680", "#F29999", "#FCFFF5", "#D1DBBD",
        "#FFF4E0",
        "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF", "#1CE882", "#F5D41E", "#C9DFF1", "#C1BBA8",
        "#EFBFA8",
        "#FF8984"
    ],
    'onColorSelected': function() {
        console.log("The user has selected the color: " + this.color)
        this.element.css({
            'backgroundColor': this.color,
            'color': this.color
        });
        $('#color').val(this.color);
    }
});
var color;
$("#picker2").colorPick({
    'initialColor': $('#color1').val(),
    'palette': ["#BF4565", "#93BFA3", "#F2EFC4", "#F2B680", "#F29999", "#FCFFF5", "#D1DBBD",
        "#FFF4E0",
        "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF", "#1CE882", "#F5D41E", "#C9DFF1", "#C1BBA8",
        "#EFBFA8",
        "#FF8984"
    ],
    'onColorSelected': function() {
        console.log("The user has selected the color: " + this.color)
        this.element.css({
            'backgroundColor': this.color,
            'color': this.color
        });
        $('#color1').val(this.color);


    }
});

$(document).ready(function() {


    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    $('#calendar').fullCalendar({
        locale: 'tr',
        lang: 'tr',
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
        },
        defaultDate: date,
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        select: function(start, end) {

            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
            $('#ModalAdd').modal('show');
        },
        eventRender: function(event, element) {
            element.bind('dblclick', function() {
                $('#ModalEdit #id').val(event.id);
                $('#ModalEdit #title').val(event.title);
                $('#ModalEdit #aciklama').val(event.aciklama);
                $('#ModalEdit #color1').val(event.color);
                $('#ModalEdit #kullanici').val(event.kullanici);
                $("#picker2").colorPick({
                    'initialColor': $('#color1').val(),
                    'palette': ["#BF4565", "#93BFA3", "#F2EFC4",
                        "#F2B680",
                        "#F29999", "#FCFFF5", "#D1DBBD", "#FFF4E0",
                        "#00ADB5", "#BAD6FD", "#E0ACF6", "#00A7FF",
                        "#1CE882",
                        "#F5D41E", "#C9DFF1", "#C1BBA8", "#EFBFA8",
                        "#FF8984"
                    ],
                    'onColorSelected': function() {
                        console.log(
                            "The user has selected the color: " +
                            this
                            .color)
                        this.element.css({
                            'backgroundColor': this.color,
                            'color': this.color
                        });
                        $('#color1').val(this.color);


                    }
                });
                $('#ModalEdit').modal('show');
            });
        },
        eventDrop: function(event, delta, revertFunc) { // si changement de position

            edit(event);

        },
        eventResize: function(event, dayDelta, minuteDelta,
            revertFunc) { // si changement de longueur

            edit(event);

        },
        events: [
            <?php foreach ($events as $event) :
                        $kullanicievent = $db->prepare("SELECT * from kullanici where kullanici_id=:id");
                        $kullanicievent->execute(array(
                            'id' => $event['kullanici_id']
                        ));
                        $kullanici_idcek  = $kullanicievent->fetch(PDO::FETCH_ASSOC);
                        $start = explode(" ", $event['start']);
                        $end = explode(" ", $event['end']);
                        if ($start[1] == '00:00:00') {
                            $start = $start[0];
                        } else {
                            $start = $event['start'];
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event['end'];
                        }
                    ?> {
                id: '<?php echo $event['id']; ?>',
                title: '<?php echo $event['title']; ?>',
                aciklama: '<?php echo $event['aciklama']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
                color: '<?php echo $event['color']; ?>',
                kullanici: '<?php echo $kullanici_idcek['kullanici_adsoyad']; ?>',
            },
            <?php endforeach; ?>
        ]
    });

    function edit(event) {
        start = event.start.format('YYYY-MM-DD HH:mm:ss');
        if (event.end) {
            end = event.end.format('YYYY-MM-DD HH:mm:ss');
        } else {
            end = start;
        }

        id = event.id;

        Event = [];

        Event[0] = id;
        Event[1] = start;
        Event[2] = end;
        Event[3] = 'editDate';

        $.ajax({
            url: '../netting/islem.php',
            type: "POST",
            data: {
                Event: Event
            },
            success: function(rep) {
                if (rep == 'OK') {
                    alert('Kaydedildi');
                } else {
                    alert('Bir terslik var. Tekrar deneyin.');
                }
            }
        });
    }

});
 </script>
 <!-- Datatables -->

 <script>
$(document).ready(function() {

    var handleDataTableButtons = function() {
        if ($(".nowrap").length) {
            $(".nowrap").DataTable({
                binfo: true,
                bPaginate: false,
                lengthChange: false,
                dom: "lBfrtip",
                buttons: [{
                        extend: "copy",
                        className: "btn-sm",
                        footer: true
                    },
                    {
                        extend: "csv",
                        className: "btn-sm",
                        footer: true
                    },
                    {
                        extend: "excel",
                        className: "btn-sm",
                        footer: true
                    },
                    {
                        extend: "pdfHtml5",
                        className: "btn-sm",
                        footer: true
                    },
                    {
                        extend: "print",
                        className: "btn-sm",
                        footer: true
                    },
                ],

                responsive: true


            });
        }
    };

    TableManageButtons = function() {
        "use strict";
        return {
            init: function() {
                handleDataTableButtons();
            }
        };
    }();

    $('#datatable').DataTable();

    $('#datatable-keytable').DataTable({
        keys: true
    });



    $('#datatable-scroller').DataTable({
        ajax: "js/datatables/json/scroller-demo.json",
        deferRender: true,
        scrollY: 380,
        scrollCollapse: true,
        scroller: true
    });

    $('#datatable-fixed-header').DataTable({
        fixedHeader: true
    });

    var $datatable = $('#datatable-checkbox');

    $datatable.dataTable({

        'order': [
            [1, 'asc']
        ],
        'columnDefs': [{
            orderable: false,
            targets: [0]
        }]
    });
    $datatable.on('draw.dt', function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
        });
    });

    TableManageButtons.init();
});
 </script>


 <!-- dosya upload -->
 <script type="text/javascript">
$(document).ready(function() {
    $('.raportab').DataTable({
        dom: "lBfrtip",
        buttons: [{
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
        ],
        "searching": true,
        "paging": false,
        "info": true,
        "order": [
            [1, "asc"]
        ]
    });
});
$(document).ready(function() {
    $('.yuzunetab').DataTable({
        dom: "lBfrtip",
        buttons: [{
                extend: "copy",
                className: "btn-sm"
            },
            {
                extend: "csv",
                className: "btn-sm"
            },
            {
                extend: "excel",
                className: "btn-sm"
            },
            {
                extend: "pdfHtml5",
                className: "btn-sm"
            },
            {
                extend: "print",
                className: "btn-sm"
            },
        ],
        "searching": false,
        "paging": false,
        "info": false,
        "order": [
            [1, "asc"]
        ]
    });
});


function bs_input_file() {
    $(".input-file").before(
        function() {
            if (!$(this).prev().hasClass('input-ghost')) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("name", $(this).attr("name"));
                element.change(function() {
                    element.next(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function() {
                    element.click();
                });
                $(this).find("button.btn-reset").click(function() {
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor", "pointer");
                $(this).find('input').mousedown(function() {
                    $(this).parents('.input-file').prev().click();
                    return false;
                });
                return element;
            }
        }
    );
}
$(function() {
    bs_input_file();
});
 </script>
 <!-- önizleme -->



 <!-- dosya yükleme bitiş -->
 <script>
function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}
 </script>





 <script type="text/javascript">
$(.table).ready(function() {
    $('.table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
 </script>

 </body>

 </html>