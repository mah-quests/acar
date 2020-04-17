<?php

require_once 'func/functions.php';

function getNumberOfWorkingDays($payslip_date)
{
    $year_month = substr($payslip_date, 0, -3);
    if ($year_month == '2019-01' || $year_month == '2019-05' || $year_month == '2019-08' || $year_month == '2020-01' || $year_month == '2020-03' || $year_month == '2020-10') {
        return 22;
    } elseif ($year_month == '2019-10' || $year_month == '2019-11' || $year_month == '2019-07' || $year_month == '2020-07') {
        return 23;
    } elseif ($year_month == '2020-06' || $year_month == '2020-09' || $year_month == '2020-11') {
        return 21;
    } elseif ($year_month == '2019-02' || $year_month == '2019-03' || $year_month == '2019-04' || $year_month == '2019-09' || $year_month == '2020-02' || $year_month == '2020-05' || $year_month == '2020-08' || $year_month == '2020-12') {
        return 20;
    } elseif ($year_month == '2019-06' || $year_month == '2019-12' || $year_month == '2020-04') {
        return 19;
    } elseif ($year_month == '2018-12') {
        return 18;
    } else {
        return 0;
    }
}

// Get the first day of the month
function firstDayOfGivenMonth($payslip_date)
{
    $givenDate = date('Y-m-01', strtotime($payslip_date));

    return $givenDate;
}

// Get the last day of the month
function lastDayOfGivenMonth($payslip_date)
{
    $givenDate = date('Y-m-t', strtotime($payslip_date));

    return $givenDate;
}

function convertFormatting($amount)
{
    $currency = 'R ';

    return $currency.number_format($amount, 2, '.', ',');
}

// Check the number of days the candidate has worked this particular month
function daysWorkedInGivenMonth($id_number, $db_name, $payslip_date)
{
    $db = getDbInstance();

    $firstDay = firstDayOfGivenMonth($payslip_date);
    $lastDay = lastDayOfGivenMonth($payslip_date);
    $count = 0;

    if ($db_name == 'time_in') {
        $numberOfDays = $db->where('check_in_date', array($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $count = $db->getValue($db_name, 'count(*)');
    } else {
        $numberOfDays = $db->where('check_out_date', array($firstDay, $lastDay), 'BETWEEN');
        $numberOfDays = $db->where('id_number', $id_number);
        $count = $db->getValue($db_name, 'count(*)');
    }

    return $count;
}

function calclulateMonthIncome($gross, $commision, $overtime, $bonus, $other, $payslip_date, $approved_leave, $id_number)
{
    $ratePerDay = calculateRatePerDay($gross, $payslip_date);
    $numberOfWorkingDays = getNumberOfWorkingDays($payslip_date);
    $approvedLeave = $approved_leave;

    $daysCheckedIn = daysWorkedInGivenMonth($id_number, 'time_in', $payslip_date);

    $all_income = ($daysCheckedIn + $approvedLeave) * $ratePerDay;
    $all_income = $all_income + $commision + $overtime + $bonus + $other;

    return $all_income;
}

function addPayslipIncome($gross, $commision, $overtime, $bonus, $other)
{
    $total = $gross + $commision + $overtime + $bonus + $other;

    return $total;
}

function calclulateAllExpenses($uif_amount, $sdl_amount, $paye_amount)
{
    $all_expenses = $uif_amount + $sdl_amount + $paye_amount;

    return $all_expenses;
}

function calculateNettSalary($gross, $commision, $overtime, $bonus, $other, $payslip_date, $approved_leave, $id_number, $uif_amount, $sdl_amount, $paye_amount)
{
    $allIncome = calclulateMonthIncome($gross, $commision, $overtime, $bonus, $other, $payslip_date, $approved_leave, $id_number);
    $allExpense = calclulateAllExpenses($uif_amount, $sdl_amount, $paye_amount);

    $nett_pay = $allIncome - $allExpense;

    return $nett_pay;
}

function calculateRatePerDay($gross, $payslip_date)
{
    $numberOfWorkingDays = getNumberOfWorkingDays($payslip_date);

    if ($numberOfWorkingDays > 0) {
        $ratePerDay = ($gross / $numberOfWorkingDays);
    } else {
        $ratePerDay = 0;
    }

    return $ratePerDay;
}

function payslipAlreadyGenerated($id_number, $payslip_date)
{
    $firstDay = firstDayOfGivenMonth($payslip_date);
    $lastDay = lastDayOfGivenMonth($payslip_date);

    $db = getDbInstance();
    $db->join('candidates can', 'can.id_number=pay.id_number', 'LEFT');
    $db->where('can.id_number', $id_number);
    $db->where('payslip_date', array($firstDay, $lastDay), 'BETWEEN');
    $db->get('payslips pay', null);

    return $db->count;
}

function calculatePAYE($gross)
{
    return 0;
}

function calculateUIF($gross)
{
    return 0;
}

function calculateSDL($gross)
{
    return 0;
}

function payslipData(&$data_to_create_payslip)
{
    //Extract information relevent to bank_accounts table
    $id_number = $data_to_create_payslip['id_number'];
    $gross = $data_to_create_payslip['gross'];
    $commission = $data_to_create_payslip['commission'];
    $overtime = $data_to_create_payslip['overtime'];
    $bonus = $data_to_create_payslip['bonus'];
    $other = $data_to_create_payslip['other'];
    $payslip_date = $data_to_create_payslip['payslip_date'];
    $generated_at = $data_to_create_payslip['generated_at'];
    $approved_leave = $data_to_create_payslip['approved_leave'];
    $allIncome = calclulateMonthIncome($gross, $commision, $overtime, $bonus, $other, $payslip_date, $approved_leave, $id_number);
    $paye_amount = calculatePAYE($gross);
    $uif_amount = calculateUIF($gross);
    $sdl_amount = calculateSDL($gross);
    $rate_per_day = calculateRatePerDay($gross, $payslip_date);
    $nett_pay = calculateNettSalary($gross, $commision, $overtime, $bonus, $other, $payslip_date, $approved_leave, $id_number, $uif_amount, $sdl_amount, $paye_amount);

    $payslip_data = array('id_number' => $id_number,
                            'gross' => $gross,
                            'commission' => $commission,
                            'overtime' => $overtime,
                            'bonus' => $bonus,
                            'other' => $other,
                            'paye_amount' => $paye_amount,
                            'uif_amount' => $uif_amount,
                            'nett_pay' => $nett_pay,
                            'payslip_date' => $payslip_date,
                            'rate_per_day' => $rate_per_day,
                            'approved_leave' => $approved_leave,
                            'generated_at' => $generated_at,
    );

    return $payslip_data;
}

function updatePayslipDetails($candidate_id, &$payslip_data)
{
    $payslip_update = payslipData($payslip_data);

    $db = getDbInstance();
    $rowId = getDBRowID($candidate_id, 'payslips');

    $db->where('id', $rowId);
    $last_id = $db->update('payslips', $payslip_update);

    return $last_id;
}

function addPayslipDetails(&$payslip_data)
{
    $payslip_update = payslipData($payslip_data);

    $db = getDbInstance();
    $last_id = $db->insert('payslips', $payslip_update);

    return $last_id;
}
