<section id="login">
	<div id="form-container">
		<h2>Register</h2>
		<form class="form" action="?client/validateRegister" method="post">
			<div class="form-group">
				<label for="username">Email:</label> <input type="text"
					id="username" name="username">
			</div>
			<div class="form-group">
				<label for="password">Contraseña:</label> <input type="password"
					id="password" name="password">
			</div>
			<div class="form-group">
				<input type="submit" class="btn" id="submit" name="submit"
					value="Iniciar Sesión">
			</div>
		</form>
		<?= isset($errors) ? $errors : ''; ?>
        <p>
			Si no estas registrado en la pagina, registrate aqui -> <a
				class="enlace_invertido" href="registro.html">Aqui</a>
		</p>
	</div>
</section>