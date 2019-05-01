public function M_hitung()
{
   $this->db->select_sum('stok');
   $query = $this->db->get('kontak');
   if($query->num_rows()>0)
   {
     return $query->row()->stok;
   }
   else
   {
     return 0;
   }
}