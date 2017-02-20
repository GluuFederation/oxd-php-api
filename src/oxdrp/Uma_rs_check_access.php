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
	 * @link      Documentation      : <https://oxd.gluu.org/docs/libraries/php/>
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
	 * UMA RS Check Access class
	 *
	 * Class is connecting to oxd-server via socket, and getting access grant response from gluu-server.
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
	
	class Uma_rs_check_access extends Client_OXD_RP{
	
	    /**
	     * @var string $request_oxd_id                         This parameter you must get after registration site in gluu-server
	     */
	    private $request_oxd_id = null;
	    /**
	     * @var string $request_rpt                            This parameter you must get after using uma_rp_get_rpt protocol
	     */
	    private $request_rpt = null;
	    /**
	     * @var string $request_path                           Path of resource (e.g. http://rs.com/phones), /phones should be passed
	     */
	    private $request_path = null;
	    /**
	     * @var string $request_http_method                    Http method of RP request (GET, POST, PUT, DELETE)
	     */
	    private $request_http_method = null;
	
	    /**
	     * Response parameter from oxd-server
	     * Access grant response (granted or denied)
	     *
	     * @var string $response_access
	     */
	    private $response_access;
	
	    /**
	     * Response parameter from oxd-server
	     * Tiket number
	     *
	     * @var string $response_ticket
	     */
	    private $response_ticket;
	
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
	     * @return string
	     */
	    public function getResponseTicket()
	    {
	        $this->response_ticket = $this->getResponseData()->ticket;
	        return $this->response_ticket;
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
	     * @return string
	     */
	    public function getRequestRpt()
	    {
	        return $this->request_rpt;
	    }
	
	    /**
	     * @param string $request_rpt
	     * @return void
	     */
	    public function setRequestRpt($request_rpt)
	    {
	        $this->request_rpt = $request_rpt;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestPath()
	    {
	        return $this->request_path;
	    }
	
	    /**
	     * @param null $request_path
	     * @return void
	     */
	    public function setRequestPath($request_path)
	    {
	        $this->request_path = $request_path;
	    }
	
	    /**
	     * @return string
	     */
	    public function getRequestHttpMethod()
	    {
	        return $this->request_http_method;
	    }
	
	    /**
	     * @param string $request_http_method
	     * @return void
	     */
	    public function setRequestHttpMethod($request_http_method)
	    {
	        $this->request_http_method = $request_http_method;
	    }
	
	    /**
	     * @return string
	     */
	    public function getResponseAccess()
	    {
	        $this->response_access = $this->getResponseData()->access;
	        return $this->response_access;
	    }
	
	    /**
	     * Protocol command to oxd server
	     * @return void
	     */
	    public function setCommand()
	    {
	        $this->command = 'uma_rs_check_access';
	    }
	
	    /**
	     * Protocol parameter to oxd server
	     * @return void
	     */
	    public function setParams()
	    {
	        $this->params = array(
	            "oxd_id" => $this->getRequestOxdId(),
	            "rpt" => $this->getRequestRpt(),
	            "path" => $this->getRequestPath(),
	            "http_method" => $this->getRequestHttpMethod()
	        );
	    }
	
	}