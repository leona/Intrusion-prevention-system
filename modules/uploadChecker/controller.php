<?php
namespace IPS\modules\uploadChecker;
use IPS\core\classes\BaseModule;

class Controller extends BaseModule {
    
    private $finfo;
    
    public function startModule() {
        if (empty($_FILES)) return false;
        $this->finfo = finfo_open(FILEINFO_MIME_TYPE);
        
        foreach($_FILES as $value) {
            if (in_array(finfo_file($this->finfo, $value['tmp_name']), $this->moduleOption('blacklisted_filetypes')))
                $this->badRequest();
            
            if (in_array(pathinfo($value['name'])['extension'], $this->moduleOption('blacklisted_filenames')))
                $this->badRequest();
        }
    }
}