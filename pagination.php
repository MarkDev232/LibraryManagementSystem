<?php
// Simulated content for the div elements
$divContent = array(
    "Div 1 content",
    "Div 2 content",
    "Div 3 content",
    "Div 4 content",
    "Div 5 content",
    "Div 6 content",
    "Div 7 content",
    "Div 8 content",
    "Div 9 content",
    "Div 10 content"
);

// Number of div elements per page
$perPage = 6;

// Current page (default to page 1 if not set)
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the starting index for the current page
$startIndex = ($page - 1) * $perPage;

// Get the div elements for the current page
$currentPageDivs = array_slice($divContent, $startIndex, $perPage);

// Total number of pages
$totalPages = ceil(count($divContent) / $perPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Div Pagination</title>
    <style>
        /* Style for the div elements */
        .div-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
            width: 150px;
            display: inline-block;
        }
    </style>
</head>
<body>

<?php
// Display the div elements for the current page
foreach ($currentPageDivs as $div) {
    echo '<div class="div-container">' . $div . '</div>';
}

// Display pagination links
echo '<div>';
for ($i = 1; $i <= $totalPages; $i++) {
    echo '<a href="?page=' . $i . '">' . $i . '</a> ';
}
echo '</div>';
?>

</body>
</html>
