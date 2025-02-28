<label for="fname">First Name</label><br>
<input type="text" id="fname" name="user[first_name]" required><br>

<label for="lname">Last Name</label><br>
<input type="text" id="lname" name="user[last_name]" required><br>

<label for="signup-username">Username</label><br>
<input type="text" id="signup-username" name="user[username]" required><br>

<label for="email">Email</label><br>
<input type="text" id="email" name="user[email]" required><br>

<label for="profileImg">Profile Image</label><br>
<input type="file" id="profileImg" name="user[profileImg]" accept="image/*"><br>

<?php if ($session->is_admin()): ?>
<label for="roleLevel">Role Level</label>
<select id="roleLevel" name="user[roleLevel]">
  <?php foreach(User::USER_LEVEL_OPTIONS as $id => $userLevel) { ?>
  <option value="">Choose Role:</option>
  <option value="<?php echo $id; ?>" <?php if ($user->roleLevel == $id) { echo 'selected'; } ?>>
    <?php echo $roleLevel; ?>
  </option>
  <?php } ?>
  </select>
<?php endif; ?>

<label for="signup-password">Password</label><br>
<input type="text" id="signup-password" name="user[password]" required><br>

<label for="confirmPass">Confirm Password</label><br>
<input type="text" id="confirmPass" name="user[confirm_password]" required><br>
