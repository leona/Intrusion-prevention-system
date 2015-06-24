<?php
namespace IPS\modules\uploadChecker;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {
    
    private $finfo;
    
    public function __construct() {
        if (empty($_FILES)) 
            return false;
            
        parent::__construct();
        
        $this->finfo = finfo_open(FILEINFO_MIME_TYPE);
    }
    
    public function startModule() {
        foreach($_FILES as $value) {
            if (in_array(finfo_file($this->finfo, $value['tmp_name']), $this->moduleOption('blacklisted_filetypes')))
                $this->badRequest(2);
            
            if (in_array(pathinfo($value['name'])['extension'], $this->moduleOption('blacklisted_filenames')))
                $this->badRequest(2);
        }
    }
}