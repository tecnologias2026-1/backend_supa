<?php
require_once __DIR__ . '/../database/connection.php';

global $conn;
echo "Conectado a la base de datos en user.model.php\n";
echo json_encode(getUsersModel()) ? "Usuarios obtenidos correctamente\n" : "Error obteniendo usuarios\n";
function getUsersModel() {
  global $conn;
  
  try {
    $query = "SELECT * FROM usuario";
    $stmt = $conn->query($query);
    $users = $stmt->fetchAll();
    return $users ?: [];
  } catch (PDOException $e) {
    error_log("Error getting users: " . $e->getMessage());
    return false;
  }
}

function getUserByIdModel($id) {
  global $conn;
  
  try {
    $id = intval($id);
    $query = "SELECT * FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    return $user ?: null;
  } catch (PDOException $e) {
    error_log("Error getting user by id: " . $e->getMessage());
    return false;
  }
}

function createUserModel($data) {
  global $conn;
  
  try {
    $nombre = $data['nombre'] ?? '';
    $email = $data['email'] ?? '';
    $telefono = $data['telefono'] ?? null;
    
    $query = "INSERT INTO usuario (nombre, cedula, correo) VALUES (?, ?, ?) RETURNING id";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nombre, $email, $telefono]);
    $result = $stmt->fetch();
    
    return $result['id'] ?? false;
  } catch (PDOException $e) {
    error_log("Error creating user: " . $e->getMessage());
    return false;
  }
}

function updateUserModel($id, $data) {
  global $conn;
  
  try {
    $id = intval($id);
    $nombre = $data['nombre'] ?? null;
    $email = $data['email'] ?? null;
    $telefono = $data['telefono'] ?? null;
    
    $query = "UPDATE usuario SET nombre = ?, email = ?, telefono = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nombre, $email, $telefono, $id]);
    
    return $stmt->rowCount();
  } catch (PDOException $e) {
    error_log("Error updating user: " . $e->getMessage());
    return false;
  }
}

function deleteUserModel($id) {
  global $conn;
  
  try {
    $id = intval($id);
    $query = "DELETE FROM usuario WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$id]);
    
    return $stmt->rowCount();
  } catch (PDOException $e) {
    error_log("Error deleting user: " . $e->getMessage());
    return false;
  }
}
?>
