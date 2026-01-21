<?php 

class Items {
    public static function getItems(): array {
        return ["Home", "About", "Contact"];
    }
    public static function displayItems(): void {
        $items = self::getItems();
        echo "<ul>";
        foreach ($items as $item) {
            echo "<li>{$item}</li>";
        }
        echo "</ul>";
    }
}