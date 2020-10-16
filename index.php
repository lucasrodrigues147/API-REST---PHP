<?php 

header('Content-Type: application/json; charset=UTF-8');

require_once 'classes/Estoque.php';


class Rest{

    public static function open($requisicao){//Open recebe uma requisição como parâmetro
        $url = explode('/', $requisicao['url']);
        //O explode está removendo a barra da minha Url, e agora divide os parâmetros dentro do Array


        $classe = ucfirst($url[0]);//o ucfirst deixa o primeiro caracter maiusculo
        array_shift($url);//O Arrar_shift vai eliminar a posição 1[0] desse array

        $metodo = $url[0];
        array_shift($url);//O Arrar_shift vai eliminar a posição 2[1] desse array

        $parametros = array();
        $parametros = $url; // Vai me retornar todos os outros parâmetros existentes na url
        //e caso não tenha nenhum, ele é por padrão um Array (linha 16)
        
        try {
            if(class_exists($classe)){
                if(method_exists($classe, $metodo)){
                     $retorno =  call_user_func_array(array(new $classe, $metodo), $parametros);
            
                        return json_encode(array('status' => 'Sucesso', 'dados' => $retorno));

                }else{
                        return json_encode(array('status' => 'Erro', 'dados' => 'Método Inexistente'));

            }
            }else{
                        return json_encode(array('status' => 'Erro', 'dados' => 'Classe Inexistente'));
        }
    } catch (Exception $e) {

        return json_encode(array('status' => 'Erro', 'dados' => $e->getMessage()));

    }
    
    
    
    
    
    
    
    
    
    
    }
}



if (isset($_REQUEST)){ // verifica se existe uma requisição
   echo Rest::open($_REQUEST);
    
}



?>