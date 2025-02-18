<!DOCTYPE html>
<html>
<head>
    <title>Triangle Area Calculator</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .input-group {
            display: flex;
            flex-direction: column;
            width: 100%;
            text-align: left;
            margin-bottom: 10px;
        }
        .input-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Triangle Area Calculator</h2>
    <div class="container">
        <form method="POST">
            <div class="input-group">
                <label>Side 1:</label> 
                <input type="number" name="side1" step="any" required>
            </div>
            <div class="input-group">
                <label>Side 2:</label> 
                <input type="number" name="side2" step="any" required>
            </div>
            <div class="input-group">
                <label>Side 3:</label> 
                <input type="number" name="side3" step="any" required>
            </div>
            <input type="submit" name="calculate" value="Calculate Area">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $side1 = $_POST["side1"];
        $side2 = $_POST["side2"];
        $side3 = $_POST["side3"];
        $s = ($side1 + $side2 + $side3) / 2;
        $area = ($s * ($s - $side1) * ($s - $side2) * ($s - $side3));
        $x = $area;
        $y = 1;
        $e = 0.000001; 
        while ($x - $y > $e) {
            $x = ($x + $y) / 2;
            $y = $area / $x;
        }
        echo "<h3>Triangle Area: " . number_format($x, 2) . "</h3>";
    }
    ?>
</body>
</html>
