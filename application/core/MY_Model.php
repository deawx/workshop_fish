<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

  public $table_name = '';
  public $primary_key = 'id';
  public $order_by = 'id DESC';
  public $rules = array();

  function search($conditions=NULL,$limit=NULL,$offset=NULL,$order_by=NULL)
  {
    if ($conditions != NULL) :
      if (is_array($conditions)) :
        foreach ($conditions as $key => $value) :
          $this->db->where($key,$value);
        endforeach;
        else :
          $this->db->where($conditions);
        endif;
      endif;

      if ($limit != NULL)
      $this->db->limit($limit);

      if ($offset != NULL)
      $this->db->offset($offset);

      if ($order_by !== NULL) :
        if (is_array($order_by)) :
          foreach ($order_by as $key => $value) :
            $this->db->order_by($key,$value);
          endforeach;
        else:
          $this->db->order_by($order_by);
        endif;
      else:
        $this->db->order_by($this->order_by);
      endif;

      return $this->db->get($this->table_name);
    }

    function search_id($id = NULL)
    {
      $id = intval($id);
      if ($id !== NULL)
        $this->db->where($this->primary_key, $id);

      $this->db->order_by($this->order_by);
      return $this->db->get($this->table_name);
    }

    function save($data)
    {
      $op = 'update';
      $keyExists = FALSE;
      $fields = $this->db->field_data($this->table_name);

      foreach ($fields as $field) :
        if ($field->primary_key==1) :
          $keyExists = TRUE;
          if (isset($data[$field->name])) :
            $this->db->where($field->name, $data[$field->name]);
          else :
            $op = 'insert';
          endif;
        endif;
      endforeach;

      $this->db->set($data);
      if ($keyExists && $op=='update') :
        $this->db->update($this->table_name);
      else:
        $this->db->insert($this->table_name);
      endif;

      return $this->db->affected_rows();
    }

    function remove($id)
    {
      $id = intval($id);
      if ($id !== NULL)
        return FALSE;

      $this->db->where($this->primary_key,$id);
      $this->db->delete($this->table_name);

      return $this->db->affected_rows();
    }

  }
