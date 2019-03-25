<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>/admins" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<br>
<h1><?php echo $data['user']->name; ?></h1>
<div class="bg-secondary text-black p-2 mb-3">
  User Role <strong><?php echo $data['user']->user_type; ?></strong> on <?php echo $data['user']->created_at; ?>
</div>
<p><?php echo $data['user']->email; ?></p>

<?php if($_SESSION['user_type'] == 'admin' ) : ?>
  <hr>
  <a href="<?php echo URLROOT; ?>/admins/edit/<?php echo $data['user']->id; ?>" class="btn btn-dark">Edit</a>

  <form class="pull-right" action="<?php echo URLROOT; ?>/admins/delete/<?php echo $data['user']->id; ?>" method="post">
    <input type="submit" value="Delete" class="btn btn-danger">
  </form>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>