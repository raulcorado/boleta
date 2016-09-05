<div id="<?php echo $id ?>"></div>
<script type="text/javascript">
    var chart = c3.generate({
        bindto: '<?php echo "#$id" ?>',
        data: {
            x: '<?php echo $field1 ?>',
            columns: <?php echo $data ?>,
            groups: [<?php echo $groups ?>],
            type: 'pie',
            order: 'des',
        },
//        color: {
//            pattern: ['#00a896', '#02c39a', '#f2f2f2']
//        },
        gauge: {
            width: 15
        },
        legend: {
            position: 'right'
        },
        axis: {
            x: {
                type: 'category'
            }
        },
        point: {
            show: true
        },
        tooltip: {
            format: {
                value: function (value, ratio, id, index) {
                    return value;
                }
            }
        }
    });
</script>


<!--<div id="<?php echo $chid ?>"></div>
<script type="text/javascript">
    var chart = c3.generate({
        bindto: '<?php echo "#$chid" ?>',
        data: {
            rows: <?php echo $data ?>,
            type: 'donut',
            order: null,
        },
        color: {
//                        pattern: ['#002626', '#0e4749', '#d3d0cb']
            pattern: ['#00a896', '#02c39a', '#f2f2f2']
        },
        gauge: {
            width: 15
        },
        donut: {
            title: "<?php echo $titulo ?>",
            label: {
                show: false,
            }
        }

    });
</script>-->







