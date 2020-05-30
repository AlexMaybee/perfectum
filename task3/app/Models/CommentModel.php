<?php

namespace App\Models;

class CommentModel extends \CodeIgniter\Model
{
    protected $table = 'comment';

    protected $allowedFields = ['user_name', 'email','comment'];

//    public function __construct()
//    {
//        parent::__construct();
//        $this->load->database();
//    }

    public function getAllComments($slug = false,$offset = 0)
    {
        if ($slug === false)
        {
//            return $this->findAll();
            return $this->orderBy('date_create', 'desc')
                    ->findAll();
        }

        return $this->asArray()
            ->where(['slug' => $slug])
            ->first();
    }

    public function saveComment($data)
    {
        return $this->insert([
            'user_name' => $data['name'],
            'email'  => $data['email'],
            'comment'  => $data['comment'],
        ]);
    }


    /*
     * переопределена от наследуемой
     * */
    public function reversePagination(int $perPage = null, string $group = 'default', int $page = 0, int $segment = 0)
    {

        $pager = \Config\Services::pager(null, null, false);
        $page  = $page >= 1 ? $page : $pager->getCurrentPage($group);

        $total = $this->countAllResults(false);

        // Store it in the Pager library so it can be
        // paginated in the views.
        $this->pager = $pager->store($group, $page, $perPage, $total, $segment);
        $perPage     = $this->pager->getPerPage($group);
        $offset      = ($page - 1) * $perPage;

        return $this->orderBy('date_create', 'desc')->findAll($perPage, $offset);
    }


}