<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputText = $_POST['text'];
    $sortingOrder = $_POST['sort'];
    $displayLimit = $_POST['limit'];

    $stopwords_common = array("the", "and", "in", "of", "to", "a", "is", "that", "it", "with", "as", "for", "was", "on", "at", "by", "an");
    $words = str_word_count(strtolower($inputText), 1);
    $filtered_words = array_diff($words, $stopwords_common);
    $word_freq = array_count_values($filtered_words);

    if ($sortingOrder === 'asc') {
        asort($word_freq);
    }
    else {
        arsort($word_freq);
    }

    $word_freq = array_slice($word_freq, 0, $displayLimit, true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Word Frequency Counter</h1>
    
    <form action="index.php" method="post">
        <label for="text">Paste your text here:</label><br>
        <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>
        
        <label for="sort">Sort by frequency:</label>
        <select id="sort" name="sort">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select><br><br>
        
        <label for="limit">Number of words to display:</label>
        <input type="number" id="limit" name="limit" min="1" placeholder="ex: 5" required><br><br>
        
        <input type="submit" value="Submit">
    </form>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <h2>Counted Words (Frequency)</h2>
        <ul>
            <?php foreach ($word_freq as $word => $frequency): ?>
                <li><?php echo htmlspecialchars($word) . ': ' . $frequency; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>