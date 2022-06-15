<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CSV_Reader extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('csv_model');
    }

    public function juiceCSV() {
        $juiceD = $juiceH = array();
        $url = ASSET_URL . "csv/juice2.csv";
        $allData = $this->getCSVResultNew($juiceD, $juiceH, $url);
        //print_r($allData);
        die;
        if ($allData != null) {
            $this->updateNutritionFactsInDB($allData);
        }
    }

    public function proteinShakeCSV() {
        $protein_shakeD = $protein_shakeH = array();
        $url = ASSET_URL . "csv/protein_shake.csv";
        $allData = $this->getCSVResultNew($protein_shakeD, $protein_shakeH, $url);
        die;
        if ($allData != null) {
            $this->updateNutritionFactsInDB($allData);
        }
    }

    public function almondMilkCSV() {
        $almond_milkD = $almond_milkH = array();
        $url = ASSET_URL . "csv/almond-milk-new.csv";
        $allData = $this->getCSVResultNew($almond_milkD, $almond_milkH, $url);
        die;
        if ($allData != null) {
            $this->updateNutritionFactsInDB($allData);
        }
    }

    public function getCSVResultNew($getData, $getHeading, $url) {
        $getPercentTitle = '';
        $row = 1;
        if (($handle = fopen($url, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                //echo '<pre>';
                if ($row == 1) {
                    $headerArr = $data;
                } else {
                    //print_r($data);die;
                    $product_name = $data[0];
                    $parr = explode('-', $product_name);
                    $arr['serving_size'] = $data[1];
                    //$arr['Amount per serving'] = $data[2];
                    $arr['calories'] = $data[4];
                    $arr['percent_title'] = $data[3];
                    $arr['bottle_size'] = $data[2];
                    for ($i = 5; $i < (count($data)); $i++) {
                        $adata = explode('|', $data[$i]);
                        $a = array($headerArr[$i], $adata[0], $adata[1]);
                        $arr['details'][] = $a;
                        unset($adata);
                        unset($a);
                    }

                    echo $recordForUpdate = json_encode($arr);
                    unset($arr);
                    echo $product_name;
                    $s = $this->csv_model->updateNutritionFacts(trim($parr[1]), $recordForUpdate);
                    var_dump($s);
                }
                $row++;
            }
        }
    }

    public function getCSVResult($getData, $getHeading, $url) {
        $getPercentTitle = '';
        $row = 1;
        if (($handle = fopen($url, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $productName = null;
                $data2 = $data3 = $dataBeforeCalories = $Calories = $dataAfterCalories = $data4 = array();
                $num = count($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    if ($row == 2) {
                        $getHeading[] = $data[$c];
                    }
                    // if($row>2 AND $row<=3){
                    if ($row > 2) {
                        // $data2[$juiceH[$c]] = $data[$c];

                        if ($c == 0) {
                            $productName = $data[$c];
                        }
                        if ($c == 1) { // for displaying product name start with $c>=0
                            $data2[] = array($getHeading[$c], "", $data[$c]);
                        }
                        if ($c == 4) {
                            $Calories[] = array($getHeading[$c], "", $data[$c]);
                        }

                        if ($c >= 5) { // for Details
                            $str1 = $str2 = '';
                            if (strpos($data[$c], '|') !== FALSE) {
                                $str1 = strstr($data[$c], '|', true);
                                $str2 = substr(strstr($data[$c], '|'), 1);
                                $data3[] = array($getHeading[$c], $str1, $str2);
                            } elseif (strpos($data[$c], '?') !== FALSE) {
                                $str1 = strstr($data[$c], '?', true);
                                $str2 = substr(strstr($data[$c], '?'), 1);
                                $data3[] = array($getHeading[$c], $str1, $str2);
                            } else {
                                $data3[] = array($getHeading[$c], "", $data[$c]);
                            }
                            // array($juiceH[$c],"",$data[$c]);
                            $data4['details'] = $data3;
                        }

                        if ($c == 3)
                            $getPercentTitle = $data[$c];
                    }
                }
                // $productName = 
                $dataBeforeCalories[] = array("Amount per serving", "", "");
                $dataAfterCalories[] = array("", "250ml", $getPercentTitle);

                if ($data2 == null)
                    continue; // for empty array
                $getData[$productName] = array_merge($data2, $dataBeforeCalories, $Calories, $dataAfterCalories, $data4);
                // unset($data3);
            }
            fclose($handle);
        }

        return $getData;
    }

    public function updateNutritionFactsInDB($allData) {
        foreach ($allData as $key => $row) {
            $product_name = $key;
            $recordForUpdate = json_encode($row);
            $status = $this->csv_model->updateNutritionFacts($product_name, $recordForUpdate); // Update DB Record with JSON
            if ($status == false)
                echo 'Product: ' . $product_name . " Not updated. <br>";
            if ($status == true)
                echo 'Product: ' . $product_name . " updated. <br>";
        }
    }

    public function valuePacksImg() {
        $url = "csv/value_packs_IMAGES.csv";
        $wholeData = $this->getDesktopAndMobileImages($url);
        if ($wholeData != null) {
            $this->updateImages($wholeData);
        }
    }

    public function almondMilkImg() {
        $url = "csv/almond_milk_IMAGES.csv";
        $wholeData = $this->getDesktopAndMobileImages($url);
        if ($wholeData != null) {
            $this->updateImages($wholeData);
        }
    }

    public function proteinMilkshakeImg() {
        $url = "csv/protein_milkshake_IMAGES.csv";
        $wholeData = $this->getDesktopAndMobileImages($url);
        if ($wholeData != null) {
            $this->updateImages($wholeData);
        }
    }

    public function cleansesImg() {
        $url = "csv/cleanses_IMAGES.csv";
        $wholeData = $this->getDesktopAndMobileImages($url);

        /* print_r($wholeData);
          exit; */

        if ($wholeData != null) {
            $this->updateImages($wholeData);
        }
    }

    public function subscriptionsImg() {
        $url = "csv/subscriptions_IMAGES.csv";
        $wholeData = $this->getDesktopAndMobileImages($url);
        if ($wholeData != null) {
            $this->updateImages($wholeData);
        }
    }

    public function updateImages($data) {
        // if($data!=null){
        foreach ($data as $key => $val) {
            $productName = $val['name'];
            $productId = $val['id'];
            $data2['desktop_image_url'] = $val['desktop_image'];
            $data2['mobile_image_url'] = $val['mobile_image'];

            // print_r($data2);
            if ($productId != null) {
                $recordStatus = $this->csv_model->updateProductImage($productId, $data2);
                if ($recordStatus == true)
                    echo $productName . " <b>Updated</b>" . "<br>";
                if ($recordStatus == false)
                    echo $productName . " <b style='color:red'>Not Updated</b>" . "<br>";
            }
        }
        // }
    }

    public function getDesktopAndMobileImages($url) {
        $wholeData = array();
        $row = 1;
        if (($handle = fopen(ASSET_URL . $url, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $data2 = array();
                $num = count($data);
                $row++;
                for ($c = 0; $c < $num; $c++) {
                    if ($row > 2) {
                        if ($c == 0) {
                            $data2['id'] = $data[$c];
                        }
                        if ($c == 1) {
                            $data2['name'] = $data[$c];
                        }
                        if ($c == 3) {
                            $data2['desktop_image'] = $data[$c];
                        }
                        if ($c == 4) {
                            $data2['mobile_image'] = $data[$c];
                        }
                    }
                }
                if ($data2 == null)
                    continue;
                $wholeData[] = $data2;
            }
        }

        return $wholeData;
    }

}
