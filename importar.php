
<?php
include 'secure.php';
include 'conection.php';




//if ($_SESSION['rolid'] <> 3) {
//    echo "<hr/><p>Solo el administrador podrá importar datos desde el CD <br /> </p>";
//}

include 'header.php';
?>



<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Importar</h1>
            <h4>Importar</h4>

            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-paperclip" aria-hidden="true">  </span>
                </div>
                <div class="panel-body">
                    <?php if (($_SESSION['rolid'] == 3)) { ?>

                        <form action="importar" method="post" name="importar" id="form1" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <hr />
                                    <label class="btn btn-info" for="file">
                                        <input name="file" id="file" type="file" >
                                    </label>
                                    <hr />
                                    <p class="text-warning">Este proceso puede tardar algunos minutos. Presione Importar y espere el resultado</p>
                                    <small id="a" class="text-success"></small>
                                    <div class="progress">
                                        <div id="mybar" class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>


                                    <hr />
                                    <button type="submit" class="btn btn-primary" name="submit"><span class='glyphicon glyphicon-import'> </span> Importar</button>
                                    <hr />
                                </div>
                            </div>
                            <br />
                        </form>
                        <?php
                    } else {
                        echo 'Ninguna opción disponible';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>















<?php
if (isset($_POST['submit']) and ( $_SESSION['rolid'] = 3)) {
//if (isset($_POST['submit'])) {
    $file = $_FILES['file']['tmp_name'];

    $fl = file($file);
    $count = count($fl);

    if ($_FILES['file']['size'] > 0) {
        $handle = fopen($file, "r");
        $e;
        $i = 0;
        set_time_limit(0);
        while (($data = fgetcsv($handle, 1000, ",")) !== false) {

//            borrar el SC antes de insertar
            $query = "delete from scactive where `sc number` = $data[1]";
            $result = mysqli_query($link, $query);

//            insertar el SC especifico
            $query = "insert into scactive (`sc status`, `sc number`, `sc name`,   `gender`,  `dob`,       `afiliation level name`,    `cw`,      `pu code`,   `pu name`) values "
                    . "                    ('$data[0]',    $data[1],   '$data[2]', '$data[3]', '$data[4]', '$data[5]',                 '$data[6]', '$data[7]',  '$data[8]')";
            $result = mysqli_query($link, $query);
            if (!$result) {
                $e++;
                echo $query;
                echo '<br />';
            } else {
                $i++;
                //echo "$data[1]\n";
                //echo ".";
            }
            $p = round($i * 100 / $count, 0);
            ob_flush();
            echo "<script language='javascript'> "
            . "$('#mybar').css('width', '$p%');"
            . "$('#mybar').text('$p%');"
            . "$('#a').text('$data[8] $data[0] $data[1] $data[2]');"
            . "</script>";
            flush();
        }
        echo "<hr/><p>Registros importados correctamente: $i <br /> </p>"
        . "<p>Registros saltados en el proceso: $e </p> <hr/>";
    }
}



include 'footer.php';
?>
