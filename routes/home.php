<?php
require_once __DIR__ . '/../vendor/autoload.php';

// error_reporting( E_ALL );
// ini_set( 'display_errors', 1 );

use ChetanvaghelaKw\UserManagementSystem\App\Database;
use ChetanvaghelaKw\UserManagementSystem\App\UserManager;
use ChetanvaghelaKw\UserManagementSystem\Repositories\UserRepository;


$db              = Database::getConnection();
$user_repository = new UserRepository( $db );
$user_manager    = new UserManager( $user_repository );

$delete_user_id = $_GET['delete_user_id'] ?? '';
if ( ! empty( $delete_user_id ) ) {
	$user_manager->deleteUser( $delete_user_id );
}

$current_page = isset( $_GET['page'] ) && is_numeric( $_GET['page'] ) ? (int) $_GET['page'] : 1;

$limit  = 3;
$offset = ( $current_page - 1 ) * $limit;

$users = $user_repository->getAllUsers( $limit, $offset );

$total_users = $user_repository->getUserCount();
$total_pages = ceil( $total_users / $limit );

?>
<div class="d-flex bd-highlight mb-3">
		<div class="me-auto p-2 bd-highlight mt-5">
			<h2>Welcome to the User Management System
		</div>
		<div class="p-2 bd-highlight mt-5">
			<a href="?route=add_user" class="btn btn-secondary">Add user</a>
		</div>
</div>
	<?php
	if ( ! empty( $users ) ) :
		?>
		<h3>Users</h3>
		<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Email</th>
					<th scope="col">Phone</th>
					<th scope="col">DOB</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>
			<tbody id="mytable">
				<?php

				foreach ( $users as $user ) :
					?>
					<tr>
						<td><?php echo htmlspecialchars( $user['id'] ); ?></td>
						<td><?php echo htmlspecialchars( $user['name'] ); ?></td>
						<td><?php echo htmlspecialchars( $user['email'] ); ?></td>
						<td><?php echo htmlspecialchars( $user['phone'] ); ?></td>
						<td><?php echo htmlspecialchars( $user['dob'] ); ?></td>
						<td>
							<a href="?route=view_user&id=<?php echo $user['id']; ?>">View</a> |
							<a href="?route=edit_user&id=<?php echo $user['id']; ?>">Edit</a> |
							<a href="?delete_user_id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>                        
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php if ( $total_pages > 1 ) : ?>
			<div class="pagination">
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<?php
						$range = 2;
						$start = max( 1, $current_page - $range );
						$end   = min( $total_pages, $current_page + $range );

						// First page link.
						if ( $start > 1 ) {
							echo '<li class="page-item"><a class="page-link" href="?page=1">1</a></li>';
							if ( $start > 2 ) {
								echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
							}
						}

						// Page number links.
						for ( $i = $start; $i <= $end; $i++ ) {
							echo '<li class="page-item ' . ( $i == $current_page ? 'active' : '' ) . '">
									<a class="page-link" href="?page=' . $i . '">' . $i . '</a>
								</li>';
						}

						// Last page link.
						if ( $end < $total_pages ) {
							if ( $end < $total_pages - 1 ) {
								echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
							}
							echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '">' . $total_pages . '</a></li>';
						}
						?>
					</ul>
				</nav>
			</div>
		<?php endif; ?>
		</div>
		<?php
	else :
		?>
		<div class="alert alert-danger" role="alert">
		No users found. Please <a href="?route=add_user">Add User</a> users.
		</div>
		<?php
	endif;
