<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "project") or die('Failed to connect to MySQL:' . mysqli_connect_error());
mysqli_set_charset($con, 'utf8');

define("BASE_URL", "/dms");
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] . "/dms");

function chk_dea(){
        if($_SESSION['dean'] == 0){
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//Check permit endorser
function chk_eds()
{
        if ($_SESSION['endorser'] == 0) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//check permit admin
function chk_admin()
{
        if ($_SESSION['admin'] == 0) {
                // header("location:".BASE_URL."/backend/unaccess.php");
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//check permit staff
function chk_staff()
{
        if ($_SESSION['staff'] == 0) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//check permit student
function chk_secretary()
{
        if ($_SESSION['secretary'] == 0) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}



//check permit student
function chk_student()
{
        if ($_SESSION['student'] == 0) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//check permit teacher
function chk_teacher()
{
        if ($_SESSION['teacher'] == 0) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

function chk_management()
{
        if (isset($_SESSION['admin']) || isset($_SESSION['endorser']) || isset($_SESSION['student']) || isset($_SESSION['teacher'])) {
                header("location:" . BASE_URL . "/backend/unaccess.php");
        }
}

//ฟังก์ชั่นแปลงวันที่ไทย อาจารย์ไม่ต้องถามผมใส่เองครับ
function DateThai($strDate)
{
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        //$strMinute= date("i",strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
}

function DateThai2($strDate)
{
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

function formatSizeUnits($bytes)
{
        if ($bytes >= 1073741824) {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
                $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
                $bytes = $bytes . ' byte';
        } else {
                $bytes = '0 bytes';
        }

        return $bytes;
}

