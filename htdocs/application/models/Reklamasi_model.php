<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Reklamasi_model extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid, date, area, luas, company, jenis, ST_AsText(Shape)')->from('postgres.reklamasi_all')
           ->order_by('company')->order_by('date')
           ->get();

        // $query = "SHOW TABLES FROM `database_balangan`";
 
           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.reklamasi_all', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid)
        {
            $query = $this->db->select('objectid, date, company, ST_AsText(Shape), area, luas')->from('postgres.reklamasi_all')
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
            // $query = $this->db->update('postgres.reklamasi_all', $data, $id);
            // var_dump($data);

            echo $data['date'];

            $query = $this->db->query('UPDATE "postgres"."reklamasi_all" SET "date" = \''.$data['date'].'\', "company" = \''.$data['company'].'\', "area" = \''.$data['area'].'\', "luas" = \''.$data['luas'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid" = \''.$id['objectid'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid)
        {
            $query = $this->db->query("DELETE FROM postgres.reklamasi_all where objectid = ".$objectid);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.reklamasi_all (date, company, shape) values ('".$data['date']."','". $data['company']."',ST_GeometryFromText('". $data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
