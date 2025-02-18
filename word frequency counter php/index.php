<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputText = $_POST['text'];
        $sortingOrder = $_POST['sort'];
        $displayLimit = $_POST['limit'];
        $word_freq = process_text($inputText, $sortingOrder, $displayLimit);
    }

    function process_text($text, $sortOrder, $limit) {
        $stopwords_common = array("the", "and", "in", "of", "to", "a", "is", "that", "it", "with", "as", "for", "was", "on", "at", "by", "an");
        $words = token_text($text);
        $filtered_words = filter_stopwords($words, $stopwords_common);
        $word_freq = calc_wordfreq($filtered_words);
        $sorted_word_freq = sort_wordfreq($word_freq, $sortOrder);
        return array_slice($sorted_word_freq, 0, $limit, true);
    }

    function token_text($text) {
        return str_word_count(strtolower($text), 1);
    }

    function filter_stopwords($words, $stopwords) {
        return array_diff($words, $stopwords);
    }

    function calc_wordfreq($words) {
        return array_count_values($words);
    }

    function sort_wordfreq($word_freq, $sortOrder) {
        if ($sortOrder === 'asc') {
            asort($word_freq);
        } else {
            arsort($word_freq);
        }
        return $word_freq;
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

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <h3>Counted Words (Frequencies)</h3>
            <ul style="text-align:left;">
                <?php foreach ($word_freq as $word => $frequency): ?>
                    <li><?php echo htmlspecialchars($word) . ': ' . $frequency; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </form>
</body>
</html>