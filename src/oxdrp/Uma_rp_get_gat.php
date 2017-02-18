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
	 * @version   3.0.0
	 *
	 * @author    Gluu Inc.          : <https://gluu.org>
	 * @link      Oxd site           : <https://oxd.gluu.org>
	 * @link      Documentation      : <https://oxd.gluu.org/docs/3.0.0/libraries/php/>
	 * @director  Mike Schwartz      : <mike@gluu.org>
	 * @support   Support page       : <support@gluu.org>
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
	 * UMA RP - Get GAT class
	 *
	 * Class is connecting to oxd-server via socket, and getting GAT from gluu-server.
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
	
	class Uma_rp_get_gat extends Client_OXD_RP{
	
	    /**
	     * @var string $request_oxd_id                            This parameter you must get after registration site in gluu-server
	     */
	    private $request_oxd_id = null;
	
	    /**
	     * @var array $request_scopes                            RP should know required scopes in advance
	     */
	    private $request_scopes = null;
	
	    /**
	     * Response parameter from oxd-server
	     * GAT stands for Gluu Access Token
	     *
	     * @var string $response_gat
	     */
	    private $response_gat;
	
	    /**
	     * Constructor
	     *
	     * @return	void
	     */
	    public function __construct()
	    {
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
	    public function getRequestScopes()
	    {
	        return $this->request_scopes;
	    }
	
	    /**
	     * @param array $request_scopes
	     * @return void
	     */
	    public function setRequestScopes(array $request_scopes)
	    {
	        $this->request_scopes = $request_scopes;
	    }
	
	    /**
	     * @return string
	     */
	    public function getResponseGat()
	    {
	        return $this->response_gat;
	    }
	
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'uma_rp_get_gat';
	    }
	
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "oxd_id" => $this->getRequestOxdId(),
	            "scopes" => $this->getRequestScopes()
	
	        );
	    }
	
	}