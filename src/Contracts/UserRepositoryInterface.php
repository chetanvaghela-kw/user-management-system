<?php
namespace ChetanvaghelaKw\UserManagementSystem\Contracts;

interface UserRepositoryInterface {

	/**
	 * Add a new user to the database.
	 *
	 * @param array $data The user data to be added.
	 */
	public function addUser( array $data ): bool;

	/**
	 * Update user to the database.
	 *
	 * @param int   $id The user id to be updated.
	 * @param array $data The user data to be updated.
	 */
	public function updateUser( int $id, array $data ): bool;

	/**
	 * Delete user to the database.
	 *
	 * @param int $id The user id to be deleted.
	 */
	public function deleteUser( int $id ): bool;

	/**
	 * Get user from the database.
	 *
	 * @param int $id The user id to be displayed.
	 */
	public function getUser( int $id ): array;
    
	/**
	 * Get users from the database.
     * 
     * @param int $offset offset the number of users to be displayed.
	 * @return array data if the users found. successfully, false otherwise.
	 */
	public function getAllUsers( int $limit, int $offset): array;

    /**
	 * Get users count from the database.
 	 * @return array data if the users found. successfully, false otherwise.
	 */
	public function getUserCount(): int;
}
