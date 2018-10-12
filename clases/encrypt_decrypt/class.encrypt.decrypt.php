<?php

class encryptDecrypt {
    /**
   * Constructor
   * @param boolean $exceptions Should we throw external exceptions?
   */
    public function __construct() {        
        $this->encrypt_method = "AES-256-CBC";
        $this->secret_key = '3du4rd0';
        $this->secret_iv = 'losviejosrockerosnuncamueren';	
        $this->key = hash('sha256', $this->secret_key);
        $this->do_debug = 0;
        $this->iv = substr(hash('sha256', $this->secret_iv), 0, 16);
    }
    
    /**
    * Encripta la cadena recibida
    *
    * @access public
    * @return string salida
    */
    public function encrypt($cadena) {
        $salida = openssl_encrypt($cadena, $this->encrypt_method, $this->key, 0, $this->iv);
	$salida = base64_encode($salida);        
	
        return $salida;
    }
    
    /**
    * Desencripta la cadena recibida
    *
    * @access public
    * @return string salida
    */
    public function desencrypt($cadena) {
        //$salida = "aFBiSXU3bDNwYVhxUkFSMUw0b3NXZz09";
        $salida = openssl_decrypt(base64_decode($cadena), $this->encrypt_method, $this->key, 0, $this->iv);
        
	return $salida;        
    }  
}

