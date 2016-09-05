<div id="<?php echo $id ?>"></div>
<script type="text/javascript">
    var chart = c3.generate({
        bindto: '<?php echo "#$id" ?>',
        data: {
            x: '<?php echo $ejex ?>',
            rows: <?php echo $data ?>,
            //groups: [<?php echo $groups ?>],
            type: 'line',
            order: null,
        },
        axis: {
            x: {
                type: 'category'
            }
        },
        point: {
            show: true
        },

    });
</script>






