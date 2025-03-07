<?php

if(!isset($user)) {
  redirect_to(url_for('../public/index.php'));
}

?>

<label for="fname">First Name <span>*</span></label><br>
<input type="text" id="fname" name="user[first_name]" required><br>

<label for="lname">Last Name <span>*</span></label><br>
<input type="text" id="lname" name="user[last_name]" required><br>

<label for="signupUsername">Username <span>*</span></label><br>
<input type="text" id="signupUsername" name="user[username]" required><br>

<label for="email">Email <span>*</span></label><br>
<input type="text" id="email" name="user[email]" required><br>

<?php if($session->is_super_admin()): ?>
  <div>
    <label for="roleLevel">User Level:</label>
    <select id="roleLevel" name="user[role_id]">
      <?php foreach (User::USER_LEVEL_OPTIONS as $id => $roleId): ?>
        <option value="<?= $id; ?>" <?= ($user->roleId == $id) ? 'selected' : ''; ?>>
          <?= htmlspecialchars($roleId, ENT_QUOTES, 'UTF-8'); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
<?php endif; ?>

<label for="signupPassword">Password <span>*</span></label><br>
<input type="password" id="signupPassword" name="user[password]" required><br>

<label for="confirmPass">Confirm Password <span>*</span></label><br>
<input type="password" id="confirmPass" name="user[confirm_password]" required><br>
