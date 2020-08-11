<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Model_disposal extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid_1, date, company, ST_AsText(Shape)')->from('postgres.disposal_all')
           ->order_by('date')
           ->get();

        // $query = "SHOW TABLES FROM `database_balangan`";

           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.disposal_all', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid_1)
        {
            $query = $this->db->where('objectid_1', $objectid_1)->get('postgres.disposal_astext');

            if ($query){
                return $query->row();
            } else {
                return false;
            }
        }

        public function update($data, $id)
        {
            // $query = $this->db->update('postgres.pit_all', $data, $id);
            // var_dump($data);

            echo $data['date'];

            $query = $this->db->query('UPDATE "postgres"."disposal_all" SET "date" = \''.$data['date'].'\', "company" = \''.$data['company'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid_1" = \''.$id['objectid_1'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid_1)
        {
            $query = $this->db->query("DELETE FROM postgres.disposal_all where objectid_1 = ".$objectid_1);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.disposal_all (date, company, shape) values ('".$data['date']."','". $data['company']."',ST_GeometryFromText('". $data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
