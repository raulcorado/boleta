<?php
//no incluir secure.php nunca aqui, ni tampoco ninguna impresion html
session_start();
include 'mivar.php';
include 'conection.php';

//if ($_SERVER["SERVER_ADDR"] != "10.32.36.14") {
//    header('Location:http://10.32.36.14/boleta');
//}

if (isset($_SESSION['login_status']) == TRUE) {
     header('Location:index.php');
} elseif (isset($_POST['submit'])) {

     $username = $_POST['username'];
     $pwd = md5($_POST['pwd']);

     //evitando sql injection funcion basico
     $username = preg_replace('/[^a-zA-Z0-9_]/', 'a', $username);
     $pwd = preg_replace('/[^a-zA-Z0-9_]/', 'a', $pwd);
     $username = mysqli_real_escape_string($link, $username);


     //$query = "SELECT * from sUSUA where (((username='$username') and (password='$pwd'))and (not disabled))";
     $query = "select u.*, d.depto, o.rolid, o.admin, r.rol from susua u, sdepto d, srolesusua o, sroles r where u.deptoid=d.id and u.id=o.userid and o.rolid=r.id and (((u.username='$username') and (u.password='$pwd')) and (not u.disabled))";
     $result = mysqli_query($link, $query);

     if (mysqli_num_rows($result) == 1) {

          $row = mysqli_fetch_array($result);
          $_SESSION['login_status'] = TRUE;
          $_SESSION['sessionapp'] = $miapp;
          $_SESSION['userid'] = $row['id']; // indice
          $_SESSION['username'] = $row['username']; //username
          $_SESSION['password'] = $_POST['pwd'];
          $_SESSION['nombrecomp'] = $row['nombrecomp'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['deptoid'] = $row['deptoid'];
          $_SESSION['depto'] = $row['depto'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['rolid'] = $row['rolid'];  //3= admin

          $query = "update susua set ultimologin=current_timestamp, logins=logins+1 where (username='$username')";
          mysqli_query($link, $query);
          header('Location:index.php');
     }
}
include 'header.php';
?>


<div class="container">
     <div class="row">
          <br />
          <br />
          <div class="col-xs-5 col-sm-6">
               <br />
               <br />
               <br />
               <br />
               <h3><?php $miapp . " " . $oficina ?></h3>
               <br />
               <h5><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Registre los <strong>casos</strong> de niños y niñas</h5>
               <br />
               <h5><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>Dé <strong>seguimiento</strong> inmediato a los casos</h5>
               <br />
               <h5><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> <strong>Reporte</strong> resumen de la información</h5>
               <br />

          </div>
          <div class="col-xs-7 col-sm-6 col-lg-4">
               <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-user" aria-hidden="true">  </span>Iniciar sesión</div>
                    <div class="panel-body">
                         <br />
                         <br />
                         <p><small>Tu usuario y clave le darán acceso al registro</small></p>

                         <form role="form" action="login" method="post">
                              <div class="form-group">
                                   <input type="text" class="form-control" name="username" id="username" placeholder="USUARIO" required="required">
                              </div>
                              <div class="form-group">

                                   <input type="password" class="form-control" name="pwd" id="pwd" placeholder="PASSWORD" required="required">
                              </div>
                              <div class="checkbox">
                                   <label><input type="checkbox" checked>Seguir conectado</label>
                              </div>
                              <button name="submit" type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in" aria-hidden="true">  </span>  Entrar</button>
                         </form>
                         <hr />
                         <small>
                              <p><a href="usersrp"><span class="glyphicon glyphicon-repeat" aria-hidden="true">  </span>Olvidé mi contraseña?</a></p>
                              <!-- <p><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true">  </span>Registrarme como usuario NUEVO</a></p> -->
                         </small>


                    </div>
               </div>

          </div>
     </div>
</div>


<?php include 'footer.php'; ?>
