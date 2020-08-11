<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Catchmentpit_model extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid_1, date, luas, ST_AsText(Shape)')->from('postgres.catchment_pit')
           ->order_by('date')
           ->get();

        // $query = "SHOW TABLES FROM `database_balangan`";

           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.catchment_pit', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid_1)
        {
            $query = $this->db->select('objectid_1, date, luas, ST_AsText(Shape)')->from('postgres.catchment_pit')
            ->order_by('date')
            ->get();
            
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

            $query = $this->db->query('UPDATE "postgres"."catchment_pit" SET "date" = \''.$data['date'].'\', "luas" = \''.$data['luas'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid_1" = \''.$id['objectid_1'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid_1)
        {
            $query = $this->db->query("DELETE FROM postgres.catchment_pit where objectid_1 = ".$objectid_1);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.catchment_pit (date, luas, shape) values ('".$data['date']."','". $data['luas']."',ST_GeometryFromText('". $data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
