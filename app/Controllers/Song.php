<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\SongModel;

class Song extends ResourceController
{
    protected $modelName = 'App\Models\SongModel';
    protected $format = 'json';

    private $limit = 20;

    public function __construct()
    {
        $this->model = new SongModel();
        $this->validation = \Config\Services::validation();
    }

    private function getOffset($page)
    {

        $offset =  ($page - 1)  * $this->limit;
        return $offset;
    }

    private function getPageCount($countData)
    {
        $pageCount = ceil($countData / $this->limit);
        return $pageCount;
    }

    public function getAllSongs($page = 1)
    {
        $songs = $this->model->findAll($this->limit, $this->getOffset($page));
        $countData = $this->model->countAll();
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);

        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'songs' => $songs,
        ];

        return $this->respond($data);
    }

    public function getSongByAlphabet($alphabet, $page = 1)
    {
        $songs = $this->model->like("judul", $alphabet, 'after')->findAll($this->limit, $this->getOffset($page));
        $countData = $this->model->like("judul", $alphabet, 'after')->countAllResults();
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);

        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'songs' => $songs,
        ];

        return $this->respond($data);
    }

    public function getSongByArtist($artist, $page = 1)
    {
        $songs = $this->model->where("penyanyi", $artist)->findAll($this->limit, $this->getOffset($page));
        $countData = $this->model->where("penyanyi", $artist)->countAllResults();
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);

        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'songs' => $songs,
        ];

        return $this->respond($data);
    }

    public function getAllArtist($page = 1)
    {
        $artists = $this->model->getAllArtist($this->limit, $this->getOffset($page));
        $countData = $this->model->countArtist();
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);
        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'artist' => $artists,
        ];


        return $this->respond($data);
    }

    public function getArtistByAlphabet($alphabet, $page = 1)
    {
        $artists = $this->model->getArtistByAlphabet($alphabet, $this->limit, $this->getOffset($page));
        $countData = $this->model->countArtistByAlphabet($alphabet);
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);
        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'artist' => $artists,
        ];


        return $this->respond($data);
    }

    public function getSongById($id)
    {
        $song = $this->model->find($id);

        return $this->respond($song);
    }

    public function search($keyword, $page = 1)
    {
        $result = $this->model->search($keyword, $this->limit, $this->getOffset($page));
        $countData = $this->model->countResultBySearch($keyword);
        $page = (int)$page;
        $pageCount = $this->getPageCount($countData);
        $data = [
            'page' => $page,
            'perpage' => $this->limit,
            'pagecount' => $pageCount,
            'count' => $countData,
            'result' => $result,
        ];
        return $this->respond($data);
    }

    public function create()
    {

        $judul = $this->request->getPost('judul');
        $penyanyi = $this->request->getPost('penyanyi');
        $link = $this->request->getPost('link');
        $lirik = $this->request->getPost('lirik');


        $data = [
            'judul' =>  $judul,
            'penyanyi' => $penyanyi,
            'link' => $link,
            'lirik' => $lirik,
        ];

        $validate = $this->validation->run($data, 'validationSong');
        $errors = $this->validation->getErrors();

        if ($errors) {
            return $this->fail($errors);
        }

        $created =  $this->model->create($data);
        if ($created === true) {
            $response = [
                'status' => 201,
                'error'  => null,
                'message' => 'Data Successfully inserted'
            ];
        } else {
            $response = [
                'status' => 401,
                'message' => 'cannot add data'
            ];
        }

        return $this->respond($response, 201);
    }

    public function update($id = null)
    {
        $model = new SongModel();
        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'judul' =>  $json->judul,
                'penyanyi' => $json->penyanyi,
                'link' => $json->link,
                'lirik' => $json->lirik,
            ];
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'judul' =>  $input['judul'],
                'penyanyi' => $input['penyanyi'],
                'link' => $input['link'],
                'lirik' => $input['lirik'],
            ];
        }
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new SongModel();
        $data = $model->find($id);

        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('cannot find id' . $id);
        }
    }
}
