 <?php
 
 require_once __DIR__ . '/../lib/DatabaseConnection.php';
 
 class UserModel
 {
     private $db;
 
     public function __construct()
     {
         $this->db = new DatabaseConnection();
     }
 
     public function getUserById($id)
     {
         $sql = "SELECT * FROM users WHERE id = ?";
         $stmt = $this->db->conn->prepare($sql);
         $stmt->bind_param("i", $id);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_assoc();
     }
 
     public function getAllUsers()
     {
         $sql = "SELECT * FROM users";
         $stmt = $this->db->conn->prepare($sql);
         $stmt->execute();
         $result = $stmt->get_result();
         $users = [];
         while ($row = $result->fetch_assoc()) {
             $users[] = $row;
         }
         return $users;
     }
 
     public function createUser($data)
     {
         $sql = "INSERT INTO `users` (`username`, `email`, `password`, `birthdate`, `phone_number`, `url`) VALUES (?, ?, ?, ?, ?, ?)";
         $stmt = $this->db->conn->prepare($sql);
         $stmt->bind_param("ssssss", $data['username'], $data['email'], $data['password'], $data['birthdate'], $data['phone_number'], $data['url']);
         $stmt->execute();
         return $this->getUserById($this->db->conn->insert_id);
     }
 
     public function updateUser($id, $data)
     {
         $sql = "UPDATE `users` SET `username` = ?, `email` = ?, `password` = ?, `birthdate` = ?, `phone_number` = ?, `url` = ? WHERE `id` = ?";
         $stmt = $this->db->conn->prepare($sql);
         $stmt->bind_param("ssssssi", $data['username'], $data['email'], $data['password'], $data['birthdate'], $data['phone_number'], $data['url'], $id);
         $stmt->execute();
         return $this->getUserById($id);
     }
 
     public function deleteUser($id)
     {
         $sql = "DELETE FROM `users` WHERE `id` = ?";
         $stmt = $this->db->conn->prepare($sql);
         $stmt->bind_param("i", $id);
         $stmt->execute();
         return $this->getUserById($id);
     }

}