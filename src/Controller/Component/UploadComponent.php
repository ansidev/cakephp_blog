<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;

class UploadComponent extends Component
{
    public $allowedImageTypes = ['image/jpg', 'image/jpeg', 'image/x-icon', 'image/png', 'image/bmp', 'image/x-windows-bmp', 'image/gif'];
    public $uploadDir = 'upload';
    public $uploadDetected = false;
    private $uploadedFile = false;
    private $data = [], $params = [];
    public $finalFile = null;
    public $fileVar = 'file';

    public function initialize(Event $event)
    {
        $this->data = $event->subject->request->data;
        $this->params = $event->subject->request->params;
    }

    public function startup(Event $event)
    {
        $this->uploadDetected =
            ($this->_multiArrayKeyExists("tmp_name", $this->data) || $this->_multiArrayKeyExists("tmp_name", $this->data));
        $this->uploadedFile = $this->_uploadedFileArray();
        if ($this->_checkFile() && $this->_checkType()) {
            $this->_processFile();
        }
    }

    public function removeFile($name = null)
    {
        if (!$name) return false;

        $up_dir = WWW_ROOT . $this->uploadDir;
        $target_path = $up_dir . DS . $name;
        if (unlink($target_path)) return true;
        else return false;
    }

    public function showErrors($sep = "<br />")
    {
        $retval = "";
        foreach ($this->errors as $error) {
            $retval .= "$error $sep";
        }
        return $retval;
    }

    public function _processFile()
    {
        $up_dir = WWW_ROOT . $this->uploadDir;
        $target_path = $up_dir . DS . $this->uploadedFile['name'];
        $temp_path = substr($target_path, 0, strlen($target_path) - strlen($this->_ext())); //temp path without the ext
        //make sure the file doesn't already exist, if it does, add an itteration to it
        $i = 1;
        while (file_exists($target_path)) {
            $target_path = $temp_path . "-" . $i . $this->_ext();
            $i++;
        }
        if (!file_exists($target_path))
            mkdir($up_dir);

        if (move_uploaded_file($this->uploadedFile['tmp_name'], $target_path)) {
            //Final File Name
            $this->finalFile = $this->uploadDir . '/webroot/img/uploads' . basename($target_path);
        } else {
            $this->_error('FileUpload::processFile() - Unable to save temp file to file system.');
        }
    }

    public function _error($text)
    {
        $message = __($text, true);
        $this->errors[] = $message;
        trigger_error($message, E_USER_WARNING);
    }

    public function _checkType()
    {
        foreach ($this->allowedImageTypes as $value) {
            if (strtolower($this->uploadedFile['type']) == strtolower($value)) {
                return true;
            }
        }
        $this->_error("FileUpload::_checkType() {$this->uploadedFile['type']} is not in the allowedTypes array.");
        return false;
    }

    public function _checkFile()
    {
        if ($this->uploadedFile && $this->uploadedFile['error'] == UPLOAD_ERR_OK) return true;
        else return false;
    }

    public function _ext()
    {
        return strrchr($this->uploadedFile['name'], ".");
    }

    public function _uploadedFileArray()
    {
        $retval = isset($this->data[$this->fileVar]) ? $this->data[$this->fileVar] : false;
        if ($this->uploadDetected && $retval === false) {
            $this->_error("FileUpload: A file was detected, but was unable to be processed due to a misconfiguration of FileUpload. Current config -- fileModel:'{$this->fileModel}' fileVar:'{$this->fileVar}'");
        }
        return $retval;
    }

    public function _multiArrayKeyExists($needle, $haystack)
    {
        if (is_array($haystack)) {
            foreach ($haystack as $key => $value) {
                if ($needle == $key) {
                    return true;
                }
                if (is_array($value)) {
                    if ($this->_multiArrayKeyExists($needle, $value)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
}






