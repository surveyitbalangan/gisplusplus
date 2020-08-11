<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Fasilitas_penunjang_model extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid, date, company, ST_AsText(Shape), land_use')->from('postgres.fasilitas_penunjang')
           ->order_by('date')
           ->get();

           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.fasilitas_penunjang', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid)
        {
            $query = $this->db->select('objectid, date, company, ST_AsText(Shape), land_use')->from('postgres.fasilitas_penunjang')
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
            echo $data['date'];

            $query = $this->db->query('UPDATE "postgres"."fasilitas_penunjang" SET "date" = \''.$data['date'].'\', "company" = \''.$data['company'].'\', "land_use" = \''.$data['land_use'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid" = \''.$id['objectid'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid)
        {
            $query = $this->db->query("DELETE FROM postgres.fasilitas_penunjang where objectid = ".$objectid);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.fasilitas_penunjang (date, land_use, company, shape) values ('".$data['date']."','". $data['land_use']."','". $data['company']."',ST_GeometryFromText('". $data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
