<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$this->menu  = "squad";
$this->submenu = 'tactics';
$this->title = 'Táticas';


switch ($this->request['subrequest']) {
  case 'value':
    # code...
    break;

  default:
    $this->addCSSFile('tactics.css');
    $this->addJSFile('tactics.js');
    $this->addJSFile('table.sort.js');
    $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players inner join players_position using(id_player) where id_player_club=:id_club and id_position!=1 group by id_player order by id_player");
    $query->bindParam(":id_club",$_SESSION['SL_club']);
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $player = Player::__this($data->id_player);
      $player->__loadinfo();
      $player->__loadskills();
      // $player->__loadhistory();
      $player->__loadpositions();
      $player->skillIndex();
      $this->data['players']['line'][]=$player;
    }
    break;
}