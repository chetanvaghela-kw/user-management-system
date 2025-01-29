<?php
require_once __DIR__ . '/../vendor/autoload.php';


// error_reporting(E_ALL);
// ini_set('display_errors', 1);

use ChetanvaghelaKw\UserManagementSystem\App\Database;
use ChetanvaghelaKw\UserManagementSystem\App\UserManager;
use ChetanvaghelaKw\UserManagementSystem\Repositories\UserRepository;

$db              = Database::getConnection();
$user_repository = new UserRepository( $db );
$user_manager    = new UserManager( $user_repository );
$message_type    = '';
if ( isset( $_SERVER['REQUEST_METHOD'] ) && 'POST' === $_SERVER['REQUEST_METHOD'] ) {
	$name  = $_POST['name'] ?? '';
	$email = $_POST['email'] ?? '';
	$phone = $_POST['phone'] ?? '';
	$dob   = $_POST['dob'] ?? '';

	if ( ! empty( $name ) && ! empty( $email ) && ! empty( $phone ) && ! empty( $dob ) ) {
		try {
			$user_manager->addUser(
				array(
					'name'  => $name,
					'email' => $email,
					'phone' => $phone,
					'dob'   => $dob,
				)
			);
			$message      = 'User added successfully!';
			$message_type = 'alert-success';
		} catch ( Exception $e ) {
			$message      = 'Error: ' . $e->getMessage();
			$message_type = 'alert-danger';
		}
	} else {
		$message = 'All fields are required!';
	}
}?>
	
<div class="container mt-5 mb-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<h2 class="pt-2 pb-2">Add New User</h2>

			<?php if ( ! empty( $message ) ) : ?>
				<div class="alert <?php echo $message_type; ?>" role="alert">
				<?php echo htmlspecialchars( $message ); ?>
				</div>
			<?php endif; ?>

			<form method="POST" action="" class="row g-3">
				<div class="mb-3">
					<label for="name" class="form-label">Name:</label>
					<input type="text" id="name" name="name" class="form-control" required>
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email:</label>
					<input type="email" id="email" name="email" class="form-control" required>
				</div>
				<div class="mb-3">
					<label for="phone" class="form-label">Phone:</label>
					<input type="text" id="phone" name="phone" class="form-control" required>
				</div>
				<div class="mb-3">
					<label for="dob" class="form-label">DOB:</label>
					<input type="date" id="dob" name="dob" class="form-control" required>
				</div>
				<button class="btn btn-primary" type="submit">Add User</button>
			</form>
		</div>
	</div>
</div>
