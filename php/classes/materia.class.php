<?php
    include_once "../../php/utils/autoload.php";
    class Materia extends Database{
        private $id;
        private $nome;
        private $professor;
        private $cor;

        public function __construct($id, $nome, $professor, $cor) {
            $this->setid($id);
            $this->setnome($nome);
            $this->setprofessor($professor);
            $this->setcor($cor);
        }

        public function getid() {
            return $this->id;
        }

        public function setid($id) {
            $this->id = $id;
        }

        public function getnome() {
            return $this->nome;
        }

        public function setnome($nome) {
            $this->nome = $nome;
        }

        public function getprofessor() {
            return $this->professor;
        }

        public function setprofessor($professor) {
            $this->professor = $professor;
        }

        public function getcor() {
            return $this->cor;
        }

        public function setcor($cor) {
            $this->cor = $cor;
        }

        public function inserir(){
            $sql = 'INSERT INTO gestao.materia (nome_materia, professor_materia, cor_materia)
            VALUES (:nome, :professor, :cor);';
            $parametros = array(":nome"=>$this->getnome(),
                                ":professor"=>$this->getprofessor(),
                                ":cor"=>$this->getcor());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM gestao.materia WHERE idmateria = :id;';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE gestao.materia
            SET nome_materia = :nome, professor_materia = :professor, cor_materia = :cor
            WHERE idmateria = :id;';
            $parametros = array(":nome"=>$this->getnome(),
                                ":professor"=>$this->getprofessor(),
                                ":cor"=>$this->getcor(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM materia";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE idmateria like :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome_materia like :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE professor_materia like :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE cor_mateiria like :procurar;"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM materia";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function consultarData($id){
            $sql = "SELECT * FROM materia WHERE idmateria = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>
