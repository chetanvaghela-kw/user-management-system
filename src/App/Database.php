<?php
namespace ChetanvaghelaKw\UserManagementSystem\App;

use PDO;
use PDOException;

/**
 * Database Class for User Management System
 *
 * This class handles all database connections.
 *
 * @package UserManagementSystem
 */
class Database {

	/**
	 * Define database connection
	 *
	 * @var PDO
	 */
	private static ?PDO $instance = null;

	/**
	 * Get database connection
	 *
	 * @return bool True if connection successfully, false otherwise.
	 */
	public static function getConnection(): PDO {
		if ( self::$instance === null ) {
			try {
				self::$instance = new PDO(
					'mysql:host=localhost;dbname=cv-user-management', // Replace with your DB details.
					'root',                                         // Replace with your DB username.
					'Root@1234'                                      // Replace with your DB password.
				);

				// Create ums_users table if it doesn't exist.
				$create_table_query = 'CREATE TABLE IF NOT EXISTS ums_users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    phone VARCHAR(255) NOT NULL,
                    dob VARCHAR(255) NOT NULL,                    
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )';
				self::$instance->exec( $create_table_query );

				self::$instance->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch ( PDOException $e ) {
				die( 'Database connection failed: ' . $e->getMessage() );
			}
		}
		return self::$instance;
	}
}
