<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="student-info-wrapper">
    <div class="student-info-header">
        <h3>
            <i class="fa fa-search"></i> <?php echo $this->lang->line('student_information_report'); ?>
        </h3>
    </div>

    <div class="student-info-body">
        <ul class="student-info-grid">
            <?php 
            // Modern gradient palette
            $gradients = [
                ["bg" => "linear-gradient(135deg, #4facfe, #00f2fe)", "text" => "light"],
                ["bg" => "linear-gradient(135deg, #43e97b, #38f9d7)", "text" => "dark"],
                ["bg" => "linear-gradient(135deg, #ff9a9e, #fecfef)", "text" => "dark"],
                ["bg" => "linear-gradient(135deg, #f6d365, #fda085)", "text" => "dark"],
                ["bg" => "linear-gradient(135deg, #a1c4fd, #c2e9fb)", "text" => "dark"],
                ["bg" => "linear-gradient(135deg, #84fab0, #8fd3f4)", "text" => "dark"],
                ["bg" => "linear-gradient(135deg, #fccb90, #d57eeb)", "text" => "light"],
                ["bg" => "linear-gradient(135deg, #e0c3fc, #8ec5fc)", "text" => "dark"],
            ];
            $g = 0;

            function studentCard($url, $label, $class, $gradients, &$g) {
                $bg = $gradients[$g % count($gradients)]['bg'];
                $textClass = $gradients[$g % count($gradients)]['text'] === 'light' ? 'light-text' : 'dark-text';
                $g++;
                echo '<li class="'.$class.' '.$textClass.'" style="background:'.$bg.';">
                        <a href="'.$url.'">
                            <i class="fa fa-file-text-o"></i>
                            <span>'.$label.'</span>
                        </a>
                      </li>';
            }

            if ($this->rbac->hasPrivilege('student_report', 'can_view')) {
                studentCard(base_url().'report/studentreport', $this->lang->line('student_report'), set_SubSubmenu('Reports/student_information/student_report'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('class_section_report', 'can_view')) {
                studentCard(site_url('report/classsectionreport'), $this->lang->line('class_section_report'), set_SubSubmenu('Reports/student_information/classsectionreport'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('guardian_report', 'can_view')) {
                studentCard(base_url().'report/guardianreport', $this->lang->line('guardian_report'), set_SubSubmenu('Reports/student_information/guardian_report'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('student_history', 'can_view')) {
                studentCard(base_url().'report/admissionreport', $this->lang->line('student_history'), set_SubSubmenu('Reports/student_information/student_history'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('student_login_credential_report', 'can_view')) {
                studentCard(base_url().'report/logindetailreport', $this->lang->line('student_login_credential'), set_SubSubmenu('Reports/student_information/student_login_credential'), $gradients, $g);
                studentCard(base_url().'report/parentlogindetailreport', $this->lang->line('parent_login_credential'), set_SubSubmenu('Reports/student_information/parent_login_credential'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('class_subject_report', 'can_view')) {
                studentCard(base_url().'report/class_subject', $this->lang->line('class_subject_report'), set_SubSubmenu('Reports/student_information/class_subject_report'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('admission_report', 'can_view')) {
                studentCard(base_url().'report/admission_report', $this->lang->line('admission_report'), set_SubSubmenu('Reports/student_information/admission_report'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('sibling_report', 'can_view')) {
                studentCard(base_url().'report/sibling_report', $this->lang->line('sibling_report'), set_SubSubmenu('Reports/student_information/sibling_report'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('student_profile', 'can_view')) {
                studentCard(base_url().'report/student_profile', $this->lang->line('student_profile'), set_SubSubmenu('Reports/student_information/student_profile'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('student_gender_ratio_report', 'can_view')) {
                studentCard(base_url().'report/boys_girls_ratio', $this->lang->line('student_gender_ratio_report'), set_SubSubmenu('Reports/student_information/boys_girls_ratio'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('student_teacher_ratio_report', 'can_view')) {
                studentCard(base_url().'report/student_teacher_ratio', $this->lang->line('student_teacher_ratio_report'), set_SubSubmenu('Reports/student_information/student_teacher_ratio'), $gradients, $g);
            }
            if ($this->rbac->hasPrivilege('online_admission_report', 'can_view')) {
                studentCard(base_url().'report/online_admission_report', $this->lang->line('online_admission_report'), set_SubSubmenu('Reports/online_admission'), $gradients, $g);
            }
            ?>
        </ul>
    </div>
</div>

<style>
.student-info-wrapper {
    background: #f7f9fc;
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
}

.student-info-header {
    background: linear-gradient(90deg, #0072ff, #00c6ff);
    padding: 15px 20px;
    border-radius: 14px;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
    margin-bottom: 20px;
}

.student-info-header h3 {
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
}

.student-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 14px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.student-info-grid li {
    border-radius: 14px;
    padding: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    backdrop-filter: blur(6px);
}

.student-info-grid li a {
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.student-info-grid li i {
    font-size: 1.3rem;
}

/* Text colours based on background brightness */
.light-text {
    color: #fff;
}
.light-text a {
    color: #fff;
}
.dark-text {
    color: #222;
}
.dark-text a {
    color: #222;
}

.student-info-grid li:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 0 8px 18px rgba(0,0,0,0.18);
}

@media (max-width: 600px) {
    .student-info-header {
        text-align: center;
    }
}
</style>
