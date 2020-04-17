<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
require_once 'func/functions.php';
require_once 'func/payslipCalculations.php';

    $payslip_id = filter_input(INPUT_GET, 'payslip_id', FILTER_VALIDATE_INT);
    $company_id = 1;

    $db = getDbInstance();
    $db->where('id', $payslip_id);    
    $payslipDetail = $db->getOne("payslips");

    $internship = getRowOnEditPayslip($payslip_id, 'internship_details');
    $candidate = getRowOnEditPayslip($payslip_id, 'candidates');
    $internship = getRowOnEditPayslip($payslip_id, 'internship_details');
    $bankAccount = getRowOnEditPayslip($payslip_id, 'bank_account');  
    $companyDetails = getCompanyDetailsRowOnEdit($company_id, 'business_infomation'); 

    $id_number = $candidate['id_number']; 

?>

<?php
    include_once 'includes/header.php';
?>
<div id="page-wrapper">
    <div class="row">
        <br>
        <div id="title" align="center">Payslip</div>
    </div>

<!-- Candididate Details & Company Details on top -->    
    <div id="scope">
        <div>
            <div class="value" align="left"><b><?php echo $candidate['first_names'] ." ". $candidate['last_name'] ?> </b></div>
            <div class="value" align="left"><i>ID Number : </i><?php echo $candidate['id_number'] ?></div>
            <div class="value" align="left"><i>Cadidate No : </i> <?php echo $candidate['id'] ?></div>
            <div class="value" align="left"><i>Address:</i></div>
            <div class="value" align="left"><?php echo $candidate['candidate_address'] ?></div>
            <div class="value" align="left">‭<i>Phone:</i> <?php echo $candidate['phone'] ?></div>
            <div class="value" align="left"><i>‭Email:</i> <?php echo $candidate['email'] ?></div>
        </div>
        <div class="contributions">
            <div class="value" align="right"><b><?php echo $companyDetails['business_name']?></b></div>
            <div class="value" align="right"><?php echo $companyDetails['ck_number']?></div>
            <div class="value" align="right"><?php echo $companyDetails['address1']?></div>
            <div class="value" align="right"><?php echo $companyDetails['address2']?></div>
            <div class="value" align="right"><?php echo $companyDetails['city'] .", ". $companyDetails['postal_code'] ?></div>
            <div class="value" align="right"><?php echo $companyDetails['phone_number']?></div>
            <div class="value" align="right"><?php echo $companyDetails['email']?></div>
            <div class="value" align="right"><?php echo $companyDetails['web']?></div>
        </div>
    </div>


    <?php 
        $payslipDate = $payslipDetail['payslip_date'];
        $employed = $internship['employment_date'];
        $employedDate = date_create($employed);
        $ratePerDay =  $payslipDetail['rate_per_day'];
    ?>

<!-- Top line [Pay-run date and Pay period] -->
    <div id="scope">
        <div class="scope-entry">
            <div class="title">EMPLOYED SINCE</div>
            <div class="value"><?php echo date_format($employedDate ,"d M y"); ?></div>
        </div>
        <div class="scope-entry">
            <div class="title">PAY PERIOD</div>
            <div class="value"><?php echo firstDayOfGivenMonth($payslipDate); ?> to <?php echo lastDayOfGivenMonth($payslipDate); ?> </div>
        </div>
        <div class="scope-entry">
            <div class="title">RATE PER DAY</div>
            <div class="value"><?php echo convertFormatting($ratePerDay); ?></div> 
        </div>        
        <div class="scope-entry">
            <div class="title">PAY DAY</div>
            <div class="value"><?php echo $payslipDate; ?></div>
        </div>      
    </div>  

        <!-- Employee Details -->

    <div class="content">
        <div class="left-panel">
            <div class="details">
                <div class="entry">
                    <div><i> Account Owner : </i></div>
                    <div class="value"><?php echo $bankAccount['account_owner'] ?></div>
                </div>
                <div class="entry">
                    <div><i> Bank Name : </i></div>
                    <div class="value"><?php echo $bankAccount['bank_name'] ?></div>
                </div>
                <div class="entry">
                    <div><i> Branch Name : </i></div>
                    <div class="value"><?php echo $bankAccount['branch_name'] ?></div>
                </div>
                <div class="entry">
                    <div><i> Branch Code : </i></div>
                    <div class="value"><?php echo $bankAccount['branch_code'] ?></div>
                </div>
                <div class="entry">
                    <div><i> Account Number : </i></div>
                    <div class="value"><?php echo $bankAccount['account_number'] ?></div>
                </div>
                <div class="gross">
                    <div class="title"></div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="value"></div>
                    </div>
                </div>
                <div class="entry">
                    <div>Position : </div>
                    <div class="value"><?php echo $internship['position'] ?></div>
                </div>
                <div class="entry">
                    <div>Department</div>
                    <div class="value"><?php echo $internship['department'] ?></div>
                </div>
                <div class="entry">
                    <div>Tax Ref</div>
                    <div class="value"><?php echo $internship['tax_ref'] ?></div>
                </div>              
            </div>
            <div class="contributions">
                <div class="title">Employer Contribution</div>
                <?php
                    $employerUIF = $payslipDetail['uif_amount']; 
                    $employerSDL = $payslipDetail['uif_amount']; 
                ?>
                <div class="entry">
                    <div>UIF</div>
                    <div class="value">R <?php echo $employerUIF ?></div>
                </div>                  
                <div class="entry">
                    <div>SDL</div>
                    <div class="value">R 0</div>
                </div> 
            </div>
            <div class="ytd">
                <div class="title">Year To Date Figures</div>
                <div class="entry">
                    <div>Taxable Earnings</div>
                    <div class="value">R1 00</div>
                </div>  
                <div class="entry">
                    <div>Allowance</div>
                    <div class="value">R 0</div>
                </div>  
                <div class="entry">
                    <div>Bonus</div>
                    <div class="value">R 0</div>
                </div>  
                <div class="entry">
                    <div>Deduction</div>
                    <div class="value">R 0</div>
                </div>
                <div class="entry">
                    <div>Tax Paid</div>
                    <div class="value">R 0</div>
                </div>              
            </div>
        </div>
        <div class="right-panel">
            <div class="details">
                <div class="salary">
                    <div align="center" class="entry">
                        <h3 >Earnings:</h3>
                    </div>                  
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">Basic salary</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['gross']) ?></div>
                    </div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">Commission</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['commission']) ?></div>
                    </div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">Overtime</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['overtime']) ?></div>
                    </div>                  
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">Bonus</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['bonus']) ?></div>
                    </div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">Other</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['other']) ?></div>
                    </div>
                </div>
                <?php $incomeTotal =  $payslipDetail['gross'] + $payslipDetail['commission'] + $payslipDetail['overtime'] + $payslipDetail['bonus'] + $payslipDetail['other']?>
                <div class="total_earnings">
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">TAXABLE EARNINGS</div>
                        <div class="rate"></div>
                        <div class="amount"><?php  echo convertFormatting($incomeTotal) ?></div>
                    </div>
                </div>

                <div class="salary">
                    <div align="center" class="entry">
                        <h3 >Deductions:</h3>
                    </div>                  
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">PAYE</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['paye_amount']) ?></div>
                    </div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">UIF</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['uif_amount']) ?></div>
                    </div>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">SDL</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($payslipDetail['sdl_amount']) ?></div>
                    </div>
                    <?php
                        $payslip_date = $payslipDetail['payslip_date'];
                        $approvedLeaveDays = $payslipDetail['approved_leave'];
                        $monthDays = getNumberOfWorkingDays($payslip_date);
                        $presentDays = daysWorkedInGivenMonth($id_number,'time_in',$payslip_date);
                        $absentDays = ($monthDays - ($presentDays + $approvedLeaveDays));
                        $ratePerDay = $payslipDetail['rate_per_day'];
                        $deductedDaySalary = ($absentDays * $ratePerDay)
                    ?>
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail"># <?php echo $absentDays ?> days absent</div>
                        <div class="rate"></div>
                        <div class="amount"><?php echo convertFormatting($deductedDaySalary) ?></div>
                    </div>                                   
                </div>
                <?php $deductionTotal =  $payslipDetail['paye_amount'] + $payslipDetail['uif_amount'] + $deductedDaySalary ?>
                <div class="total_deductions">
                    <div class="entry">
                        <div class="label"></div>
                        <div class="detail">TOTAL DEDUCTIONS</div>
                        <div class="rate"></div>
                        <div class="amount"><?php  echo convertFormatting($deductionTotal) ?></div>
                    </div>
                </div>
                <?php $nettTotal =  $incomeTotal - $deductionTotal ?>
                <div class="net_pay">
                    <div class="entry">
                        <div class="label">NETT PAY</div>
                        <div class="detail"></div>
                        <div class="rate"></div>
                        <div class="amount"><?php  echo convertFormatting($nettTotal) ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>