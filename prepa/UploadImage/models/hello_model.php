<?php
class Hello_Model extends Model
{
public function __construct()
{
parent::__construct();
}
public function file_details($data)
{
$this->db->insert('image_table', $data);
}
}
?>