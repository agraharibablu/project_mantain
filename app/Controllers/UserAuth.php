<?php

namespace App\Controllers;

use App\Models\userAuthModel;

class UserAuth extends BaseController
{

    public function signInSave()
    { 
        $val = $this->validate([
            'email' => 'required',
            'password'  => 'required'
        ]);
        if (!$val) {
            $data['error'] = $this->validation->getErrors();
            return view('signIn',$data);
        } else {

        $model = new userAuthModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $query = $model->where('email',$email)->first();

        if ($query) {

            if (password_verify($password, $query->password)) {

                $newdata = [
                    'name'  => $query->name,
                    'email'     => $query->email,
                    'loggedIn' => TRUE
                ];

                $this->session->set('user',$newdata);
               
                
                return redirect()->to('note');
            } else {
                $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Username & Password does not match!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                    $this->session->setFlashdata('message', $message);
                    return redirect('/');
            }
        } else {
            $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something is going to wrong, Please try again!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
                $this->session->setFlashdata('message', $message);
                return redirect('/');
        }}
    }

    public function signUp()
    {
        if($this->session->get('user')){
            return redirect()->to(base_url().'/note');
             }
        $data['message'] = $this->session->getFlashdata('message');
        return view('signUp', $data);
    }

    public function signUpSave()
    {

        if(!$this->session->get('user')){
            return redirect()->to(base_url().'/');
             }

        $model = new userAuthModel();

        $val = $this->validate([
            'name' => 'required',
            'email' => 'required',
            'password'  => 'required',
            'conform_password' => 'required'
        ]);
        if (!$val) {
            $data['error'] = $this->validation->getErrors();
            return view('signUp',$data);
        } else {

            $dataArr = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];
            $result = $model->insert($dataArr);

            if ($result) {

                $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Register Successfully, Please Login Here!
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                $this->session->setFlashdata('message', $message);
                return redirect('/');
            } else {
                $message = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something is going to wrong, Please try again!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
                $this->session->setFlashdata('message', $message);
                return redirect()->to('/signUp');
            }
        }
    }


    public function sessDestroy(){

     $this->session->destroy();
      
       if(!$this->session->get('user')->loggedIn){
        return redirect()->to(base_url().'/');
         }
    }
}
