<div class="container">
<div class="card mt-2">
  <div class="card-header">
    Acceso de Usuarios
  </div>
  <div class="card-body">
      <form method="POST">
          <div class="form-group">
              <label for="user_email">Correo electrónico</label>
              <input type="email" class="form-control" id="user_email" name="user_email" aria-describedby="emailHelp" required>
              <small id="emailHelp" class="form-text text-muted">Nunca publicaremos tu correo con nadie.</small>
          </div>

          <div class="form-group">
              <label for="user_password">Contraseña</label>
              <input type="password" class="form-control" id="user_password" name="user_password" required>
          </div>
      <div class="row justify-content-end mr-2">
      <a href="#" class="btn btn-link">¿No recuerdas tu contraseña?</a>
      <button type="submit" class="btn btn-success">Entrar</a>
      </div>
      </form>
  </div>
</div>
<p class="text-muted text-center"><em>Desarrollado por Hector Silva</em></p>
</div>