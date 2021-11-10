
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
<!-- <script src="<?php echo base_url();?>res/js/demo/datatables-demo.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        //searchable dropdown
        $('.select2').select2();

        //select menu active menu page
        var active_menu = "#" + "<?php echo $menu;?>";
        var active_page = "#" + "<?php echo $menuitem;?>";

        if(active_menu != "#"){
            $(active_menu).show();
        }
        if(active_page != "#"){
            $(active_page).addClass("active");
        }

        //handle menu expand and collapse
        $('.collapsed').click(function(){
            var menu = $(this).attr("data-target");
            var hidden = $(menu).is(":hidden");
            $('.collapse').hide();
            if(hidden == false){
                $(menu).hide();
            }else{
                $(menu).show();
            }
        });

        // Confirm deletes
        $('.delete-button').click(function(){
            return confirm(' Delete this record ?');
        });

        var dtable = '<?php echo $dtable;?>';
        if (dtable == 'present') {
            // data table plugin call
            var table = $('.datatable').DataTable();
            var buttons = new $.fn.dataTable.Buttons(table, {
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }).container().appendTo($('.table-buttons'));
        }

    });
</script>

</body>

</html>