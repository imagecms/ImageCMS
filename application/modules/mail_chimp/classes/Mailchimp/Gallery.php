<?php

class Mailchimp_Gallery {
    public function __construct(Mailchimp $master) {
        $this->master = $master;
    }

    /**
     * Return a section of the image gallery
     * @param associative_array $opts
     *     - type string optional the gallery type to return - images or files - default to images
     *     - start int optional for large data sets, the page number to start at - defaults to 1st page of data  (page 0)
     *     - limit int optional for large data sets, the number of results to return - defaults to 25, upper limit set at 100
     *     - sort_by string optional field to sort by - one of size, time, name - defaults to time
     *     - sort_dir string optional field to sort by - one of asc, desc - defaults to desc
     *     - search_term string optional a term to search for in names
     * @return associative_array the matching gallery items
     *     - total int the total matching items
     *     - data array structs for each item included in the set, including:
     *         - name string the file name
     *         - time string the creation date for the item
     *         - size int the file size in bytes
     *         - full string the url to the actual item in the gallery
     *         - thumb string a url for a thumbnail that can be used to represent the item, generally an image thumbnail or an icon for a file type
     */
    public function getList($opts=array()) {
        $_params = array("opts" => $opts);
        return $this->master->call('gallery/list', $_params);
    }

}


