<?php


$status = $toernooi_object->getStatus($_SESSION["toernooiId"]);

//if form is sent 
if (isset($_POST["spelerId"])) {
    $aanmelding_object->aanmelden($_POST["spelerId"], $_SESSION["toernooiId"]);
}

$aanmeldingen = $aanmelding_object->get($_SESSION["toernooiId"]);
$spelers = $speler_object->get();



?>
        <div class="container">
            <?php if($status == 1):?>
            <div class="alert alert-warning mt-2" role="alert">
                Het toernooi is al gesloten. Er kunnen geen nieuwe deelnemers toegevoegd worden.
            </div>
            <?php endif; ?>
            <div class="alert alert-info mt-2" role="alert">
             Deelnemers 
            </div>
            
            <table class="table  table-hover table-sm">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>School</th>
                        <th>Aan/Afmelden</th>
                        <th><?php echo count($aanmelding_object->get($_SESSION["toernooiId"])); ?></th>
                    </tr>
                </thead>
                <tbody> 
                    <?php foreach($spelers as $data ): 
                            if($data["spelerId"] == 0){
                                continue;//speler met ID 0 overslaan
                            }
                        //controlleer of een speler voorkomt bij aanmeldingen. Zo ja dan vinken we die aan.
                        $key = array_search($data["spelerId"], array_column($aanmeldingen, 'spelerId'));
                        if(!is_bool($key)){$checked = "checked"; $selected = "table-success";}else{ $checked = ""; $selected = "table-light";}
                        ?>
                        <tr class="<?php echo $selected ?>">
                            <td><?php echo $data["roepnaam"]." " .$data["tussenvoegsels"]." " .$data["achternaam"] ; ?></td>
                            <td><?php echo $data["schoolnaam"]; ?></td>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="spelerId" value="<?php echo $data["spelerId"] ?>">
                                    <input type="checkbox" name="aanmelden" onchange="submit();" <?php echo $checked; ?>>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script>
            $('.table tr').click(function(event){
                if(event.target.type !== 'checkbox'){
                    $(':checkbox', this).trigger("click");
                }
            });
        </script>  