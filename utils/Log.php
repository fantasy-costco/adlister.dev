<?php

class Log {
	private $handle;
	private $filename;

	public function __construct($prefix = "log-") {
		$this->handle = fopen($this->setFileName($prefix), "a");
	}

	public function logMessage($level, $message) {
		$formattedMessage = date("Y-m-d H:i:s") . " [$level] $message";
		fwrite($this->handle, $formattedMessage);
	}

	private function setFilename($prefix) {
		$filename = "$prefix" . date("Y-m-d") . ".log";
		if (!touch($filename) || !is_writable($filename)) {
			echo "This file $filename cannot be modified.";
		}
		return $filename;
	}

	public function info($message) {
		$this->logMessage("INFO", $message);
	}

	public function error($message) {
		$this->logMessage("ERROR", $message);
	}

	public function __destruct() {
		fclose($this->handle);
	}

}
