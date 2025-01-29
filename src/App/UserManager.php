<?php
namespace ChetanvaghelaKw\UserManagementSystem\App;

use ChetanvaghelaKw\UserManagementSystem\Repositories\UserRepository;

/**
 * User Manager Class for User Management System
 *
 * This class handles all database operations related to users including
 * creating, reading, updating, and deleting user records. It implements
 * the UserRepositoryInterface and uses PDO for database interactions.
 *
 * @package UserManagementSystem
 */
class UserManager {

	/**
	 * Define repository interface property.
	 *
	 * @var UserRepository
	 */
	private UserRepository $repository;

	/**
	 * Constructor for UserManager
	 *
	 * @param UserRepository $repository The repository object.
	 */
	public function __construct( UserRepository $repository ) {
		$this->repository = $repository;
	}

	/**
	 * Add a new user to the database.
	 *
	 * @param array $data The user data to be added.
	 */
	public function addUser( array $data ): void {
		if ( $this->repository->addUser( $data ) ) {
			//echo "User added successfully!\n";
		} else {
			echo "Failed to add user.\n";
		}
	}

	/**
	 * Update user to the database.
	 *
	 * @param int   $id The user id to be updated.
	 * @param array $data The user data to be updated.
	 */
	public function updateUser( int $id, array $data ): void {
		if ( $this->repository->updateUser( $id, $data ) ) {
			// echo "User updated successfully!\n";
		} else {
			echo "Failed to update user.\n";
		}
	}

	/**
	 * Delete user to the database.
	 *
	 * @param int $id The user id to be deleted.
	 */
	public function deleteUser( int $id ): void {
		if ( $this->repository->deleteUser( $id ) ) {
			// echo "User deleted successfully!\n";
		} else {
			echo "Failed to delete user.\n";
		}
	}

	/**
	 * Get user from the database.
	 *
	 * @param int $id The user id to be displayed.
	 */
	public function getUser( int $id ): void {
		$user = $this->repository->getUser( $id );
		if ( $user ) {
			print_r( $user );
		} else {
			echo "User not found.\n";
		}
	}

	/**
	 * Get users from the database.
     * 
     * @param int $limit limit the number of users to be displayed.
     * @param int $offset offset the number of users to be displayed.
	 */
	public function getAllUsers(int $limit, int $offset): void {
		$user = $this->repository->getAllUsers($limit,$offset);
		if ( $user ) {
			print_r( $user );
		} else {
			echo "User not found.\n";
		}
	}

    /**
	 * Get users count from the database.
     * 
	 */
	public function getUserCount(): void {
		$user = $this->repository->getUserCount();
		if ( $user ) {
			print_r( $user );
		} else {
			echo "User not found.\n";
		}
	}

}
