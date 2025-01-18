<?php
	require_once 'vendor/autoload.php';
	class ServerManager {
		private $apiKey;
		private $panelUrl;
		private $host;
		private $username;
		private $password;
		private $database;
	
		public function __construct() {
			$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
			$dotenv->load();
			
			$this->apiKey = $_ENV['PTERO_APIKEY'];
			$this->panelUrl = $_ENV['PTERO_URL'];
			$this->host = $_ENV['DB_HOST'];
			$this->username = $_ENV['DB_USER'];
			$this->password = $_ENV['DB_PASSWORD'];
			$this->database = $_ENV['DB_NAME'];
		}

		private function postAPI($data, $path){
			$ch = curl_init($this->panelUrl . '/api/client/' . $path);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Accept: application/json',
				'Content-Type: application/json',
				'Authorization: Bearer ' . $this->apiKey
			]);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
			
			$response = curl_exec($ch);
			curl_close($ch);
		}

		private function getAPI($path){
			$ch = curl_init($this->panelUrl . '/api/client/' . $path);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Accept: application/json',
				'Content-Type: application/json',
				'Authorization: Bearer ' . $this->apiKey
			]);
			
			$response = curl_exec($ch);
			var_dump($response);
			curl_close($ch);
		}

		public function logDownload($file, $ip_address){
			$conn = new mysqli($this->host, $this->username, $this->password, $this->database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		
			$query = "INSERT INTO download_logs (file_name, ip_address) VALUES ('$file', '$ip_address')";
			$conn->query($query);
			$conn->close();
		}

		public function powerServer($power, $server){
			$data = [
				"signal" => $power,
			];
			$this->postAPI($data, 'servers/' . $server . '/power');
			$conn = new mysqli($this->host, $this->username, $this->password, $this->database);
		
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
	
			$sql = "UPDATE servers SET serverStarted = '" . time() . "' WHERE serverID = '" . $server . "'";
			$conn->query($sql);
			$conn->close();
		}

		public function checkUptime($server){
			$conn = new mysqli($this->host, $this->username, $this->password, $this->database);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * FROM servers WHERE serverID = '" . $server . "'";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$serverStarted = $row["serverStarted"];
					if ($serverStarted + (40 * 60) <= time()) {
						return;
					}
					if ($serverStarted + (30 * 60) <= time()){
						$this->sendCommand($server, "say Server is shutting down.");
						$this->powerServer("stop", $server);
					} else if($serverStarted + (29 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 1 minute.");
					} else if($serverStarted + (25 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 5 minutes.");
					} else if($serverStarted + (20 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 10 minutes.");
					} else if($serverStarted + (15 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 15 minutes.");
					} else if($serverStarted + (10 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 20 minutes.");
					} else if($serverStarted + (5 * 60) <= time()){
						$this->sendCommand($server, "say Server is stopping in 25 minutes.");
					}
				}
			}
			$conn->close();
		}

		public function sendCommand($server, $message){
			$data = [
				"command" => $message,
			];
			$this->postAPI($data, 'servers/' . $server . '/command');
		}

		public function getDetails($server){
			$this->getAPI('servers/' . $server);
		}
	}
?>