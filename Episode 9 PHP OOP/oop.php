<?php

class Book {
    // Property dengan visibilitas private
    private $code_book;
    private $name;
    private $qty;

    // Constructor untuk inisialisasi property
    public function __construct($code_book, $name, $qty) {
        $this->setCodeBook($code_book);
        $this->name = $name;
        $this->setQty($qty);
    }

    // Setter untuk $code_book
    private function setCodeBook($code_book) {
        // Validasi format $code_book
        if (preg_match('/^[A-Z]{2}[0-9]{2}$/', $code_book)) {
            $this->code_book = $code_book;
        } else {
            echo "Error: Format code_book harus berupa dua huruf besar diikuti dua angka (misalnya BB00).\n";
        }
    }

    // Getter untuk $code_book
    public function getCodeBook() {
        return $this->code_book;
    }

    // Setter untuk $qty
    private function setQty($qty) {
        // Validasi bahwa qty harus berupa integer positif
        if (is_int($qty) && $qty > 0) {
            $this->qty = $qty;
        } else {
            echo "Error: Qty harus berupa angka positif yang lebih besar dari 0.\n";
        }
    }

    // Getter untuk $qty
    public function getQty() {
        return $this->qty;
    }

    // Getter untuk $name
    public function getName() {
        return $this->name;
    }
}

// Contoh penggunaan
$book1 = new Book('BB01', 'Pemrograman PHP', 10);
echo "Code Book: " . $book1->getCodeBook() . "\n";
echo "Name: " . $book1->getName() . "\n";
echo "Quantity: " . $book1->getQty() . "\n";

// Testing error
$book2 = new Book('B123', 'JavaScript Basics', -5); 
$book3 = new Book('BB01', 'HTML Basics', 0); 

?>