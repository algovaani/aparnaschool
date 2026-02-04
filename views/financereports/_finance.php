<!-- finance.php modern redesign -->

<meta name="viewport" content="width=device-width, initial-scale=1">

<div class="finance-wrapper">
    <div class="finance-header">
        <h3>
            <i class="fa fa-search"></i> <?php echo $this->lang->line('finance') ?>
        </h3>
        <span class="criteria-badge">
            <?php echo $this->lang->line('select_criteria'); ?>
        </span>
    </div>

    <div class="finance-body">
        <?php
        $solid_colors = [
            "#ff6f61", "#f06292", "#9575cd", "#64b5f6", "#4dd0e1", "#4db6ac",
            "#81c784", "#aed581", "#dce775", "#ffd54f", "#ffb74d", "#a1887f",
            "#90a4ae", "#26c6da", "#7e57c2", "#00897b", "#f9a825"
        ];
        $tabs = [];
        $i = 0;

        if ($this->rbac->hasPrivilege('balance_fees_statement', 'can_view')) {
            $tabs[] = [
                'url' => site_url('financereports/reportduefees'),
                'label' => $this->lang->line('balance_fees_statement'),
                'class' => set_SubSubmenu('Reports/finance/reportduefees'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('daily_collection_report', 'can_view')) {
            $tabs[] = [
                'url' => site_url('financereports/reportdailycollection'),
                'label' => $this->lang->line('daily_collection_report'),
                'class' => set_SubSubmenu('Reports/finance/reportdailycollection'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/reportbyname'),
                'label' => $this->lang->line('fees_statement'),
                'class' => set_SubSubmenu('Reports/finance/reportbyname'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('balance_fees_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/studentacademicreport'),
                'label' => $this->lang->line('balance_fees_report'),
                'class' => set_SubSubmenu('Reports/finance/studentacademicreport'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('fees_collection_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/collection_report'),
                'label' => $this->lang->line('fees_collection_report'),
                'class' => set_SubSubmenu('Reports/finance/collection_report'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('online_fees_collection_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/onlinefees_report'),
                'label' => $this->lang->line('online_fees_collection_report'),
                'class' => set_SubSubmenu('Reports/finance/onlinefees_report'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('balance_fees_report_with_remark', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/duefeesremark'),
                'label' => $this->lang->line('balance_fees_report_with_remark'),
                'class' => set_SubSubmenu('Reports/finance/duefeesremark'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('income_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/income'),
                'label' => $this->lang->line('income_report'),
                'class' => set_SubSubmenu('Reports/finance/income'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('expense_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/expense'),
                'label' => $this->lang->line('expense_report'),
                'class' => set_SubSubmenu('Reports/finance/expense'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('payroll_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/payroll'),
                'label' => $this->lang->line('payroll_report'),
                'class' => set_SubSubmenu('Reports/finance/payroll'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('income_group_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/incomegroup'),
                'label' => $this->lang->line('income_group_report'),
                'class' => set_SubSubmenu('Reports/finance/incomegroup'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('expense_group_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/expensegroup'),
                'label' => $this->lang->line('expense_group_report'),
                'class' => set_SubSubmenu('Reports/finance/expensegroup'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }
        if ($this->rbac->hasPrivilege('online_admission', 'can_view')) {
            $tabs[] = [
                'url' => base_url('financereports/onlineadmission'),
                'label' => $this->lang->line('online_admission_fees_collection_report'),
                'class' => set_SubSubmenu('Reports/finance/onlineadmission'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }

        $tabs[] = [
            'url' => base_url('financereports/incomeexpensebalancereport'),
            'label' => $this->lang->line('income_expense_balance_report'),
            'class' => set_SubSubmenu('Reports/finance/incomeexpensebalancereport'),
            'color' => $solid_colors[$i++ % count($solid_colors)],
        ];

        if ($this->rbac->hasPrivilege('income_report', 'can_view')) {
            $tabs[] = [
                'url' => base_url('feestatus'),
                'label' => 'Fee Details Report',
                'class' => set_SubSubmenu('Feestatus'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
            $tabs[] = [
                'url' => base_url('feestatusunpaid'),
                'label' => 'Unpaid Fees',
                'class' => set_SubSubmenu('Feestatusunpaid'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
            $tabs[] = [
                'url' => base_url('feestatuspaid'),
                'label' => 'Paid Fees',
                'class' => set_SubSubmenu('Feestatuspaid'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
            $tabs[] = [
                'url' => base_url('feestatusassign'),
                'label' => 'Total Assign Fees',
                'class' => set_SubSubmenu('Feestatusassign'),
                'color' => $solid_colors[$i++ % count($solid_colors)],
            ];
        }

        echo '<ul class="finance-grid">';
        foreach ($tabs as $tab) {
            echo '<li class="finance-card '.$tab['class'].'" style="background:'.$tab['color'].';">
                    <a href="'.$tab['url'].'">
                        <i class="fa fa-file-text-o"></i>
                        <span>'.$tab['label'].'</span>
                    </a>
                  </li>';
        }
        echo '</ul>';
        ?>
    </div>
</div>

<style>
.finance-wrapper {
    background: linear-gradient(135deg, #f9f9f9 0%, #eef2f3 100%);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.finance-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    padding: 18px 25px;
    border-radius: 16px;
    color: #fff;
    font-family: 'Montserrat', sans-serif;
}

.finance-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
}

.criteria-badge {
    background: rgba(255,255,255,0.15);
    padding: 8px 18px;
    border-radius: 14px;
    font-weight: 600;
    backdrop-filter: blur(4px);
}

.finance-body {
    margin-top: 20px;
}

.finance-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
    gap: 14px;
    list-style: none;
    padding: 0;
}

.finance-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    border-radius: 14px;
    color: #fff;
    font-weight: 600;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.finance-card a {
    color: inherit;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 10px;
    width: 100%;
}

.finance-card i {
    font-size: 1.4rem;
}

.finance-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.25);
}

.finance-card span {
    flex: 1;
    font-size: 1rem;
}

/* Responsive tweaks */
@media (max-width: 600px) {
    .finance-header {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
}
</style>
