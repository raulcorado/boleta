<?php
include 'secure.php';
include 'header.php';
include 'conection.php';
?>


<br />
<div class="container-fluid">




     <div class="col-md-12">
          <br />
          <h1><?php echo $_SESSION['email']; ?></h1>
          <hr />
          <p><?php echo $_SESSION['email']; ?></p>
          <p>Haga clic en casos para dar seguimiento</p>
          <br />
          <br />
          <br />
          <a href="logout.php" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-log-out" aria-hidden="true">  </span>  Salir</a>
     </div>






</div>
<?php
include 'footer.php';
?>
