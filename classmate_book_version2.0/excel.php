<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
//require_once '../Build/PHPExcel.phar';
require_once './Classes/PHPExcel.php';


require_once './database.php';
//$data = array(['uid'=>'123', 'email'=>'144966@qq.com', 'password'=>'fa2iifw23']);


 /* 导出excel函数*/
function push($data,$name='Excel'){

    error_reporting(E_ALL);
    date_default_timezone_set('Europe/London');
    $objPHPExcel = new PHPExcel();

    /*以下是一些设置 ，什么作者  标题啊之类的*/
    $objPHPExcel->getProperties()->setCreator("转弯的阳光")
                           ->setLastModifiedBy("转弯的阳光")
                           ->setTitle("数据EXCEL导出")
                           ->setSubject("数据EXCEL导出")
                           ->setDescription("备份数据")
                           ->setKeywords("excel")
                          ->setCategory("result file");
     /*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
     $objPHPExcel->setActiveSheetIndex(0)
                 //Excel的第A列，uid是你查出数组的键值，下面以此类推
                  ->setCellValue('A1', '学号') 
                  ->setCellValue('B1', '姓名') 
                  ->setCellValue('C1', '电话') 
                  ->setCellValue('D1', '邮件') 
                  ->setCellValue('E1', 'qq号码')
                  ->setCellValue('F1', '微信号码')
                  ->setCellValue('G1', '地址')   
                  ->setCellValue('H1', '个人签名');

    foreach($data as $k => $v){
         $num=$k+1;
         $count = $num + 1;
         $objPHPExcel->setActiveSheetIndex(0)

                     //Excel的第A列，uid是你查出数组的键值，下面以此类推
                      ->setCellValue('A'.$count, $v['stu_no']) 
                      ->setCellValue('B'.$count, $v['name'])
                      ->setCellValue('C'.$count, $v['tel']) 
                      ->setCellValue('D'.$count, $v['email']) 
                      ->setCellValue('E'.$count, $v['qq_no'])
                      ->setCellValue('F'.$count, $v['wx_no'])
                      ->setCellValue('G'.$count, $v['addr'])   
                      ->setCellValue('H'.$count, $v['descript']);
        }

        $objPHPExcel->getActiveSheet()->setTitle('同学录');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$name.'.xls"');
        header('Cache-Control: max-age=0');
		ob_clean();
		flush();
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
}

push($data,$name='Excel');