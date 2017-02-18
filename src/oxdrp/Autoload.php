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
	 * Autoload class
	 *
	 * Class is auto-loading namespaces and classes.
	 *
	 * @package		Gluu-oxd-library
	 * @subpackage	Libraries
	 */

	namespace oxdrp;
	
	
	$treasure_data_loader = new Autoload(__DIR__, __NAMESPACE__);
	spl_autoload_register(array($treasure_data_loader, 'loadClass'));
	
	class Autoload
	{
	    protected $path;
	    protected $ns;
	    protected $ns_sep = '\\';
	    protected $suffix = '.php';
	
	    public function __construct($path, $ns)
	    {
	        $this->path = $path;
	        $this->ns = $ns;
	    }
	
	    public function loadClass($name)
	    {
	        if (strpos($name, $this->ns) !== 0) {
	            return ;
	        }
	
	        $classname = $name;
	        $filename = $this->path
	            . DIRECTORY_SEPARATOR
	            . str_replace(
	                $this->ns_sep,
	                DIRECTORY_SEPARATOR,
	                substr($classname, strpos($classname, $this->ns_sep) + 1))
	            . $this->suffix;
	
	        return $this->loadFile($filename);
	    }
	
	    public function loadFile($filename)
	    {
	        if (is_readable($filename)) {
	            return require_once $filename;
	        }
	        return false;
	    }
	}
