<?php
    class Datalist_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
        
        public $sql_query = "SELECT t.table_schema, t.table_name
                                from information_schema.tables t
                                inner join information_schema.columns c on c.table_name = t.table_name and c.table_schema = t.table_schema
                            where c.column_name = 'date' 
                                t.table_schema not in ('information_schema', 'pg_catalog')
                                and t.table_type = 'BASE TABLE'
                            order by t.table_schema;";
        
        
        
        public function get_table_list($slug = FALSE)
        {
            if ($slug == FALSE) {
                $query = $this->db->query($this->sql_query);
                
                return $query->result_array();
            }

            $query = $query = $this->db->query($this->sql_query);
            return $query->row_array();
        }
    }