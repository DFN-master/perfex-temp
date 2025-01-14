<?php if(count(get_included_files()) == 1) exit("No direct script access allowed");

class ReportBuilderLic{

    private $current_version;

    public function __construct(){ 
        $this->current_version = 'v1.0.0';
    }

    /**
     * get current version
     * @return string
     */
    public function get_current_version(){
        return $this->current_version;
    }

    /**
     * verify license (simplified to always return true)
     * @param  boolean $time_based_check
     * @param  boolean $license  
     * @param  boolean $client   
     * @return array
     */
    public function verify_license($time_based_check = false, $license = false, $client = false){
        return array('status' => TRUE, 'message' => 'Verified! Thanks for using our product.');
    }

    /**
     * deactivate license (simplified with no operation)
     * @param  boolean $license 
     * @param  boolean $client  
     * @return json
     */
    public function deactivate_license($license = false, $client = false){
        return array('status' => TRUE, 'message' => 'Deactivation is not necessary.');
    }

    /**
     * check_update (returns a placeholder response)
     * @return json
     */
    public function check_update(){
        return array('status' => TRUE, 'message' => 'You are using the latest version.');
    }

    /**
     * download_update (simplified with no actual download)
     * @param  [type]  $update_id 
     * @param  [type]  $type         
     * @param  [type]  $version      
     * @param  boolean $license      
     * @param  boolean $client       
     * @param  boolean $db_for_import
     * @return object               
     */
    public function download_update($update_id, $type, $version, $license = false, $client = false, $db_for_import = false){ 
        return array('status' => TRUE, 'message' => 'No updates available.');
    }
}
