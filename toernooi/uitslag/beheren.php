
<?php
$toernooi_id = $_SESSION["toernooiId"];//over welk toernooi hebben we het?

//als er iets verkeerd is gegaan dan kan de gebruiker altijd een reset uitvoeren.
if(isset($_POST["resetToernooi"]) ){
    $toernooi_object->reset($toernooi_id);
}

$ronde = $wedstrijd_object->get_actieve_ronde(); //wat is de huidige ronde van het toernooi

if($wedstrijd_object->check_games_actieve_ronde($toernooi_id, $ronde)){ //staan er nog wedstrijden open voor deze ronde?
    echo "Alle wedstrijden uit ronde $ronde zijn gespeeld";
    if( isset($_POST["new_round"]) ){
        $wedstrijd_object->moveWinners($ronde);
        $wedstrijd_object->set_actieve_ronde($ronde );
    }else{
        //Er zijn nog wedstrijden die deze ronde gespeeld moeten worden
    }
}

if( isset($_POST["save"]) ){
    foreach( $_POST["wedstrijd"] as $wedst ){
        // $current_round = $wedstrijd_object);
        $speler1 = $wedst["thuis"]['speler'];
        $speler2 = $wedst["uit"]['speler'];
        if($speler2 == 0){ //als speler2 een dummy speler is dan verliest hij automatisch met 2-0
            $score1 = 2;
            $score2 = 0;
        }else{
            if( $wedst["thuis"]['score'] > 2 ){ $wedst["thuis"]['score'] = 2; }
            if( $wedst["uit"]['score'] > 2 ){ $wedst["uit"]['score'] = 2; }
            $score1 = $wedst["thuis"]['score'];
            $score2 = $wedst["uit"]['score'];
        }
        $wedstrijd_object->update($toernooi_id, $speler1, $speler2, $score1, $score2);//update de wedstrijd met scores
    }
}


?>
<form method="post">
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
                echo "<label>ronde: ". $wedstrijd_object->get_actieve_ronde() . "</label>";
                ?>
                <div class="mt-3">
                    <input type="submit" name="save" class="btn btn-success" value="Sla scores op!">
                    <input type="submit" name="new_round" class="btn btn-warning" value="Maak nieuwe ronde">
                    <input type="submit" name="resetToernooi" class="btn btn-danger" value="Reset Toernooi" onclick="return confirm('Weet je zeker dat je de gegevens opnieuw wilt invoeren?')">
                </div>
                <div class="container mt-2 toernooi-schema">
                    <?php
                    // print_r($wedstrijden);
                    // var_dump($number);
                    for($i = 0  ; $i <= $aantal_deelnemers + 1; $i++ ): //genereer rondes
                        $aantal_deelnemers = $aantal_deelnemers / 2;

                         ?>
                        <div class="ronde">
                        <?php
                        for($y = 0 ; $y < $aantal_deelnemers; $y++): //genereer wedstrijden
                            if(isset($wedstrijden[$number]["ronde"]) && $wedstrijden[$number]["ronde"] == $ronde){
                                $speler1 = $speler_object->getSpeler($wedstrijden[$number]["speler1Id"]);//maak speler 1
                                $speler2 = $speler_object->getSpeler($wedstrijden[$number]["speler2Id"]);// maak speler 2
                                $wedstrijd = $wedstrijd_object->getSingle($toernooi_id, $speler1["spelerId"], $speler2["spelerId"], $ronde);
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
                                        <input class='winst' type='checkbox'<?php echo ( isset($wedstrijd["speler1Id"]) ? ($wedstrijd["speler1Id"] == $winner ? "checked" : "") : "") ?> >

                                        <span class="checkmark"></span>
                                    </label>
                                    <input type="hidden" value="<?php echo (isset($wedstrijd["speler1Id"])) ? $wedstrijd["speler1Id"] : ""; ?>" name="wedstrijd[<?php echo $number ?>][thuis][speler]">
                                    <input class="score" type="number" value="<?php echo (isset($wedstrijd["score1"])) ? $wedstrijd["score1"] : "" ?>" name="wedstrijd[<?php echo $number ?>][thuis][score]" >
                                </div>
                                <div class="speler-results">
                                    <label class="checkbox-container">
                                        <span id="roepnaam" class="player-data"><?php echo (isset($speler2["roepnaam"])) ? $speler2["roepnaam"] : "-"; ?></span>
                                        <span id="tussenvoegsel" class="player-data"><?php echo (isset($speler2["tussenvoegsels"])) ? $speler2["tussenvoegsels"] : "-"; ?></span>
                                        <span id="achternaam" class="player-data"><?php echo (isset($speler2["achternaam"])) ? $speler2["achternaam"] : "-"; ?></span>
                                        <input class='winst' type='checkbox' <?php echo ( isset($wedstrijd["speler2Id"]) ? ($wedstrijd["speler2Id"] == $winner ? "checked" : "") : "") ?> >
                                        <span class="checkmark"></span>
                                    </label>
                                    <input type="hidden" value="<?php echo (isset($wedstrijd["speler2Id"]))? $wedstrijd["speler2Id"] : "" ?>" name="wedstrijd[<?php echo $number ?>][uit][speler]" >
                                    <input class="score" type="number" value="<?php echo (isset($wedstrijd["score2"])) ? $wedstrijd["score2"] : "" ?>" name="wedstrijd[<?php echo $number ?>][uit][score]" >
                                </div>
                            </div>
                        <?php
                        $number++;
                        endfor; ?>
                        </div>
                    <?php
                    $ronde = $ronde + 1;
                endfor; ?>

                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-3" role="alert">
                    Geen wedstrijden aangemaakt voor dit toernooi -> toernooi moet nog gesloten worden!
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

</form>
