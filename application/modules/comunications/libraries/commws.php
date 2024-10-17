 <?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');


class Commws {
    private $CI;

     
    function __construct()
    {
      $this->CI =& get_instance();
    }

    
    
function http_conn_comunication_cd($sms_mas3) {
		   
define('TP_USER', 'sms');
define('TP_PASS', 'sms2018*');

  //$credentials = "DannyCalle:DannyC2018*"; 
$credentials = "sms:sms2018*";
  $postDataJson = json_encode($sms_mas3);
  
  $curl = curl_init();
		curl_setopt_array($curl, array(
    		
			  CURLOPT_HTTPHEADER => array(
		         //   "Authorization: Basic " . base64_encode(TP_USER . ":" . TP_PASS),
				 "Authorization: Basic " . base64_encode($credentials) ,
		              "Content-type: application/json",
		              "Accept: application/json"
				),
				
				CURLOPT_POSTFIELDS => $postDataJson,
			    CURLOPT_RETURNTRANSFER => 1,
    			CURLOPT_URL => 'https://apismsi.aldeamo.com/SmsiWS/smsSendPost/ ',
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
			    CURLOPT_POST => 1,    
				CURLOPT_SSL_VERIFYPEER => false
		));
                    
		$resp = curl_exec($curl);
echo "RESPUESTA".$resp;
		curl_close($curl);
		
    }

	function saldo_cd($sms_mas3) {
		
define('TP_USER', 'DannyCalle');
define('TP_PASS', 'DannyC2018*');

 //$credentials = "santa_rosa:santa_rosa2018*";
  $credentials = "sms:sms2018*";

$tipo_pro=array(); 
		 array_push($tipo_pro, 'SMS');
		 
		$message = array(
          "land" =>'593',	
		  "packageTypeList" =>$tipo_pro
	);

 
//print_r ($message);
$postDataJson = json_encode($message);
          
		$curl = curl_init();
		curl_setopt_array($curl, array(
    		
			    CURLOPT_HTTPHEADER => array(
		             // "Authorization: Basic " . base64_encode(TP_USER . ":" . TP_PASS),
					  "Authorization: Basic " . base64_encode($credentials) ,
		              "Content-type: application/json",
		              "Accept: application/json"
				),
				
				CURLOPT_POSTFIELDS => $postDataJson,
			    CURLOPT_RETURNTRANSFER => 1,
    			CURLOPT_URL => 'https://apismsi.aldeamo.com/SmsiWS/packageReportPost',
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
			    CURLOPT_POST => 1,   
				CURLOPT_SSL_VERIFYPEER => false
				
		));
              
		$resp = curl_exec($curl);

	//	return $resp;
	//	echo "RESPUESTA".$resp;
		curl_close($curl);
		return $resp;	





    }
	

	
    function reporte_cd($fecha_desde,$fecha_hasta) {
		
                        
$credentials = "sms:sms2018*";
  $usuario=array(); 
		 array_push($usuario, "sms");
		$message = array(
          "clickReport" =>false,	
		  "dateToSendFrom" =>$fecha_desde,
		  "dateToSendTo" =>$fecha_hasta,	
		  "land" =>'593',
		  "userNameList" =>$usuario
 );
 
 $re1 ["filters"] =$message;
 
$postDataJson = json_encode($re1);
		$curl = curl_init();
		curl_setopt_array($curl, array(
    		
			    CURLOPT_HTTPHEADER => array(
		             // "Authorization: Basic " . base64_encode(TP_USER . ":" . TP_PASS),
					  "Authorization: Basic " . base64_encode($credentials),
		              "Content-type: application/json",
		              "Accept: application/json"
				),
				
				CURLOPT_POSTFIELDS => $postDataJson,
			    CURLOPT_RETURNTRANSFER => 1,
    			CURLOPT_URL => 'https://apismsi.aldeamo.com/SmsiWS/smsReportPost',
                    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
			    CURLOPT_POST => 1,    
		));
              
		$resp = curl_exec($curl);
$lol=json_decode($resp, true);
$lol1=$lol["result"];
$lol2=$lol1["reportList"];
return $lol2;
		curl_close($curl);

    }
	
	
	
    public function get_user_ws() {
        return $this->user_ws;
    }
    public function set_user_ws($param) {
        $this->user_ws = $param;
    }
    
    public function get_pass_ws() {
        return $this->pass_ws;
    }
    public function set_pass_ws($param) {
        $this->pass_ws = $param;
    }
    
    public function get_url_ws() {
        return $this->url_ws;
    }
    public function set_url_ws($param) {
        $this->url_ws = $param;
    }
	
	
	
	
	
}
