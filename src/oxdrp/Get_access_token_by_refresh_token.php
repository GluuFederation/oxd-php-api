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
	 * @version   3.0.1
	 *
	 * @author    Gluu Inc.          : <https://gluu.org>
	 * @link      Oxd site           : <https://oxd.gluu.org>
	 * @link      Documentation      : <https://gluu.org/docs/oxd/3.1.1/libraries/php/>
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
	 * Client tokens code class
	 *
	 * Class is connecting to oxd-server via socket, and getting token code from gluu-server.
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
	
	class Get_access_token_by_refresh_token extends Client_OXD_RP
	{
	    /**
	     * @var string $request_oxd_id                           This parameter you must get after registration site in gluu-server
	     */
	    private $request_oxd_id = null;
            /**
             * @var string $refresh_token
             */
            private $request_refresh_token;
            /**
             * @var array $request_scopes
             */
            private $request_scopes;
	    /**
	     * Response parameter from oxd-server
	     * It need to using for get_user_info and logout classes
	     *
	     * @var string $response_access_token
	     */
	    private $response_access_token;
            
            /**
	     * Response parameter from oxd-server
	     * Showing user expires time
	     *
	     * @var string $response_expires_in
	     */
	    private $response_expires_in;
            /**
	     * Response parameter from oxd-server
	     * It need to using for get_user_info and logout classes
	     *
	     * @var string $response_refresh_token
	     */
	    private $response_refresh_token;
	    
            /**
	     * @var string $request_access_token     access token for each request
	     */
            private $request_protection_access_token;
	
	    /**
	     * Constructor
	     *
	     * @return	void
	     */
	    public function __construct($config = null)
	    {
                if(is_array($config)){
                    Client_Socket_OXD_RP::setUrl(substr($config["host"], -1) !== '/'?$config["host"]."/".$config["get_access_token_by_refresh_token"]:$config["host"].$config["get_access_token_by_refresh_token"]);
                }
	        parent::__construct(); // TODO: Change the autogenerated stub
	    }
            
            function getRequest_protection_access_token() {
                return $this->request_protection_access_token;
            }

            function setRequest_protection_access_token($request_protection_access_token) {
                $this->request_protection_access_token = $request_protection_access_token;
            }
            
            /**
	     * @return string
	     */
	    public function getRequestRefreshToken()
	    {
	        return $this->request_refresh_token;
	    }
	
	    /**
	     * @param string $request_scopes
	     * @return	void
	     */
	    public function setRequestRefreshToken($request_refresh_token)
	    {
	        $this->request_refresh_token = $request_refresh_token;
	    }
            
	    /**
	     * @return string
	     */
	    public function getRequestScopes()
	    {
	        return $this->request_scopes;
	    }
	
	    /**
	     * @param string $request_scopes
	     * @return	void
	     */
	    public function setRequestScopes($request_scopes)
	    {
	        $this->request_scopes = $request_scopes;
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
	     * @return	void
	     */
	    public function setRequestOxdId($request_oxd_id)
	    {
	        $this->request_oxd_id = $request_oxd_id;
	    }
	
	    /**
	     * @return string
	     */
	    public function getResponseAccessToken()
	    {
	        $this->response_access_token = $this->getResponseData()->access_token;
	        return $this->response_access_token;
	    }
	
	    /**
	     * @return string
	     */
	    public function getResponseExpiresIn()
	    {
	        $this->response_expires_in = $this->getResponseData()->expires_in;
	        return $this->response_expires_in;
	    }
            
            /**
	     * @return string
	     */
	    public function getResponseRefreshToken()
	    {
	        $this->response_refresh_token = $this->getResponseData()->refresh_token;
	        return $this->response_refresh_token;
	    }
	
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'get_access_token_by_refresh_token';
	    }
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "oxd_id" => $this->getRequestOxdId(),
	            "refresh_token" => $this->getRequestRefreshToken(),
	            "scope" => $this->getRequestScopes(),
	            "protection_access_token"=> $this->getRequest_protection_access_token()
	        );
	    }
	
	}
