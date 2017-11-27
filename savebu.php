if($result==false || $result->rowCount()<=0){
                        if($txttel[0]=="mem"){
                        $host = 'ec2-54-163-255-181.compute-1.amazonaws.com';
                        $dbname = 'dcoh0blsle9i6l'; 
                        $user = 'fljlfseofpkpfr';
                        $pass = 'ac9fab1bfcbd77359fb3c7f0a30c571de1e94d13006d1be29aa39e5c978b9182'; 
                        $connection=new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
                        $params = array('tpre'=> $txttel[0], 'tname'=> $txttel[1],'ttel'=> $txttel[2],);
                        $statement=$connection->prepare("INSERT INTO com4_6_phone (name,mobile) VALUES(:tname,:ttel)");
                        $result = $statement->execute($params);
                        if($result !== null) {
                            $respMessage='จำเบอร์ '.$txttel[1].' เรียบร้อยแล้ว';
                        }else{
                            $respMessage='ติดต่อไม่ได้';
                        }
                        }else{
                        $respMessage='เบอร์ '.$txttel[1].' จำไปแล้วครับ พิมพ์ เบอร์,ชื่อคนที่ต้องการ เพื่อดูเบอร์';    
                        }   
                    }