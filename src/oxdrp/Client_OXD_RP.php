<?php
/**
 * Gluu-oxd-library
 *
 * An open source application library for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2015-2016, Gluu inc, USA, Austin
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
 * @package	Gluu-oxd-library
 * @version 2.4.4
 * @author	Vlad Karapetyan
 * @author		vlad.karapetyan.1988@mail.ru
 * @copyright	Copyright (c) 2015-2016, Gluu inc federation (https://gluu.org/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://gluu.org/
 * @since	Version 2.4.4
 * @filesource
 */

/**
 * Client oxd RP class
 *
 * Class is basic, which is connecting to oxd-server via socket
 *
 * @package		Gluu-oxd-library
 * @subpackage	Libraries
 * @category	Base class for all protocols
 * @author		Vlad Karapetyan
 * @author		vlad.karapetyan.1988@mail.ru
 * @see	        Client_Socket_OXD_RP
 * @see	        Oxd_RP_config
 */

namespace oxdrp;
use oxdrp\Client_Socket_OXD_RP;

abstract class Client_OXD_RP extends Client_Socket_OXD_RP{

    /**
     * @var array $command_types        Protocols commands name
     */
    private $command_types = array( 'get_authorization_url',
                                    'update_site_registration',
                                    'get_tokens_by_code',
                                    'get_user_info',
                                    'register_site',
                                    'get_logout_uri',
                                    'get_authorization_code',
                                    'uma_rs_protect',
                                    'uma_rs_check_access',
                                    'uma_rp_get_rpt',
                                    'uma_rp_authorize_rpt',
                                    'uma_rp_get_gat',
    );    /**
     * @var string $command             Extend class protocol command name, for sending oxd-server
     */
    protected $command;
    /**
     * @var string $params              Extends class sending parameters to oxd-server
     */
    protected $params = array();
    /**
     * @var string $data                Response data from oxd-server
     */
    protected $data = array();
    /**
     * @var string $response_json       Response data from oxd-server in format json
     */
    protected $response_json;
    /**
     * @var object $response_object     Response data from oxd-server in format object
     */
    protected $response_object;
    /**
     * @var string $response_status     Response status from oxd-server
     */
    protected $response_status;
    /**
     * @var array $response_data        Response data from oxd-server in format array
     */
    protected $response_data = array();


    /**
     * Constructor
     *
     * @return	void
     */
    public function __construct()
    {

        parent::__construct(); // TODO: Change the autogenerated stub
        $this->setCommand();
        $exist = false;
        for ($i = 0; $i < count($this->command_types); $i++) {

            if ($this->command_types[$i] == $this->getCommand()) {
                $exist = true;
                break;
            }
        }
        if (!$exist) {
            $this->log('Command: ' . $this->getCommand() . ' is not exist!','Exiting process.');
            $this->error_message('Command: ' . $this->getCommand() . ' is not exist!');
        }
    }

    /**
     * send function sends the command to the oxD server.
     *
     * Args:
     * command (dict) - Dict representation of the JSON command string
     * @return	void
     **/
    public function request()
    {
        $this->setParams();

        $jsondata = json_encode($this->getData(), JSON_UNESCAPED_SLASHES);

        if(!$this->is_JSON($jsondata)){
            $this->log("Sending parameters must be JSON.",'Exiting process.');
            $this->error_message('Sending parameters must be JSON.');
        }
        $lenght = strlen($jsondata);
        if($lenght<=0){
            $this->log("Length must be more than zero.",'Exiting process.');
            $this->error_message("Length must be more than zero.");
        }else{
            $lenght = $lenght <= 999 ? "0" . $lenght : $lenght;
        }

        $this->response_json = $this->oxd_socket_request(utf8_encode($lenght . $jsondata));

        $this->response_json = str_replace(substr($this->response_json, 0, 4), "", $this->response_json);
        if ($this->response_json) {
            $object = json_decode($this->response_json);
            if ($object->status == 'error') {
                $this->error_message($object->data->error . ' : ' . $object->data->error_description);
            } elseif ($object->status == 'ok') {
                $this->response_object = json_decode($this->response_json);
            }
        } else {
            $this->log("Response is empty...",'Exiting process.');
            $this->error_message('Response is empty...');
        }
    }

    /**
     * Response status
     *
     * @return string, OK on success, error on failure
     */
    public function getResponseStatus()
    {
        return $this->response_status;
    }

    /**
     * Setting response status
     *
     * @return	void
     */
    public function setResponseStatus()
    {
        $this->response_status = $this->getResponseObject()->status;
    }

    /**
     * If data is not empty it is returning response data from oxd-server in format array.
     * If data empty or error , you have problem with parameter or protocol.
     * @return array
     */
    public function getResponseData()
    {
        if (!$this->getResponseObject()) {
            $this->response_data = 'Data is empty';
            $this->error_message($this->response_data);
        } else {
            $this->response_data = $this->getResponseObject()->data;
        }
        return $this->response_data;
    }

    /**
     * Data which need to send oXD server.
     *
     * @return array
     */
    public function getData()
    {
        $this->data = array('command' => $this->getCommand(), 'params' => $this->getParams());
        return $this->data;
    }

    /**
     * Protocol name for request.
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Setting protocol name for request.
     *
     * @return void
     */
    abstract function setCommand();

    /**
     * If response data is not empty it is returning response data from oxd-server in format object.
     * If response data empty or error , you have problem with parameter or protocol.
     *
     * @return object
     */
    public function getResponseObject()
    {
        return $this->response_object;
    }

    /**
     * If response data is not empty it is returning response data from oxd-server in format json.
     * If response data empty or error , you have problem with parameter or protocol.
     * @return string
     */
    public function getResponseJSON()
    {
        return $this->response_json;
    }

    /**
     * Setting parameters for request.
     *
     * @return void
     */
    abstract function setParams();

    /**
     * Parameters for request.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Checking format string.
     *
     * @param  string  $string
     * @return bool
     **/
    public function is_JSON($string){
        return is_string($string) && is_object(json_decode($string)) ? true : false;
    }

}