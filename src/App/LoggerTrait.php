<?php
namespace ChetanvaghelaKw\UserManagementSystem\App;

trait LoggerTrait {

	/**
	 * Log a message to a file.
	 *
	 * @param string $message The message to log.
	 * @return void
	 */
	public function log( string $message ): void {
		$logDir = __DIR__ . '/../../logs'; // Define log directory
        $logFile = $logDir . '/app.log'; // Log file path

        // Ensure the directory exists
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $timestamp = date('Y-m-d H:i:s'); // Current timestamp
        $logMessage = "[{$timestamp}] {$message}" . PHP_EOL;

        // Append the log message to the file
        file_put_contents($logFile, $logMessage, FILE_APPEND);
	}
}
