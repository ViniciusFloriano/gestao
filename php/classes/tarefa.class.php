<?php
    include_once "../../php/utils/autoload.php";
    class Tarefa extends Database{
        private $id;
        private $titulo;
        private $data;
        private $descricao;
        private $prioridade;
        private $idmateria;

        public function __construct($id, $titulo, $data, $descricao, $prioridade, $idmateria){
            $this->setid($id);
            $this->settitulo($titulo);
            $this->setdata($data);
            $this->setdescricao($descricao);
            $this->setprioridade($prioridade);
            $this->setidmateria($idmateria);
        }

        public function getid() {
            return $this->id;
        }

        public function setid($id) {
            $this->id = $id;
        }

        public function gettitulo() {
            return $this->titulo;
        }

        public function settitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function getdata() {
            return $this->data;
        }

        public function setdata($data) {
            $this->data = $data;
        }

        public function getdescricao() {
            return $this->descricao;
        }

        public function setdescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function getprioridade() {
            return $this->prioridade;
        }

        public function setprioridade($prioridade) {
            $this->prioridade = $prioridade;
        }

        public function getidmateria() {
            return $this->idmateria;
        }

        public function setidmateria($idmateria) {
            $this->idmateria = $idmateria;
        }

        public function inserir(){
            $sql = 'INSERT INTO gestao.tarefa (titulo_tarefa, data_tarefa, descricao_tarefa, prioridade_tarefa, idmateria)
            VALUES (:titulo, :data, :descricao, :prioridade, :idmateria);';
            $parametros = array(":titulo"=>$this->gettitulo(),
                                ":data"=>$this->getdata(),
                                ":descricao"=>$this->getdescricao(),
                                ":prioridade"=>$this->getprioridade(),
                                ":idmateria"=>$this->getidmateria());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM gestao.tarefa WHERE id = :id;';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE gestao.tarefa
            SET titulo_tarefa = :titulo, data_tarefa = :data, descricao_tarefa = :descricao, prioridade_tarefa = :prioridade, idmateria = :idmateria
            WHERE id = :id;';
            $parametros = array(":titulo"=>$this->gettitulo(),
                                ":data"=>$this->getdata(),
                                ":descricao"=>$this->getdescricao(),
                                ":prioridade"=>$this->getprioridade(),
                                ":idmateria"=>$this->getidmateria(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM tarefa, materia WHERE tarefa.idmateria = materia.idmateria";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " AND id LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " AND titulo_tarefa LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " AND data_tarefa LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " AND descricao_tarefa LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " AND prioridade_tarefa LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " AND idmateria LIKE :procurar;"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM tarefa";
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
            $sql = "SELECT * FROM tarefa WHERE id = :id;";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>
