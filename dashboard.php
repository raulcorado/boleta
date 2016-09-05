<?php
include 'secure.php';
include 'conection.php';



$filtro = "1=1 "
. "and year(estatusfecha)=year(now()) ";
$fhallazgo = "EDUCACION";
$filtrodesc = "| " . date('Y');

if (isset($_POST['filtrar'])) {
      $filtro = "1=1 ";
      $filtrodesc = "";

      if ($_POST[cw] != "") {
            $filtro = $filtro . "and cw='$_POST[cw]' ";
            $filtrodesc = $filtrodesc . " | " . $_POST[cw];
      }
      if ($_POST[pucode] != "") {
            $filtro = $filtro . "and `pu code`='$_POST[pucode]' ";
            $filtrodesc = $filtrodesc . " | " . $_POST[pucode];
      }
      if ($_POST[afiliationlevelname] != "") {
            $filtro = $filtro . "and `afiliation level name`='$_POST[afiliationlevelname]' ";
            $filtrodesc = $filtrodesc . " | " . $_POST[afiliationlevelname];
      }
      if ($_POST[idestatus] != "") {
            $filtro = $filtro . "and `idestatus`='$_POST[idestatus]' ";
            $filtrodesc = $filtrodesc . " | ESTATUS " . $_POST[idestatus];
      }
      if ($_POST[hallazgo] != "") {
            $filtro = $filtro . "and $_POST[hallazgo]_hallazgo='1' ";
            if ($_POST[hallazgo] == "n") {
                  $fhallazgo = "NUTRICION";
            }
            if ($_POST[hallazgo] == "s") {
                  $fhallazgo = "SALUD";
            }
            if ($_POST[hallazgo] == "p") {
                  $fhallazgo = "PROTECCION";
            }
            if ($_POST[hallazgo] == "e") {
                  $fhallazgo = "EDUCACION";
            }
            $filtrodesc = $filtrodesc . " | " . $fhallazgo;
      }
      if ($_POST[ano] != "") {
            $filtro = $filtro . "and year(estatusfecha)='$_POST[ano]' ";
            $filtrodesc = $filtrodesc . " | " . $_POST[ano];
      }
      if ($_POST[trim] != "") {
            $filtro = $filtro . "and quarter(estatusfecha)='$_POST[trim]' ";
            $filtrodesc = $filtrodesc . " | TRIMESTRE " . $_POST[trim];
      }
      if (isset($_POST[entre])) {
            $filtro = $filtro . "and estatusfecha  between '$_POST[del]' and '$_POST[al]' ";
            $filtrodesc = $filtrodesc . " | DEL " . $_POST[del] . " AL " . $_POST[al];
      }


      if ($filtrodesc == "") {
            $filtrodesc = "| ningún filtro definido";
      }
}
$filtrodesc = "<span class='glyphicon glyphicon-filter'></span>" . $filtrodesc . " |";



include 'header.php';
?>

<!-- Modal SC -->
<div id="modalfiltro" class="modal fade" role="dialog">
      <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content">
                  <div class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span class="glyphicon glyphicon-filter" aria-hidden="true">  </span>FILTRO</h4>
                  </div>
                  <div class="modal-body">
                        <div class="container-fluid">
                              <form role="form" class="form-horizontal" action="dashboard" method="post">
                                    <h4>SELECCIONE UNO O VARIOS CAMPOS</h4>
                                    <hr />
                                    <div class="form-group">
                                          <div class="col-xs-4">
                                                <label for="cw">Facilitador:</label>
                                                <select class="form-control input-sm" id="cw" name="cw">
                                                      <option value="" selected>todos</option>
                                                      <?php
                                                      $query = "select `cw` from boletas left join scactive on sc=`sc number` group by 1 order by 1";
                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option value='$row[0]'>$row[0]</option>";
                                                      }
                                                      ?>
                                                </select>
                                          </div>
                                          <div class="col-xs-4">
                                                <label for="pucode">UP:</label>
                                                <select class="form-control input-sm" id="pucode" name="pucode">
                                                      <option value="" selected>todos</option>
                                                      <?php
                                                      $query = "select depto from sdepto order by 1";
                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option value='$row[0]'>$row[0]</option>";
                                                      }
                                                      ?>
                                                </select>
                                          </div>
                                          <div class="col-xs-4">
                                                <label for="afiliationlevelname">Comunidad:</label>
                                                <select class="form-control input-sm" id="afiliationlevelname" name="afiliationlevelname">
                                                      <option value="" selected>todos</option>
                                                      <?php
                                                      $query = "select `pu code`, `afiliation level name` from boletas left join scactive on sc=`sc number` group by 2 order by 1, 2";
                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option value='$row[1]'>$row[1] ($row[0])</option>";
                                                      }
                                                      ?>
                                                </select>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <div class="col-xs-4">
                                                <label for="idestatus">ESTATUS:</label>
                                                <select class="form-control input-sm" id="idestatus" name="idestatus">
                                                      <option value="" selected>todos</option>
                                                      <?php
                                                      $query = "select id, estatus from estatus order by 1";
                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option value='$row[0]'>$row[1]</option>";
                                                      }
                                                      ?>
                                                </select>
                                          </div>
                                          <div class="col-xs-4">
                                                <label for="hallazgo">HALLAZGO:</label>
                                                <select class="form-control input-sm" id="hallazgo" name="hallazgo">
                                                      <option value="" selected>todos</option>
                                                      <option value='n'>NUTICION</option>
                                                      <option value='s'>SALUD</option>
                                                      <option value='p'>PROTECCION</option>
                                                      <option value='e'>EDUCACION</option>

                                                </select>
                                          </div>
                                          <div class="col-xs-4">
                                          </div>
                                    </div>

                                    <div class="form-group">
                                          <div class="col-xs-4">
                                                <label for="ano">AÑO:</label>
                                                <select class="form-control input-sm" id="ano" name="ano">
                                                      <option value="" selected>todos</option>
                                                      <?php
                                                      $query = "select year(estatusfecha) from boletas group by 1 order by 1";
                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            echo "<option value='$row[0]' " . (date('Y') == $row[0] ? "selected" : "") . " >$row[0]</option>";
                                                      }
                                                      ?>
                                                </select>

                                          </div>
                                          <div class="col-xs-4">

                                                <label for="trim">Trimestre:</label>
                                                <select class="form-control input-sm" id="trim" name="trim">
                                                      <option value="" selected>todos</option>
                                                      <option value='1'>1</option>
                                                      <option value='2'>2</option>
                                                      <option value='3'>3</option>
                                                      <option value='4'>4</option>
                                                </select>


                                          </div>

                                    </div>
                                    <div class="form-group">
                                          <div class="col-xs-4">
                                                <div class="checkbox"><label><input type="checkbox" name="entre"> Entre</label></div>
                                          </div>
                                          <br />
                                          <div class="col-xs-4">
                                                <label for="boletafecha">DEL:</label>
                                                <input type="date" name="del" class="form-control input-sm" value="<?php echo date() ?>">
                                          </div>
                                          <div class="col-xs-4">
                                                <label for="boletafecha">AL:</label>
                                                <input type="date" name="al" class="form-control input-sm" value="<?php echo date() ?>">
                                          </div>
                                    </div>

                                    <hr />
                                    <div class="text-right">
                                          <button type="submit" class="btn btn-success" name="filtrar"><span class='glyphicon glyphicon-ok'> </span>Aceptar</button>
                                          <button type="button" class="btn btn-danger" data-dismiss="modal"><span class='glyphicon glyphicon-remove'> </span>Cancelar</button>
                                    </div>


                              </form>
                        </div>
                  </div>
                  <div class="modal-footer bg-success">

                  </div>
            </div>
      </div>
</div>


<div class="row">
      <div class="panel panel-info">
            <div class="panel-heading">
                  <p><span class="glyphicon glyphicon-info-sign"></span>Información General</p>
            </div>
            <div class="panel-body">
                  <h4 class="text-center">TABLA GENERAL DE CASOS POR ESTATUS</h4>
                  <table class="table table-condensed table-hover table-striped">
                        <?php
                        // CROSS INICIO
                        $gquery="select puname `UP`, estatus from boletasgeneral ";
                        $field1 = "UP";
                        $field2 = "estatus";
                        $tot=1; //columna totales
                        include 'fnc/cross.php';
                        // CROSS FINAL
                        //TCONTENT INICIO
                        include 'fnc/tcontent.php';
                        //TCONTENT FINAL
                        ?>
                  </table>
                  <hr>
                  <?php
                  // SERIAL INICIO
                  $gquery = "select puname `UP`, estatus from boletasgeneral ";
                  $field1 = "UP";
                  $field2 = "estatus";
                  include 'fnc/serial.php';
                  // SERIAL FINAL

                  $id="g1";
                  include     'gbar.php';


                  ?>

            </div>
      </div>
</div>

<br>

<div class="text-right">
      <span data-toggle="tooltip" data-placement="left" title="Definir filtro">
            <a href="#" data-target="#modalfiltro" class="btn btn-primary" data-toggle="modal"><span class='glyphicon glyphicon-filter'></span>FILTRO</a>
      </span>
      <a href="dashboard" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Quitar filtro"><span class='glyphicon glyphicon-asterisk'> </span>LIMPIAR</a>
</div>
<br />



<div class="row">
      <?php
      $query = "select "
      . "count(case when idestatus=1 then 1 end) 'abiertos', "
      . "count(case when idestatus=2 then 1 end) 'RESUELTOS', "
      . "count(case when idestatus=3 then 1 end) 'Cvisi', "
      . "count(case when idestatus=4 then 1 end) 'Cfall', "
      . "count(case when idestatus=5 then 1 end) 'Ccanc', "
      . "count(case when idestatus=6 then 1 end) 'Cdisc', "
      . "count(case when idestatus=7 then 1 end) 'Cmatr', "
      . "count(case when idestatus=8 then 1 end) 'Cerrado', "
      . "count(case when n_hallazgo=1 then 1 end) as 'NUTRICION', "
      . "count(case when s_hallazgo=1 then 1 end) as 'SALUD', "
      . "count(case when p_hallazgo=1 then 1 end) as 'PROTECCION', "
      . "count(case when e_hallazgo=1 then 1 end) as 'EDUCACION', "
      . "count(case when Gender = 'M' then 1 end) as 'M', "
      . "count(case when Gender = 'F' then 1 end) as 'F', "
      . "count(*) TOTAL "
      . "FROM boletas b left join scactive a on sc=`sc number` "
      . "where $filtro";


      $result = mysqli_query($link, $query);
      mysqli_data_seek($result, 0);
      $row = mysqli_fetch_array($result);
      ?>
      <div class="col-xs-9">
            <div class="alert alert-info">
                  <h3>CASOS DETECTADOS POR ESTATUS</h3>
                  <small class="text-danger"><?php echo $filtrodesc ?></small>
                  <?php
                  $gquery = "select `pu name` puname, estatus FROM boletas b left join scactive a on sc=`sc number` left join estatus e on b.idestatus=e.id "
                  . "where $filtro";

                  $field1 = "puname";     //Filas
                  $field2 = "estatus";      //Columnas o "TOTAL"
                  $id = $field2;
                  include 'serializa.php';
                  include 'gbar.php';
                  ?>


                  <!--                    <hr />
                  <p>Se registraron <span class="label label-default"><?php echo "$row[$fhallazgo]" ?></span> casos de <?php echo $fhallazgo ?> y se han resuelto <span class="label label-success"><?php echo $row[RESUELTOS] ?></span> equivalentes al <?php echo round(100 * $row[RESUELTOS] / $row[$fhallazgo], 1) ?>%.</p>
                  <p><span class="label label-warning"><?php echo $row[Cvisi] ?></span> casos fueron cerrados despues de realizar una visita, equivalentes al <?php echo round($row[Cvisi] / $row[$fhallazgo] * 100, 1) ?>%. </p>
                  <p><span class="label label-warning"><?php echo ($row[Cfall] + $row[Ccanc] + $row[Cdisc] + $row[Cmatr] + $row[CERRADO]) ?></span> fueron cerrados por diferentes causas y <span class="label label-danger"><?php echo $row[abiertos] ?></span> todavía permanecen abiertos</p>-->






            </div>

      </div>
      <div class="col-xs-3">
            <div class="alert alert-info">
                  <hr />
                  <p>EDUCACION</p>

                  <?php
                  $query = "select "
                  . "count(case when idestatus=3 then 1 end) 'CERRADOS VISITA', "
                  . "count(case when idestatus=2 then 1 end) 'RESUELTOS', "
                  . "count(case when ((idestatus=1) or (idestatus=4) or (idestatus=5) or (idestatus=6) or (idestatus=7) or (idestatus=8)) then 1 end) '-' "
                  . "FROM boletas b left join scactive a on sc=`sc number` "
                  . "where e_hallazgo='1' "
                  . "and $filtro";

                  $result = mysqli_query($link, $query);
                  mysqli_data_seek($result, 0);
                  $data = "[['CERRADOS VISITA','RESUELTOS','-'],";
                  $row = mysqli_fetch_row($result);
                  $data = $data . "[$row[0], $row[1], $row[2]], ";

                  $data = $data . "]";
                  $chid = "EDU3";
                  $titulo = round(100 * ($row[0] + $row[1]) / ($row[0] + $row[1] + $row[2])) . "%";
                  ?>


                  <div id="<?php echo $chid ?>"></div>
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
                  </script>

            </div>
      </div>
</div>





<div class="row">
      <?php
      for ($q = 1; $q <= 4; $q++) {
            $query = "select "
            . "count(case when idestatus = 1 then 1 end) 'abiertos', "
            . "count(case when idestatus = 2 then 1 end) 'RESUELTOS', "
            . "count(case when idestatus = 3 then 1 end) 'Cvisi', "
            . "count(case when idestatus = 4 then 1 end) 'Cfall', "
            . "count(case when idestatus = 5 then 1 end) 'Ccanc', "
            . "count(case when idestatus = 6 then 1 end) 'Cdisc', "
            . "count(case when idestatus = 7 then 1 end) 'Cmatr', "
            . "count(case when idestatus = 8 then 1 end) 'Cerrado', "
            . "count(*) TOTAL "
            . "FROM boletas b left join scactive a on sc = `sc number` "
            . "where "
            . "quarter(estatusfecha) = $q "
            . "and $filtro";


            $result = mysqli_query($link, $query);
            mysqli_data_seek($result, 0);
            $row = mysqli_fetch_array($result);
            ?>
            <div class="col-xs-3">
                  <div class="alert alert-info text-center">
                        <p>TRIMESTRE <?php echo $q ?></p>
                        <h4><span class="glyphicon glyphicon-info-sign"></span></h4>
                        <div class="text-muted col-xs-6">

                              <small>TOTAL</small>
                              <h2 style="margin-top:0px"><?php echo "$row[TOTAL]" ?></h2>

                        </div>
                        <div class="text-info col-xs-6" style="color: #4c5c68">

                              <small>CONCLUIDOS</small>
                              <h2 style = "margin-top:0px"><?php echo ($row[TOTAL] - $row[abiertos])
                              ?> </h2>

                        </div>
                        <p>-</p>
                        <div class="progress">
                              <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuemin='0' aria-valuemax='100' style='width: <?php echo 100 * ($row[TOTAL] - $row[abiertos]) / $row[TOTAL] ?>%; background-color: #4c5c68'><?php echo round(100 * ($row[TOTAL] - $row[abiertos]) / $row[TOTAL]) ?>%</div>
                        </div>
                        <div class="progress">
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[RESUELTOS] / $row[TOTAL]; ?>%; background-color: #028090'><?php echo "$row[RESUELTOS]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Cvisi] / $row[TOTAL]; ?>%; background-color: #00a896'><?php echo "$row[Cvisi]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Ccanc] / $row[TOTAL]; ?>%; background-color: #02c39a'><?php echo "$row[Ccanc]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Cfall] / $row[TOTAL]; ?>%; background-color: #f0f3bd'><?php echo "$row[Cfall]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Cdisc] / $row[TOTAL]; ?>%; background-color: #c5c3c6'><?php echo "$row[Cdisc]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Cmatr] / $row[TOTAL]; ?>%; background-color: #ffbf00'><?php echo "$row[Cmatr]" ?></div>
                              <div class='progress-bar' role='progressbar' aria-valuemin='0' aria-valuemax='<?php echo "$row[TOTAL]" ?>' style='width: <?php echo 100 * $row[Cerrado] / $row[TOTAL]; ?>%; background-color: #2274a5'><?php echo "$row[Cerrado]" ?></div>
                        </div>
                        <table class="table table-condensed text-left">
                              <tbody>

                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #028090"></span>Resueltos </td><td><?php echo $row[RESUELTOS] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #00a896"></span>Cerrados Visita</td><td><?php echo $row[Cvisi] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #02c39a"></span>Cerrados Cancelado</td><td><?php echo $row[Ccanc] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #f0f3bd"></span>Cerrados Fallecimiento Fam</td><td><?php echo $row[Cfall] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #c5c3c6"></span>Cerrados Discapacidad</td><td><?php echo $row[Cdisc] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #ffbf00"></span>Cerrados Matrimonio</td><td><?php echo $row[Cmatr] ?></td></tr>
                                    <tr><td><span class="glyphicon glyphicon-info-sign" style="color: #2274a5"></span>Cerrado</td><td><?php echo $row[Cerrado] ?></td></tr>
                              </tbody>
                        </table>

                  </div>
            </div>
            <?php } ?>
      </div>










      <div class="row">
            <div class="col-xs-12">
                  <div class="row">
                        <div class="col-xs-4">

                              <div class="alert alert-danger">
                                    <p>CASOS POR SEXO</p>
                                    <table class="table table-condensed table-hover nowrap">
                                          <thead>
                                                <tr class="tbl-header">
                                                      <th>UP</th><th>M</th><th>F</th><th>TOTAL</th><th>NIÑOS / NIÑAS</th>
                                                </tr>
                                          </thead>
                                          <tbody>
                                                <?php
                                                $query = "select "
                                                . "`pu name` as up, "
                                                . "count(case when Gender='M' then 1 end) as 'M', "
                                                . "count(case when Gender='F' then 1 end) as 'F', "
                                                . "count(*) as total "
                                                . "FROM boletas b left join scactive a on sc=`sc number` left join estatus e on b.idestatus=e.id "
                                                . "where $filtro "
                                                . "group by 1 order by 3 desc";

                                                $result = mysqli_query($link, $query);
                                                mysqli_data_seek($result, 0);
                                                while ($row = mysqli_fetch_row($result)) {
                                                      ?>
                                                      <tr>
                                                            <td><?php echo $row[0]; ?></td>
                                                            <td><?php echo $row[1]; ?></td>
                                                            <td><?php echo $row[2]; ?></td>
                                                            <td><?php echo $row[3]; ?></td>
                                                            <td>
                                                                  <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuemin='0' aria-valuemax='100' style='width: <?php echo 100 * $row[1] / $row[3] ?>%; background-color: royalblue'><?php echo $row[1] ?></div>
                                                                  <div class='progress-bar progress-bar-striped active' role='progressbar' aria-valuemin='0' aria-valuemax='100' style='width: <?php echo 100 * $row[2] / $row[3] ?>%; background-color: hotpink'><?php echo $row[2] ?></div>
                                                            </td>
                                                      </tr>
                                                      <?php } ?>
                                                </tbody>
                                          </table>

                                    </div>
                              </div>
                              <div class="col-xs-4">

                                    <div class="alert alert-danger">
                                          <p>CASOS POR HALLAZGO</p>
                                          <table class="table table-condensed table-hover nowrap">
                                                <thead>
                                                      <tr class="tbl-header">
                                                            <th>UP</th><th>NU</th><th>SA</th><th>PR</th><th>ED</th><th>TOTAL</th>
                                                      </tr>
                                                </thead>
                                                <tbody>
                                                      <?php
                                                      $query = "select "
                                                      . "`pu name` as up, "
                                                      . "count(case when n_hallazgo=1 then 1 end) as 'NUTRICION', "
                                                      . "count(case when s_hallazgo=1 then 1 end) as 'SALUD', "
                                                      . "count(case when p_hallazgo=1 then 1 end) as 'PROTECCION', "
                                                      . "count(case when e_hallazgo=1 then 1 end) as 'EDUCACION', "
                                                      . "count(*) as total "
                                                      . "FROM boletas b left join scactive a on sc=`sc number` left join estatus e on b.idestatus=e.id "
                                                      . "where $filtro "
                                                      . "group by 1 order by total desc";

                                                      $result = mysqli_query($link, $query);
                                                      mysqli_data_seek($result, 0);
                                                      while ($row = mysqli_fetch_row($result)) {
                                                            ?>
                                                            <tr>
                                                                  <td><?php echo $row[0] ?></td>
                                                                  <td><?php echo $row[1] ?></td>
                                                                  <td><?php echo $row[2] ?></td>
                                                                  <td><?php echo $row[3] ?></td>
                                                                  <td><?php echo $row[4] ?></td>
                                                                  <td><div><?php echo $row[5] ?></div></td>
                                                            </tr>
                                                            <?php } ?>
                                                      </tbody>
                                                </table>
                                          </div>
                                    </div>
                                    <div class="col-xs-4">

                                          <div class="alert alert-success">
                                                <p>CASOS POR HALLAZGO</p>
                                                <table class="table table-condensed table-hover nowrap">
                                                      <thead>
                                                            <tr class="tbl-header">
                                                                  <th>UP</th><th>NU</th><th>SA</th><th>PR</th><th>ED</th><th>TOTAL</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                            <?php
                                                            $query = "select "
                                                            . "`pu name` as up, "
                                                            . "count(case when n_hallazgo=1 then 1 end) as 'NUTRICION', "
                                                            . "count(case when s_hallazgo=1 then 1 end) as 'SALUD', "
                                                            . "count(case when p_hallazgo=1 then 1 end) as 'PROTECCION', "
                                                            . "count(case when e_hallazgo=1 then 1 end) as 'EDUCACION', "
                                                            . "count(*) as total "
                                                            . "FROM boletas b left join scactive a on sc=`sc number` left join estatus e on b.idestatus=e.id "
                                                            . "where $filtro "
                                                            . "group by 1 order by total desc";

                                                            $result = mysqli_query($link, $query);
                                                            mysqli_data_seek($result, 0);
                                                            while ($row = mysqli_fetch_row($result)) {
                                                                  ?>
                                                                  <tr>
                                                                        <td><?php echo $row[0] ?></td>
                                                                        <td><?php echo $row[1] ?></td>
                                                                        <td><?php echo $row[2] ?></td>
                                                                        <td><?php echo $row[3] ?></td>
                                                                        <td><?php echo $row[4] ?></td>
                                                                        <td><div><?php echo $row[5] ?></div></td>
                                                                  </tr>
                                                                  <?php } ?>
                                                            </tbody>
                                                      </table>
                                                </div>
                                          </div>
                                    </div>







                                    <div class="row">
                                          <div class="col-xs-12">
                                                <div class="alert alert-info">
                                                      <p>añops</p>
                                                      <table class="table table-condensed table-hover nowrap" width="100%">
                                                            <thead>
                                                                  <tr>
                                                                        <?php
                                                                        $query = "select "
                                                                        . "`pu name` as 'UNIDAD DE PROGRAMA', "
                                                                        . "count(case when idestatus=1 then 1 end) as 'ABIERTOS', "
                                                                        . "count(case when idestatus=2 then 1 end) as 'RESUELTOS', "
                                                                        . "count(case when idestatus=3 then 1 end) as 'Cerrado despues de visita', "
                                                                        . "count(case when idestatus=4 then 1 end) as 'Cerrado notif fallecimiento', "
                                                                        . "count(case when idestatus=5 then 1 end) as 'Cerrado por cancelacion', "
                                                                        . "count(case when idestatus=6 then 1 end) as 'Cerrado discapacidad', "
                                                                        . "count(case when idestatus=7 then 1 end) as 'Cerrado matrimonio', "
                                                                        . "count(case when idestatus=8 then 1 end) as 'Cerrado', "
                                                                        . "count(*) as TOTAL "
                                                                        . "FROM boletas b left join scactive a on sc=`sc number` "
                                                                        . "where $filtro "
                                                                        . "group by 1 order by 10 desc";


                                                                        $result = mysqli_query($link, $query);
                                                                        $field_cnt = mysqli_num_fields($result);
                                                                        mysqli_data_seek($result, 0);
                                                                        while ($property = mysqli_fetch_field($result)) {
                                                                              ?>
                                                                              <th width='<?php echo (100 / $field_cnt) . "%" ?>'><?php echo "$property->name" ?></th>
                                                                              <?php } ?>
                                                                        </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                        <?php
                                                                        mysqli_data_seek($result, 0);
                                                                        while ($row = mysqli_fetch_row($result)) {
                                                                              ?>
                                                                              <tr>
                                                                                    <?php
                                                                                    for ($i = 0; $i <= $field_cnt; $i++) {
                                                                                          ?>
                                                                                          <td><?php echo $row[$i] ?>  </td>
                                                                                          <?php } ?>
                                                                                    </tr>
                                                                                    <?php } ?>
                                                                              </tbody>
                                                                        </table>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>



                                          <div class="row">
                                                <div class="col-xs-3">
                                                      <div class="alert alert-info">
                                                            <p>NUTRICION</p>
                                                            <?php
                                                            $query = "select "
                                                            . "count(case when idestatus>2 then 1 end) 'CERRADOS', "
                                                            . "count(case when idestatus=2 then 1 end) 'RESUELTOS', "
                                                            . "count(case when idestatus=1 then 1 end) 'ABIERTOS' "
                                                            . "FROM boletas b left join scactive a on sc=`sc number` "
                                                            . "where n_hallazgo='1' "
                                                            . "and $filtro";

                                                            $result = mysqli_query($link, $query);
                                                            mysqli_data_seek($result, 0);
                                                            $data = "[['CERRADOS','RESUELTOS','ABIERTOS'],";
                                                            $row = mysqli_fetch_row($result);
                                                            $data = $data . "[$row[0], $row[1], $row[2]], ";

                                                            $data = $data . "]";
                                                            $chid = "NUT";
                                                            $titulo = round(100 * ($row[0] + $row[1]) / ($row[0] + $row[1] + $row[2])) . "%";
                                                            ?>


                                                            <div id="<?php echo $chid ?>"></div>
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
                                                            </script>

                                                      </div>
                                                </div>

                                                <div class="col-xs-3">
                                                      <div class="alert alert-info">
                                                            <p>SALUD</p>
                                                            <?php
                                                            $query = "select "
                                                            . "count(case when idestatus>2 then 1 end) 'CERRADOS', "
                                                            . "count(case when idestatus=2 then 1 end) 'RESUELTOS', "
                                                            . "count(case when idestatus=1 then 1 end) 'ABIERTOS' "
                                                            . "FROM boletas b left join scactive a on sc=`sc number` "
                                                            . "where s_hallazgo='1' "
                                                            . "and $filtro";

                                                            $result = mysqli_query($link, $query);
                                                            mysqli_data_seek($result, 0);
                                                            $data = "[['CERRADOS','RESUELTOS','ABIERTOS'],";
                                                            $row = mysqli_fetch_row($result);
                                                            $data = $data . "[$row[0], $row[1], $row[2]], ";

                                                            $data = $data . "]";
                                                            $chid = "SAL";
                                                            $titulo = round(100 * ($row[0] + $row[1]) / ($row[0] + $row[1] + $row[2])) . "%";
                                                            ?>


                                                            <div id="<?php echo $chid ?>"></div>
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
                                                            </script>

                                                      </div>
                                                </div>
                                                <div class="col-xs-3">
                                                      <div class="alert alert-info">
                                                            <p>PROTECCION</p>
                                                            <?php
                                                            $query = "select "
                                                            . "count(case when idestatus>2 then 1 end) 'CERRADOS', "
                                                            . "count(case when idestatus=2 then 1 end) 'RESUELTOS', "
                                                            . "count(case when idestatus=1 then 1 end) 'ABIERTOS' "
                                                            . "FROM boletas b left join scactive a on sc=`sc number` "
                                                            . "where p_hallazgo='1' "
                                                            . "and $filtro";

                                                            $result = mysqli_query($link, $query);
                                                            mysqli_data_seek($result, 0);
                                                            $data = "[['CERRADOS','RESUELTOS','ABIERTOS'],";
                                                            $row = mysqli_fetch_row($result);
                                                            $data = $data . "[$row[0], $row[1], $row[2]], ";

                                                            $data = $data . "]";
                                                            $chid = "PROT";
                                                            $titulo = round(100 * ($row[0] + $row[1]) / ($row[0] + $row[1] + $row[2])) . "%";
                                                            ?>


                                                            <div id="<?php echo $chid ?>"></div>
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
                                                            </script>

                                                      </div>
                                                </div>














                                          </div>





                                          <?php
                                          include 'footer.php';
                                          ?>
