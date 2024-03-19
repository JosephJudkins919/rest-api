<?php

header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
        exit();
    }

require_once 'Database.php';

class QuotesController {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get all quotes
    public function getAllQuotes() {
        $query = "SELECT q.id, q.quote, a.author, c.category
            FROM quotes q
            INNER JOIN authors a ON q.author_id = a.id
            INNER JOIN categories c ON q.category_id = c.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($quotes);
    }

    // Get quote by ID
    public function getQuoteById($id) {
        $query = "SELECT q.id, q.quote, a.author, c.category
            FROM quotes q
            INNER JOIN authors a ON q.author_id = a.id
            INNER JOIN categories c ON q.category_id = c.id
            WHERE q.id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $quote = $stmt->fetch(PDO::FETCH_ASSOC);
        return json_encode($quote);
    }

    // Create a new quote
    public function createQuote($quote, $author_id, $category_id) {
        $query = "INSERT INTO quotes (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);

        if ($stmt->execute()) {
            return json_encode(array("message" => "Quote created successfully"));
        } else {
            return json_encode(array("message" => "Unable to create quote"));
        }
    }

    // Update a quote
    public function updateQuote($id, $quote, $author_id, $category_id) {
        $query = "UPDATE quotes
            SET quote = :quote, author_id = :author_id, category_id = :category_id
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return json_encode(array("message" => "Quote updated successfully"));
        } else {
            return json_encode(array("message" => "Unable to update quote"));
        }
    }

    // Delete a quote
    public function deleteQuote($id) {
        $query = "DELETE FROM quotes WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            return json_encode(array("message" => "Quote deleted successfully"));
        } else {
            return json_encode(array("message" => "Unable to delete quote"));
        }
    }
}

?>
