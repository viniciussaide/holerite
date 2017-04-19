<?php

/**
 * Classe login
 * Realiza todo o processo de login e logout
 */
class Login
{
    public $db_connection = null;

    public $errors = array();

    public $messages = array();

    /**
     * Método contrutor da classe Login
     */
    public function __construct()
    {
        //Inicia a sessão
        session_start();

        if (isset($_GET["logout"])) {
			//Apresenta mensagem de Logout
            $this->doLogout();
        }
		elseif (isset($_GET["forcedlogout"])) {
			//Apresenta mensagem de Logout forçado
            $this->forceLogout();
        }
		elseif (isset($_GET["timeout"])){
			//Apresenta mensagem de login expirado
			$this->timeout_session();
		}
		elseif(isset($_POST["login"])) {
			//Faz login com dados enviados
			$this->dologinWithPostData();
		}
	}
	

    private function dologinWithPostData()
    {
        // Verifica se existe campos em branco
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Campo usuário está em branco.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Campo senha está em branco.";
		} elseif (empty($_POST['uniqueCode'])) {
            $this->errors[] = "Chave de segurança está em branco.";	
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])&&!empty($_POST['uniqueCode'])) {

            //Cria conexão com o banco
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			
            // Modifica charset para UTF8
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            //Verifica se conexão com o banco é válida
            if (!$this->db_connection->connect_errno) {
                //Necessário para segurança, para evitar SQL Injection
                $matricula = $this->db_connection->real_escape_string($_POST['user_name']);
				

                //Query para buscar matrícula no banco
                $sql = "SELECT matricula, cpf, nome, user_password_hash, uniqueCode, id_sessao, cargo, email
                        FROM users
                        WHERE matricula = '$matricula'";
                $result_of_login_check = $this->db_connection->query($sql);

                // Se matrícula existe
                if ($result_of_login_check->num_rows == 1) {
					//Guarda as variáveis id_sessao e chave de segurança, para verificar login
					$result_row = $result_of_login_check->fetch_object();
					$uniqueCode = $result_row->uniqueCode;
					$id_sessao = $result_row->id_sessao;
					
					//Verifica a chave de segurança
					if ($_POST['uniqueCode']==$uniqueCode){
					
						//Verifica se o hash da senha é igual a senha fornecida
						if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {
						
							if((isset($_COOKIE['id_sessao']))&&($id_sessao<>$_COOKIE['id_sessao'])){
								//Caso exista um cookie de id_sessao, mas este id não seja igual ao do banco, força logout
								$matricula = $result_row->matricula;
								$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
								$sql = "UPDATE users SET id_sessao = '' WHERE matricula ='$matricula'";
								$this->db_connection->query($sql);
								header ("location:index.php?forcedlogout");
							}
							elseif ($id_sessao==''){
								//Caso não exista sessão aberta, abra uma nova sessão
								$_SESSION['user_name'] = $result_row->matricula;
								$_SESSION['nome'] = $result_row->nome;
								$_SESSION['nome'] = trim($_SESSION['nome']);
								$_SESSION['cpf'] = $result_row->cpf;
								$_SESSION['cargo'] = $result_row->cargo;
								$_SESSION['email'] = $result_row->email;
								$nome = explode(" ", $_SESSION['nome']);
								$_SESSION['primeiro_nome'] = $nome[0];
								$_SESSION['ultimo_nome'] = $nome[count($nome)-1];
								$_SESSION['user_login_status'] = 1;
								$sql = "SELECT * FROM `relacao_type_user` join user_type on relacao_type_user.fk_id_user_type=user_type.id_user_type Where relacao_type_user.fk_matricula='$matricula' GROUP BY type ORDER BY id_user_type;";
								$result = $this->db_connection->query($sql);
								$query_restricao = '';
								$user_default = "fk_id_user_type = 2";
								while($row = $result->fetch_array(MYSQLI_ASSOC)) {
									if ($query_restricao<>''){
										$query_restricao .= " OR ";
									}
									$query_restricao .= "fk_id_user_type = ". $row['id_user_type'];
								}
								$_SESSION['query_restricao'] = $query_restricao;
								if (isset($_POST['id_sessao'])){
									$_SESSION['id_sessao'] = $_POST['id_sessao'];
								}
								if ($query_restricao==$user_default){
									$_SESSION['tempo_sessao'] = time()+SESSION_TIME;
								}
								else {
									$_SESSION['tempo_sessao'] = time()+360000;
								}
								setcookie('id_sessao', $_SESSION['id_sessao']);
								$id_sessao = $_SESSION['id_sessao'];
								$sql = "UPDATE users SET id_sessao = '$id_sessao' WHERE matricula ='$matricula'";
								$this->db_connection->query($sql);
								header ("location:index.php?pagina=home.php");
							}
							elseif (($_SESSION['tempo_sessao']<time()) AND (isset($_SESSION['id_sessao']))) {
								//Caso exista uma sessão aberta e o tempo da sessao se esgotou, expira login
								header ("location:index.php?timeout");
							}
							else{
								//Caso algum erro não documentado ocorra, força logout
								$matricula = $result_row->matricula;
								$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
								$sql = "UPDATE users SET id_sessao = '' WHERE matricula ='$matricula'";
								$this->db_connection->query($sql);
								header ("location:index.php?forcedlogout");
							}
						} else {
							//Mensagem de erro caso senha incorreta
							$this->errors[] = "<strong>Senha incorreta.</strong><p></p>
							<div class='form-horizontal' style='text-align:center;'>
							<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Tente Novamente</a></p>
							<a class='btn btn-primary form-group' style='width:150px' href='recuperar_senha.php'>Solicite outra</a>
							</div>";
						}
					}
					else {
						//Mensagem de erro caso chave de segurança incorreta
						$this->errors[] = "<strong>Chave de Segurança incorreta.</strong><p></p>
						<div class='form-horizontal' style='text-align:center;'>
						<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Tente Novamente</a></p>
						</div>";
					}
                } else {
					//Mensagem de erro caso matrícula não exista
                    $this->errors[] = "<strong>Este usuário não existe.</strong><p></p>
					<div class='form-horizontal' style='text-align:center;'>
					<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Tente Novamente</a></p>
					</div>";
                }
            } else {
				//Mensagem de erro caso possua problemas na conexão com banco de dados
                $this->errors[] = "<strong>Problema em conexão com banco de dados.</strong>";
            }
        }
    }


    public function doLogout(){
        //Logout
		if (isset($_SESSION['user_name'])){
			$matricula = $_SESSION['user_name'];
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$sql = "UPDATE users SET id_sessao = '' WHERE matricula ='$matricula'";
			$this->db_connection->query($sql);
			$_SESSION = array();
			setcookie('id_sessao', '', time() - 3600);
			session_destroy();
			// return a little feeedback message
			$this->messages[] = "logout";
		}
    }
	
	public function forceLogout() {
		//Logout forçado
		if (isset($_SESSION['user_name'])){
			$matricula = $_SESSION['user_name'];
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$sql = "UPDATE users SET id_sessao = '' WHERE matricula ='$matricula'";
			$this->db_connection->query($sql);
			$_SESSION = array();
			setcookie('id_sessao', '', time() - 3600);
			session_destroy();
			$this->errors[] = "<strong>Sessão com problema.</strong></br>Identificamos que seu usuário estava logado em outro dispositivo, a partir de agora as sessões antigas foram encerradas. Caso você não tenha realizado outro login, sugerimos que altere sua senha.<p></p>
			<div class='form-horizontal' style='text-align:center;'>
			<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Tente Novamente</a></p>
			</div>";
		}
		else {
			$_SESSION = array();
			setcookie('id_sessao', '', time() - 3600);
			session_destroy();
			$this->errors[] = "<strong>Sessão com problema.</strong></br>Identificamos que seu usuário estava logado em outro dispositivo, a partir de agora as sessões antigas foram encerradas. Caso você não tenha realizado outro login, sugerimos que altere sua senha.<p></p>
			<div class='form-horizontal' style='text-align:center;'>
			<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Tente Novamente</a></p>
			</div>";
		}
	}
	
	public function timeout_session() {
		//Sessão expirou
		if (isset($_SESSION['user_name'])){
			$matricula = $_SESSION['user_name'];
			$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			$sql = "UPDATE users SET id_sessao = '' WHERE matricula ='$matricula'";
			$this->db_connection->query($sql);
			$_SESSION = array();
			setcookie('id_sessao', '', time() - 3600);
			session_destroy();
			$this->errors[] = "<strong>Login expirou!</strong></br>Sua sessão ficou inativa por muito tempo, e por isso foi finalizada por segurança.</br><p></p>
			<div class='form-horizontal' style='text-align:center;'>
			<p><a class='btn btn-default form-group' style='width:150px' data-dismiss='modal' data-toggle='modal' data-target='#login'>Logue Novamente</a></p>
			</div>";
		}
	}
	
	public function message(){
		//Mensagem que aparece na página inicial
		$_SESSION = array();
		$this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->db_connection->set_charset("utf8");
		$query = "SELECT * FROM mensagem WHERE tela_inicial=1";
		$result = $this->db_connection->query($query);
		$row = $result->fetch_object();
		$this->titulo_mensagem = $row->titulo;
		$this->messages[] = $row->mensagem;
    }

    public function isUserLoggedIn(){
		if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        return false;
    }
}