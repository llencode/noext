<?php

require APPPATH . '/libraries/REST_Controller.php';
Class Noext Extends REST_Controller{
    
    function __construct($config = 'rest') {
        parent::__construct($config);
    }
    
    // untuk menampilkan data
    function index_get(){
        $data = $this->db->get('kontak')->result();
        return $this->response($data,200);
        $this->load->model('m_data');
    }
    
    // untuk mengirim data
    function index_post(){
        $id           = $this->post('id');
        $noext          = $this->post('noext');
        $ruang    = $this->post('ruang');
        
        $kontak = array (
                    'id'         =>  $id,
                    'noext'          =>  $noext,
                    'ruang'   =>  $ruang);

        $insert = $this->db->insert('kontak',$kontak);
        
        if($insert){
            $this->response($kontak,200);
        }else{
            $data = array ('status'=>'gagal insert');
            $this->response($data,502);
        }
    }
    
    function index_put(){
        // parameter yang dikirimkan oleh client
        $id           = $this->put('id');
        $noext          = $this->put('noext');
        $ruang    = $this->put('ruang');
        // menyimpan data dalam bentuk array
        $kontak           = array(
                            'id'         =>  $id,
                            'noext'        =>  $noext,
                            'ruang'   =>  $ruang);
        // update berdasarkan sibn sebagai parameter
        $this->db->where('id',$id);
        $update = $this->db->update('kontak',$kontak); 
        // chek apakah update nya berhasil atau gagal
        if($update){
            $this->response($kontak,200);
        }else{
            $data = array ('status'=>'gagal insert');
            $this->response($data,502);
        }
    }
    
    function index_delete(){
        $id= $this->delete('id');
        $kontak = $this->db->get_where('kontak',array('id'=>$id));
        if($kontak->num_rows()>0){
            // delete data
            $this->db->where('id',$id);
            $this->db->delete('kontak');
            $data = array('status'=>'Berhasil Delete  : '.$id);
            $this->response($data,200);
        }else{
            $data = $data = array('status'=>' '.$id.' Tidak Ditemukan');
            $this->response($data,200);
        }
    }
}
?>
