<?php
/**
 * Main routing file that handles page requests
 * Routes are passed via GET parameter and included from /routes directory
 * Includes header and footer files
 *
 * @package UserManagementSystem
 */

$route = isset( $_GET['route'] ) ? $_GET['route'] : '';

// include header file.
require __DIR__ . '/includes/header.php';

switch ( $route ) {
	case 'add_user':
		require __DIR__ . '/routes/add_user.php';
		break;
	case 'edit_user':
		require __DIR__ . '/routes/edit_user.php';
		break;
	case 'view_user':
		require __DIR__ . '/routes/view_user.php';
		break;
	default:
		require __DIR__ . '/routes/home.php';
		break;
}

// include footer file.
require __DIR__ . '/includes/footer.php';
