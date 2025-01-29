<?php
require_once __DIR__ . '/../vendor/autoload.php';

use ChetanvaghelaKw\UserManagementSystem\App\Database;
use ChetanvaghelaKw\UserManagementSystem\App\UserManager;
use ChetanvaghelaKw\UserManagementSystem\Repositories\UserRepository;

$db              = Database::getConnection();
$user_repository = new UserRepository( $db );

$user_id = $_GET['id'] ?? '';
$user    = $user_repository->getUser( $user_id );


?>
<div class="container mt-5">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<h2>User Details</h2>
			<?php
			if ( ! empty( $user ) ) :
				?>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">Phone</th>
								<th scope="col">DOB</th>
								<th scope="col">Created At</th>
							</tr>
						</thead>
						<tbody id="mytable">			
						<tr>
								<td><?php echo htmlspecialchars( $user['id'] ); ?></td>
								<td><?php echo htmlspecialchars( $user['name'] ); ?></td>
								<td><?php echo htmlspecialchars( $user['email'] ); ?></td>
								<td><?php echo htmlspecialchars( $user['phone'] ); ?></td>
								<td><?php echo htmlspecialchars( $user['dob'] ); ?></td>
								<td><?php echo htmlspecialchars( $user['created_at'] ); ?></td>
								</tr>
						</tbody>
					</table>
				</div>
				<?php
			else :
				?>
				<div class="alert alert-danger" role="alert">User not found.</div>
				<?php
			endif;
			?>
		</div>
	</div>
</div>
