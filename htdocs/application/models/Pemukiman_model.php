<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    class Pemukiman_model extends CI_Model {

       public function get_all(){
           $query = $this->db->select('objectid, name, area, ST_AsText(Shape)')->from('postgres.pemukiman')
           ->order_by('name')
           ->get();

        // $query = "SHOW TABLES FROM `database_balangan`";

           return $query->result();
       }

       public function simpan($data)
       {
           $query = $this->db->insert('postgres.pemukiman', $data);

            if ($query){
                return true;
            }else{
                return false;        
            }
        }

        public function edit($objectid)
        {
            $query = $this->db->select('objectid, name, area, ST_AsText(Shape)')->from('postgres.pemukiman')
            ->where('objectid', $objectid)->get();

            if ($query){
                return $query->row();
            } else {
                return false;
            }
        }

        public function update($data, $id)
        {
            var_dump($data);
            echo("<br>");
            var_dump($id);
            
            // var_dump($id);

            $query = $this->db->query('UPDATE "postgres"."pemukiman" SET "name" = \''.$data['name'].'\', "area" = \''.$data['area'].'\', shape = st_geometryfromtext(\''.$data['shape'].'\',4326) where "objectid" = \''.$id['objectid'].'\'');

            if ($query){
                return true;
            } else {
                return false;
            }
        }

        public function hapus($objectid)
        {
            $query = $this->db->query("DELETE FROM postgres.pemukiman where objectid = ".$objectid);

            if($query){
                return true;
            }else{
                return false;
            }

        }

        public function insert($data)
        {
            $query = $this->db->query("INSERT INTO postgres.pemukiman (name, area, shape) values ('".$data['name']."','". $data['area']."',ST_GeometryFromText('". $data['shape']."',4326))");

            if ($query) {
                return true;
            } else {
                return false;
            }
        }

    }
