<?php

namespace App\Controllers;

use App\Models\contentModel;

class Home extends BaseController
{
	public function index()
	{
			
		if ($this->session->get('user')) {
			return redirect()->to(base_url() . '/note');
		}

		$data['message'] = $this->session->getFlashdata('message');
		return view('signIn', $data);
	}


	public function note()
	{

		if (!$this->session->get('user')) {
			return redirect()->to(base_url() . '/');
		}
		//echo uri($this,'1');
		//echo $this->request->uri->getSegment(1);
		$model = new contentModel();

		$data['message'] = $this->session->getFlashdata('message');

		$data['result'] = $model->paginate(1);
            $data['pager'] = $model->pager;

		return view('note', $data);
	}


	public function save_note()
	{

		if (!$this->session->get('user')) {
			return redirect()->to(base_url() . '/');
		}

		$model = new contentModel();

		$dataArr = [
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content')
		];

		$result = $model->insert($dataArr);

		if ($result) {
			$message = [
				'text' => 'Successfully Added Data!',
				'status' => 'success'
			];

			$this->session->setFlashdata('message', $message);
			return redirect()->to(base_url() . '/note');
		} else {
			$message = [
				'text' => 'Error, Data not Added Successfully!',
				'status' => 'error'
			];
			$this->session->setFlashdata('message', $message);
			return redirect()->to(base_url() . '/note');
		}
	}

	public function edit()
	{

		$id = $this->request->getPost('id');
		$model = new contentModel();
		$record = $model->find($id);

		die(json_encode($record));
	}

	public function update()
	{

		if (!$this->session->get('user')) {
			return redirect()->to(base_url() . '/');
		}

		$model = new contentModel();

		$id = $this->request->getPost('id');

		$dataArr = [
			'title' => $this->request->getPost('title'),
			'content' => $this->request->getPost('content')
		];

		$result = $model->update($id, $dataArr);

		if ($result) {
			$message = [
				'text' => 'Successfully Updated Data!',
				'status' => 'success'
			];
		} else {
			$message = [
				'text' => 'Error, Data not Updated Successfully!',
				'status' => 'error'
			];
		}
		die(json_encode($message));
	}


	public function remove()
	{
		if (!$this->session->get('user')) {
			return redirect()->to(base_url() . '/');
		}

		$model = new contentModel();

		$id = $this->request->getPost('id');

		$result = $model->delete($id);

		if ($result) {
			$message = [
				'text' => 'Data Removed Successfully!',
				'status' => 'success'
			];
		} else {
			$message = [
				'text' => 'Error, Data not Removed Successfully!',
				'status' => 'error'
			];
		}
		die(json_encode($message));
	}


	public function search()
	{

		$model = new contentModel();

		$value = $this->request->getGet('value');
		$builder = $model->builder();
		$result = $builder->like('title', $value)->where(['deleted_at is NULL'=>''])->get()->getResult();

		$data = '';
		foreach($result as $val){
			$data .='<div class="card m-2 p-2">
			<div class="font-weight-bold badge-secondary">'.$val->title.'</div>
			<div class=""> '.$val->content .'</div>
			<div class="row mt-4">
			<div class="col-md-6">
			<span class="font-weight-bold">'.date_format(date_create("$val->created_at"),"d M Y").'</span>
			</div>
			<div class="col-md-6 text-right">
				<a href="#" class="text-info edit" data=' .$val->id .' data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
				<a href="#" class="text-danger remove" data='. $val->id .' data-toggle="tooltip" title="Remove"><i class="far fa-trash-alt"></i></a>
			</div>
			</div>
		</div>';

		}
		die(json_encode($data));
	}
}
