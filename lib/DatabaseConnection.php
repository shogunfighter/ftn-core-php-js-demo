<?php
class DatabaseConnection
{
    private $host, $username, $password, $dbname;
    public $conn;

    // Constructor
    public function __construct()
    {

        $envFile = __DIR__ . '/../config/.env';
        $envData = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($envData as $line) {
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                $_ENV[$key] = $value;
            }
        }

        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_DATABASE'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Destructor
    public function __destruct()
    {
        $this->conn->close();
    }

    // /**
    //  * Retrieves all users from the database.
    //  *
    //  * @return array An array of user records.
    //  * @throws Exception If there is an error executing the query.
    //  */
    // public function getUsers()
    // {
    //     $sql = "SELECT * FROM users";
    //     $result = $this->conn->query($sql);
    //     if (!$result) {
    //         throw new Exception($this->conn->error);
    //     }
    //     $records = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $records[] = $row;
    //     }

    //     return $records;
    // }

    // /**
    //  * Retrieves a user from the database based on their ID.
    //  *
    //  * @param int $id The ID of the user to retrieve.
    //  * @return array|null An array of user records, or null if no user is found.
    //  * @throws Exception If there is an error executing the query.
    //  */
    // public function getUser($id)
    // {
    //     $sql = "SELECT * FROM users WHERE id = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     if (!$stmt) throw new Exception($this->conn->error);
        
    //     $stmt->bind_param("i", $id);
    //     if (!$stmt->execute()) throw new Exception($stmt->error);
        
    //     $result = $stmt->get_result();
    //     if (!$result) throw new Exception($stmt->error);
        
    //     return ($result->num_rows > 0) 
    //         ? $result->fetch_assoc()
    //         : null;
    // }

    // /**
    //  * Inserts a user into the database.
    //  *
    //  * @param array $data An associative array containing the form data.
    //  *                    The keys should be 'username', 'email', 'password', 'birthdate', 'phone_number', and 'url'.
    //  * @return int|bool The ID of the inserted/updated record, or false if an error occurred.
    //  */
    // public function insertUser($data)
    // {
    //     $sql = "INSERT INTO `users` (`username`, `email`, `password`, `birthdate`, `phone_number`, `url`) VALUES (?, ?, ?, ?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     if (!$stmt) throw new Exception($this->conn->error);

    //     $stmt->bind_param("ssssss", $data['username'], $data['email'], $data['password'], $data['birthdate'], $data['phone_number'], $data['url']);
    //     if (!$stmt->execute()) throw new Exception($stmt->error);
    //     $stmt->close();
    //     return $this->conn->affected_rows > 0 ? $this->conn->insert_id : false;
    // }

    // /**
    //  * Delete a user from the database
    //  *
    //  * @param string $username The username of the user to delete
    //  * @return int|false The ID of the deleted record if successful, false otherwise
    //  * @throws Exception If there is an error executing the query.
    //  */
    // public function deleteUser($username)
    // {
    //     $sql = "DELETE FROM `users` WHERE `username` = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     if (!$stmt) throw new Exception($this->conn->error);

    //     $stmt->bind_param("s", $username);

    //     if (!$stmt->execute()) throw new Exception($stmt->error);
    //     $stmt->close();
    //     return $this->conn->affected_rows > 0 ? $this->conn->insert_id : false;
    // }

}


// // Retrieve all users
// $db = new DatabaseConnection();
// $users = $db->getUsers();
// foreach ($users as $user) {
//     echo $user['username'] . ' ' . $user['email'] . '<br>';
// }

// // Retrieve a specific user
// $db = new DatabaseConnection();
// $user = $db->getUser(1);
// echo $user['username'] . ' ' . $user['email'] . '<br>';

// // Insert a new user
// $db = new DatabaseConnection();
// $data = array(
//     'username' => 'john_doe',
//     'email' => 'john@example.com',
//     'password' => 'secret',
//     'birthdate' => '1990-01-01',
//     'phone_number' => '1234567890',
//     'url' => 'https://www.example.com'
// );
// $db->insertUser($data);

// // Usage example 4: Delete a user
// $db = new DatabaseConnection();
// $db->deleteUser('john_doe');