<?php
require 'dbconfig.php';

try {
    $sql = "DELETE FROM rock_bands WHERE band_name = :band";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':band' => 'Iron Maiden']);

    echo "Band deleted. All associated concerts were automatically cascaded and removed.";

} catch (PDOException $e) {
    echo "Delete Error: " . $e->getMessage();
}
?>