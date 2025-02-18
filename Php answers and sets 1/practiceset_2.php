<?php
    $fruits = ["Mangosteen", "Kiwi", "Watermelon", "Jackfruit", "Blueberry"];
    echo "<ol>";
    for ($i = 0; $i < count($fruits); $i++) {
        echo "<li>" .($fruits[$i]) . "</li>";
    }
    echo "</ol>";
?>
