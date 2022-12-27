<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\EmployeeModel;

class Employees extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function index()
    {
        $model = new EmployeeModel();
        $data = $model->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new EmployeeModel();
        $data = $model->find(['id' => $id]);
        if (!$data)
            return $this->failNotFound('Employee not found');
        return $this->respond($data[0]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new ()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'name' => 'required',
            'position' => 'required',
            'contract' => 'required'
        ];
        $data = [
            'name' => $this->request->getVar('name'),
            'position' => $this->request->getVar('position'),
            'contract' => $this->request->getVar('contract')
        ];
        if (!$this->validate($rules))
            return $this->fail($this->validator->getErrors());
        $model = new EmployeeModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Employee Added'
            ]
        ];
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'name' => 'required',
            'position' => 'required',
            'contract' => 'required'
        ];
        $data = [
            'name' => $this->request->getVar('name'),
            'position' => $this->request->getVar('position'),
            'contract' => $this->request->getVar('contract')
        ];
        if (!$this->validate($rules))
            return $this->fail($this->validator->getErrors());
        $model = new EmployeeModel();
        $findById = $model->find(['id' => $id]);
        if (!$findById)
            return $this->failNotFound('No Data Found');
        $model->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data updated'
            ]
        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new EmployeeModel();
        $findById = $model->find(['id' => $id]);
        if (!$findById)
            return $this->failNotFound('No Data Found');
        $model->delete($id);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data updated'
            ]
        ];
        return $this->respond($response);
    }
}