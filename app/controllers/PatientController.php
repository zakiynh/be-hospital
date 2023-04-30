<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class PatientController extends \Phalcon\Mvc\Controller
{

    public function getAction()
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isGet()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Pasien::find();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function getByIdAction($patient_id)
    {

        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isGet()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Pasien::find($patient_id);

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function postAction()
    {
        $this->view->disable();
        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");
        // $response->setHeader('Access-Control-Allow-Origin: http://127.0.0.1:5173');
        // $response->setHeader("Access-Control-Allow-Headers", "*");

        $request = new Request();

        if ($request->isPost()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Add Patient Success",
            ];

            $data = $request->getPost();

            $patient = new Pasien();
            $patient->name      = $data["name"];
            $patient->sex       = $data["sex"];
            $patient->religion  = $data["religion"];
            $patient->phone     = $data["phone"];
            $patient->address   = $data["address"];
            $patient->nik       = $data["nik"];

            $savedSuccessfully = $patient->save();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function putAction($patient_id)
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
        // $response->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization');
        // $response->setHeader("Access-Control-Allow-Credentials", true);

        $request = new Request();

        if ($request->isPut()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Update Patient Successfully",
            ];

            $patient = Pasien::findFirstById($patient_id);

            $patients = $request->getPut();

            $patient->id = $patient_id;
            $patient->name = $patients["name"];
            $patient->sex = $patients["sex"];
            $patient->religion = $patients["religion"];
            $patient->phone = $patients["phone"];
            $patient->address = $patients["address"];
            $patient->nik = $patients["nik"];

            $patient->update();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function deleteAction($patient_id)
    {

        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');

        $request = new Request();
        echo $patient_id;
        if ($patient_id) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Delete Patient Successfully",
            ];

            $patient = Pasien::find($patient_id);
            $patient->delete();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData]);
        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }
}

