<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Mpdf\Mpdf;
use CodeIgniter\HTTP\Files\UploadedFile;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


class Purchase extends Controller
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

    public function report_form_purchase($id = null)
    {
        require_once APPPATH . '/ThirdParty/dompdf/lib/Cpdf.php';
        if ($id != null) {
            $data['data'] = $this->supplie_model->getFormpurchase($id);
            $data['title'] = 'ใบสั่งซื้อสั่งจ้าง';
            $mpdf = new \Mpdf\Mpdf(array('mode' => 'utf-8', 'default_font' => 'Garuda'));
            // $mpdf->showImageErrors = true;
            // $mpdf->Image(base_url('files/barcode.jpg'), 0, 0, 210, 297, 'jpg', '', true, false);
            $mpdf->Image('files/barcode.jpg', 0, 0, 210, 297, 'jpg', '', true, false);

            $html = view('pc/report_form_purchase', $data);
            $filename = 'report_form_purchase_' . date("Y_m_d_H_i_s") . '.pdf';
            $mpdf->WriteHTML($html);
            return redirect()->to($mpdf->Output($filename, 'I'));
        } else
            return redirect()->to('/purchase/list_form_purchase');
    }
    // -----------------------------------------------------------------
    public function list_form_purchase()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'form_purchase_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("รหัส", "ผู้ขาย/ผู้รับจ้าง", "ใบสั่งซื้อ/สั่งจ้าง", "ที่อยู่", "ซอย", "วันที่", "ถนน", "ตำบล", "อำเภอ", "จังหวัด", "รหัสไปรษณีย์", "ที่อยู่", "หมู่ที่", "ซอย", "โทรศัพท์", "ถนน", "ตำบล", "อำเภอ", "เลขที่ประจำตัวผู้เสียภาษี", "จังหวัด", "รหัสไปรษณีย์", "เลขที่บัญชีเงินฝากธนาคาร", "โทรศัพท์", "ชื่อบัญชี", "ธนาคาร", "สาขา", "อื่นๆ", "รายละเอียด", "รายการ", "ราคาหน่วย (บาท/สตางค์)", "จำนวนเงิน (บาท/สตางค์)", "ราคาก่อนรวมภาษีมูลค่าเพิ่ม", "ภาษีมูลค่าเพิ่ม 7%", "รวมเป็นเงินทั้งสิ้น");
                fputcsv($file, $header);
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getFormpurchase($id);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $excel = [
                            'id'                    => $x['id'],
                            'seller_name'           => $x['seller_name'],
                            'purchase_order'        => 'PO-' . $x['purchase_order1'] . '/' . $x['purchase_order2'],
                            'house_no'              => $x['house_no'],
                            'alley'                 => $x['alley'],
                            'date'                  => date('d/m/Y', strtotime($x['date'])),
                            'road'                  => $x['road'],
                            'sub_district'          => $x['sub_district'],
                            'district'              => $x['district'],
                            'province'              => $x['province'],
                            'postal_code'           => $x['postal_code'],
                            'house_no2'             => $x['house_no2'],
                            'swine2'                => $x['swine2'],
                            'alley2'                => $x['alley2'],
                            'tel'                   => "=\"" . $x["tel"] . "\"",
                            'road2'                 => $x['road2'],
                            'sub_district2'         => $x['sub_district2'],
                            'district2'             => $x['district2'],
                            'taxpayer_id'           => $x['taxpayer_id'],
                            'province2'             => $x['province2'],
                            'postal_code2'          => $x['postal_code2'],
                            'bank_account_number'   => $x['bank_account_number'],
                            'tel2'                  => "=\"" . $x["tel2"] . "\"",
                            'account_name'          => $x['account_name'],
                            'bank_number'           => $x['bank_number'],
                            'bank_branch'           => $x['bank_branch'],
                            'other'                 => strip_tags($x['other']),
                            'detail'                => strip_tags($x['detail']),
                            'list'                  => $x['list'],
                            'unit_price'            => $x['unit_price'],
                            'amount'                => $x['amount'],
                            'before_vat'            => $x['before_vat'],
                            'vat'                   => $x['vat'],
                            'total'                 => $x['total'],
                        ];
                        fputcsv($file, $excel);
                    }
                    fclose($file);
                }
                exit;
            }
        }
        $from   = $this->request->getPost('datepicker_from') ? $this->request->getPost('datepicker_from') : null;
        $to     = $this->request->getPost('datepicker_to') ? $this->request->getPost('datepicker_to') : null;


        $data['data'] = $this->supplie_model->getFormpurchase(null, $from, $to);
        // $data['data'] = $this->supplie_model->getFormpurchase();
        $data['title'] = 'รายการสั่งซื้อสั่งจ้าง';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/list_form_purchase');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function form_purchase()
    {
        if ($this->request->getPost('save') != null) {

            $add = [
                'seller_name'           => $this->request->getPost('seller_name'),
                'purchase_order1'       => $this->request->getPost('purchase_order1'),
                'purchase_order2'       => $this->request->getPost('purchase_order2'),
                'house_no'              => $this->request->getPost('house_no'),
                'alley'                 => $this->request->getPost('alley'),
                'date'                  => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'road'                  => $this->request->getPost('road'),
                'sub_district'          => $this->request->getPost('sub_district'),
                'district'              => $this->request->getPost('district'),
                'province'              => $this->request->getPost('province'),
                'house_no2'             => $this->request->getPost('house_no2'),
                'road2'                 => $this->request->getPost('road2'),
                'swine2'                => $this->request->getPost('swine2'),
                'alley2'                => $this->request->getPost('alley2'),
                'tel'                   => $this->request->getPost('tel'),
                'sub_district2'         => $this->request->getPost('sub_district2'),
                'district2'             => $this->request->getPost('district2'),
                'taxpayer_id'           => $this->request->getPost('taxpayer_id'),
                'province2'             => $this->request->getPost('province2'),
                'bank_account_number'   => $this->request->getPost('bank_account_number'),
                'tel2'                  => $this->request->getPost('tel2'),
                'account_name'          => $this->request->getPost('account_name'),
                'bank_number'           => $this->request->getPost('bank_number'),
                'bank_branch'           => $this->request->getPost('bank_branch'),
                'other'                 => $this->request->getPost('other'),
                'detail'                => $this->request->getPost('detail'),
                'list'                  => $this->request->getPost('list'),
                'unit_price'            => $this->request->getPost('unit_price') ? (float)str_replace(",", "", $this->request->getPost('unit_price')) : 0,
                'amount'                => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
                'before_vat'            => $this->request->getPost('before_vat') ? (float)str_replace(",", "", $this->request->getPost('before_vat')) : 0,
                'vat'                   => $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
                'total'                 => $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
                'postal_code'           => $this->request->getPost('postal_code'),
                'postal_code2'          => $this->request->getPost('postal_code2'),
                'fiscal_year'           => $this->request->getPost('fiscal_year'),
            ];
            $path = ROOTPATH . 'public/files/form_purchase_files';

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
            $this->supplie_model->addFormpurchase($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_form_purchase');
        } else {
            $data['title'] = 'สร้างแบบฟอร์มสั่งซื้อสั่งจ้าง';
            $data['pages'] = [['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/form_purchase');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_form_purchase($id = null)
    {
        if ($id == null)
            return redirect()->to('/purchase/list_form_purchase');
        if ($this->request->getPost('save') != null) {
            $add = [
                'seller_name'           => $this->request->getPost('seller_name'),
                'purchase_order1'       => $this->request->getPost('purchase_order1'),
                'purchase_order2'       => $this->request->getPost('purchase_order2'),
                'house_no'              => $this->request->getPost('house_no'),
                'alley'                 => $this->request->getPost('alley'),
                'date'                  => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'road'                  => $this->request->getPost('road'),
                'sub_district'          => $this->request->getPost('sub_district'),
                'district'              => $this->request->getPost('district'),
                'province'              => $this->request->getPost('province'),
                'house_no2'             => $this->request->getPost('house_no2'),
                'road2'                  => $this->request->getPost('road2'),
                'swine2'                => $this->request->getPost('swine2'),
                'alley2'                => $this->request->getPost('alley2'),
                'tel'                   => $this->request->getPost('tel'),
                'sub_district2'         => $this->request->getPost('sub_district2'),
                'district2'             => $this->request->getPost('district2'),
                'taxpayer_id'           => $this->request->getPost('taxpayer_id'),
                'province2'             => $this->request->getPost('province2'),
                'bank_account_number'   => $this->request->getPost('bank_account_number'),
                'tel2'                  => $this->request->getPost('tel2'),
                'account_name'          => $this->request->getPost('account_name'),
                'bank_number'           => $this->request->getPost('bank_number'),
                'bank_branch'           => $this->request->getPost('bank_branch'),
                'other'                 => $this->request->getPost('other'),
                'detail'                => $this->request->getPost('detail'),
                'list'                  => $this->request->getPost('list'),
                'unit_price'            => $this->request->getPost('unit_price') ? (float)str_replace(",", "", $this->request->getPost('unit_price')) : 0,
                'amount'                => $this->request->getPost('amount') ? (float)str_replace(",", "", $this->request->getPost('amount')) : 0,
                'before_vat'            => $this->request->getPost('before_vat') ? (float)str_replace(",", "", $this->request->getPost('before_vat')) : 0,
                'vat'                   => $this->request->getPost('vat') ? (float)str_replace(",", "", $this->request->getPost('vat')) : 0,
                'total'                 => $this->request->getPost('total') ? (float)str_replace(",", "", $this->request->getPost('total')) : 0,
                'postal_code'           => $this->request->getPost('postal_code'),
                'postal_code2'          => $this->request->getPost('postal_code2'),
                'fiscal_year'           => $this->request->getPost('fiscal_year'),
            ];
            $path = ROOTPATH . 'public/files/form_purchase_files';

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
            $this->supplie_model->editFormpurchase($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_form_purchase');
        } else {
            $data['data'] = $this->supplie_model->getFormpurchase($id);
            $data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
            $data['title'] = 'แก้ไขแบบฟอร์มสั่งซื้อสั่งจ้าง';
            $data['pages'] = [['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/edit_form_purchase');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_form_purchase($id = null)
    {
        $data['data'] = $this->supplie_model->getFormpurchase($id);
        $data['title'] = 'รายละเอียดแบบฟอร์มสั่งซื้อสั่งจ้าง';
        $data['pages'] = [['link' => base_url('purchase/list_form_purchase'), 'title' => 'ใบขอซื้อพัสดุทั้งหมด(PR)'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/view_form_purchase');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_form_purchase_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getFormpurchase($id);
            $data['title'] = 'รายละเอียดแบบฟอร์มสั่งซื้อสั่งจ้าง';
            echo view('pc/view_form_purchase_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function delete_form_purchase($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteFormpurchaseByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_form_purchase');
        }
    }
    // -----------------------------------------------------------------
    public function list_buy_supplies()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'buy_supplies_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้ขอซื้อ", "แผนก/ฝ่าย", "เลขที่", "วันที่", "ประเภท", "ผู้จัดจำหน่าย", "ใบสั่ง ภาษี", "ส่วนลด", "ประเภทการซ่อม", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getBuySuppliesByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $ar = ['1' => 'วัสดุสิ้นเปลือง', '2' => 'สินทรัพย์', '3' => 'วัตถุดิบ', '4' => 'อื่นๆ: ' . $x['type_detail']];
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'employees_id'        => $x['employees_id'],
                            'department'        => $x['department'],
                            'reference'            => $x['reference'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ar[$x['type_id']],
                            'biller_id'            => $x['distributor'],
                            'tax_invoice_id'    => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'                => strip_tags($x['note']),
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


        $data['data'] = $this->supplie_model->getBuySupplies($from, $to);
        // $data['data'] = $this->supplie_model->getBuySupplies();
        $data['title'] = 'ใบขอซื้อพัสดุทั้งหมด(PR)';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/list_buy_supplies');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function buy_supplies()
    {
        if ($this->request->getPost('save') != null) {

            $add = [
                'employees_id'      => $this->request->getPost('employees_id'),
                'department'        => $this->request->getPost('department'),
                'reference'         => $this->request->getPost('reference'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                // 'type_detail'       => $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null,
                // 'biller_id'         => $this->request->getPost('biller_id') ? $this->request->getPost('biller_id') : 1,
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'distributor'       => $this->request->getPost('distributor'),
                'order_status'      => $this->request->getPost('order_status'),
                'payment_status'    => $this->request->getPost('payment_status'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
            ];

            if ($add['type_id'] == 4) {
                $add['type_detail'] = $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null;
            }
            $this->supplie_model->addBuySupplies($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_buy_supplies');
        } else {
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'สร้างใบขอซื้อพัสดุ';
            $data['pages'] = [['link' => base_url('purchase/list_buy_supplies'), 'title' => 'ใบขอซื้อพัสดุทั้งหมด(PR)'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/buy_supplies');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_buy_supplies($id = null)
    {
        if ($this->request->getPost('save') != null) {

            $add = [
                'employees_id'      => $this->request->getPost('employees_id'),
                'department'        => $this->request->getPost('department'),
                'reference'         => $this->request->getPost('reference'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                // 'type_detail'       => $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null,
                // 'biller_id'         => $this->request->getPost('biller_id') ? $this->request->getPost('biller_id') : 1,
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'distributor'       => $this->request->getPost('distributor'),
                'order_status'      => $this->request->getPost('order_status'),
                'payment_status'    => $this->request->getPost('payment_status'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
            ];
            if ($add['type_id'] == 4) {
                $add['type_detail'] = $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null;
            }

            $this->supplie_model->editBuySupplies($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_buy_supplies');
        } else {
            $data['data'] = $this->supplie_model->getBuySuppliesByID($id);
            $data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'แก้ไขใบขอซื้อพัสดุ';
            $data['pages'] = [['link' => base_url('purchase/list_buy_supplies'), 'title' => 'ใบขอซื้อพัสดุทั้งหมด(PR)'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/edit_buy_supplies');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_buy_supplies($id = null)
    {
        $data['data'] = $this->supplie_model->getBuySuppliesByID($id);
        $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
        $data['title'] = 'รายละเอียดใบขอซื้อพัสดุ';
        $data['pages'] = [['link' => base_url('purchase/list_buy_supplies'), 'title' => 'ใบขอซื้อพัสดุทั้งหมด(PR)'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/view_buy_supplies');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_buy_supplies_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getBuySuppliesByID($id);
            $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
            $data['title'] = 'รายละเอียดใบขอซื้อพัสดุ';
            echo view('pc/view_buy_supplies_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function delete_buy_supplies($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deleteBuySuppliesByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_buy_supplies');
        }
    }
    // -----------------------------------------------------------------
    public function actions_buy_supplies()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'buy_supplies_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้ขอซื้อ", "แผนก/ฝ่าย", "เลขที่", "วันที่", "ประเภท", "ผู้จัดจำหน่าย", "ใบสั่ง ภาษี", "ส่วนลด", "ประเภทการซ่อม", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getBuySuppliesByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $ar = ['1' => 'วัสดุสิ้นเปลือง', '2' => 'สินทรัพย์', '3' => 'วัตถุดิบ', '4' => 'อื่นๆ: ' . $x['type_detail']];
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'employees_id'        => $x['employees_id'],
                            'department'        => $x['department'],
                            'reference'            => $x['reference'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ar[$x['type_id']],
                            'biller_id'            => $x['biller_id'],
                            'tax_invoice_id'    => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'                => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/purchase/list_buy_supplies');
    }
    // -----------------------------------------------------------------
    public function list_purchase()
    {
        $data['data'] = $this->supplie_model->getPurchase();
        $data['title'] = 'รายการจัดซื้อจัดจ้างทั้งหมด (PO)';
        $data['pages'] = [['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/list_purchase');
        echo view('footer');
    }
    // -----------------------------------------------------------------
    public function purchase()
    {
        if ($this->request->getPost('save') != null) {

            $add = [
                'employees_id'      => $this->request->getPost('employees_id'),
                'department'        => $this->request->getPost('department'),
                'reference'         => $this->request->getPost('reference'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                // 'type_detail'       => $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null,
                'biller_id'         => $this->request->getPost('biller_id') ? $this->request->getPost('biller_id') : 1,
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'distributor'       => $this->request->getPost('distributor'),
                'order_status'      => $this->request->getPost('order_status'),
                'payment_status'    => $this->request->getPost('payment_status'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
            ];

            if ($add['type_id'] == 4) {
                $add['type_detail'] = $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null;
            }
            $this->supplie_model->addPurchase($add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_purchase');
        } else {
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'สร้างการจัดซื้อจัดจ้าง';
            $data['pages'] = [['link' => base_url('purchase/list_purchase'), 'title' => 'รายการจัดซื้อจัดจ้างทั้งหมด (PO)'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/purchase');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function edit_purchase($id = null)
    {
        if ($this->request->getPost('save') != null) {

            $add = [
                'employees_id'      => $this->request->getPost('employees_id'),
                'department'        => $this->request->getPost('department'),
                'reference'         => $this->request->getPost('reference'),
                'date'              => Date('Y-m-d', strtotime(str_replace('/', '-', $this->request->getPost('date')))),
                'type_id'           => $this->request->getPost('type_id'),
                // 'type_detail'       => $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null,
                'biller_id'         => $this->request->getPost('biller_id') ? $this->request->getPost('biller_id') : 1,
                'tax_invoice_id'    => $this->request->getPost('tax_invoice_id'),
                'discount'          => $this->request->getPost('discount') ? $this->request->getPost('discount') : 0,
                'type_maintenance'  => $this->request->getPost('type_maintenance'),
                'distributor'       => $this->request->getPost('distributor'),
                'order_status'      => $this->request->getPost('order_status'),
                'payment_status'    => $this->request->getPost('payment_status'),
                'payment_term'      => $this->request->getPost('payment_term'),
                'note'              => $this->request->getPost('note'),
            ];
            if ($add['type_id'] == 4) {
                $add['type_detail'] = $this->request->getPost('type_detail') ? $this->request->getPost('type_detail') : null;
            }

            $this->supplie_model->editPurchase($id, $add);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_purchase');
        } else {
            $data['data'] = $this->supplie_model->getPurchaseByID($id);
            $data['data'][0]['date'] = Date('d/m/Y', strtotime($data['data'][0]['date']));
            $data['tax'] = $this->supplie_model->getTaxRate();
            $data['title'] = 'แก้ไขการจัดซื้อจัดจ้าง';
            $data['pages'] = [['link' => base_url('purchase/list_purchase'), 'title' => 'รายการจัดซื้อจัดจ้างทั้งหมด (PO)'], ['link' => '#', 'title' => $data['title']]];
            echo view('header', $data);
            echo view('pc/edit_purchase');
            echo view('footer');
        }
    }
    // -----------------------------------------------------------------
    public function view_purchase($id = null)
    {
        $data['data'] = $this->supplie_model->getPurchaseByID($id);
        $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
        $data['title'] = 'รายละเอียดการจัดซื้อจัดจ้าง';
        $data['pages'] = [['link' => base_url('purchase/list_purchase'), 'title' => 'รายการจัดซื้อจัดจ้างทั้งหมด (PO)'], ['link' => '#', 'title' => $data['title']]];
        echo view('header', $data);
        echo view('pc/view_purchase');
        echo view('footer');
    }
    // -----------------------------------------------------------------

    public function view_purchase_id($id = null)
    {
        if ($id != null) {
            $data['data'] = $this->supplie_model->getPurchaseByID($id);
            $data['tax'] = $this->supplie_model->getTaxRateByID($data['data'][0]['tax_invoice_id']);
            $data['title'] = 'รายละเอียดการจัดซื้อจัดจ้าง';
            echo view('pc/view_purchase_id', $data);
        } else {
            echo 'no data';
        }
    }
    // -----------------------------------------------------------------
    public function delete_purchase($id = null)
    {
        if ($id == null)
            return false;
        else {
            $this->supplie_model->deletePurchaseByID($id);
            $this->supplie_model->addLog(1);
            return redirect()->to('/purchase/list_purchase');
        }
    }
    // -----------------------------------------------------------------
    public function actions_purchase()
    {
        if (!empty($_POST['val'])) {

            if ($this->request->getPost('excell_x')) {
                // var_dump($_POST['val']);
                // file name 
                $filename = 'purchase_' . date('Y_m_d_H_i_s') . '.csv';
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/csv; ");
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                $header = array("ลำดับ", "รหัส", "ผู้ขอซื้อ", "แผนก", "เลขที่", "วันที่", "ประเภท", "ผู้จัดจำหน่าย", "ใบสั่ง ภาษี", "ส่วนลด", "ประเภทการซ่อม", "Payment term", "อื่นๆ");
                fputcsv($file, $header);
                $no = 1;
                foreach ($_POST['val'] as $id) {
                    // get data 
                    $data = $this->supplie_model->getPurchaseByID($id);
                    $tax = $this->supplie_model->getTaxRateByID($data[0]['tax_invoice_id']);

                    // file creation 
                    $file = fopen('php://output', 'w');
                    fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF)));
                    foreach ($data as $x) {
                        $ar = ['1' => 'วัสดุสิ้นเปลือง', '2' => 'สินทรัพย์', '3' => 'วัตถุดิบ', '4' => 'อื่นๆ: ' . $x['type_detail']];
                        $excel = [
                            'no'                => $no,
                            'id'                => $x['id'],
                            'employees_id'        => $x['employees_id'],
                            'department'        => $x['department'],
                            'reference'            => $x['reference'],
                            'date'              => date('d/m/Y', strtotime($x['date'])),
                            'type_id'           => $ar[$x['type_id']],
                            'biller_id'            => $x['biller_id'],
                            'tax_invoice_id'    => $tax[0]['name'],
                            'discount'          => $x['discount'],
                            'type_maintenance'  => $x['type_maintenance'],
                            'payment_term'      => $x['payment_term'],
                            'note'                => $x['note'],
                        ];
                        fputcsv($file, $excel);
                        $no++;
                    }
                    fclose($file);
                }
                exit;
            }
        } else

            return redirect()->to('/purchase/list_purchase');
    }
    // -----------------------------------------------------------------
}
