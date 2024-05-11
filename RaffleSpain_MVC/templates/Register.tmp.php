<section id="registro">
	<div class="form-container">
		<h2>Register</h2>
		<form class="form" action="?client/validateRegister" method="post">
			<div class="form-group">
				<label for="name">Nombre:</label> <input type="text" id="name"
					name="name" required <?= $register->name ? 'value="' . $register->name . '"' : ''; ?>>
			</div>
			<div class="form-group">
				<label for="surnames">Apellidos:</label> <input type="text"
					id="surnames" name="surnames" <?= $register->surnames ? 'value="' . $register->surnames . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="username">Email:</label> <input type="text"
					id="username" name="username" <?= $register->email ? 'value="' . $register->email . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="password">Contraseña:</label> <input type="password"
					id="password" name="password" <?= $register->password ? 'value="' . $register->password . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="born">Fecha:</label> <input type="date"
					name="born" id="born" <?= $register->born ? 'value="' . $register->born . '"' : ''; ?> /> <!-- Hacer max y min en php -->
			</div>
			<div class="form-group">
				<label for="phone">Telefono:</label> <input type="tel"
					id="phone" name="phone" <?= $register->phone ? 'value="' . $register->phone . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="poblation">Poblacion:</label> <input type="text" id="poblation"
					name="poblation" <?= $register->poblation ? 'value="' . $register->poblation . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="address">Direccion:</label> <input type="text" id="address"
					name="address" <?= $register->address ? 'value="' . $register->address . '"' : ''; ?> required>
			</div>
			<div class="form-group">
				<label for="floor">Planta:</label> <input type="text" id="floor" require
					name="floor" <?= $register->floor ? 'value="' . $register->floor . '"' : ''; ?>>
			</div>
			<div class="form-group">
				<label for="door">Puerta:</label> <input type="text" id="door" require
					name="door" <?= $register->door ? 'value="' . $register->door . '"' : ''; ?>>
			</div>
			<div class="form-group">
				<label for="postal_code">Codigo Postal:</label> <input type="text" id="postal_code" require
					name="postal_code" <?= $register->postal_code ? 'value="' . $register->postal_code . '"' : ''; ?>>
			</div>
			<div class="form-group">
				<label for="sex">Sexo:</label>
				<select name="sex" require>
                    <option value="H" <?= ($register->sex === "H") ? "selected" : '' ?>>Hombre</option>
                    <option value="M" <?= ($register->sex === "M") ? "selected" : '' ?>>Mujer</option>
                    <option value="O" <?= ($register->sex === "O") ? "selected" : '' ?>>Otr@</option>	
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