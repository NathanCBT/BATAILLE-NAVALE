<?php
$tableau = [];


for ($i = 0; $i < 11; $i++) {
    for ($j = 0; $j < 11; $j++) {
        if ($i == 0 && $j == 0) {
            $tableau[$i][$j] = ""; 
        } elseif ($i == 0) {
           
            $tableau[$i][$j] = chr(ord('A') + $j - 1);
        } elseif ($j == 0) {
            
            $tableau[$i][$j] = $i;
        } else {
        
            $tableau[$i][$j] = "";
        }
    }
}


echo "<table border='1' cellpadding='5' cellspacing='0'>";
for ($i = 0; $i < 11; $i++) {
    echo "<tr>";
    for ($j = 0; $j < 11; $j++) {
        echo "<td>" . $tableau[$j][$i] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>