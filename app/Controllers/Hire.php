<?php

namespace App\Controllers;

use CodeIgniter\Controller;


class Hire extends Controller
{
    public function __construct()
    {
        $this->account_model = model('account_model');
        $this->finance_model = model('finance_model');
        $this->supplie_model = model('supplie_model');

        $session = session();
        if (!$session->has('login')) {
            return redirect()->to('/login');
        }
    }
    // -----------------------------------------------------------------
    public function getProduct()
    {

        $test = $this->request->getPost('search') ? $this->request->getPost('search') : null;
        $data = $this->supplie_model->getProductForSelect($test);
        if (!empty($data))
            return json_encode(array($data), JSON_UNESCAPED_UNICODE);
        else
            return json_encode(array(["massage" => "No data found"]));
    }
    // -----------------------------------------------------------------
    public function report_hire()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'hire_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "ผู้ว่าจ้าง", "ผู้รับจ้าง", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getHireByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'name'              => $x['operator'],
                            'code'              => $x['employer'],
                            'contractor'        => $x['contractor'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => $x['note'],
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $data['data'] = $this->supplie_model->getHire();
        $data['title'] = 'รายงานจัดจ้าง';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/report_hire');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function list_hire()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'hire_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "ผู้ว่าจ้าง", "ผู้รับจ้าง", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getHireByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'name'              => $x['operator'],
                            'code'              => $x['employer'],
                            'contractor'        => $x['contractor'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => $x['note'],
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $data['data'] = $this->supplie_model->getHire();
        $data['title'] = 'งานจัดจ้าง';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/list_hire');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function hire()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'operator'          => $this->request->getPost('operator'),
                'employer'          => $this->request->getPost('employer'),
                'contractor'        => $this->request->getPost('contractor'),
                'financial_amount'  => (float)str_replace(",", "", $this->request->getPost('financial_amount')),
                'type'              => $this->request->getPost('type'),
                'contract'          => $this->request->getPost('contract'),
                'period'            => $this->request->getPost('period'),
                'share'             => (float)str_replace(",", "", $this->request->getPost('share')),
                'note'              => $this->request->getPost('note'),
                'amount'            => (float)str_replace(",", "", $this->request->getPost('amount')),
                'tax'               => (float)str_replace(",", "", $this->request->getPost('tax')),
                'total'             => (float)str_replace(",", "", $this->request->getPost('total')),
                'director_name1'    => $this->request->getPost('director_name1'),
                'director_name2'    => $this->request->getPost('director_name2'),
                'director_name3'    => $this->request->getPost('director_name3'),
                'director_name4'    => $this->request->getPost('director_name4'),
                'director_name5'    => $this->request->getPost('director_name5'),
                'director_name6'    => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/hire_files/';

            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->addHire($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_hire');
        } else {
            $data['title'] = 'สร้างแบบฟอร์มจัดจ้าง';
            $data['pages'] = [['link' => base_url('hire/list_hire'), 'title' => 'งานจัดจ้าง'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/hire');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_hire($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'operator'          => $this->request->getPost('operator'),
                'employer'          => $this->request->getPost('employer'),
                'contractor'        => $this->request->getPost('contractor'),
                'financial_amount'  => (float)str_replace(",", "", $this->request->getPost('financial_amount')),
                'type'              => $this->request->getPost('type'),
                'contract'          => $this->request->getPost('contract'),
                'period'            => $this->request->getPost('period'),
                'share'             => (float)str_replace(",", "", $this->request->getPost('share')),
                'note'              => $this->request->getPost('note'),
                'amount'            => (float)str_replace(",", "", $this->request->getPost('amount')),
                'tax'               => (float)str_replace(",", "", $this->request->getPost('tax')),
                'total'             => (float)str_replace(",", "", $this->request->getPost('total')),
                'director_name1'          => $this->request->getPost('director_name1'),
                'director_name2'          => $this->request->getPost('director_name2'),
                'director_name3'          => $this->request->getPost('director_name3'),
                'director_name4'          => $this->request->getPost('director_name4'),
                'director_name5'          => $this->request->getPost('director_name5'),
                'director_name6'          => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/hire_files/';

            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                // $document->move(WRITEPATH . 'uploads', $newName);
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->editHire($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_hire');
        } else {
            $data['data'] = $this->supplie_model->getHireByID($id);
            $data['title'] = 'แก้ไขงานจัดจ้าง';
            $data['pages'] = [['link' => base_url('hire/list_hire'), 'title' => 'งานจัดจ้าง'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/edit_hire');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_hire($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteHireByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_hire');
        }
    }
    // -----------------------------------------------------------------
    public function view_hire($id = null)
    {
        $data['data'] = $this->supplie_model->getHireByID($id);
        $data['title'] = 'รายละเอียดงานจัดจ้าง';
        $data['pages'] = [['link' => base_url('hire/list_hire'), 'title' => 'งานจัดจ้าง'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/view_hire');
        echo view('footer');
    }

    // -----------------------------------------------------------------

    public function view_hire_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getHireByID($id);
            $data['title'] = 'รายละเอียดงานจัดจ้าง';
            echo view('hr/view_hire_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_hire()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'hire_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "ผู้ว่าจ้าง", "ผู้รับจ้าง", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getHireByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'name'              => $x['operator'],
                            'code'              => $x['employer'],
                            'contractor'        => $x['contractor'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => $x['note'],
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/hire/list_hire');
    }
    // -----------------------------------------------------------------
    public function report_supply()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'supply_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "วิธีการจัดหา", "หน่วยงาน", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getSupplyByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    $mt = [
                        '0' => '',
                        '1' => 'ประมูล',
                        '2' => 'จัดหา',
                        '3' => 'แบบพิเศษ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'operator'          => $x['operator'],
                            'method'            => $mt[$x['method']],
                            'agency'            => $x['agency'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => strip_tags($x['note']),
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $data['data'] = $this->supplie_model->getSupply();
        $data['title'] = 'รายงานจัดหา';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/report_supply');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function list_supply()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'supply_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "วิธีการจัดหา", "หน่วยงาน", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getSupplyByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    $mt = [
                        '0' => '',
                        '1' => 'ประมูล',
                        '2' => 'จัดหา',
                        '3' => 'แบบพิเศษ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'operator'          => $x['operator'],
                            'method'            => $mt[$x['method']],
                            'agency'            => $x['agency'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => strip_tags($x['note']),
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $data['data'] = $this->supplie_model->getSupply();
        $data['title'] = 'งานจัดหา';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/list_supply');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function supply()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'operator'          => $this->request->getPost('operator'),
                'method'            => $this->request->getPost('method'),
                'agency'            => $this->request->getPost('agency'),
                'financial_amount'  => (float)str_replace(",", "", $this->request->getPost('financial_amount')),
                'type'              => $this->request->getPost('type'),
                'contract'          => $this->request->getPost('contract'),
                'period'            => $this->request->getPost('period'),
                'share'             => (float)str_replace(",", "", $this->request->getPost('share')),
                'note'              => $this->request->getPost('note'),
                'amount'            => (float)str_replace(",", "", $this->request->getPost('amount')),
                'tax'               => (float)str_replace(",", "", $this->request->getPost('tax')),
                'total'             => (float)str_replace(",", "", $this->request->getPost('total')),
                'director_name1'    => $this->request->getPost('director_name1'),
                'director_name2'    => $this->request->getPost('director_name2'),
                'director_name3'    => $this->request->getPost('director_name3'),
                'director_name4'    => $this->request->getPost('director_name4'),
                'director_name5'    => $this->request->getPost('director_name5'),
                'director_name6'    => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/supply_files/';

            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                // $document->move(WRITEPATH . 'uploads', $newName);
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->addSupply($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_supply');
        } else {
            $data['title'] = 'สร้างแบบฟอร์มจัดหา';
            $data['pages'] = [['link' => base_url('hire/list_supply'), 'title' => 'งานจัดหา'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/supply');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_supply($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'operator'          => $this->request->getPost('operator'),
                'method'            => $this->request->getPost('method'),
                'agency'            => $this->request->getPost('agency'),
                'financial_amount'  => (float)str_replace(",", "", $this->request->getPost('financial_amount')),
                'type'              => $this->request->getPost('type'),
                'contract'          => $this->request->getPost('contract'),
                'period'            => $this->request->getPost('period'),
                'share'             => (float)str_replace(",", "", $this->request->getPost('share')),
                'note'              => $this->request->getPost('note'),
                'amount'            => (float)str_replace(",", "", $this->request->getPost('amount')),
                'tax'               => (float)str_replace(",", "", $this->request->getPost('tax')),
                'total'             => (float)str_replace(",", "", $this->request->getPost('total')),
                'director_name1'    => $this->request->getPost('director_name1'),
                'director_name2'    => $this->request->getPost('director_name2'),
                'director_name3'    => $this->request->getPost('director_name3'),
                'director_name4'    => $this->request->getPost('director_name4'),
                'director_name5'    => $this->request->getPost('director_name5'),
                'director_name6'    => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/supply_files/';

            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                // $document->move(WRITEPATH . 'uploads', $newName);
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->editSupply($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_supply');
        } else {
            $data['data'] = $this->supplie_model->getSupplyByID($id);
            $data['title'] = 'แก้ไขงานจัดหา';
            $data['pages'] = [['link' => base_url('hire/list_supply'), 'title' => 'งานจัดหา'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/edit_supply');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_supply($id = null)
    {
        $data['data'] = $this->supplie_model->getSupplyByID($id);
        $data['title'] = 'รายละเอียดงานจัดหา';
        $data['pages'] = [['link' => base_url('hire/list_supply'), 'title' => 'งานจัดหา'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/view_supply');
        echo view('footer');
    }

    // -----------------------------------------------------------------

    public function view_supply_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getSupplyByID($id);
            $data['title'] = 'รายละเอียดงานจัดหา';
            echo view('hr/view_supply_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function delete_supply($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteSupplyByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_supply');
        }
    }
    // -----------------------------------------------------------------
    public function actions_supply()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'supply_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "วิธีการจัดหา", "หน่วยงาน", "วงเงิน", "ประเภท", "งวดงาน", "แบ่งจ่าย %", "หมายเหตุ", "จำนวนเงิน (หน่วย:บาท)", "ภาษีมูลค่าเพิ่ม (7%)", "จำนวนเงินทั้งสิ้น (หน่วย:บาท)");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getSupplyByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'นิติบุคคล',
                        '2' => 'ผู้รับเหมา',
                        '3' => 'บุคคลทั่วไป',
                        '4' => 'ภาครัฐ / คู่ค้า',
                    ];
                    $mt = [
                        '0' => '',
                        '1' => 'ประมูล',
                        '2' => 'จัดหา',
                        '3' => 'แบบพิเศษ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'operator'          => $x['operator'],
                            'method'            => $mt[$x['method']],
                            'agency'            => $x['agency'],
                            'financial_amount'  => $x['financial_amount'],
                            'type'              => $ar[$x['type']],
                            'period'            => $x['period'],
                            'share'             => $x['share'],
                            'note'              => strip_tags($x['note']),
                            'amount'            => $x['amount'],
                            'tax'               => $x['tax'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/hire/list_supply');
    }
    // -----------------------------------------------------------------
    public function report_repair()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'repair_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่ง ภาษี", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getRepairByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เทส1',
                        '2' => 'เทส2',
                        '3' => 'เทส3',
                        '4' => 'เทส4',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            'number'            => $x['number'],
                            'tax'               => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $from     = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to     = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


        $data['data'] = $this->supplie_model->getRepairNew($from, $to);
        // $data['data'] = $this->supplie_model->getRepair();
        $data['title'] = 'รายงานซ่อม';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/report_repair');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function report_repair_pdf($id = null)
    {
        require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';

        if ($id != null) {
            $data['data'] = $this->supplie_model->getRepairNewByID($id);
            $data['title'] = 'รายงานการซ่อม';

            $mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
            $html = view('hr/report_repair_pdf', $data);
            $filename = 'report_repair_pdf_' . date("Y_m_d_H_i_s") . '.pdf';
            $mpdf->WriteHTML($html);
            return redirect()->to($mpdf->Output($filename, 'I'));
        } else
            return redirect()->to('/hire/report_repair_pdf');
    }
    // -----------------------------------------------------------------
    public function list_repair()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'repair_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่ง ภาษี", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getRepairByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เทส1',
                        '2' => 'เทส2',
                        '3' => 'เทส3',
                        '4' => 'เทส4',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            'number'            => $x['number'],
                            'tax'               => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $from     = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to     = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


        $data['data'] = $this->supplie_model->getRepairNew($from, $to);
        // $data['data'] = $this->supplie_model->getRepair();
        $data['title'] = 'รายการซ่อม';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/list_repair');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function repair()
    {
        if ($this->request->getPost('save') != null) {
            $no = $this->request->getPost('no1') . "/" . $this->request->getPost('no2');
            $date = Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date'))));
            $responsible_id = $this->request->getPost('responsible_id');
            $gender = $this->request->getPost('gender');
            // if($gender == "1"){
            //     $gender = "นาย";
            // }else if($gender == "2"){
            //     $gender = "นาง";
            // }else if($gender == "3"){
            //     $gender = "นางสาว";
            // }
            $fullname = $this->request->getPost('fullname');
            $group = $this->request->getPost('group');
            $request = $this->request->getPost('request');
            $since = $this->request->getPost('since');
            $number = $this->request->getPost('number');
            $note = $this->request->getPost('note');
            $status = $this->request->getPost('status');
            $reason = $this->request->getPost('reason');
            $to = $this->request->getPost('to');

            $add = [
                'id_cus'            => $no,
                'date'              => $date,
                'responsible'       => $responsible_id,
                'gender'            => $gender,
                'fullname'            => $fullname,
                'group'             => $group,
                'request'           => $request,
                'since'             => $since,
                'number'            => $number,
                'note'              => $note,
                'status'            => $status,
                'reason'            => $reason,
                'to'                => $to,


                // 'officer'           => $this->request->getPost('officer'),
                'date_completion'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date_completion')))),
            ];


            // $add = [
            //     'no'                => $this->request->getPost('no'),
            //     'name'              => $this->request->getPost('name'),
            //     'responsible_id'    => $this->request->getPost('responsible_id'),
            //     'status'            => $this->request->getPost('status'),
            //     'agency'            => $this->request->getPost('agency'),
            //     'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
            //     'type_id'           => $this->request->getPost('type_id'),
            //     'number'            => $this->request->getPost('number'),
            //     'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
            //     'discount'          => (float)str_replace(",", "", $this->request->getPost('discount')),
            //     'type_maintenance'  => $this->request->getPost('type_maintenance'),
            //     'payment_term'      => $this->request->getPost('payment_term'),
            //     'note'              => $this->request->getPost('note'),
            // ];
            // $path = ROOTPATH . 'public/files/repair_files/';
            // if ($this->request->getFile('document')->getpath() != "") {
            //     $document = $this->request->getFile('document');
            //     $newName = $document->getRandomName();
            //     $document->move($path, $newName);
            //     $add['document'] = $newName;
            // }

            $this->supplie_model->addRepairNew($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_repair');
        } else {
            $data['repair_new'] = $this->supplie_model->getRepairNew($from = null, $to = null);
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['product'] = $this->supplie_model->getProduct();
            $data['title'] = 'สร้างแบบฟอร์มซ่อม';
            $data['pages'] = [['link' => base_url('hire/list_repair'), 'title' => 'รายการซ่อม'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/repair');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_repair($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $no = $this->request->getPost('no1') . "/" . $this->request->getPost('no2');
            $date = Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date'))));
            $responsible_id = $this->request->getPost('responsible_id');
            $gender = $this->request->getPost('gender');
            $fullname = $this->request->getPost('fullname');
            $group = $this->request->getPost('group');
            $request = $this->request->getPost('request');
            $since = $this->request->getPost('since');
            $number = $this->request->getPost('number');
            $note = $this->request->getPost('note');
            $status = $this->request->getPost('status');
            $reason = $this->request->getPost('reason');
            $to = $this->request->getPost('to');

            $add = [
                'id_cus'            => $no,
                'date'              => $date,
                'responsible'       => $responsible_id,
                'gender'            => $gender,
                'fullname'            => $fullname,
                'group'             => $group,
                'request'           => $request,
                'since'             => $since,
                'number'            => $number,
                'note'              => $note,
                'status'            => $status,
                'reason'            => $reason,
                'to'                => $to,
                // 'officer'           => $this->request->getPost('officer'),
                'date_completion'   => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date_completion')))),
            ];
            $this->supplie_model->editRepairNew($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_repair');
        } else {
            $data['data'] = $this->supplie_model->getRepairNewByID($id);
            // $data['data'] = $this->supplie_model->getRepairByID($id);
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['product'] = $this->supplie_model->getProduct();
            $data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
            $data['data'][0]['date_completion'] = Date('d/m/Y', strtotime($data['data'][0]['date_completion']));

            $test = explode("/", $data['data'][0]['id_cus']);
            $data['data'][0]['no1'] = $test[0];
            $data['data'][0]['no2'] = $test[1];

            $data['title'] = 'แก้ไขแบบฟอร์มซ่อม';
            $data['pages'] = [['link' => base_url('hire/list_repair'), 'title' => 'รายการซ่อม'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/edit_repair');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_repair($id = null)
    {
        $data['data'] = $this->supplie_model->getRepairNewByID($id);
        // $data['data'] = $this->supplie_model->getRepairByID($id);
        $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
        $data['title'] = 'รายละเอียดการซ่อม';
        $data['pages'] = [['link' => base_url('hire/list_repair'), 'title' => 'รายการซ่อม'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/view_repair');
        echo view('footer');
    }

    // -----------------------------------------------------------------

    public function view_repair_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getRepairNewByID($id);
            // $data['data'] = $this->supplie_model->getRepairByID($id);
            $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
            $data['title'] = 'รายละเอียดการซ่อม';
            echo view('hr/view_repair_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_repair()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'repair_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่ง ภาษี", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getRepairByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เทส1',
                        '2' => 'เทส2',
                        '3' => 'เทส3',
                        '4' => 'เทส4',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            'number'            => $x['number'],
                            'tax'               => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/hire/list_repair');
    }
    // -----------------------------------------------------------------
    public function delete_repair($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteRepairByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_repair');
        }
    }
    // -----------------------------------------------------------------
    public function report_lease()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'lease_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่งเช่า", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getLeaseByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เรียบร้อย',
                        '2' => 'ระหว่างดำเนินการ',
                        '3' => 'ยกเลิก',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            // 'number'         => $x['number'],
                            'number'            => "=\"" . $x["number"] . "\"",
                            'tax_invoice_id'    => $x['tax_invoice_id'],
                            // 'tax'            => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => strip_tags($x['note']),
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $from     = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to     = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


        $data['data'] = $this->supplie_model->getLease($from, $to);
        // $data['data'] = $this->supplie_model->getLease();
        $data['title'] = 'รายงานเช่า';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/report_lease');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function list_lease()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'lease_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่งเช่า", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getLeaseByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เรียบร้อย',
                        '2' => 'ระหว่างดำเนินการ',
                        '3' => 'ยกเลิก',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            // 'number'         => $x['number'],
                            'number'            => "=\"" . $x["number"] . "\"",
                            'tax_invoice_id'    => $x['tax_invoice_id'],
                            // 'tax'            => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => strip_tags($x['note']),
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $from     = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to     = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


        $data['data'] = $this->supplie_model->getLease($from, $to);
        // $data['data'] = $this->supplie_model->getLease();
        $data['title'] = 'รายการเช่า';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/list_lease');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function lease()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'no'                => $this->request->getPost('no'),
                'name'              => $this->request->getPost('name'),
                'responsible_id'    => $this->request->getPost('responsible_id'),
                'status'            => $this->request->getPost('status'),
                'agency'            => $this->request->getPost('agency'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                'number'            => $this->request->getPost('number'),
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => (float)str_replace(",", "", $this->request->getPost('discount')),
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
                'director_name1'          => $this->request->getPost('director_name1'),
                'director_name2'          => $this->request->getPost('director_name2'),
                'director_name3'          => $this->request->getPost('director_name3'),
                'director_name4'          => $this->request->getPost('director_name4'),
                'director_name5'          => $this->request->getPost('director_name5'),
                'director_name6'          => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/lease_files/';
            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->addLease($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_lease');
        } else {
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'สร้างรายการเช่า';
            $data['pages'] = [['link' => base_url('hire/list_lease'), 'title' => 'รายการเช่า'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/lease');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_lease($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'no'                => $this->request->getPost('no'),
                'name'              => $this->request->getPost('name'),
                'responsible_id'    => $this->request->getPost('responsible_id'),
                'status'            => $this->request->getPost('status'),
                'agency'            => $this->request->getPost('agency'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                'number'            => $this->request->getPost('number'),
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => (float)str_replace(",", "", $this->request->getPost('discount')),
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
                'director_name1'          => $this->request->getPost('director_name1'),
                'director_name2'          => $this->request->getPost('director_name2'),
                'director_name3'          => $this->request->getPost('director_name3'),
                'director_name4'          => $this->request->getPost('director_name4'),
                'director_name5'          => $this->request->getPost('director_name5'),
                'director_name6'          => $this->request->getPost('director_name6'),
                'position1'         => $this->request->getPost('position1'),
                'position2'         => $this->request->getPost('position2'),
                'position3'         => $this->request->getPost('position3'),
                'position4'         => $this->request->getPost('position4'),
                'position5'         => $this->request->getPost('position5'),
                'position6'         => $this->request->getPost('position6'),
            ];
            $path = ROOTPATH . 'public/files/lease_files/';
            if ($this->request->getFile('document')->getpath() != "") {
                $document = $this->request->getFile('document');
                $newName = $document->getRandomName();
                $document->move($path, $newName);
                $add['document'] = $newName;
            }
            if ($this->request->getFile('document2')->getpath() != "") {
                $document2 = $this->request->getFile('document2');
                $newName = $document2->getRandomName();
                $document2->move($path, $newName);
                $add['document2'] = $newName;
            }
            if ($this->request->getFile('document3')->getpath() != "") {
                $document3 = $this->request->getFile('document3');
                $newName = $document3->getRandomName();
                $document3->move($path, $newName);
                $add['document3'] = $newName;
            }

            $this->supplie_model->editLease($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_lease');
        } else {
            $data['data'] = $this->supplie_model->getLeaseByID($id);
            $data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'แก้ไขรายการเช่า';
            $data['pages'] = [['link' => base_url('hire/list_lease'), 'title' => 'รายการเช่า'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/edit_lease');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_lease($id = null)
    {
        $data['data'] = $this->supplie_model->getLeaseByID($id);
        $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
        $data['title'] = 'รายละเอียดการเช่า';
        $data['pages'] = [['link' => base_url('hire/list_lease'), 'title' => 'รายการเช่า'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/view_lease');
        echo view('footer');
    }

    // -----------------------------------------------------------------

    public function view_lease_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getLeaseByID($id);
            $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
            $data['title'] = 'รายละเอียดการเช่า';
            echo view('hr/view_lease_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_lease()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'lease_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้รับผิดชอบ", "สถานะซ่อม", "หน่วยงาน", "วันที่", "ประเภท", "เบอร์ภายใน", "ใบสั่ง ภาษี", "ส่วนลด (5/5%)", "ประเภทซ่อม (เช่น เครม,เปลี่ยน,เพิ่ม)", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getLeaseByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'เทส1',
                        '2' => 'เทส2',
                        '3' => 'เทส3',
                        '4' => 'เทส4',
                    ];
                    $ty = [
                        '0' => '',
                        '1' => 'วัสดุสิ้นเปลือง',
                        '2' => 'สินทรัพย์',
                        '3' => 'วัตถุดิบ',
                        '4' => 'อื่นๆ',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'responsible_id'    => $x['responsible_id'],
                            'status'            => $ar[$x['status']],
                            'agency'            => $x['agency'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ty[$x['type_id']],
                            // 'number'            => $x['number'],
                            'number'            => "=\"" . $x["number"] . "\"",
                            'tax'               => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'              => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/hire/list_lease');
    }
    // -----------------------------------------------------------------
    public function delete_lease($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteLeaseByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_lease');
        }
    }
    // -----------------------------------------------------------------
    public function check()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'agency_code'           => $this->request->getPost('agency_code'),
                'document_date'         => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('document_date')))),
                'passed_date'           => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
                'responsible_person'    => $this->request->getPost('responsible_person'),
                'unit_code'             => $this->request->getPost('unit_code'),
                'delivery_number'       => $this->request->getPost('delivery_number'),
                'record'                => $this->request->getPost('record'),
                'note'                  => $this->request->getPost('note'),
                'order_number'          => $this->request->getPost('order_number'),
                'contract_date'         => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('contract_date')))),
                'purchasing_type'       => $this->request->getPost('purchasing_type'),
                'take_action'           => $this->request->getPost('take_action'),
                'seller_name'           => $this->request->getPost('seller_name'),
                'contract'              => $this->request->getPost('contract'),
                'contract_end_date'     => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('contract_end_date')))),
                'inspection_number'     => $this->request->getPost('inspection_number'),
            ];

            $this->supplie_model->addCheck($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_reveal');
        } else {
            $data['title'] = 'งานตรวจรับ';
            $data['pages'] = [['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/check');
            echo view('footer');
        }
    }

    // -----------------------------------------------------------------
    public function edit_check($id = null)
    {
        if ($id == null)
            return redirect()->to('/hire/list_reveal');
        if ($this->request->getPost('save') != null) {
            $add = [
                'agency_code'           => $this->request->getPost('agency_code'),
                'document_date'         => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('document_date')))),
                'passed_date'           => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('passed_date')))),
                'responsible_person'    => $this->request->getPost('responsible_person'),
                'unit_code'             => $this->request->getPost('unit_code'),
                'delivery_number'       => $this->request->getPost('delivery_number'),
                'record'                => $this->request->getPost('record'),
                'note'                  => $this->request->getPost('note'),
                'order_number'          => $this->request->getPost('order_number'),
                'contract_date'         => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('contract_date')))),
                'purchasing_type'       => $this->request->getPost('purchasing_type'),
                'take_action'           => $this->request->getPost('take_action'),
                'seller_name'           => $this->request->getPost('seller_name'),
                'contract'              => $this->request->getPost('contract'),
                'contract_end_date'     => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('contract_end_date')))),
                'inspection_number'     => $this->request->getPost('inspection_number'),
            ];

            $this->supplie_model->editCheck($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_reveal');
        } else {
            $data['data']                           = $this->supplie_model->getCheck($id);
            $data['data'][0]['document_date']       = Date('d/m/Y', strtotime($data['data'][0]['document_date']));
            $data['data'][0]['passed_date']         = Date('d/m/Y', strtotime($data['data'][0]['passed_date']));
            $data['data'][0]['contract_date']       = Date('d/m/Y', strtotime($data['data'][0]['contract_date']));
            $data['data'][0]['contract_end_date']   = Date('d/m/Y', strtotime($data['data'][0]['contract_end_date']));
            $data['title']                          = 'แก้ไขงานตรวจรับ';
            $data['pages']                          = [['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('hr/edit_check');
            echo view('footer');
        }
    }

    // -----------------------------------------------------------------
    public function view_check($id = null)
    {
        $data['data'] = $this->supplie_model->getCheck($id);
        $data['title'] = 'รายละเอียดงานตรวจรับ';
        $data['pages'] = [['link' => base_url('hire/list_reveal'), 'title' => 'งานตรวจรับ'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/view_check');
        echo view('footer');
    }

    // -----------------------------------------------------------------

    public function view_check_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getCheck($id);
            $data['title'] = 'รายละเอียดงานตรวจรับ';
            echo view('hr/view_check_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function delete_check($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteCheckByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/hire/list_reveal');
        }
    }
    // -----------------------------------------------------------------
    public function list_reveal()
    {
        if ($this->request->getPost('excell_x')) {
            if (!empty($_POST['val'])) {
                // file name 
                $filename = 'reveal_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "ผู้ถอน", "วันที่ถอนเงิน", "ผู้ดำเนินการ", "จำนวนเงิน", "ค่าบริการ", "จำนวนเงินทั้งสิ้น");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data    = $this->supplie_model->getCheck($id);
                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $x['date'] = date('d/m/Y', strtotime($x['date']));
                        $excel = [
                            'no'                 => $no,
                            'withdrawal'         => $x['withdrawal'],
                            'date'                 => $x['date'],
                            'operator'            => $x['operator'],
                            'amount'             => $x['amount'],
                            'service_charge'    => $x['service_charge'],
                            'total'             => $x['total'],
                        ];
                        fputcsv($file, $excel);
                    }
                    fclose($file);
                    $no = $no + 1;
                }
                exit;
            } else {
                return redirect()->to('/hire/list_reveal');
            }
        }
        $from = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;
        $data['data']         = $this->supplie_model->getCheck(null, $from, $to);
        $data['title']         = 'รายการเบิก อนุมัติ งวดงาน';
        $data['pages']         = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('hr/list_reveal');
        echo view('footer');
    }
    // -----------------------------------------------------------------
}
