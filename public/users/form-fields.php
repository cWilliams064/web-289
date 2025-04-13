<label for="fname">First Name <span>*</span></label><br>
<input type="text" id="fname"  class="<?= isset($errors['firstName']) ? 'error-input' : ''; ?>" name="user[first_name]" 
value="<?= isset($_POST['user']['first_name']) ? h($_POST['user']['first_name']) : (isset($viewUser) ? h($viewUser->firstName) : '') ?>" required><br>

<?php if (!empty($errors['firstName'])): ?>
  <?= '<p class="create-errors">' . $errors['firstName'] . '</p>'; ?>
<?php endif; ?>

<label for="lname">Last Name <span>*</span></label><br>
<input type="text" id="lname" class="<?= isset($errors['lastName']) ? 'error-input' : ''; ?>" name="user[last_name]" 
value="<?= isset($_POST['user']['last_name']) ? h($_POST['user']['last_name']) : (isset($viewUser) ? h($viewUser->lastName) : '') ?>" required><br>

<?php if (!empty($errors['lastName'])): ?>
  <?= '<p class="create-errors">' . $errors['lastName'] . '</p>'; ?>
<?php endif; ?>

<label for="signupUsername">Username <span>*</span></label><br>
<input type="text" id="signupUsername" class="<?= isset($errors['username']) ? 'error-input' : ''; ?>" name="user[username]" 
value="<?= isset($_POST['user']['username']) ? h($_POST['user']['username']) : (isset($viewUser) ? h($viewUser->username) : '') ?>" required><br>

<?php if (!empty($errors['username'])): ?>
  <?= '<p class="create-errors">' . $errors['username'] . '</p>'; ?>
<?php endif; ?>

<label for="email">Email <span>*</span></label><br>
<input type="text" id="email" class="<?= isset($errors['email']) ? 'error-input' : ''; ?>" name="user[email]" 
value="<?= isset($_POST['user']['email']) ? h($_POST['user']['email']) : (isset($viewUser) ? h($viewUser->email) : '') ?>" required><br>

<?php if (!empty($errors['email'])): ?>
  <?= '<p class="create-errors">' . $errors['email'] . '</p>'; ?>
<?php endif; ?>

<?php if($session->is_logged_in() && $session->is_super_admin()): ?>
  <div>
    <label for="roleLevel">User Level:</label><br>
    <select id="roleLevel" name="user[role_id]">
      <?php foreach (User::USER_LEVEL_OPTIONS as $id => $roleId): ?>
      <option value="<?= $id; ?>" <?php if (isset($viewUser) && ($viewUser->roleId == $id)) { echo 'selected'; } ?>>
        <?= $roleId; ?>
      </option>
      <?php endforeach; ?>
    </select>
  </div>
<?php endif; ?>

<label for="signupPassword">Password:<span>*</span></label><br>
<input type="password" id="signupPassword" class="<?= isset($errors['password']) ? 'error-input' : ''; ?>" name="user[password]"><br>

<?php if (!empty($errors['password'])): ?>
  <?= '<p class="create-errors">' . $errors['password'] . '</p>'; ?>
<?php endif; ?>

<label for="confirmPass">Confirm Password:<span>*</span></label><br>
<input type="password" id="confirmPass" class="<?= isset($errors['confirmPassword']) ? 'error-input' : ''; ?>" name="user[confirm_password]"><br>

<?php if (!empty($errors['confirmPassword'])): ?>
  <?= '<p class="create-errors">' . $errors['confirmPassword'] . '</p>'; ?>
<?php endif; ?>
