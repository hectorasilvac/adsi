<?php session_start(); ?>
<?php $check = $_SESSION["check"]; ?>
<?php if ($check == 1): ?>
<?php unset($_SESSION["check"]); ?>

<div class="container">
    <?php if(isset($process)): ?>

<div class="card text-white bg-danger mb-3">
  <div class="card-header">CRUD</div>
  <div class="card-body">
    <h5 class="card-title">Operación Fallida</h5>
    <p class="card-text">Se ha presentado el siguiente problema: <?= $process; ?></p>
  </div>
    <?php else: ?>

        <div class="card text-white bg-success mb-3">
  <div class="card-header">CRUD</div>
  <div class="card-body">
    <h5 class="card-title">Operación Exitosa</h5>
    <p class="card-text">Se ha registrado la transacción correctamente en nuestro sistema.</p>
  </div>
  
    <?php endif; ?>
</div>
<div class="col"><a href="/user/list" target="_self" class="btn btn-primary">Volver</a></div>

<?php else: ?>
<?php header("Location: /user/list"); ?>;
<?php endif; ?>