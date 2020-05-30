<?php
/**
 * Created by PhpStorm.
 * User: ПК
 * Date: 29.05.2020
 * Time: 15:14
 */

namespace App\Controllers;

use App\Models\CommentModel;

class Comment extends BaseController
{
    public function index()
    {
        $commentsModel = new CommentModel();
        $data['comments'] = $commentsModel->getAllComments();

        $data['pagination'] = \Config\Services::pager();

//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';

        echo view('template/header', $data);
        echo view('template/top_menu');
        echo view('comment/index', $data);
        echo view('template/footer', $data);
    }

    public function view($page = 'home')
    {
        if ( ! is_file(APPPATH.'/Views/comment/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter


//        $commentsModel = new CommentModel();
//        $ddd = [
//                'user_name' => 'RRRR',
//                'email'  => '22@22.ia',
//                'comment'  => 'EEEEEEEEEEEEEEEEEEEEEEEEE',
//        ];
//
//        echo $commentsModel->save($ddd);

        echo view('template/header', $data);
        echo view('comment/'.$page, $data);
        echo view('template/footer', $data);
    }

    public function create()
    {
        $result = [
            'result' => false,
            'errors' => [],
        ];

        if($this->request->isAJAX())
        {
            if($this->request->getMethod() === 'post')
            {

                helper(['url', 'form']);

//                echo json_encode($this->request->getPost());
                if($this->validate([
                    'email' => 'required|min_length[3]|valid_email',
                    'comment'  => 'required|min_length[3]|max_length[7]'
                ]))
                {
                    $commentsModel = new CommentModel();

//                    $saveRes = $commentsModel->save([
//                        'user_name' => $this->request->getPost('name'),
//                        'email'  => $this->request->getPost('email'),
//                        'comment'  => $this->request->getPost('comment'),
//                    ]);

                    $result['result'] = $commentsModel->saveComment($this->request->getPost());
//                    echo json_encode(['result' => $commentsModel->saveComment($this->request->getPost())]);
                }
                else{
                    $result['errors'] = \Config\Services::validation()->getErrors();
//                    echo json_encode(['errors' => \Config\Services::validation()->getErrors()]);
                }
            }
            else
            {
                $result['errors'][] = 'BAD REQUEST!';
//                echo json_encode(['error' => 'BAD REQUEST!']);
            }

            echo json_encode($result);
        }
        else
        {
            echo view('errors/html/error_404');
            die();
        }
    }


}