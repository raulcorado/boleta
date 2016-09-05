<?php
// temporalmente include 'secure.php';
include 'conection.php';
include 'header.php';
?>


<link href="css/c3.min.css" rel="stylesheet" type="text/css"/>
<script src="js/d3.min.js" type="text/javascript"></script>
<script src="js/c3.min.js" type="text/javascript"></script>

<style type="text/css">
    .c3-chart-arcs-title{
        font-size-adjust: inherit;
    }
    .c3-chart-arcs {
        stroke-width: 0px
    }
</style>




<div class="row">
    <div class="col-xs-12">
        <table id="tablapagos" class="table table-condensed table-hover">
            <thead class="thead-inverse">
                <tr class="bg-danger">
                    <?php
                    $gquery = "select `idestatus` puname, `e_hallazgo` scstatus from new_view";
                    $field1 = "puname";     //Filas
                    $field2 = "scstatus";      //Columnas o "TOTAL"


                    $colquery = "select a.$field2, count(a.$field2) from ($gquery) as a group by 1";
                    $result = mysqli_query($link, $colquery);
                    mysqli_data_seek($result, 0);
                    $countquery = "";
                    if ($field2 != "TOTAL") {
                        while ($row = mysqli_fetch_row($result)) {
                            $countquery = $countquery . (strlen($countquery) > 0 ? ", " : "") . "sum(case when a.$field2='$row[0]' then 1 else 0 end) as `$row[0]`";
                        }
                    } else {
                        $countquery = "count(*) as `TOTAL`";
                    }
                    $crossquery = "select a.$field1, $countquery from ($gquery) a group by 1 order by 1";
                    echo $crossquery . "<br />";
                    $result = mysqli_query($link, $crossquery);
                    $field_cnt = mysqli_num_fields($result);
                    mysqli_data_seek($result, 0);
                    while ($property = mysqli_fetch_field($result)) {
                        ?>
                        <th width='<?php echo (100 / $field_cnt) . "%" ?>'><?php echo $property->name; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                mysqli_data_seek($result, 0);
                while ($row = mysqli_fetch_row($result)) {
                    ?>
                    <tr>
                        <?php for ($i = 0; $i <= $field_cnt - 1; $i++) { ?>
                            <td><?php echo $row[$i] ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <span class="text-warning">aaaa</span>
            </tbody>
        </table>

    </div>
</div>


<div>

    <?php
    $gquery = "select `pu name` puname, `sc status` scstatus from scactive";
    $field1 = "puname";     //Filas
    $field2 = "TOTAL";      //Columnas o "TOTAL"
    $field2 = "scstatus";      //Columnas o "TOTAL"
    $id = "bars";
    include 'serializa.php';
    include 'gbar.php';
    ?>

</div>





<?php
include 'footer.php';
?>
