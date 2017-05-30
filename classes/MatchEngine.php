<?

class MatchEngine{
  public $match;
  public $matchStats;
  public $matchReport;

  //tactical variables
  public $players = array();
  public $tactics = array();
  public $positions = array('gk','dc','dcl','dcr','dl','dr','dmc','dmcr','dmcl','dmr','dml','mc','mcr','mcl','ml','mr','omc','omcl','omcr', 'oml','omr','fc','fcr','fcl');
  public $positions_reserve = array('gk','dc','ml','mc','fc');
  public $functions = array('captain','freekick','corner','penalty');
  public $tactical_pattern = array('gk','dcl','dcr','dr','dl','ml','mcl','mcr','mcr','mr','fcl','fcr');

  public function __construct(Match $match){
    $this->match = $match;
    $this->matchStats = new MatchStats($this->match);
    $this->matchReport = new MatchReport($this->match);
  }
  public function __loadteams(){
    //load home
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM tactics where id_club=:id_club");
    $query->bindParam(':id_club',$this->match->home);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $this->tactics['home'] = $data;
    $this->tactics['home']['players_on_field'] = json_decode($this->tactics['home']['players_on_field']);
    $this->tactics['home']['players_on_reserve'] = json_decode($this->tactics['home']['players_on_reserve']);
    $this->tactics['home']['players_functions'] = json_decode($this->tactics['home']['players_functions']);

    if($this->tactics['home']['players_on_field']!=null){
      foreach ($this->tactics['home']['players_on_field'] as $key => $value) {
        $player = Player::__this(intval($value));
        if($player->__injuried()==false or $player->__suspended()==3){
          $players[$value] = $player;
          $players[$value]->__loadinfo();
          $players[$value]->__loadskillsDecimals();
        }else{
          unset($this->tactics['home']['players_on_field']->$key);
        }
      }
    }
    if($this->tactics['home']['players_on_reserve']!=null){
      foreach ($this->tactics['home']['players_on_reserve'] as $key => $value) {
        $player = Player::__this(intval($value));
        if($player->__injuried()==false or $player->__suspended()==3){
          $players[$value] = $player;
          $players[$value]->__loadinfo();
          $players[$value]->__loadskillsDecimals();
        }else{
          unset($this->tactics['home']['players_on_reserve']->$key);
        }
      }
    }


    // var_dump($this->tactics['home']['players_functions']);

    // var_dump($this->tactics['home']['players_functions']);
    //load away
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM tactics where id_club=:id_club");
    $query->bindParam(':id_club',$this->match->away);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    $this->tactics['away'] = $data;
    $this->tactics['away']['players_on_field'] = json_decode($this->tactics['away']['players_on_field']);
    $this->tactics['away']['players_on_reserve'] = json_decode($this->tactics['away']['players_on_reserve']);
    $this->tactics['away']['players_functions'] = json_decode($this->tactics['away']['players_functions']);

    if($this->tactics['away']['players_on_field']!=null){
      foreach ($this->tactics['away']['players_on_field'] as $key => $value) {
        $player = Player::__this(intval($value));
        if($player->__injuried()==false or $player->__suspended()==3){
          $players[$value] = $player;
          $players[$value]->__loadinfo();
          $players[$value]->__loadskillsDecimals();
        }else{
          unset($this->tactics['away']['players_on_field']->$key);
        }
      }
    }
    if($this->tactics['away']['players_on_reserve']!=null){
      foreach ($this->tactics['away']['players_on_reserve'] as $key => $value) {
        $player = Player::__this(intval($value));
        if($player->__injuried()==false or $player->__suspended()==3){
          $players[$value] = $player;
          $players[$value]->__loadinfo();
          $players[$value]->__loadskillsDecimals();
        }else{
          unset($this->tactics['away']['players_on_reserve']->$key);
        }
      }
    }
  }
  public function __WO(){
    if(count((array)$this->tactics['home']['players_on_field'])!=11 AND count((array)$this->tactics['away']['players_on_field'])==11){
      return 2;
    }else if(count((array)$this->tactics['home']['players_on_field'])==11 AND count((array)$this->tactics['away']['players_on_field'])!=11){
      return 1;
    }else if(count((array)$this->tactics['home']['players_on_field'])!=11 AND count((array)$this->tactics['away']['players_on_field'])!=11){
      return 0;
    }else{
      return false;
    }
  }
  public function attendance(){
    $attendance = array();
    $attendance[1] = array(30,75);
    $attendance[2] = array(40,90);
    $attendance[3] = array(50,95);
    $attendance[4] = array(85,100);
    $attendance[5] = array(90,100);
    $this->match->attendance = rand($attendance[$this->match->id_weather][0],$attendance[$this->match->id_weather][1]);
  }
  public function weather(){
    $this->match->id_weather = rand(1,5);
  }
  public function pitch_condition(){
    $pitch = array();
    $pitch[1] = array(30,75);
    $pitch[2] = array(40,90);
    $pitch[3] = array(50,95);
    $pitch[4] = array(85,100);
    $pitch[5] = array(90,100);
    $this->match->pitch = rand($pitch[$this->match->id_weather][0],$pitch[$this->match->id_weather][1]);
  }
}
error_reporting(!E_NOTICE);
include('Match.php');
include('MatchReport.php');
include('MatchStats.php');
include('Player.php');
include('Goalkeeper.php');
include('LinePlayer.php');
include('Connection.php');
$match = new Match(1);
$match->__load();
$engine = new MatchEngine($match);
$engine->__loadteams();
$engine->weather();
$engine->pitch_condition();
$engine->attendance();
if($engine->__WO()!=false){
  $wo = $engine->__WO();
}else{
  $engine->match();
}
// function print_var_name($var) {
//     foreach($GLOBALS as $var_name => $value) {
//         if ($value === $var) {
//             return $var_name;
//         }
//     }
//
//     return false;
// }
