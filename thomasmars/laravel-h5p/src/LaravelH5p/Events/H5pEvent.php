<?php

/*
 *
 * @Project        Expression project.displayName is undefined on line 5, column 35 in Templates/Licenses/license-default.txt.
 * @Copyright      leechanrin
 * @Created        2017-04-05 오후 4:55:07 
 * @Filename       H5PEvent.php
 * @Description    
 *
 */

namespace thomasmars\LaravelH5p\Events;

use thomasmars\LaravelH5p\Eloquents\H5pEventLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\SerializesModels;
use H5PEventBase;

//use Illuminate\Contracts\Events;

class H5pEvent extends H5PEventBase {

    private $user;

    /**
     * Adds event type, h5p library and timestamp to event before saving it.
     *
     * @param string $type
     *  Name of event to log
     * @param string $library
     *  Name of H5P library affacted
     */
    function __construct($type, $sub_type = NULL, $content_id = NULL, $content_title = NULL, $library_name = NULL, $library_version = NULL) {
        $this->user = Auth::id();
        parent::__construct($type, $sub_type, $content_id, $content_title, $library_name, $library_version);
    }

    /**
     * Store the event.
     */
    protected function save() {

        // Get data in array format without NULL values
        $data = $this->getDataArray();
        $data['user_id'] = Auth::id();

        // Insert into DB
        return H5pEventLog::create($data);
    }

    /**
     * Count number of events.
     */
    protected function saveStats() {

        return true;

//        $type = $this->type . ' ' . $this->sub_type;
//        $current_num = $wpdb->get_var($wpdb->prepare(
//                        "SELECT num
//           FROM h5p_counters
//          WHERE type = '%s'
//            AND library_name = '%s'
//            AND library_version = '%s'
//        ", $type, $this->library_name, $this->library_version));
//
//
//        if ($current_num === NULL) {
//            // Insert
//            $wpdb->insert("h5p_counters", array(
//                'type' => $type,
//                'library_name' => $this->library_name,
//                'library_version' => $this->library_version,
//                'num' => 1
//                    ), array('%s', '%s', '%s', '%d'));
//        } else {
//            // Update num+1
//            $wpdb->query($wpdb->prepare(
//                            "UPDATE h5p_counters
//              SET num = num + 1
//            WHERE type = '%s'
//              AND library_name = '%s'
//              AND library_version = '%s'
//      		", $type, $this->library_name, $this->library_version));
//        }
//        
    }

}
