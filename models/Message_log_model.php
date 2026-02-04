<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Message_log_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add message log entry
     * @param array $data
     * @return int Insert ID
     */
    public function add($data)
    {
        $this->db->trans_start();
        
        $this->db->insert('message_logs', $data);
        $id = $this->db->insert_id();
        
        $message = INSERT_RECORD_CONSTANT . " On message log id " . $id;
        $action = "Insert";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }
        
        return $id;
    }

    /**
     * Get message logs
     * @param int $id Optional ID
     * @return array
     */
    public function get($id = null)
    {
        $this->db->select()->from('message_logs');
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('created_at', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * Get logs by message ID
     * @param int $message_id
     * @return array
     */
    public function getByMessageId($message_id)
    {
        $this->db->select()->from('message_logs');
        $this->db->where('message_id', $message_id);
        $this->db->order_by('created_at', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Update message log
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->update('message_logs', $data);
        
        $message = UPDATE_RECORD_CONSTANT . " On message log id " . $id;
        $action = "Update";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }
        
        return true;
    }

    /**
     * Delete message log
     * @param int $id
     * @return bool
     */
    public function remove($id)
    {
        $this->db->trans_start();
        
        $this->db->where('id', $id);
        $this->db->delete('message_logs');
        
        $message = DELETE_RECORD_CONSTANT . " On message log id " . $id;
        $action = "Delete";
        $record_id = $id;
        $this->log($message, $record_id, $action);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }
        
        return true;
    }
}
