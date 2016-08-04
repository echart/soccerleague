<?

class ClubInfo{
  public static function get($id_club){
    $query=Connection::getInstance()->connect()->prepare("SELECT * from club_info where id_club=:id_club LIMIT 1");
    $query->bindParam(':id_club', $id_club);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public static function update($id_club,$manager,$nickname,$stadium,$city,$clubcolor,$history):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("UPDATE club_info SET manager=:manager, nickname=:nickname, stadium=:stadium,city=:city,clubcolor=:clubcolor,history=:history WHERE id_club=:id_club");
			$query->bindParam(':manager',$manager);
			$query->bindParam(':nickname',$nickname);
			$query->bindParam(':stadium',$stadium);
			$query->bindParam(':city',$city);
			$query->bindParam(':clubcolor',$clubcolor);
			$query->bindParam(':history',$history);
			$query->bindParam(':id_club',$id_club);
      $query->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
			return false;
		}
  }
  public static function updateLogo($id_club,$logo){
    try{
			$query=Connection::getInstance()->connect()->prepare("UPDATE club_info SET logo=:logo WHERE id_club=:id_club");
			$query->bindParam(':logo',$logo);
			$query->bindParam(':id_club',$id_club);
      $query->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
			return false;
		}
  }
}