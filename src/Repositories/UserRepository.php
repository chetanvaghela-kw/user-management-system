<?php
namespace ChetanvaghelaKw\UserManagementSystem\Repositories;

use ChetanvaghelaKw\UserManagementSystem\Contracts\UserRepositoryInterface;
use ChetanvaghelaKw\UserManagementSystem\App\Database;
use ChetanvaghelaKw\UserManagementSystem\App\LoggerTrait;

use PDO;

/**
 * User Repository Class for User Management System
 *
 * This class handles all database operations related to users including
 * creating, reading, updating, and deleting user records. It implements
 * the UserRepositoryInterface and uses PDO for database interactions.
 *
 * @package UserManagementSystem
 */
class UserRepository implements UserRepositoryInterface {

	use LoggerTrait;

	/**
	 * Define database connection
	 *
	 * @var PDO
	 */
	private PDO $db;

	/**
	 * Constructor for UserRepository
	 *
	 * @param PDO $db The PDO database connection object.
	 */
	public function __construct( PDO $db ) {
		$this->db = $db;
	}

	/**
	 * Add a new user to the database.
	 *
	 * @param array $data The user data to be added.
	 * @return bool True if the user was added successfully, false otherwise.
	 */
	public function addUser( array $data ): bool {
		$stmt = $this->db->prepare( 'INSERT INTO ums_users (name, email, phone, dob) VALUES (:name, :email, :phone, :dob)' );
		$this->log( 'Adding user: ' . $data['name'] );
		return $stmt->execute(
			array(
				'name'  => $data['name'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'dob' => $data['dob'],
			)
		);
	}

	/**
	 * Update user to the database.
	 *
	 * @param int   $id The user id to be updated.
	 * @param array $data The user data to be updated.
	 * @return bool True if the user was updated successfully, false otherwise.
	 */
	public function updateUser( int $id, array $data ): bool {
		$stmt = $this->db->prepare( 'UPDATE ums_users SET name = :name, email = :email, phone = :phone, dob = :dob WHERE id = :id' );
		$this->log( "Updating user with ID: $id" );
		return $stmt->execute(
			array(
				'name'  => $data['name'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'dob' => $data['dob'],
				'id'    => $id,
			)
		);
	}

	/**
	 * Delete user to the database.
	 *
	 * @param int $id The user id to be deleted.
	 * @return bool True if the user was deleted. successfully, false otherwise.
	 */
	public function deleteUser( int $id ): bool {
		$stmt = $this->db->prepare( 'DELETE FROM ums_users WHERE id = :id' );
		$this->log( "Deleting user with ID: $id" );
		return $stmt->execute( array( 'id' => $id ) );
	}

	/**
	 * Get user from the database.
	 *
	 * @param int $id The user id to be displayed.
	 * @return array data if the user found. successfully, false otherwise.
	 */
	public function getUser( int $id ): array {
		$stmt = $this->db->prepare( 'SELECT * FROM ums_users WHERE id = :id' );
		$stmt->execute( array( 'id' => $id ) );
		$this->log( "Fetching user with ID: $id" );
		return $stmt->fetch( PDO::FETCH_ASSOC ) ?: array();
	}

	/**
	 * Get users from the database.
	 *
     * @param int $limit limit the number of users to be displayed.
     * @param int $offset offset the number of users to be displayed.
	 * @return array data if the users found. successfully, false otherwise.
	 */
	public function getAllUsers(int $limit, int $offset): array {
		 // Prepare the query
         $stmt = $this->db->prepare('SELECT * FROM ums_users ORDER BY id ASC LIMIT ? OFFSET ?');
         $stmt->bindValue(1, $limit, PDO::PARAM_INT);
         $stmt->bindValue(2, $offset, PDO::PARAM_INT);
     
         // Execute the statement
         $stmt->execute();
		$this->log( 'Fetching All users' );
		return $stmt->fetchAll( PDO::FETCH_ASSOC );
	}

    /**
	 * Get users count from the database.
	 *
	 * @return array data if the users found. successfully, false otherwise.
	 */
    public function getUserCount(): int {
        $stmt = $this->db->prepare('SELECT COUNT(*) FROM ums_users');
        $stmt->execute();
        return (int) $stmt->fetchColumn();
    }
}
