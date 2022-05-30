
<?php
$toernooi_id = $_SESSION["toernooiId"];
?>

    <div class="container">
    
        <?php 
        if( isset($toernooi_id) ):
            $aantal_aanmeldingen = count($aanmelding_object->get($toernooi_id)); //haal het aantal deelnemers op
            $aantal_deelnemers = $aantal_aanmeldingen + $wedstrijd_object->machtTweeAantal($aantal_aanmeldingen);
            $wedstrijden = $wedstrijd_object->toon($toernooi_id); //haal alle wedstrijden op
        ?>
            <?php 
            if(!empty($wedstrijden)):
                $number = 0; //gamenummers;
                $ronde = 1; //rondenummers
                ?>
                <div class="container mt-2 toernooi-schema">
                <?php
                for($i = 0  ; $i <= $aantal_deelnemers + 1; $i++ ): //genereer rondes

                    $aantal_deelnemers = $aantal_deelnemers / 2;
                    ?>
                    
                    <div class="ronde">
                    <?php  
                    for($y = 0 ; $y < $aantal_deelnemers; $y++): //genereer wedstrijden
                        // echo "wedstrijd: ".$number ."<br>";
                        // echo "ronde: ".$ronde ."<br>";
                        if(isset($wedstrijden[$number]["ronde"]) && $wedstrijden[$number]["ronde"] == $ronde){
                            $speler1 = $speler_object->getSpeler($wedstrijden[$number]["speler1Id"]);
                            $speler2 = $speler_object->getSpeler($wedstrijden[$number]["speler2Id"]);
                            $wedstrijd = $wedstrijd_object->getSingle($toernooi_id, $speler1["spelerId"], $speler2["spelerId"], $ronde);
                            // print_r($wedstrijd);
                            //bepaal winnaar om de checkboxen aan te zetten
                            $winner = $wedstrijd_object->getWinner($wedstrijd["id"]);
                        } else{
                            $speler1 = "";
                            $speler2 = "";
                            $wedstrijd ="";
                        }
                        ?>
                        <div class="wedstrijd">
                            <div class="speler-results">
                                <label class="checkbox-container">
                                    <span id="roepnaam" class="player-data"><?php echo (isset($speler1["roepnaam"])) ? $speler1["roepnaam"] : " -"; ?></span>
                                    <span id="tussenvoegsel" class="player-data"><?php echo (isset($speler1["tussenvoegsels"])) ? $speler1["tussenvoegsels"] : "-"; ?></span>
                                    <span id="achternaam" class="player-data"><?php echo (isset($speler1["achternaam"])) ? $speler1["achternaam"] : "-"; ?></span>
                                    <input class='winst' type='checkbox'<?php echo ( isset($wedstrijd["speler1Id"]) ? ($wedstrijd["speler1Id"] == $winner ? "checked" : "") : "") ?> disabled>

                                    <span class="checkmark"></span>
                                </label>
                                <input type="hidden" value="<?php echo (isset($wedstrijd["speler1Id"])) ? $wedstrijd["speler1Id"] : ""; ?>" name="wedstrijd[<?php echo $number ?>][thuis][speler]" disabled>
                                <input class="score" type="number" value="<?php echo (isset($wedstrijd["score1"])) ? $wedstrijd["score1"] : "" ?>" name="wedstrijd[<?php echo $number ?>][thuis][score]" disabled>
                            </div>
                            <div class="speler-results">
                                <label class="checkbox-container">
                                    <span id="roepnaam" class="player-data"><?php echo (isset($speler2["roepnaam"])) ? $speler2["roepnaam"] : "-"; ?></span>
                                    <span id="tussenvoegsel" class="player-data"><?php echo (isset($speler2["tussenvoegsels"])) ? $speler2["tussenvoegsels"] : "-"; ?></span>
                                    <span id="achternaam" class="player-data"><?php echo (isset($speler2["achternaam"])) ? $speler2["achternaam"] : "-"; ?></span>    
                                    <input class='winst' type='checkbox' <?php echo ( isset($wedstrijd["speler2Id"]) ? ($wedstrijd["speler2Id"] == $winner ? "checked" : "") : "") ?> disabled>
                                    <span class="checkmark"></span>
                                </label>
                                <input type="hidden" value="<?php echo (isset($wedstrijd["speler2Id"]))? $wedstrijd["speler2Id"] : "" ?>" name="wedstrijd[<?php echo $number ?>][uit][speler]" disabled>
                                <input class="score" type="number" value="<?php echo (isset($wedstrijd["score2"])) ? $wedstrijd["score2"] : "" ?>" name="wedstrijd[<?php echo $number ?>][uit][score]" disabled>
                            </div>
                        </div>
                    <?php 
                    $number++;
                    endfor; ?>
                    </div>
                    
                    <?php 
                    $ronde = $ronde + 1;
                
                endfor; ?>
                
                
            <?php else: ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Geen wedstrijden aangemaakt voor dit toernooi -> toernooi moet nog gesloten worden!
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
    

