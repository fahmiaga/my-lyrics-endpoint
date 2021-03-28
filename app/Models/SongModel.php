<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class SongModel extends Model
{
    protected $table = 'lagu';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 'penyanyi', 'link', 'lirik'
    ];
    protected $returnType = 'App\Entities\Song';
    protected $useTimesstamps = true;

    public function getAllArtist($limit, $offset)
    {
        $builder = $this->builder();
        $builder->select('penyanyi');
        $builder->distinct();
        $builder->orderBy('penyanyi', 'ASC');
        $builder->limit($limit, $offset);
        $data = $builder->get();
        if ($data) {
            return $data->getResult();
        } else {
            return false;
        }
    }

    public function countArtist()
    {
        $builder = $this->builder();
        $builder->select('penyanyi');
        $builder->distinct();
        $count = $builder->countAllResults();
        if ($count) {
            return $count;
        }
    }

    public function getArtistByAlphabet($alphabet, $limit, $offset)
    {
        $builder = $this->builder();
        $builder->select('penyanyi');
        $builder->like('penyanyi', $alphabet, 'after');
        $builder->distinct();
        $builder->orderBy('penyanyi', 'ASC');
        $builder->limit($limit, $offset);
        $data = $builder->get();
        if ($data) {
            return $data->getResult();
        } else {
            return false;
        }
    }

    public function countArtistByAlphabet($alphabet)
    {
        $builder = $this->builder();
        $builder->select('penyanyi');
        $builder->like('penyanyi', $alphabet, 'after');
        $builder->distinct();
        $count = $builder->countAllResults();
        if ($count) {
            return $count;
        } else {
            return false;
        }
    }
    public function search($keyword, $limit, $offset)
    {
        $builder = $this->builder();
        $builder->select('*');
        $builder->like('penyanyi', $keyword, 'both')->orLike('judul', $keyword, 'both');
        $builder->distinct();
        $builder->orderBy('penyanyi', 'ASC');
        $builder->limit($limit, $offset);
        $data = $builder->get();
        if ($data) {
            return $data->getResult();
        } else {
            return false;
        }
    }
    public function countResultBySearch($keyword)
    {
        $builder = $this->builder();
        $builder->select('*');
        $builder->like('penyanyi', $keyword, 'both')->orLike('judul', $keyword, 'both');
        $builder->distinct();
        $count = $builder->countAllResults();
        if ($count) {
            return $count;
        } else {
            return false;
        }
    }

    public function create($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query ? true : false;
    }
}
