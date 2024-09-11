<?php
use gs\Connection;
use gs\Models\{User, History};
use gs\Helpers\Auth;
use gs\Table\Tableuser;


Auth::admincheck($match['name']);


$pdo = Connection::pdo();

$histories = [];

$properties = ['object', 'property', 'details', 'username'];

$dates = ['d_date', 'e_date', 'a_date'];

$columns = ['Object', 'Property', 'Details', 'Username', 'Date'];



//data treatement:
if(!empty($_POST)){
    //dd($_POST);
    $min = $_POST['datemin'];
    $max = $_POST['datemax'];
    $user = $_POST['user'];
    if($_POST['action'] === 'all'){
        
        $msg = "SELECT * FROM deletion WHERE d_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $deletion_query = $pdo->query($msg);
        $histories[] = $deletion_query->fetchAll(PDO::FETCH_CLASS, History::class);

        $msg = "SELECT * FROM editing WHERE e_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $editing_query = $pdo->query($msg);
        $histories[] = $editing_query->fetchAll(PDO::FETCH_CLASS, History::class);

        $msg = "SELECT * FROM addition WHERE a_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $query = $pdo->query($msg);
        $histories[] = $query->fetchAll(PDO::FETCH_CLASS, History::class);
        //dd($histories);

    }elseif($_POST['action'] === 'deletion'){
        $msg = "SELECT * FROM deletion WHERE d_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $query = $pdo->query($msg);
        $histories[] = $query->fetchAll(PDO::FETCH_CLASS, History::class);
        //dd($histories);

    }elseif($_POST['action'] === 'editing'){
        $msg = "SELECT * FROM editing WHERE e_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $query = $pdo->query($msg);
        $histories[] = $query->fetchAll(PDO::FETCH_CLASS, History::class);
        //dd($histories);

    }elseif($_POST['action'] === 'addition'){
        $msg = "SELECT * FROM addition WHERE a_date BETWEEN '{$min}' AND '{$max}'";
        if($_POST['user'] !== 'All'){
            $msg .= " AND username= {$user}";
        }
        $query = $pdo->query($msg);
        $histories[] = $query->fetchAll(PDO::FETCH_CLASS, History::class);
        //dd($histories);

    }
}



//getting users options
$users = [];
$users[0] = 'All';
$users_opts = [];
$usrs = (new Tableuser($pdo))->getAll();
foreach($usrs as $usr){
    $users[$usr->getId()] = $usr->getUsername();
}

foreach($users as $user){
    $selected = "";
    if(!empty($_POST)){
        if($_POST['user'] === $user){
            $selected = " selected";
        }
    }
    $users_opts[] = "<option value=\"$user\"$selected>$user</option>";
}
$usernames = implode('', $users_opts);


$actions = ['all', 'deletion', 'editing', 'addition'];
foreach($actions as $action){
    $selected = "";
    if(!empty($_POST)){
        if($_POST['action'] === $action){
            $selected = " selected";
        }
    }
    $opt = ucfirst($action);
    $opts[] = "<option value=\"$action\"$selected>$opt</option>";
}
$options = implode('', $opts);

$today = (new DateTime())->format('Y-m-d');
?>

<h1 class="mt-5" style="color: white;">History :</h1>

<div class="container">
    <div class="form-group mt-5">
        <form action="" method="POST">
            <div class="form-control" style="display:inline">
                    <label for="datemin">select date of start:</label>
                    <input type="date" id="datemin" name="datemin" max="<?=$today?>" required>
                    <label for="datemax">select date of end:</label>
                    <input type="date" id="datemax" name="datemax" value="<?=$today?>" max="<?=$today?>" required>  
                    <label for="act">Action:</label>
                    <select name="action" id="act">
                       <?= $options ?>
                    </select>
                    <label for="us">User:</label>
                    <select name="user" id="us"><?= $usernames ?></select>
            </div>   
                
            <button class="btn btn-primary" type="submit">Confirm</button>
            
        </form>
        
    </div>
</div>

<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <?php foreach($columns as $column): ?>
                    <th style="font-size: 22px;"><?= $column ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach($histories as $histori):
                    foreach($histori as $history): ?>
                        <tr>
                        <?php if($history->getDetails() === 'Item deleted'){
                                $style = 'color:red';
                            }elseif($history->getDetails() === 'Item added'){
                                $style = 'color:green';
                            }else{
                                $style = '';
                            }
                            foreach($properties as $property):
                            $function = 'get' . ucfirst($property);
                                if($property === 'property'):
                                    if($history->$function() !== null):?>
                                        <td style="font-size: 18px; <?= $style ?>"><?= $history->$function() ?></td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif;
                                elseif($property === 'username'):?>
                                        <td style="font-size: 18px; <?= $style ?>"><?= $history->$function() ?></td>
                                <?php else:?>
                                <td style="font-size: 18px; <?= $style ?>"><?= $history->$function() ?></td>
                                <?php endif ?>
                        <?php endforeach;
                            foreach($dates as $date):
                                $dfct = 'get' . ucfirst($date);
                                    if($history->$dfct() !== null):?>
                                        <td style="font-size: 18px; <?= $style ?>"><?= $history->$dfct() ?></td>
                                    <?php endif;
                            endforeach?>
                        </tr>
                    <?php endforeach;
                endforeach ?>       
        </tbody>
    </table>
</div>







<?php foreach($histories as $histori):
    foreach($histori as $history):
        foreach($properties as $property):
            $function = 'get' . ucfirst($property);
            if($history->$function() !== null):?>
                <p></p>
            <?php endif;
        endforeach;
    endforeach;
endforeach;
