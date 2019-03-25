<?php require APPROOT . '/views/inc/header.php'; ?>
  <?php flash('post_message'); ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Users</h1>
    </div>
    <div class="col-md-6">
      <a href="<?php echo URLROOT; ?>/admins/add" class="btn btn-primary pull-right">
        <i class="fa fa-pencil"></i> Add User
      </a>
    </div>
  </div>
  <?php foreach($data['users'] as $user) : ?>
    <div class="card card-body mb-3">
      <h4 class="card-title"><?php echo $user->name; ?></h4>
      <div class="bg-light p-2 mb-3">
        User Role <strong> <?php echo $user->user_type; ?></strong> created at <?php echo $user->created_at; ?>
      </div>
      <p class="card-text"><?php echo $user->email; ?></p>
      <a href="<?php echo URLROOT; ?>/admins/show/<?php echo $user->id; ?>" class="btn btn-dark">More</a>
    </div>
  <?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>