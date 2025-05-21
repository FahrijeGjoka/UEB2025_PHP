<?php
require_once 'db.php'; 

if (isset($_POST['s']) && !empty(trim($_POST['s']))) {
    $search = mysqli_real_escape_string($conn, $_POST['s']);

    $query = "SELECT * FROM parfumet WHERE emri LIKE '%$search%'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $parfumi = mysqli_fetch_assoc($result);
        $kategoria = $parfumi['kategoria'];

        session_start();
        $_SESSION['search_result'] = $parfumi;

        if ($kategoria == 'Men') {
            header("Location: men.php#$anchorId");
            exit();
        } elseif ($kategoria == 'Women') {
            header("Location: women.php#$anchorId");
            exit();
        } else {
            echo "Category not found!";
        }
    } else {
        echo "Perfume not found!";
    }
} else {
    echo "Please write the perfume's name!";
}
?>
