<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Settling_pond_model extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid, date, area, luas, company, settling_p, ST_AsText(Shape)')->from('postgres.settling_pond_all')
           ->order_by('company')->order_by('date')
           ->get();

        // $query = "SHOW TABLES FROM `database_balangan`";
 
           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.settling_pond_all', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid)
        {
            $query = $this->db->select('objectid, date, area, luas, company, settling_p, ST_AsText(Shape)')->from('postgres.settling_pond_all')
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
            // $query = $this->db->update('postgres.settling_pond_all', $data, $id);
            // var_dump($data);

            echo $data['date'];

            $query = $this->db->query('UPDATE "postgres"."settling_pond_all" SET "date" = \''.$data['date'].'\', "company" = \''.$data['company'].'\', "area" = \''.$data['area'].'\', "luas" = \''.$data['luas'].'\', "settling_p" = \''.$data['settling_p'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid" = \''.$id['objectid'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid)
        {
            $query = $this->db->query("DELETE FROM postgres.settling_pond_all where objectid = ".$objectid);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.settling_pond_all (date, company, area, luas, settling_p, shape) values ('".$data['date']."','".$data['company']."','".$data['area']."','".$data['luas']."','".$data['settling_p']."','".$data['company']."', ST_GeometryFromText('".$data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
