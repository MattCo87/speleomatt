<?php
/* 
    Fonction 'cboard' : affiche le plateau de jeu sous forme HTML
    Fonction 'clinestart' : affiche la ligne de départ sous forme HTML
*/

function cboard($characters)
{
?>
    <table border: 1px solid black>
        <tr>
            <td>
                <?php echo $characters[0]; ?>
            </td>
            <td>
                <?php echo $characters[1]; ?>
            </td>
            <td>
                <?php echo $characters[2]; ?>
            </td>
            <td>
                *****
            </td>
            <td>
                <?php echo $characters[9]; ?>
            </td>
            <td>
                <?php echo $characters[10]; ?>
            </td>
            <td>
                <?php echo $characters[11]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $characters[3]; ?>
            </td>
            <td>
                <?php echo $characters[4]; ?>
            </td>
            <td>
                <?php echo $characters[5]; ?>
            </td>
            <td>
                *****
            </td>
            <td>
                <?php echo $characters[12]; ?>
            </td>
            <td>
                <?php echo $characters[13]; ?>
            </td>
            <td>
                <?php echo $characters[14]; ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $characters[6]; ?>
            </td>
            <td>
                <?php echo $characters[7]; ?>
            </td>
            <td>
                <?php echo $characters[8]; ?>
            </td>
            <td>
                *****
            </td>
            <td>
                <?php echo $characters[15]; ?>
            </td>
            <td>
                <?php echo $characters[16]; ?>
            </td>
            <td>
                <?php echo $characters[17]; ?>
            </td>
        </tr>
    </table>
<?php
    return $characters;
}


function clienstart($board){
    $i=1;
    foreach($board as $characters){
        echo "Position N° " . $i ." : ". $characters['name']." => ".$characters['position']." = (rapidity: ".$characters['rapidity']." + d20: ".$characters['alea']." )<hr>";
        //echo "Action de ". $characters['name']."<hr>";
        $i++;
    }
    return $board;
}

?>