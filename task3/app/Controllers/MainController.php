<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 30.05.2020
 * Time: 15:05
 */

namespace App\Controllers;

use App\Models\CommentModel;

class MainController extends BaseController
{

    public function index()
    {
        helper(['form']);

        $session = session();

        $commentsModel = new CommentModel();

        $data['comments'] = $commentsModel->reversePagination(5,'chat');
        $data['pager'] = $commentsModel->pager;


        $data['old'] = $session->getFlashdata('formOld');
        $data['errors'] = $session->getFlashdata('formErrors');

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('myController/index', $data);
        echo view('template/footer', $data);

    }

    public function create()
    {
        $session = session();

        $falk = $this->validate([
            'email' => 'required|min_length[3]|valid_email',
            'comment'  => 'required|min_length[3]'
        ]);

        if($falk)
        {
            $commentsModel = new CommentModel();
            $saveRes = $commentsModel->saveComment($this->request->getPost());
            return redirect()->to('/');
        }
        else
        {
            $session->setFlashdata('formErrors', $this->validator->getErrors());
            $session->setFlashdata('formOld', $this->request->getPost());

            return redirect()->to('/');
        }
    }

    public function delete($id)
    {
        if($id)
        {
            $commentsModel = new CommentModel();
            $commentsModel->db->query('DELETE FROM comment WHERE comment_id='.intval($id));
            return redirect()->to('/');
        }
    }

    public function update($id)
    {
        $commentsModel = new CommentModel();

        $data['message'] = $commentsModel->where(['comment_id' => $id])
            ->first();
        if($this->request->getMethod() === 'post')
        {
            print_r($this->request->getPost());

            if($this->validate([
                'email' => 'required|min_length[3]|valid_email',
                'comment'  => 'required|min_length[3]'
            ]))
            {
                $commentsModel = new CommentModel();

                $commentsModel->db->query('UPDATE comment SET user_name= "'.$this->request->getVar('name').'", email= "'.$this->request->getVar('email').'", comment= "'.$this->request->getVar('comment').'" WHERE comment_id='.intval($id));
                return redirect()->to('/');
            }
            else
            {
                $data['errors'] = $this->validator->getErrors();
                $data['old'] = $this->request->getPost();
            }
        }

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('myController/update', $data);
        echo view('template/footer', $data);
    }

}