<?php 


 class Estoque{

    public function mostrar(){

        $con = new PDO('mysql: host= localhost; dbname= filial;', 'root', '');
        
        $sql = "SELECT * FROM estoque ORDER BY id ASC";
        $sql = $con->prepare($sql); //Recebe minha conexão com o banco e executa a query acima :)
        $sql->execute();//Query sendo executada

        $resultados = array();

        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
            $resultados[] = $row;
        }
        if(!$resultados){

        throw new Exception("Nenhum produto no estoque meu caro :(", 1);
        
        }else{
            return $resultados;
        }

    }

 }





























?>