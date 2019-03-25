<?php require APPROOT . '/views/inc/header.php'; ?>
  <a href="<?php echo URLROOT; ?>/admins/show/<?php echo $data['id']; ?>" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Edit User</h2>
    <p>Update a user with this form</p>
    <h3><?php echo $data['name']; ?></h3>
    <form action="<?php echo URLROOT; ?>/admins/edit/<?php echo $data['id']; ?>" method="post">
      <div class="form-group">
        <label for="userType">User Role: Developer / Client </label>
        <input type="text" name="user_type" class="form-control form-control-lg <?php echo (!empty($data['user_type_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['user_type']; ?>">
        <span class="invalid-feedback"><?php echo $data['user_type_err']; ?></span>
      </div>
      <input type="submit" class="btn btn-success" value="Submit">
    </form>
  </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>