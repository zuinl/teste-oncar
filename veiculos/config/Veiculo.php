<?php
    include 'QueryHelper.php';
    class Veiculo extends QueryHelper {
        private $id;
        private $modelo;
        private $marca;
        private $ano;
        private $descricao;
        private $vendido;
        private $createdAt;
        private $updatedAt;

        public function add() {
            if(!$this->validateFields()) return;

            $this->prepareForSQLExec();

            $insert = "INSERT INTO veiculos (
                veiculo, 
                marca, 
                ano, 
                descricao, 
                vendido) VALUES (
                '$this->modelo', 
                '$this->marca', 
                $this->ano, 
                '$this->descricao', 
                $this->vendido);";
                
            if($this->execSQL($insert)) {
                echo json_encode("O veículo foi adicionado com sucesso");
                http_response_code(200);
                return;
            } else {
                echo json_encode("Houve um erro ao adicionar o veículo");
                http_response_code(500);
                return;
            }
        }

        public function getAll($busca = "") {
            $select = "SELECT * FROM veiculos";
                if($busca) $select .= " WHERE (veiculo LIKE '%$busca%' OR 
                    marca LIKE '%$busca%')";
            $select .= " ORDER BY id DESC";

            $result = $this->execSQL($select);
            $vehicles = array();
            $index = 0;
            
            while($data = mysqli_fetch_assoc($result)) {
                $vehicles[$index] = array(
                    "id" => $data["id"],
                    "modelo" => $data["veiculo"],
                    "marca" => $data["marca"],
                    "ano" => $data["ano"],
                    "descricao" => $data["descricao"],
                    "vendido" => $data["vendido"]
                );
                $index++;
            }

            echo json_encode($vehicles);
            http_response_code(200);
        }

        public function getOne() {
            $select = "SELECT * FROM veiculos WHERE id = $this->id";

            $result = $this->execSQL($select);
            $data = mysqli_fetch_assoc($result);

            echo json_encode($data);
            http_response_code(200);
        }

        public function update() {
            if(!$this->validateFields()) return;

            $this->prepareForSQLExec();

            $update = "UPDATE veiculos SET 
                veiculo = '$this->modelo',
                marca = '$this->marca',
                ano = $this->ano,
                descricao = '$this->descricao',
                vendido = $this->vendido 
                WHERE id = $this->id";

            if($this->execSQL($update)) {
                echo json_encode("O veículo foi atualizado com sucesso");
                http_response_code(200);
                return;
            } else {
                echo json_encode("Houve um erro ao atualizar o veículo");
                http_response_code(500);
                return;
            }
        }

        public function delete() {
            $delete = "DELETE FROM veiculos WHERE id = $this->id";
            if($this->execSQL($delete)) {
                echo json_encode("O veículo foi excluído");
                http_response_code(200);
            } else {
                echo json_encode("Houve um erro ao excluir o veículo");
                http_response_code(500);
            }
        }

        private function prepareForSQLExec() {
            $this->modelo = addslashes($this->modelo);
            $this->marca = addslashes($this->marca);
            $this->descricao = addslashes($this->descricao);
        }

        private function validateFields() {
            if($this->modelo === "") {
                echo json_encode("O modelo precisa ser preenchido");
                http_response_code(400);
                return false;
            }
            if($this->marca === "") {
                echo json_encode("A marca precisa ser preenchida");
                http_response_code(400);
                return false;
            }
            if($this->ano === "") {
                echo json_encode("O ano precisa ser preenchido");
                http_response_code(400);
                return false;
            }
            if($this->descricao === "") {
                echo json_encode("Adescrição precisa ser preenchido");
                http_response_code(400);
                return false;
            }

            return true;
        }

        public function getId()
        {
            return $this->id;
        }
 
        public function setId($id)
        {
            $this->id = $id;
        }

        public function getModelo()
        {
            return $this->modelo;
        }

        public function setModelo($modelo)
        {
            $this->modelo = $modelo;
        }

        public function getMarca()
        {
            return $this->marca;
        }

        public function setMarca($marca)
        {
            $this->marca = $marca;
        }
 
        public function getAno()
        {
            return $this->ano;
        }

        public function setAno($ano)
        {
            $this->ano = (int)$ano;
        }

        public function getDescricao()
        {
            return $this->descricao;
        }

        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }

        public function getVendido()
        {
            return $this->vendido;
        }

        public function setVendido($vendido)
        {
            $this->vendido = (int)$vendido;
        }
 
        public function getCreatedAt()
        {
            return $this->createdAt;
        }

        public function setCreatedAt($createdAt)
        {
            $this->createdAt = $createdAt;
        }

        public function getUpdatedAt()
        {
            return $this->updatedAt;
        }

        public function setUpdatedAt($updatedAt)
        {
            $this->updatedAt = $updatedAt;
        }
    }

?>