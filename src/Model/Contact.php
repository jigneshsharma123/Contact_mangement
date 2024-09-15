<?php

namespace JigneshSharma\New\Model;

use JigneshSharma\New\Database\DatabaseFactory;
use PDO;

class Contact {
    private $pdo;

    public function __construct() {
        $this->pdo = DatabaseFactory::createConnection();
    }

    public function create($name, $phone, $email, $address) {
        $stmt = $this->pdo->prepare("INSERT INTO contacts (name, phone, email, address) VALUES (:name, :phone, :email, :address)");
        $stmt->execute([
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM contacts");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $phone, $email, $address) {
        $stmt = $this->pdo->prepare("UPDATE contacts SET name = :name, phone = :phone, email = :email, address = :address WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM contacts WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
    public function getAllsort($sortColumn = 'name', $sortOrder = 'ASC') {
        $stmt = $this->pdo->prepare("SELECT * FROM contacts ORDER BY $sortColumn $sortOrder");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
}
