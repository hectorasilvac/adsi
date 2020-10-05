<?php  
session_start(); 
$check = 1; 
$_SESSION["check"] = $check; 
?> 

<div class="container">

<div class="card mb-2 mt-2">
  <div class="card-header">
    CRUD
  </div>
  <div class="card-body">
    <h5 class="card-title">Panel de Control</h5>
    <p class="card-text">Sistema de usuario básico desarrollado con PHP aplicando MVC, simple, amigable y escalable, usando MySQL para la base de datos y Bootstrap para el diseño de la interfaz web.</p>
    <a class="btn btn-primary" href="https://github.com/silvahector/adsi" target="_blank">Ir al repositorio</a>
  </div>
</div>

<table class="table table-sm table-bordered table-responsive-md ">
  <thead class="thead-light">
    <tr class="text-center">
      <th scope="col">Nombres</th>
      <th scope="col">Apellidos</th>
      <th scope="col">Género</th>
      <th scope="col">E-mail</th>
      <th scope="col">Rol</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($users as $user): ?>
    <form method="POST">
    <tr>
      <input type="text" id="user[user_id]" name="user[user_id]" class="border-0 rounded bg-transparent" readonly value="<?= $user->user_id; ?>" hidden>
      <td><input type="text" id="user[user_firstname]" name="user[user_firstname]" class="border-0 rounded bg-transparent" value="<?= $user->user_firstname; ?>"></td>
      <td><input type="text" id="user[user_lastname]" name="user[user_lastname]" class="border-0 rounded bg-transparent" value="<?= $user->user_lastname; ?>"></td>
      <td><input type="text" id="user[user_gender]" name="user[user_gender]" class="border-0 rounded bg-transparent" value="<?= $user->user_gender; ?>"></td>
      <td><input type="text" id="user[user_email]" name="user[user_email]" class="border-0 rounded bg-transparent" value="<?= $user->user_email; ?>"></td>
      <td>
          <select id="user[user_permissions]" name="user[user_permissions]" class="border-0">
            <?php if($user->user_permissions != 1): ?>
            <option value="1">Administrador</option>
            <option value="2" selected>Usuario</option>
            <?php else: ?>
            <option value="1" selected>Administrador</option>
            <option value="2" >Usuario</option>
            <?php endif; ?>
        </select>
      </td>
      <td><button formaction="/user/edit" class="btn btn-primary" onclick="return confirm('¿Segur@ de EDITAR este registro?')">Editar</button></td>
      <td><button formaction="/user/delete" class="btn btn-danger" onclick="return confirm('¿Segur@ de ELIMINAR este registro?')">Eliminar</button></td>
    </tr>
  </form>
    <?php endforeach; ?>
    <form method="POST">
    <tr>
      <td><input type="text" id="user[user_firstname]" name="user[user_firstname]" class="border-0 rounded bg-transparent" placeholder="Nombres"></td>
      <td><input type="text" id="user[user_lastname]" name="user[user_lastname]" class="border-0 rounded bg-transparent" placeholder="Apellidos"></td>
      <td><input type="text" id="user[user_gender]" name="user[user_gender]" class="border-0 rounded bg-transparent" placeholder="Género"></td>
      <td><input type="text" id="user[user_email]" name="user[user_email]" class="border-0 rounded bg-transparent" placeholder="E-mail"></td>
      <td>
          <select id="user[user_permissions]" name="user[user_permissions]" class="border-0">
              <option value="1">Administrador</option>
              <option value="2" selected>Usuario</option>
          </select>
      </td>
      <td><button formaction="/user/edit" class="btn btn-success" onclick="return confirm('¿Segur@ de AGREGAR este registro?')">Agregar</button></td>
      <td><button type="reset" formaction="/user/delete" class="btn btn-secondary" onclick="return confirm('¿Segur@ de RESETEAR este registro?')">Resetear</button></td>
    </tr>
  </form>
  </tbody>
</table>
<div class="text-center mb-2">
Desarrollado por Hector Alejandro Silva Cardenas
  </div>
</div>