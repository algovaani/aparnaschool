<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print-admit-card.css" /> 
<?php if ($this->customlib->getRTL() != "") { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/print-admit-card-rtl.css" />
<?php }
if (!empty($student_details)) {
    foreach ($student_details as $student_key => $student_value) {
        ?>
        <div class="mark-container">
            <div class="pagebreak">
            <?php
            if ($admitcard->background_img != "") {
            ?>
                <img src="<?php echo $this->media_storage->getImageURL('uploads/admit_card/' . $admitcard->background_img); ?>" class="tcmybg" width="100%" height="100%" />
            <?php
            }
            ?>
            <table cellpadding="0" cellspacing="0" width="100%" class="tablemain">
                
                <!-- 10cm blank space -->
                <tr><td style="height:3cm;"></td></tr>

                <?php
                if ($admitcard->exam_name) {
                ?>
                    <tr>
                        <td valign="top" style="text-align: center; text-transform: capitalize; text-decoration: underline; font-weight: bold; padding-top: 5px;"><?php echo $admitcard->exam_name; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr><td valign="top" height="10"></td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%" style="text-transform: uppercase;">
                            <tr>
                                <td valign="top">
                                    <table cellpadding="0" cellspacing="0" width="100%" >
                                        <tr>
                                            <?php
                                            if ($admitcard->is_roll_no) {
                                            ?>
                                                <td valign="top" width="25%" style="padding-bottom: 10px;"><?php echo $this->lang->line('roll_number') ?></td>
                                                <td valign="top" width="30%" style="font-weight: bold;padding-bottom: 10px;">
                                                     <?php 
                                                      echo ($exam->use_exam_roll_no)?$student_value->roll_no:$student_value->profile_roll_no; ?>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($admitcard->is_admission_no) {
                                            ?>
                                                <td valign="top" width="20%" style="padding-bottom: 10px;"><?php echo $this->lang->line('admission_no') ?></td>
                                                <td valign="top" width="25%" style="font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->admission_no; ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        if ($admitcard->is_name) {
                                        ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('candidates') . " " . $this->lang->line('name') ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $this->customlib->getFullName($student_value->firstname, $student_value->middlename, $student_value->lastname, $sch_setting->middlename, $sch_setting->lastname); ?></td>
                                                <?php
                                                if ($admitcard->is_class || $admitcard->is_section) {
                                                ?>
                                                    <td valign="top" style="padding-bottom: 10px;"> <?php echo $this->lang->line('class'); ?></td>
                                                    <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;">
                                                        <?php
                                                        if ($admitcard->is_class && $admitcard->is_section) {
                                                            echo $student_value->class . " (" . $student_value->section . ")";
                                                        } elseif ($admitcard->is_class) {
                                                            echo $student_value->class;
                                                        } elseif ($admitcard->is_section) {
                                                            echo $student_value->section;
                                                        }
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <?php
                                            if ($admitcard->is_dob) {
                                            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('d_o_b'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($student_value->dob)); ?></td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($admitcard->is_gender) {
                                            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('gender'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $this->lang->line(strtolower($student_value->gender)); ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            if ($admitcard->is_father_name) {
                                            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('father_name'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->father_name; ?></td>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($admitcard->is_mother_name) {
                                            ?>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('mother_name'); ?></td>
                                                <td valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->mother_name; ?></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        if ($admitcard->is_address) {
                                        ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('address'); ?></td>
                                                <td colspan="3" valign="top" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $student_value->current_address; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($admitcard->school_name != "") {
                                        ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('school_name') ?></td>
                                                <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->school_name; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($admitcard->exam_center != "") {
                                        ?>
                                            <tr>
                                                <td valign="top" style="padding-bottom: 10px;"><?php echo $this->lang->line('exam_center'); ?></td>
                                                <td valign="top" colspan="3" style="text-transform: uppercase; font-weight: bold;padding-bottom: 10px;"><?php echo $admitcard->exam_center; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </td>
                                <?php
                                if ($admitcard->is_photo) {
                                ?>
                                    <td valign="top" width="25%" class="photo-align">
                                        <?php
                                        if ($student_value->image != '') {
                                        ?>
                                            <img src="<?php echo  $this->media_storage->getImageURL($student_value->image); ?>" width="100" height="130" style="border: 2px solid #fff; outline: 1px solid #000000;">
                                        <?php } ?>
                                    </td>
                                <?php
                                }
                                ?>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td valign="top" height="10"></td></tr>
                <tr>
                    <td valign="top">
                        <table cellpadding="0" cellspacing="0" width="100%" class="denifittable">
                            <tr>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('theory_exam_date_time'); ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('paper_code') ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('subject'); ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo $this->lang->line('obtained_by_student') ?></th>
                                <th valign="top" style="text-align: center; text-transform: uppercase;"><?php echo 'Invigilator Sign' ?></th>
                            </tr>
                            <?php
                            foreach ($exam_subjects as $subject_key => $subject_value) {
                            ?>
                                <tr>
                                    <td valign="top" style="text-align: center;"><?php echo date($this->customlib->getSchoolDateFormat(), strtotime($subject_value->date_from)) . " " . $subject_value->time_from; ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_code; ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_name; ?></td>
                                    <td style="text-align: center;text-transform: uppercase;"><?php echo $subject_value->subject_type; ?></td>
                                     <td style="text-align: center; text-transform: uppercase;">________________</td>

                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr><td valign="top" height="5"></td></tr>
                <?php
                if ($admitcard->content_footer != "") {
                ?>
                    <tr>
                        <td valign="top" style="padding-bottom: 15px; line-height: normal;"> <?php echo htmlspecialchars_decode($admitcard->content_footer); ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr><td valign="top" height="20px"></td></tr>
               <?php
if ($admitcard->sign != "") {
?>
    <tr>
        <td align="right" valign="top" style="padding-right: 30px;">
            <img src="<?php echo  $this->media_storage->getImageURL('uploads/admit_card/' . $admitcard->sign); ?>" 
                 width="100" height="38" />
        </td>
    </tr>
<?php
}
?>
            </table>
              </div>
        </div>
        <?php
    }
}
?>
<script type="text/javascript">
window.pagebreak();
</script>
