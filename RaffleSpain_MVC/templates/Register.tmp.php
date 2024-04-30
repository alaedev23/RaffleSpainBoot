<section id="registro">
	<div id="form-container">
		<h2>Register</h2>
		<form class="form" action="?client/validateRegister" method="post">
			<div class="form-group">
				<label for="name">Nombre:</label> <input type="text" id="name"
					name="name" required>
			</div>
			<div class="form-group">
				<label for="surnames">Apellidos:</label> <input type="text"
					id="surnames" name="surnames" required>
			</div>
			<div class="form-group">
				<label for="username">Email:</label> <input type="text"
					id="username" name="username" required>
			</div>
			<div class="form-group">
				<label for="password">Contraseña:</label> <input type="password"
					id="password" name="password" required>
			</div>
			<div class="form-group">
				<label for="born">Fecha:</label> <input type="date"
					name="born" id="born" /> <!-- Hacer max y min en php -->
			</div>
			<div class="form-group">
				<label for="phone">Telefono:</label> <input type="tel"
					id="phone" name="phone" required>
			</div>
			<div class="form-group">
				<label for="poblation">Poblacion:</label> <input type="text" id="poblation"
					name="poblation" required>
			</div>
			<div class="form-group">
				<label for="address">Direccion:</label> <input type="text" id="address"
					name="address" required>
			</div>
			<div class="form-group">
				<label for="address">Planta:</label> <input type="text" id="floor"
					name="floor">
			</div>
			<div class="form-group">
				<label for="address">Puerta:</label> <input type="text" id="door"
					name="door">
			</div>
			<div class="form-group">
				<label for="address">Codigo Postal:</label> <input type="text" id="postal_code"
					name="postal_code">
			</div>
			<div class="form-group">
				<label for="sex">Sexo:</label>
				<select name="sex">
                    <option value="H" selected>Hombre</option>
                    <option value="M">Mujer</option>
                    <option value="O">Otr@</option>
                </select>
			</div>
			<div class="form-group">
				<input type="submit" class="btn" id="submit" name="submit"
					value="Registrarse">
			</div>
		</form>
		<?= isset($errors) ? "<div class=\"errorMessage\"><p>$errors</hp></div>" : ''; ?>
        <p>
			Estas registrado ? Haz login -> <a
				class="enlace_invertido" href="?client/formLogin">Aqui</a>
		</p>
	</div>
</section>