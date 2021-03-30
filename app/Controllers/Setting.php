<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use PDO;

class Setting extends Controller
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
    public function index()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'tax_product'                  => $this->request->getPost('tax_product'),
                'shelf'                       => $this->request->getPost('shelf'),
                'variety'                    => $this->request->getPost('variety'),
                'expired_product'           => $this->request->getPost('expired_product'),
                'expired_remove'               => $this->request->getPost('expired_remove'),
                'image_width'               => $this->request->getPost('image_width'),
                'image_height'               => $this->request->getPost('image_height'),
                'image_short_width'           => $this->request->getPost('image_short_width'),
                'image_short_height'           => $this->request->getPost('image_short_height'),
                'watermark'                   => $this->request->getPost('watermark'),
                'show_product'               => $this->request->getPost('show_product'),
                'barcode_separator'           => $this->request->getPost('barcode_separator'),
                'barcode_renderer'           => $this->request->getPost('barcode_renderer'),
                'update_cost_with_purchese'    => $this->request->getPost('update_cost_with_purchese'),
                'oversold'                   => $this->request->getPost('oversold'),
                'format_referent'           => $this->request->getPost('format_referent'),
                'tax_purchase'               => $this->request->getPost('tax_purchase'),
                'discount_product'           => $this->request->getPost('discount_product'),
                'no_product'                   => $this->request->getPost('no_product'),
                'detect_barcode'               => $this->request->getPost('detect_barcode'),
                'count_barcode'               => $this->request->getPost('count_barcode'),
                'add_products'               => $this->request->getPost('add_products'),
                'set_forcus'                   => $this->request->getPost('set_forcus'),
                'view_invoice'               => $this->request->getPost('view_invoice'),
            ];
            $this->supplie_model->editSetting(1, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/index');
        } else {
            $data['data'] = $this->supplie_model->getSettingByID(1);
            $data['title'] = 'ตั้งค่าพัสดุ';
            $data['pages'] = [['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/setting');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function list_tax_rate()
    {
        $data['data'] = $this->supplie_model->getTaxRate();
        $data['title'] = 'กำหนดอัตราภาษี';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/list_tax_rate');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function tax_rate()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'name'      => $this->request->getPost('name'),
                'code'      => $this->request->getPost('code'),
                'tax_rate'  => (float)str_replace(",", "", $this->request->getPost('tax_rate')),
                'type'      => $this->request->getPost('type'),
            ];
            $this->supplie_model->addTaxRate($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_tax_rate');
        } else {
            $data['title'] = 'เพิ่มกำหนดอัตราภาษี';
            $data['pages'] = [['link' => base_url('setting/list_tax_rate'), 'title' => 'กำหนดอัตราภาษี'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/tax_rate');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_tax_rate($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'name'      => $this->request->getPost('name'),
                'code'      => $this->request->getPost('code'),
                'tax_rate'  => (float)str_replace(",", "", $this->request->getPost('tax_rate')),
                'type'      => $this->request->getPost('type'),
            ];
            $this->supplie_model->editTaxRate($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_tax_rate');
        } else {
            $data['data'] = $this->supplie_model->getTaxRateByID($id);
            $data['title'] = 'แก้ไขกำหนดอัตราภาษี';
            $data['pages'] = [['link' => base_url('setting/list_tax_rate'), 'title' => 'กำหนดอัตราภาษี'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/edit_tax_rate');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_tax_rate($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteTaxRateByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_tax_rate');
        }
    }
    // -----------------------------------------------------------------
    public function view_tax_rate($id = null)
    {
        $data['data'] = $this->supplie_model->getTaxRateByID($id);
        $data['title'] = 'รายละเอียดกำหนดอัตราภาษี';
        $data['pages'] = [['link' => base_url('setting/list_tax_rate'), 'title' => 'กำหนดอัตราภาษี'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/view_tax_rate');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_tax_rate_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getTaxRateByID($id);
            $data['title'] = 'รายละเอียดกำหนดอัตราภาษี';
            echo view('st/view_tax_rate_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_tax_rate()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'tax_rate_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ชื่อ", "Code", "อัตราภาษี", "ประเภท");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getTaxRateByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    $ar = [
                        '0' => '',
                        '1' => 'ประจำ',
                        '2' => 'เปอร์เซ็นต์',
                    ];
                    foreach ($data as $x) {
                        $excel = [
                            'no'        => $no,
                            'id'        => $x['id'],
                            'name'      => $x['name'],
                            'code'      => $x['code'],
                            'tax_rate'  => $x['tax_rate'],
                            'type'      => $ar[$x['type']],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/setting/list_tax_rate');
    }
    // -----------------------------------------------------------------
    public function list_unit()
    {
        $data['data'] = $this->supplie_model->getUnit();
        $data['title'] = 'กำหนดหน่วยนับ';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/list_unit');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function unit()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'unit_code'         => $this->request->getPost('unit_code'),
                'unit_name'         => $this->request->getPost('unit_name'),
                // 'unit_base'         => $this->request->getPost('unit_base'),
                // 'operater'          => $this->request->getPost('operater'),
                // 'operater_value'    => $this->request->getPost('operater_value'),
            ];
            $this->supplie_model->addUnit($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_unit');
        } else {
            $data['unit'] = $this->supplie_model->getUnit();
            $data['title'] = 'เพิ่มกำหนดหน่วยนับ';
            $data['pages'] = [['link' => base_url('setting/list_unit'), 'title' => 'กำหนดหน่วยนับ'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/unit');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_unit($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'unit_code'         => $this->request->getPost('unit_code'),
                'unit_name'         => $this->request->getPost('unit_name'),
                // 'unit_base'         => $this->request->getPost('unit_base'),
                // 'operater'          => $this->request->getPost('operater'),
                // 'operater_value'    => $this->request->getPost('operater_value'),
            ];
            $this->supplie_model->editUnit($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_unit');
        } else {
            $data['unit'] = $this->supplie_model->getUnit();
            $data['data'] = $this->supplie_model->getUnitByID($id);
            $data['title'] = 'แก้ไขกำหนดหน่วยนับ';
            $data['pages'] = [['link' => base_url('setting/list_unit'), 'title' => 'กำหนดหน่วยนับ'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/edit_unit');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_unit($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteUnitByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_unit');
        }
    }
    // -----------------------------------------------------------------
    public function view_unit($id = null)
    {
        $data['data'] = $this->supplie_model->getUnitByID($id);
        $data['title'] = 'รายละเอียดกำหนดหน่วยนับ';
        $data['pages'] = [['link' => base_url('setting/list_unit'), 'title' => 'กำหนดหน่วยนับ'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/view_unit');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_unit_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getUnitByID($id);
            $data['title'] = 'รายละเอียดกำหนดหน่วยนับ';
            echo view('st/view_unit_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_unit()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'unit_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "Unit code", "Unit name", "Base unit", "Operator", "Operation");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getUnitByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'category_name'     => $x['unit_code'],
                            'category_sub'      => $x['unit_name'],
                            'unit_base'         => $x['unit_base'],
                            'operater'          => $x['operater'],
                            'operater_value'    => $x['operater_value'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/setting/list_unit');
    }
    // -----------------------------------------------------------------
    public function list_category()
    {
        $data['data'] = $this->supplie_model->getCategory();
        $data['title'] = 'กำหนดหมวดหมู่พัสดุ';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/list_category');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function category()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'category_name'         => $this->request->getPost('category_name'),
                'category_sub'         => $this->request->getPost('category_sub') ? $this->request->getPost('category_sub') : 0,
                'detail'         => $this->request->getPost('detail'),
            ];
            $path = ROOTPATH . 'public/files';
            if ($this->request->getFile('image')->getpath() != "") {
                $image = $this->request->getFile('image');
                $newName = $image->getRandomName();
                // $image->move(WRITEPATH . 'uploads', $newName);
                $image->move($path, $newName);
                $add['image'] = $newName;
            }

            $getId = $this->supplie_model->addCategory($add);
            $add2 = [
                'category_name'         => $this->request->getPost('category_sub') ? $this->request->getPost('category_sub') : 0,
                'detail'         => $this->request->getPost('detail'),
                'image'         => '',
                'category_sub'  => intval($getId[0]["max_id"])
            ];
            $this->supplie_model->addCategorySub($add2);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_category');
        } else {
            $data['category'] = $this->supplie_model->getCategory();
            $data['title'] = 'เพิ่มกำหนดหมวดหมู่พัสดุ';
            $data['pages'] = [['link' => base_url('setting/list_category'), 'title' => 'กำหนดหมวดหมู่พัสดุ'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/category');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_category($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'category_name'         => $this->request->getPost('category_name'),
                'category_sub'         => $this->request->getPost('category_sub') ? $this->request->getPost('category_sub') : 0,
                'detail'         => $this->request->getPost('detail'),
            ];
            $path = ROOTPATH . 'public/files';
            if ($this->request->getFile('image')->getpath() != "") {
                $image = $this->request->getFile('image');
                $newName = $image->getRandomName();
                // $image->move(WRITEPATH . 'uploads', $newName);
                $image->move($path, $newName);
                $add['image'] = $newName;
            }

            $this->supplie_model->editCategory($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_category');
        } else {
            $data['category'] = $this->supplie_model->getCategoryByExceptID($id);
            $data['data'] = $this->supplie_model->getCategoryByID($id);
            $data['title'] = 'แก้ไขกำหนดหมวดหมู่พัสดุ';
            $data['pages'] = [['link' => base_url('setting/list_category'), 'title' => 'กำหนดหมวดหมู่พัสดุ'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/edit_category');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_category($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteCategoryByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_category');
        }
    }
    // -----------------------------------------------------------------
    public function view_category($id = null)
    {
        $data['data'] = $this->supplie_model->getCategoryByID($id);
        $data['category_sub'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_sub']);
        $data['title'] = 'รายละเอียดกำหนดหมวดหมู่พัสดุ';
        $data['pages'] = [['link' => base_url('setting/list_category'), 'title' => 'กำหนดหมวดหมู่พัสดุ'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/view_category');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_category_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getCategoryByID($id);
            $data['category_sub'] = $this->supplie_model->getCategoryByID($data['data'][0]['category_sub']);
            $data['title'] = 'รายละเอียดกำหนดหมวดหมู่พัสดุ';
            echo view('st/view_category_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_category()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'category_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ชื่อหมวดหมู่หลัก", "ชื่อหมวดหมู่ย่อย", "รายละเอียด");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getCategoryByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $excel = [
                            'no'            => $no,
                            'id'            => $x['id'],
                            'category_name' => $x['category_name'],
                            'category_sub'  => $x['category_sub'],
                            'detail'        => $x['detail'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/setting/list_category');
    }
    // -----------------------------------------------------------------
    public function list_type()
    {
        $data['data'] = $this->supplie_model->getType();
        $data['title'] = 'กำหนดประเภท';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/list_type');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function type()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'name'         => $this->request->getPost('name'),
            ];
            $this->supplie_model->addType($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_type');
        } else {
            $data['title'] = 'เพิ่มกำหนดประเภท';
            $data['pages'] = [['link' => base_url('setting/list_type'), 'title' => 'กำหนดประเภท'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/type');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_type($id = null)
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'name'         => $this->request->getPost('name'),
            ];
            $this->supplie_model->editType($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_type');
        } else {
            $data['data'] = $this->supplie_model->getTypeByID($id);
            $data['title'] = 'เพิ่มกำหนดประเภท';
            $data['pages'] = [['link' => base_url('setting/list_type'), 'title' => 'กำหนดประเภท'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/edit_type');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_type($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteTypeByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_type');
        }
    }
    // -----------------------------------------------------------------
    public function view_type($id = null)
    {
        $data['data'] = $this->supplie_model->getTypeByID($id);
        $data['title'] = 'รายละเอียดกำหนดประเภท';
        $data['pages'] = [['link' => base_url('setting/list_type'), 'title' => 'กำหนดประเภท'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/view_type');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_type_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getTypeByID($id);
            $data['title'] = 'รายละเอียดกำหนดประเภท';
            echo view('st/view_type_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function actions_type()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'type_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ชื่อ");
                fputcsv($file, $header);
                $no = 1;

                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getTypeByID($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $excel = [
                            'no'            => $no,
                            'id'            => $x['id'],
                            'category_name' => $x['name'],
                        ];
                        fputcsv($file, $excel);
                    }
                    fclose($file);
                    $no++;
                }
                exit;
            }
        } else

            return redirect()->to('/setting/list_type');
    }
    // -----------------------------------------------------------------
    public function list_warehouse()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'warehouse_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("รหัส", "ชื่อ", "โทรศัพท์", "อีเมลล์", "ที่อยู่");
                fputcsv($file, $header);

                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getWarehouse($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $excel = [
                            'id'        => $x['id'],
                            'name'      => $x['name'],
                            'tel'       => $x['tel'],
                            'email'     => $x['email'],
                            'address'   => $x['address'],
                        ];
                        fputcsv($file, $excel);
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $data['data'] = $this->supplie_model->getWarehouse();
        $data['title'] = 'ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/list_warehouse');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function warehouse()
    {
        if ($this->request->getPost('save') != null) {
            $add = [
                'name'      => $this->request->getPost('name'),
                'tel'       => $this->request->getPost('tel'),
                'email'     => $this->request->getPost('email'),
                'address'   => $this->request->getPost('address'),
            ];

            $path = ROOTPATH . 'public/files';
            if ($this->request->getFile('map')->getpath() != "") {
                $map = $this->request->getFile('map');
                $newName = $map->getRandomName();
                // $image->move(WRITEPATH . 'uploads', $newName);
                $map->move($path, $newName);
                $add['map'] = $newName;
            }
            $this->supplie_model->addWarehouse($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_warehouse');
        } else {
            $data['title'] = 'เพิ่มตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์';
            $data['pages'] = [['link' => base_url('setting/list_warehouse'), 'title' => 'ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/warehouse');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_warehouse($id = null)
    {
        if ($id == null)
            return redirect()->to('/setting/list_warehouse');

        if ($this->request->getPost('save') != null) {
            $add = [
                'name'      => $this->request->getPost('name'),
                'tel'       => $this->request->getPost('tel'),
                'email'     => $this->request->getPost('email'),
                'address'   => $this->request->getPost('address'),
            ];

            $path = ROOTPATH . 'public/files';
            if ($this->request->getFile('map')->getpath() != "") {
                $map = $this->request->getFile('map');
                $newName = $map->getRandomName();
                // $image->move(WRITEPATH . 'uploads', $newName);
                $map->move($path, $newName);
                $add['map'] = $newName;
            }
            $this->supplie_model->editWarehouse($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_warehouse');
        } else {
            $data['data'] = $this->supplie_model->getWarehouse($id);;
            $data['title'] = 'แก้ไขตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์';
            $data['pages'] = [['link' => base_url('setting/list_warehouse'), 'title' => 'ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('st/edit_warehouse');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function delete_warehouse($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteWarehouseByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/setting/list_warehouse');
        }
    }
    // -----------------------------------------------------------------
    public function view_warehouse($id = null)
    {
        $data['data'] = $this->supplie_model->getWarehouse($id);
        $data['title'] = 'รายละเอียดตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์';
        $data['pages'] = [['link' => base_url('setting/list_warehouse'), 'title' => 'ตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('st/view_warehouse');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_warehouse_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getWarehouse($id);
            $data['title'] = 'รายละเอียดตั้งค่าคลังครุภัณฑ์/วัสดุภัณฑ์';
            echo view('st/view_warehouse_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
}
