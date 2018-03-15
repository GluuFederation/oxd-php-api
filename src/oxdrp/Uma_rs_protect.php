<?php
	
	/**
	 * Gluu-oxd-library
	 *
	 * An open source application library for PHP
	 *
	 *
	 * @copyright Copyright (c) 2017, Gluu Inc. (https://gluu.org/)
	 * @license	  MIT   License            : <http://opensource.org/licenses/MIT>
	 *
	 * @package	  Oxd Library by Gluu
	 * @category  Library, Api
	 * @version   3.1.2
	 *
	 * @author    Gluu Inc.          : <https://gluu.org>
	 * @link      Oxd site           : <https://oxd.gluu.org>
	 * @link      Documentation      : <https://gluu.org/docs/oxd/3.1.2/libraries/php/ >
	 * @director  Mike Schwartz      : <mike@gluu.org>
	 * @support   Support email      : <support@gluu.org>
	 * @developer Volodya Karapetyan : <https://github.com/karapetyan88> <mr.karapetyan88@gmail.com>
	 *
	 
	 *
	 * This content is released under the MIT License (MIT)
	 *
	 * Copyright (c) 2017, Gluu inc, USA, Austin
	 *
	 * Permission is hereby granted, free of charge, to any person obtaining a copy
	 * of this software and associated documentation files (the "Software"), to deal
	 * in the Software without restriction, including without limitation the rights
	 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	 * copies of the Software, and to permit persons to whom the Software is
	 * furnished to do so, subject to the following conditions:
	 *
	 * The above copyright notice and this permission notice shall be included in
	 * all copies or substantial portions of the Software.
	 *
	 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	 * THE SOFTWARE.
	 *
	 */

	/**
	 * UMA RS Protect resources class
	 *
	 * Class is connecting to oxd-server via socket, and adding resources in gluu-server.
	 *
	 * @package		  Gluu-oxd-library
	 * @subpackage	Libraries
	 * @category	  Relying Party (RP) and User Managed Access (UMA)
	 * @see	        Client_Socket_OXD_RP
	 * @see	        Client_OXD_RP
	 * @see	        Oxd_RP_config
	 */

	namespace oxdrp;
	use oxdrp\Client_OXD_RP;
	
	class Uma_rs_protect extends Client_OXD_RP{
	
	    /**
	     * @var string $request_oxd_id                         This parameter you must get after registration site in gluu-server
	     */
	    private $request_oxd_id = null;
	
	    /**
	     * @var array $request_resources                       This parameter your resources parameter
	     */
	    private $request_resources = array();
            /**
	     * @var array $request_resource                       This parameter your resources parameter
	     */
	    public $request_resource = array();
            /**
	     * @var array $request_condition                       This parameter your resources parameter
	     */
	    public $request_condition = array();
            
            /**
             * var string $request_protection_access_token
             */
            private $request_protection_access_token;
            /**
	     * @return string
	     */
            function getRequest_protection_access_token() {
                return $this->request_protection_access_token;
            }
            /**
             * @param string $request_protection_access_token
	     * @return void
	     */
            function setRequest_protection_access_token($request_protection_access_token) {
                $this->request_protection_access_token = $request_protection_access_token;
            }
            
	    /**
	     * Constructor
	     *
	     * @return	void
	     */
	    public function __construct($config = null)
	    {
                if(is_array($config)){
                    Client_Socket_OXD_RP::setUrl(substr($config["host"], -1) !== '/'?$config["host"]."/".$config["uma_rs_protect"]:$config["host"].$config["uma_rs_protect"]);
                }
	        parent::__construct(); // TODO: Change the autogenerated stub
	    }
	
	
	    /**
	     * @return string
	     */
	    public function getRequestOxdId()
	    {
	        return $this->request_oxd_id;
	    }
	
	    /**
	     * @param string $request_oxd_id
	     * @return void
	     */
	    public function setRequestOxdId($request_oxd_id)
	    {
	        $this->request_oxd_id = $request_oxd_id;
	    }
	
	    /**
	     * @return array
	     */
	    public function getRequestResources()
	    {
	
	        return $this->request_resources;
	    }
            /**
             * @param string $path
	     * @return void
	     */
	    public function addResource($path){
	        $request_resources =  array(
	            'path'=>$path,
	            'conditions' => $this->request_condition
	        );
	        array_push($this->request_resources, $request_resources);
	        //$this->request_condition = null;
	    }
	    /**
              * @param array $httpMethods
              * @param array $scopes
              * @param array $ticketScopes
              * @param array $scope_expression
	      * @return request_condition
	      */
	    public function addConditionForPath(array $httpMethods, array $scopes, array $ticketScopes, array $scope_expression = null){
	        $request_condition =   array(
	                                        "httpMethods" => $httpMethods
	        );
                if(!is_null($scope_expression)){
                    $request_condition['scope_expression'] = $scope_expression;
                } else {
                    $request_condition['scopes'] = $scopes;
                    $request_condition['ticketScopes'] = $ticketScopes;
                }
	
	        array_push($this->request_condition, $request_condition);
	        return $this->request_condition;
	    }
            /**
	     * @return array $request_condition
	     */
	    public function getCondition(){
	        return  $this->request_condition;
	    }
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'uma_rs_protect';
	    }
	
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "oxd_id" => $this->getRequestOxdId(),
	            "resources" => $this->getRequestResources(),
                    "protection_access_token" => $this->getRequest_protection_access_token()
	        );
	    }
	
	}
