<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'] ?? '';
$lookup  = $_GET['lookup'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

//  city lookup
if ($lookup === "cities") {

    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population
        FROM cities
        JOIN countries ON cities.country_code = countries.code
        WHERE countries.name LIKE :country
    ");

    $search = "%{$country}%";
    $stmt->bindParam(':country', $search, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table border='1' cellpadding='8' cellspacing='0'>
            <tr>
                <th>City Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>";

    foreach ($results as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['district']) . "</td>
                <td>" . htmlspecialchars($row['population']) . "</td>
              </tr>";
    }

    echo "</table>";
    exit;
}

// country lookup
$stmt = $conn->prepare("
    SELECT name, continent, independence_year, head_of_state
    FROM countries
    WHERE name LIKE :country
");

$search = "%{$country}%";
$stmt->bindParam(':country', $search, PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table border='1' cellpadding='8' cellspacing='0'>
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>";

foreach ($results as $row) {
    echo "<tr>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['continent']) . "</td>
            <td>" . htmlspecialchars($row['independence_year']) . "</td>
            <td>" . htmlspecialchars($row['head_of_state']) . "</td>
          </tr>";
}

echo "</table>";
?>
