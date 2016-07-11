<?

class Authentication{
	private $login;
	private $password;
	public $id_account;
	private $con;

	public function __construct(){
		$this->con=Connection::getInstance()->connect();
	}
	public function verifyAuthentication():bool{
		$session=$_SESSION['SL_session'] ?? 'null';
		$query=$this->con->prepare("SELECT valid FROM session WHERE session=:session and valid='true'");
		$query->bindParam(':session',$session);
		$query->execute();

		if($query->rowCount()>0) return true;
		else return false;
	}

	public function getAccountId():int{
		return $_SESSION['SL_account'];
	}
	public function logout(){
		// remove valid of the session table
		$query=$this->con->prepare("UPDATE session SET valid='FALSE' where session=:session and id_account=:id_account");

		$query->bindParam(':session',session_id());
		$query->bindParam(':id_account',$_SESSION['SL_account']);

		$query->execute();
		//remove the session data
		$_SESSION['SL_login']='';
		$_SESSION['SL_account']='';

		//destroy session data
		session_destroy();
		//move user back to home page
		header('location: http://' . $_SERVER['SERVER_NAME']);
	}
	public function verifyLogin($email,$password):bool{

		$query=$this->con->prepare("SELECT password, id_account FROM account where email=:email");
		$query->bindParam(':email',$email);

		$query->execute();

		if($query->rowCount()>0){
			$query->setFetchMode(PDO::FETCH_OBJ);

			$data=$query->fetch();
			$hash=$data->password;
			if(password_verify($password, $hash)){
				$this->id_account=$data->id_account;
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function login():bool{

		session_start();
		session_regenerate_id();

		$_SESSION['SL_session']=session_id();
		$_SESSION['SL_login']=$this->login;
		$_SESSION['SL_account']=$this->id_account;
		$_SESSION['SL_club']=Club::getClubByAccountId($this->id_account);
		$_SESSION['SL_div']=1;
		$_SESSION['SL_group']=1;
		try{
			$query=$this->con->prepare("INSERT INTO session(id_account,session,valid) values (:id_account, '".session_id()."','true')");
			$query->bindParam(':id_account',$this->id_account);
			$query->execute();
		}catch(PDOException $e){
			return false;
			exit;
		}finally{
			return true;
		}
	}
	public static function getSessionData(){}

	public static function homeRedirect(){
		header('location: http://' .  $_SERVER['SERVER_NAME']); //if not, go to frontpage
	}
}
