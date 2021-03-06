<?
/*
 * @author: echart
 * @description: Player class that will be extended to Goalkeeper or Lineplayer;
*/
class Player{
	/*info*/
	public $position;
	public $id_player;
	public $id_club;
	public $id_country;
	public $name;
	public $nickname;
	public $bear;
	public $hair;
	public $body;
	public $eyes;
	public $age;
	public $height;
	public $weight;
	public $wage; //
	public $skill_index; // @param $skill_index is an attribute of player that will be calculated by the sum of all the skills(VISIBLES)
	public $rec; // @param: $rec is an attribute of player that will be calculate by the importance of skills for each position that player have.
	/*Physical*/
	public $stamina;
	public $speed;
	public $resistance;
	public $jump;
	public $injury_prop;
	/*Psychologic*/
	public $professionalism;
	public $agressive;
	public $adaptability;
	public $leadership;
	public $workrate;
	public $concentration;
	public $decision;
	public $positioning;
	public $vision;
	public $unpredictability;
	public $communication;
	public function __construct($id_player){
		$this->id_player=$id_player;
	}
	/*methods*/
	public function calcwage(){
		$this->wage=pow($this->skill_index,2)*2;
		return $this->wage;
	}
	public function wage(){
		$query=Connection::getInstance()->connect()->prepare("SELECT wage FROM players_wage p where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		$this->wage = $data->wage;
		return $this->wage;
	}
	public function __loadinfo(){
		$query=Connection::getInstance()->connect()->prepare("SELECT name,nickname, age, height, weight, leg, id_player_club, id_country, recomendation FROM players p where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);

		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);

		$this->name = $data->name;
		$this->nickname = $data->nickname;
		$this->age = $data->age;
		$this->height = $data->height;
		$this->weight = $data->weight;
		$this->id_club = $data->id_player_club;
		$this->id_country = $data->id_country;
		$this->rec=$data->recomendation;
	}

	public function __loadappearance(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_appearance p where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);

		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);

		$this->hair = $data->hair;
		$this->body = $data->body;
		$this->bear = $data->bear;
		$this->eyes = $data->eyes;
	}

	public static function addHistory($id_player,$id_club,$season){
		  $query=Connection::getInstance()->connect()->prepare("INSERT INTO players_history (id_player,id_club,season) values (:id_player,:id_club,:season)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":id_club",$id_club);
			$query->bindParam(":season",$season);
			$query->execute();
	}

	public static function __this($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_position inner join positions using(id_position) where id_player=:id_player and position='GK'");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		if($query->rowCount()>0){
			return new Goalkeeper($id_player);
		}else{
			return new Lineplayer($id_player);
		}
	}
	public function __loadhistory(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_history where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();

		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;
	}
	public function __injuried(){
		$query=Connection::getInstance()->connect()->prepare("SELECT games FROM players_injury where id_player=:id_player and status=TRUE order by id_player_injury desc limit 1");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data = $query->fetch();
		if($query->rowCount()>0){
			return $data['games'];
		}else{
			return false;;
		}
	}
	public function __suspended(){
		$query=Connection::getInstance()->connect()->prepare("SELECT cards FROM players_cards where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data = $query->fetch();
		return $data['cards'];
	}
	public function __fire(){
		$query = Connection::getInstance()->connect()->prepare("DELETE FROM players where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
	}
	public function __listed(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM transferlist where id_player=:id_player and status=true");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		if($query->rowCount()>0){
			$data = $query->fetch();
			return $data;
		}else{
			return false;
		}
	}
}
