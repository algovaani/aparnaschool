<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Transfercertificate extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Customlib');
        $this->sch_setting_detail = $this->setting_model->getSetting();
    }

    /**
     * Download transfer certificate as PDF
     * URL: admin/transfercertificate/download/student_id/class_id/certificate_id
     */
    public function download()
    {
        if (!$this->rbac->hasPrivilege('generate_certificate', 'can_view') && !$this->rbac->hasPrivilege('student_certificate', 'can_view')) {
            access_denied();
        }

        $student_id    = $this->uri->segment(4);
        $class_id      = $this->uri->segment(5);
        $certificate_id = $this->uri->segment(6);

        if (empty($student_id) || empty($class_id) || empty($certificate_id)) {
            redirect('admin/generatecertificate');
            return;
        }

        $certificateResult = $this->Generatecertificate_model->getcertificatebyid($certificate_id);
        $resultlist        = $this->student_model->searchByClassStudent($class_id, $student_id);

        if (empty($certificateResult) || empty($resultlist)) {
            show_404();
            return;
        }

        $data['certificateResult'] = $certificateResult;
        $data['resultlist']        = $resultlist;
        $html                      = $this->load->view('admin/certificate/transfercertificate', $data, true);

        $pdfFilePath = 'TransferCertificate_' . $student_id . '_' . time() . '.pdf';
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, 'D');
    }
}
