<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
                
        <?php
            class PropertyTest {
                 
                public $data = array();
                /** Здесь перегрузка будет использована только при доступе вне класса. */
                private $hidden=2;
                /** Перегрузка не применяется к объявленным свойствам. */
                private $declared=1;
                
                public function __set($name_inp,$value_inp) {
                    echo "Установлен '$name_inp' в '$value_inp'</br>";
                    $this->data[$name_inp]=$value_inp;  
                }
                
                public function __get($name_inp) {
                    echo "Получение '$name_inp'\n";
                    if (array_key_exists($name_inp, $this->data)){
                        return $this->data[$name_inp];
                    }
                    $trace = debug_backtrace();

                    trigger_error(
                        'Неопределенное свойство в __get(): ' . $name_inp. 
                        ' в файле '. $trace[0]['file'] .    
                        ' на сроке '. $trace[0]['line'],
                        E_USER_NOTICE);
                    return null;                        
                }  

                public function __unset($name_inp){                    
                    echo "Удалено '$name_inp'</br>";
                    unset($this->data[$name_inp]);
                }
                
                public function __isset($name_inp){
                    
                    echo "Установлено ли '$name_inp'?</br>";
                    return isset($this->data[$name_inp]);
                }
                
                public function getHidden() {
                    return $this->hidden;
                }
                
                public function d($value) {
                    echo "<pre>". print_r($value) ."</pre>";
                }
                
                public function dump($value) {
                    echo "<pre>". var_dump($value) ."</pre>";
                }
            }    
            
            $arrNew = $arrOld = array(
                "check" => true,
                "id" => "13",
                "prefix" => 7,
                "num" => "3571070",

                "code" => 977,
                "dop" => "677"
            );          
                            
            //$arrNew = &$arrOld;
            unset($arrNew["check"],$arrNew["id"]);                        
//          echo var_dump(array_diff_assoc($arrOld,$arrNew));
//          echo print_r($arrOld);
            $property = new PropertyTest();
            $property->title = "Заголовок";
            
            echo "Свойство text </br>".$property->text. "\n";                        
            unset($property->title);
            $key = array_keys($arrOld);
            $values = array_values($arrOld);
            
//          echo $property->d($key);
//          echo $property->d($values);
//          echo $property->d(array_combine($key, $values));
             
            phpinfo();
                    
        ?>
    </body>
</html>
