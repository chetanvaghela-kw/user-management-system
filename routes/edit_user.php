<?php
require_once __DIR__ . '/../vendor/autoload.php';


error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

use ChetanvaghelaKw\UserManagementSystem\App\Database;
use ChetanvaghelaKw\UserManagementSystem\App\UserManager;
use ChetanvaghelaKw\UserManagementSystem\Repositories\UserRepository;

$db              = Database::getConnection();
$user_repository = new UserRepository( $db );
$user_manager    = new UserManager( $user_repository );

$user_id = $_GET['id'] ?? '';

$message_type = '';
if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {

	$uid   = $_POST['id'] ?? '';
	$name  = $_POST['name'] ?? '';
	$email = $_POST['email'] ?? '';
	$phone = $_POST['phone'] ?? '';
	$dob   = $_POST['dob'] ?? '';
	if ( ! empty( $uid ) && ! empty( $name ) && ! empty( $email ) && ! empty( $phone ) && ! empty( $dob ) ) {
		try {
			$user_manager->updateUser(
				$uid,
				array(
					'name'  => $name,
					'email' => $email,
					'phone' => $phone,
					'dob'   => $dob,
				)
			);
			$message      = 'User updated successfully!';
			$message_type = 'alert-success';
		} catch ( Exception $e ) {
			$message      = 'Error: ' . $e->getMessage();
			$message_type = 'alert-danger';
		}
	} else {
		$message      = 'All fields are required!';
		$message_type = 'alert-danger';
	}
}
$get_user = $user_repository->getUser( $user_id );
?>

<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-6">

		<h2>Update User</h2>

	<?php if ( ! empty( $message ) ) : ?>
		<div class="alert <?php echo $message_type; ?>" role="alert">
				<?php echo htmlspecialchars( $message ); ?>
				</div>
	<?php endif; ?>

	<form method="POST" action="" class="row g-3">
		<div class="mb-3">
			<label for="name" class="form-label">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $get_user['name']; ?>" class="form-control" required>
		</div>
		<div class="mb-3">
			<label for="email" class="form-label">Email:</label><br>
			<input type="email" id="email" name="email" value="<?php echo $get_user['email']; ?>" class="form-control" required>
			<input type="hidden" name="id" name="id" value="<?php echo $get_user['id']; ?>">
		</div>
		<div class="mb-3">
			<label for="phone" class="form-label">Phone:</label><br>
			<input type="text" id="phone" name="phone" value="<?php echo $get_user['phone']; ?>" class="form-control" required>
		</div>
		<div class="mb-3">
			<label for="dob" class="form-label">DOB:</label><br>
			<input type="date" id="dob" name="dob" value="<?php echo $get_user['dob']; ?>" class="form-control" required>
		</div>
		<button class="btn btn-primary" type="submit">Update User</button>
	</form>

	</div>
	</div>
</div>