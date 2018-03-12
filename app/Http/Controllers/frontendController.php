<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\busRequest;
use App\Http\Requests\appRequest;
use App\Http\Requests\datRequest;
use App\Http\Requests\tecRequest;
use App\Business_layer;
use App\Application_layer;
use App\Data_layer;
use App\Technology_layer;
use App\Business_relation;
use App\Application_relation;
use App\Data_relation;
use App\Technology_relation;
use App\Department;
use App\Develop_language;
use App\Devlopment_group;
use App\Type_collection;
use App\Brand;
use App\Place_relation;
use App\Place;
use App\Use_data;
use Illuminate\Support\Facades\DB;
use Excel;
use View;

  
class frontendController extends Controller{

public function viewBusOther(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('business_other')->get();
 //ddd($content->isEmpty());
   if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Busother')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
public function viewAppOther(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('application_other')->get();
    if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Appother')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
public function viewDatOther(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('data_other')->get();
     if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Datother')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
public function viewTecOther(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('technology_other')->get();
     if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Tecother')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
public function viewBui(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('technology_bulid')->get();
     if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Bui')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
public function viewNet(){
  $lv1 = DB::table('business_layer_lv1')->get();
  $content = DB::table('technology_network')->get();
     if($content->isEmpty()){
  return view('front.Nothing');
}else{
  return view('front.Net')->with(['lv1'=>$lv1,'content'=>$content]);
}
}
  public function viewBus(){
   
  $lv1 = DB::table('business_layer_lv1')->get();

 // ddd($lv1);
    $model = DB::table('business_layer')
            ->leftJoin('type_process', 'type_process.id', '=', 'business_layer.type')
            ->leftJoin('business_layer_lv3','business_layer_lv3.id', '=', 'business_layer.lv3_id')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->select('business_layer.*','business_layer.type as bltype','business_layer.name as blname','business_layer.id as blid','business_layer.id as blids',
            'type_process.name as typee','type_process.remark as pfix'
            ,'business_layer_lv2.short as lv2','business_layer_lv2.name as n2'
            ,'business_layer_lv1.short as lv1','business_layer_lv1.name as n1'
            ,'business_layer_lv3.short as lv3','business_layer_lv3.name as n3')
            ->get();
   $model2 = DB::select("
    SELECT
    bl.* , 
    al.* ,
    br.* , 
    bl.id AS blid ,   
    al.name AS alname ,
    br.business_layer_id AS compblid
    FROM 
    business_layer AS bl ,  
    application_layer AS al ,
    business_relation AS br
    WHERE
    al.id = br.comp_id AND
    bl.id = br.business_layer_id AND
    br.frag = 'a'
    ");
   $model3 =DB::table('business_relation')
             ->join( 'department','department.id', '=', 'business_relation.comp_id')
            ->where('frag', 'dp')
            ->get(); 
   if($model==NULL){
    return view('front.Nothing');
  }else{
    return view('front.Bus')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'lv1'=>$lv1]);
  }
}
public function viewBusdetail($id){

  $lv1 = DB::table('business_layer_lv1')->get();
  
      $model = DB::table('business_layer')
            ->leftJoin('type_process', 'type_process.id', '=', 'business_layer.type')
            ->leftJoin('business_layer_lv3','business_layer_lv3.id', '=', 'business_layer.lv3_id')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->select('business_layer.*','business_layer.type as bltype','business_layer.remark as blremark','business_layer.name as blname','business_layer.id as blid','business_layer.id as blids',
            'type_process.name as typee','type_process.remark as pfix'
            ,'business_layer_lv2.short as lv2','business_layer_lv2.name as n2','business_layer_lv2.id as id2'
            ,'business_layer_lv1.short as lv1','business_layer_lv1.name as n1','business_layer_lv1.id as id1'
            ,'business_layer_lv3.short as lv3','business_layer_lv3.name as n3','business_layer_lv3.id as id3')
            ->where('business_layer.id',$id)
            ->get();
            //ddd($model);
  $model2 = DB::select("
    SELECT
    br.* , 
    al.* , 
    al.name AS alname , 
    al.id AS alid
    FROM
    business_relation AS br , application_layer AS al
    WHERE
    br.frag = 'a' AND
    br.comp_id = al.id AND
    br.business_layer_id = ".$id."
    ");
    $model3 = DB::select("
    SELECT
    dl.name AS dlname , 
    dl.id AS dlid
    FROM
    business_relation AS br , data_layer AS dl
    WHERE
    br.frag = 'd' AND
    br.comp_id = dl.id AND
    br.business_layer_id = ".$id."
    ");
    $model3_1 = DB::select("
    SELECT
    dl.name AS dlname , 
    dl.id AS dlid
    FROM
    data_relation AS dr ,
     data_layer AS dl ,
     business_layer AS bl
    WHERE
    dr.frag = 'b' AND
    dr.comp_id = bl.id AND
    dr.data_layer_id = dl.id AND
    dr.comp_id = ".$id."
    ");

     $model3 = array_map(function ($modell3) {
    return (array)$modell3;
}, $model3);
$model3_1 = array_map(function ($modell3_1) {
  return (array)$modell3_1;
}, $model3_1);


  $array = array_merge ($model3, $model3_1);
  $liste = array();
  foreach ($array as $value ) {
     if(!in_array($value, $liste, true)){
        array_push($liste, $value);
    }
  }
  $model4 = DB::table('business_relation')
             ->join( 'department','department.id', '=', 'business_relation.comp_id')
            ->where('frag', 'dp')
            ->get();
if(isset($content)){
    return view('front.Nothing');
  }else{
  return view('front.BusDetail')->with(['liste'=>$liste,'model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'lv1'=>$lv1]);
}
}
 public function lv($lv,$id){

  $lv1 = DB::table('business_layer_lv1')->get();

    $model = DB::table('business_layer_lv3')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->where('business_layer_lv'.$lv.'.id',$id)
            ->select('business_layer_lv3.name as n3','business_layer_lv2.name as n2','business_layer_lv1.name as n1'
            ,'business_layer_lv3.id as id3','business_layer_lv2.id as id2','business_layer_lv1.id as id1'
            ,'business_layer_lv3.remark as remark3','business_layer_lv2.remark as remark2','business_layer_lv1.remark as remark1'
            ,'business_layer_lv3.short as s3','business_layer_lv2.short as s2','business_layer_lv1.short as s1'
            )
            ->first();

            if ($lv == 3) {
              $model1 = DB::table('business_layer')
            ->leftJoin('business_layer_lv3','business_layer_lv3.lv2_id', '=', 'business_layer.lv3_id')
            ->where('business_layer.id',$id)
             ->select('business_layer.name as n','business_layer.id as iden'
            ,'business_layer_lv3.id as id3','business_layer_lv3.remark as remark3','business_layer_lv3.short as s3')
            ->get();
            //ddd($model1);
            }elseif ($lv == 2) {
             $model1 = DB::table('business_layer_lv3')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->where('business_layer_lv2.id',$id)
            ->select('business_layer_lv3.name as n3','business_layer_lv2.name as n2'
            ,'business_layer_lv3.id as id3','business_layer_lv2.id as id2'
            ,'business_layer_lv3.remark as remark3','business_layer_lv2.remark as remark2'
            ,'business_layer_lv3.short as s3','business_layer_lv2.short as s2'
            )
            ->get();
          //  ddd($model1);
          }else {
             $model1 = DB::table('business_layer_lv2')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->where('business_layer_lv1.id',$id)
            ->select('business_layer_lv2.name as n2','business_layer_lv1.name as n1'
           ,'business_layer_lv2.id as id2','business_layer_lv1.id as id1'
            ,'business_layer_lv2.remark as remark2','business_layer_lv1.remark as remark1'
           ,'business_layer_lv2.short as s2','business_layer_lv1.short as s1'
            )
            ->get();
            //ddd($model1);
          }
            

    //ddd($model);
   if($model==NULL){
    return view('front.Nothing');
  }else{
    return view('front.Lv')->with(['model1'=>$model1,'model'=>$model,'lv'=>$lv,'lv1'=>$lv1]);
  }
 }
 public function viewAppType($type){
//echo $type;
  $lv1 = DB::table('business_layer_lv1')->get();
  if ($type == 1) {
    $model = DB::select("
  SELECT
  al.* , 
  al.id AS alid , 
  al.name AS alname , 
  al.develop_language AS aldevl , 
  al.app_database AS alappdb ,
  al.getting_start_years AS algettingstartyear ,
  al.remark AS alremark , 
  pfix.initial AS pfix
  FROM 
  application_layer AS al , 
  initial AS pfix
  WHERE
  pfix.name = 'application' AND
  al.category = 'ระบบสารสนเทศภายในองค์กร'
  ORDER BY
  al.id
  ");
  }else{
    $model = DB::select("
  SELECT
  al.* , 
  al.id AS alid , 
  al.name AS alname , 
  al.develop_language AS aldevl , 
  al.app_database AS alappdb ,
  al.getting_start_years AS algettingstartyear ,
  al.remark AS alremark , 
  pfix.initial AS pfix
  FROM 
  application_layer AS al , 
  initial AS pfix
  WHERE
  pfix.name = 'application'AND
  al.category = 'ระบบสารสนเทศภายนอกองค์กร'
  ORDER BY
  al.id
  ");
  }
  
 $model2 = DB::select("
  SELECT
  al.* ,
  ar.* , 
  al.id AS alid ,   
  al.name AS alname ,
  ar.application_layer_id AS compalid
  FROM 
  application_layer AS al ,
  application_relation AS ar
  WHERE
  al.id = ar.comp_id AND
  ar.frag = 'a'
  ");
$model3 = DB::select("
    SELECT
    la.* , 
    la.name AS laname , 
    la.id AS laid ,
    ar.* , 
    ar.id AS arid ,
     ar.application_layer_id AS compalid
    FROM
    develop_language AS la ,
    application_relation AS ar
    WHERE
    ar.comp_id = la.id AND
    ar.frag = 'la' 
    ");
  $model9 = DB::select("
    SELECT
    dp.* , 
    dp.name AS dpname , 
    dp.id AS dpid ,
    ar.* , 
    ar.id AS arid
    FROM
    department AS dp ,
    application_layer AS ar
    WHERE
    ar.department_id = dp.id 
    -- ar.frag = 'dp' AND
    
    ");
  $model10 = DB::select("
    SELECT
    dp.* , 
    dp.name AS dpname , 
    dp.id AS dpid ,
    ar.* , 
    ar.id AS arid
    FROM
    department AS dp ,
    application_relation AS ar
    WHERE
    ar.comp_id = dp.id AND
     ar.frag = 'dp' 
    
    ");

 //$model3 = Develop_language::all(); 
 $model4 = Use_data::all();

  if($type=="excel"){
 $model = DB::select("
  SELECT
  al.* , 
  al.id AS alid , 
  al.name AS alname , 
  al.develop_language AS aldevl , 
  al.app_database AS alappdb ,
  al.getting_start_years AS algettingstartyear ,
  al.remark AS alremark , 
  pfix.initial AS pfix
  FROM 
  application_layer AS al , 
  initial AS pfix
  WHERE
  pfix.name = 'application'
  ORDER BY
  al.id
  ");
            $count = 0;
            $data = array();
            $a = "" ;
            $a1 = "" ;
            $a2 = "" ;
            $a3 = "" ;
            $a4 = "" ;

                     
            foreach($model as $model){
              foreach($model3 as $modell2){
                if($model->alid == $modell2->compalid)
                            {
                              $a .= $modell2->laname." ";
                            }
              }
              foreach($model4 as $modell4){
                if($model->alappdb == $modell4->id){
                      $a1 .= $modell4->name." ";
                }
              }
              foreach($model2 as $modell2){
                if($model->alid == $modell2->compalid)
                            {
                               $a2 .= $modell2->alname." ";
                            }
              }
              foreach($model9 as $modell9){
                if($model->alid == $modell9->arid)
                            {
                               $a3 = $modell9->dpname;
                            }
              }
              foreach($model10 as $modell10){
                if($model->alid == $modell10->application_layer_id)
                            {
                               $a4 .= $modell10->dpname." ";
                            }
              }
              
              
              array_push($data, array(
                  "รหัส" => $model->pfix."".$model->alid, 
                  "ชื่อ" => $model->alname, 
                  "ประเภท" => $model->category,                 
                  "ภาษาที่ใช้" => $a,
                  "ฐานข้อมลู" => $a1 , 
                  "ปีที่เริ่มใช้งาน" =>$model->algettingstartyear,
                  "รายละเอียด" =>$model->alremark,
                  "หน่วยงานท่ีรับผิดชอบ" =>  $a3,
                  "หน่วยงานท่ีเกยี่วข้อง" =>  $a4,
                  "ระบบสารสนเทศที่เกี่ยวข้อง" =>  $a2,
                  "สถานะ" => $model->state

              ));
              $a = "" ;
              $a1 = "" ;
              $a2 = "" ;
              $a3 = "" ;
              $a4 = "" ;
              $count++;
            }

    return Excel::create('ข้อมูลระบบสารสนเทศ', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
          {
        $sheet->fromArray($data);
          });
    })->download('xlsx');
}elseif ($type== 1) {
  if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.App')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'lv1'=>$lv1]);
}
}else{
if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.App')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'lv1'=>$lv1]);
}
}

 }
public function viewApp(){

    $lv1 = DB::table('business_layer_lv1')->get();


 $model = DB::select("
  SELECT
  al.* , 
  al.id AS alid , 
  al.name AS alname , 
  al.develop_language AS aldevl , 
  al.app_database AS alappdb ,
  al.getting_start_years AS algettingstartyear ,
  al.remark AS alremark , 
  pfix.initial AS pfix
  FROM 
  application_layer AS al , 
  initial AS pfix
  WHERE
  pfix.name = 'application'
  ORDER BY
  al.id
  ");
 $model2 = DB::select("
  SELECT
  al.* ,
  ar.* , 
  al.id AS alid ,   
  al.name AS alname ,
  ar.application_layer_id AS compalid
  FROM 
  application_layer AS al ,
  application_relation AS ar
  WHERE
  al.id = ar.comp_id AND
  ar.frag = 'a'
  ");
$model3 = DB::select("
    SELECT
    la.* , 
    la.name AS laname , 
    la.id AS laid ,
    ar.* , 
    ar.id AS arid ,
     ar.application_layer_id AS compalid
    FROM
    develop_language AS la ,
    application_relation AS ar
    WHERE
    ar.comp_id = la.id AND
    ar.frag = 'la' 
    ");
 //$model3 = Develop_language::all(); 
 $model4 = Use_data::all();
 //ddd($model3);
 if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.App')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'lv1'=>$lv1]);
}

}
public function viewAppdetail($id){

    $lv1 = DB::table('business_layer_lv1')->get();

  $model = DB::select("
    SELECT 
    al.* , 
    al.name AS alname , 
    al.id AS alid , 
    al.remark AS alremark ,
    pfix.initial AS pfix
    FROM 
    application_layer AS al , 
    initial AS pfix
    WHERE
    pfix.name = 'application' AND
    al.id = ".$id."
    ");
  $model2 = DB::select("
    SELECT
    ar.* , 
    al.* , 
    al.name AS alname , 
    al.id AS alid
    FROM
    application_relation AS ar , application_layer AS al
    WHERE
    ar.frag = 'a' AND
    ar.comp_id = al.id AND
    ar.application_layer_id = ".$id."
    ");

  $model3 = DB::select("
    SELECT
    la.* , 
    la.name AS laname , 
    la.id AS laid ,
    ar.* , 
    ar.id AS arid
    FROM
    develop_language AS la ,
    application_relation AS ar
    WHERE
    ar.comp_id = la.id AND
    ar.frag = 'la' AND
    ar.application_layer_id = ".$id."
    ");
    $model4 = DB::select("
    SELECT
    ser.name AS sername , 
    ser.id AS serid 
    FROM
    technology_layer AS ser ,
    application_relation AS ar
    WHERE
    ar.comp_id = ser.id AND
    ar.frag = 't' AND
    ar.application_layer_id = ".$id."
    ");

   $model4_1 = DB::select("
    SELECT
    ser.name AS sername , 
    ser.id AS serid 
    FROM
    technology_layer AS ser ,
    technology_relation AS tr ,
    application_layer AS al
    WHERE
    tr.comp_id = al.id AND
    tr.frag = 'a' AND
    tr.technology_layer_id = ser.id AND
    tr.comp_id = ".$id."
    ");

     $model4 = array_map(function ($modell4) {
    return (array)$modell4;
}, $model4);
$model4_1 = array_map(function ($modell4_1) {
  return (array)$modell4_1;
}, $model4_1);


  $array2 = array_merge ($model4, $model4_1);
  $liste2 = array();
  foreach ($array2 as $value1 ) {
     if(!in_array($value1, $liste2, true)){
        array_push($liste2, $value1);
    }
  }
    //ser.type = '2' AND
  $model5 = DB::select("
    SELECT
    db.* , 
    db.name AS dbname , 
    db.id AS dbid ,
    ar.* , 
    ar.id AS arid
    FROM
    use_data AS db ,
    application_relation AS ar
    WHERE
    ar.comp_id = db.id AND
    ar.frag = 'db' AND
    ar.application_layer_id = ".$id."
    ");
  $model6 = DB::select("
    SELECT
    c.* , 
    c.name AS cname , 
    c.id AS cid ,
    ar.* , 
    ar.id AS arid
    FROM
    devlopment_group AS c ,
    application_relation AS ar
    WHERE
    ar.comp_id = c.id AND
    ar.frag = 'c' AND
    ar.application_layer_id = ".$id."
    ");
    $model7 = DB::select("
    SELECT
    br.* , 
    al.* ,
	bl.*,
	bl.name AS blname,
bl.id AS blid
    FROM
    business_relation AS br , application_layer AS al, business_layer as bl
    WHERE
    br.frag = 'a' AND
    br.comp_id = al.id AND
	br.business_layer_id = bl.id AND
  br.comp_id = ".$id."
    ");


    // old qury

    // SELECT
    // bl.* , 
    // bl.name AS blname , 
    // bl.id AS blid ,
    // ar.* , 
    // ar.id AS arid
    // FROM
    // business_layer AS bl ,
    // application_relation AS ar
    // WHERE
    // ar.comp_id = bl.id AND
    // ar.frag = 'a' AND
    // ar.application_layer_id = ".$id."
    // ");
    
  $model8 = DB::select("
  SELECT
  dl.name AS dlname , 
  dl.id AS dlid 
  FROM
  data_layer AS dl ,
  application_relation AS ar
  WHERE
  ar.comp_id = dl.id AND
  ar.frag = 'd' AND
  ar.application_layer_id = ".$id."
    ");
  $model9 = DB::select("
    SELECT
    dp.* , 
    dp.name AS dpname , 
    dp.id AS dpid ,
    ar.* , 
    ar.id AS arid
    FROM
    department AS dp ,
    application_layer AS ar
    WHERE
    ar.department_id = dp.id AND
    -- ar.frag = 'dp' AND
    ar.id = ".$id."
    ");
  $model10 = DB::select("
    SELECT
    dp.* , 
    dp.name AS dpname , 
    dp.id AS dpid ,
    ar.* , 
    ar.id AS arid
    FROM
    department AS dp ,
    application_relation AS ar
    WHERE
    ar.comp_id = dp.id AND
     ar.frag = 'dp' AND
     ar.application_layer_id = ".$id."
    
    ");
  //ddd($model10);

    $model8_1 = DB::select("
    SELECT
     dl.name AS dlname , 
     dl.id AS dlid 
     FROM
     data_relation AS dr,
   application_layer AS al,
     data_layer as dl
     WHERE
   dr.comp_id = al.id AND
   dr.data_layer_id = dl.id AND
     dr.frag = 'a' AND
   dr.comp_id = ".$id."
     ");
   
      $model8 = array_map(function ($modell8) {
       return (array)$modell8;
   }, $model8);
   $model8_1 = array_map(function ($modell8_1) {
     return (array)$modell8_1;
   }, $model8_1);
       $array = array_merge ($model8, $model8_1);
     $liste = array();
     foreach ($array as $value ) {
        if(!in_array($value, $liste, true)){
           array_push($liste, $value);
       }
     }


  return view('front.AppDetail')->with(['liste2'=>$liste2,'liste'=>$liste,'model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'model5'=>$model5,'model6'=>$model6,'model7'=>$model7,'model8'=>$model8,'model9'=>$model9,'lv1'=>$lv1,'model10'=>$model10]);
}

public function viewDat(){

    $lv1 = DB::table('business_layer_lv1')->get();

  $model = DB::select("
  SELECT
  dl.* , 
  dl.id AS datid , 
  dl.name AS datname ,
  dl.type AS dattype ,
  dl.remark AS datremark ,
  pfix.initial AS pfix
  FROM 
  data_layer AS dl ,
  initial AS pfix
  WHERE 
  pfix.name = 'data'
  ORDER BY
  dl.id
  ");
  $model2 = DB::select("
  SELECT
  dl.* , 
  dl.id AS datid , 
  dl.name AS datname ,
  dr.* , 
  st.* , 
  st.name AS stname , 
  st.id AS stid ,
  dr.id AS drid
  FROM 
  data_layer AS dl ,
  type_collection AS st ,
  data_relation AS dr
  WHERE 
  dr.comp_id = st.id AND
  dr.data_layer_id = dl.id AND
  dr.frag = 'st' 
  ORDER BY
  dl.id
  ");
  if($model==NULL){
    return view('front.Nothing');
  }else{
    return view('front.Dat')->with(['model2'=>$model2,'model'=>$model,'lv1'=>$lv1]);
  }
}
public function viewDatExcel(){

    $lv1 = DB::table('business_layer_lv1')->get();

  $model = DB::select("
  SELECT
  dl.* , 
  dl.id AS datid , 
  dl.name AS datname ,
  dl.type AS dattype ,
  dl.remark AS datremark ,
  pfix.initial AS pfix
  FROM 
  data_layer AS dl ,
  initial AS pfix
  WHERE 
  pfix.name = 'data'
  ORDER BY
  dl.id
  ");
  $model2 = DB::select("
  SELECT
  dl.* , 
  dl.id AS datid , 
  dl.name AS datname ,
  dr.* , 
  st.* , 
  st.name AS stname , 
  st.id AS stid ,
  dr.id AS drid
  FROM 
  data_layer AS dl ,
  type_collection AS st ,
  data_relation AS dr
  WHERE 
  dr.comp_id = st.id AND
  dr.data_layer_id = dl.id AND
  dr.frag = 'st' 
  ORDER BY
  dl.id
  ");
 $count = 0;
            $data = array();
            $a = "" ;
            $a1 = "" ;
            $a2 = "" ;
            $a3 = "" ;
            $a4 = "" ;

                     
            foreach($model as $model){

              foreach($model2 as $modell2){
                if($model->datid == $modell2->datid)
                            {
                               $a2 .= $modell2->stname." ";
                            }
              }

              
              
              array_push($data, array(
                  "รหัส" => $model->pfix."".$model->id, 
                  "ชื่อ" => $model->datname, 
                  "ประเภทการเก็บข้อมูล" => $a2,
                  "รายละเอียด" =>$model->datremark,
              ));
              $a = "" ;
              $a1 = "" ;
              $a2 = "" ;
              $a3 = "" ;
              $a4 = "" ;
              $count++;
            }

            //ddd($data);
    return Excel::create('ข้อมูล', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
          {
        $sheet->fromArray($data);
          });
    })->download('xlsx');
}

public function viewDatdetail($id){

    $lv1 = DB::table('business_layer_lv1')->get();

    $model = DB::select("
    SELECT 
    dl.* ,
    pfix.initial AS pfix 
    FROM 
    data_layer AS dl ,
    initial AS pfix 
    WHERE 
    pfix.name = 'data' AND
    dl.id=".$id."");
 $model2 = DB::select("
  SELECT
  dr.* , 
  st.* , 
  st.name AS stname , 
  st.id AS stid ,
  dr.id AS drid
  FROM
  type_collection AS st ,
  data_relation AS dr
  WHERE
  dr.comp_id = st.id AND
  dr.frag = 'st' AND
  dr.data_layer_id = ".$id."
  ");
 $model3 = DB::select("
  SELECT
  al.name AS alname , 
  al.id AS alid 
  FROM
  application_layer AS al ,
  data_relation AS dr
  WHERE
  dr.comp_id = al.id AND
  dr.frag = 'a' AND
  dr.data_layer_id = ".$id."
  ");
  $model3_1 = DB::select("
  SELECT
  al.name AS alname , 
  al.id AS alid 
  FROM
  application_relation AS ar,
application_layer AS al,
  data_layer as dl
  WHERE
ar.comp_id = dl.id AND
ar.application_layer_id = al.id AND
  ar.frag = 'd' AND
ar.comp_id = ".$id."
  ");
  
  $model4 = DB::select("
  SELECT
  bl.name AS blname , 
  bl.id AS blid 
  FROM
  business_layer AS bl ,
  data_relation AS dr
  WHERE
  dr.comp_id = bl.id AND
  dr.frag = 'b' AND
  dr.data_layer_id = ".$id."
  ");
  $model4_1 = DB::select("
  SELECT
  bl.name AS blname , 
  bl.id AS blid 
  FROM
  business_relation AS br ,
  data_layer AS dl ,
  business_layer AS bl 
  WHERE
  br.comp_id = dl.id AND
  br.frag = 'd' AND
  br.business_layer_id = bl.id AND
  br.comp_id = ".$id."
  ");

  $model4 = array_map(function ($modell4) {
    return (array)$modell4;
}, $model4);
$model4_1 = array_map(function ($modell4_1) {
  return (array)$modell4_1;
}, $model4_1);

  $array2 = array_merge ($model4, $model4_1);
  $liste2 = array();
  foreach ($array2 as $value ) {
     if(!in_array($value, $liste2, true)){
        array_push($liste2, $value);
    }
  }

 $model5 = DB::select("
  SELECT
  dr.* , 
  dp.* , 
  dp.name AS dpname , 
  dp.id AS dpid ,
  dr.id AS drid
  FROM
  department AS dp ,
  data_relation AS dr
  WHERE
  dr.comp_id = dp.id AND
  dr.frag = 'dp' AND
  dr.data_layer_id = ".$id."
  ");
  $model3 = array_map(function ($modell3) {
    return (array)$modell3;
}, $model3);
$model3_1 = array_map(function ($modell3_1) {
  return (array)$modell3_1;
}, $model3_1);
  $array = array_merge ($model3, $model3_1);
  $liste = array();
  foreach ($array as $value ) {
     if(!in_array($value, $liste, true)){
        array_push($liste, $value);
    }
  }
 return view('front.DatDetail')->with(['liste2'=>$liste2,'liste'=>$liste,'model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'model5'=>$model5,'lv1'=>$lv1]);
}

public function viewtec(){

    $lv1 = DB::table('business_layer_lv1')->get();

 $model = DB::select("
  SELECT
  tl.* , 
  tl.id AS tecid ,
  tl.name AS tecname ,
  tl.brand AS tecbrand ,
  tl.model AS tecmodel ,
  tl.tech_spec AS tecspec ,
  tl.amount AS tecamount ,
  tl.tech_location AS teclocation ,
  tl.ma_cost AS tecma_cost ,
  tl.remark AS tecremark 
  FROM 
  technology_layer AS tl
  ORDER BY
  tl.id
  ");
 $model2 = Brand::all();
 $model3 = Place::all();
 if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.Tec')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'lv1'=>$lv1]);
}
}
public function viewTecdetail($id){

    $lv1 = DB::table('business_layer_lv1')->get();

  $model = DB::select("
    SELECT 
    tl.*
    FROM 
    technology_layer AS tl
    WHERE
    tl.id = ".$id."
    ");
  $model2 = DB::select("
    SELECT
    al.name AS alname , 
    al.id AS alid
    FROM
    technology_relation AS tr , 
    application_layer AS al
    WHERE
    tr.frag = 'a' AND
    tr.comp_id = al.id AND
    tr.technology_layer_id = ".$id."
    ");

    $model2_1 = DB::select("
    SELECT
    al.name AS alname , 
    al.id AS alid
    FROM
    application_relation AS ar , 
    application_layer AS al,
    technology_layer AS tl
    WHERE
    ar.frag = 't' AND
    ar.comp_id = tl.id AND
    ar.application_layer_id = al.id AND
    ar.comp_id = ".$id."
    ");

    $model2 = array_map(function ($modell2) {
      return (array)$modell2;
  }, $model2);
  $model2_1 = array_map(function ($modell2_1) {
    return (array)$modell2_1;
  }, $model2_1);
  
  
    $array2 = array_merge ($model2, $model2_1);
    $liste2 = array();
    foreach ($array2 as $value1 ) {
       if(!in_array($value1, $liste2, true)){
          array_push($liste2, $value1);
      }
    }

  $model3 = Brand::all();
  $model4 = Place::all();
  return view('front.TecDetail')->with(['liste2'=>$liste2,'model'=>$model,'model2'=>$model2,'model3'=>$model3,'model4'=>$model4,'lv1'=>$lv1]);
}
public function downloadbus($file_name) {    
  $filePath = public_path('images/bus/'.$file_name);

  if(file_exists($filePath)) {
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);

    header("Cache-Control: private");
    header("Content-Type: application/stream");
    header("Content-Disposition: attachment; filename=".$fileName);

    readfile ($filePath);
    exit();
  }
  else {
    die('The provided file path is not valid.');
  }
}
public function downloaddat($file_name) {  

      $lv1 = DB::table('business_layer_lv1')->get();

  $filePath = public_path('images/app/'.$file_name);

  if(file_exists($filePath)) {
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);

    header("Cache-Control: private");
    header("Content-Type: application/stream");
    header("Content-Disposition: attachment; filename=".$fileName);

    readfile ($filePath);
    exit();
  }
  else {
    die('The provided file path is not valid.');
  }
}
public function downloadtec($file_name) {    
  $filePath = public_path('images/tech/'.$file_name);

  if(file_exists($filePath)) {
    $fileName = basename($filePath);
    $fileSize = filesize($filePath);

    header("Cache-Control: private");
    header("Content-Type: application/stream");
    header("Content-Disposition: attachment; filename=".$fileName);

    readfile ($filePath);
    exit();
  }
  else {
    die('The provided file path is not valid.');
  }
}
public function menurelation(){

    $lv1 = DB::table('business_layer_lv1')->get();

  return view('front.menurelation')->with(['lv1'=>$lv1]);
}

public function viewrelation(){
  if($_POST["submit"]=="submit1")
    return $this->exportrelation();
  if($_POST["submit"]=="submit2")
    return $this->exportexcel();
}

public function exportrelation(){
  $st = $_POST['frst'];
  $nd = $_POST['scnd'];
  return $this->convertrelation($_POST['frst'],$_POST['scnd']);
}
public function convertrelation($frst , $scnd){
  switch ($frst) {
    case 'b':
    $modela = Business_layer::all();
    break;
    case 'a':
    $modela = Application_layer::all();
    break;
    case 'd':
    $modela = Data_layer::all();
    break;
    case 't':
    $modela = Technology_layer::all();
    break;
    case 'dp':
    $modela = Department::all();
    break;
    case 'lo':
    $modela = Place::all();
    break;
    case 'db':
    $modela = Use_data::all();
    break;
    case 'la':
    $modela = Develop_language::all();
    break;
    case 'c':
    $modela = Devlopment_group::all();
    break;
  }
  switch ($scnd) {
    case 'b':
    $modelb = Business_layer::all();
    break;
    case 'a':
    $modelb = Application_layer::all();
    break;
    case 'd':
    $modelb = Data_layer::all();
    break;
    case 't':
    $modelb = Technology_layer::all();
    break;
    case 'dp':
    $modelb = Department::all();
    break;
    case 'lo':
    $modelb = Place::all();
    break;
    case 'db':
    $modelb = Use_data::all();
    break;
    case 'la':
    $modelb = Develop_language::all();
    break;
    case 'c':
    $modelb = Devlopment_group::all();
    break;
    case 'ser';
    $modelb = DB::select("SELECT * FROM technology_layer WHERE type='1'");
    break;
    case 'st';
    $modelb = Type_collection::all();
    break;
    case 'br';
    $modelb = Brand::all();
    break;
  }
  if($frst=='b' && $scnd=='d'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.data_layer_id AS brid , br.comp_id AS brcomp FROM data_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='b' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='b' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='b'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.business_layer_id AS brid , br.comp_id AS brcomp FROM business_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='d'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.data_layer_id AS brid , br.comp_id AS brcomp FROM data_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='la'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.develop_language_id AS brid , br.comp_id AS brcomp FROM develop_language_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='db'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='ser'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='t'");
    $modelbr = DB::select("SELECT br.*,br.technology_layer_id AS brid , br.comp_id AS brcomp FROM technology_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='c'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.devlopment_group_id AS brid , br.comp_id AS brcomp FROM devlopment_group_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='b'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.business_layer_id AS brid , br.comp_id AS brcomp FROM business_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='st'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.type_collection_id AS brid , br.comp_id AS brcomp FROM type_collection_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='br'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.brand_id AS brid , br.comp_id AS brcomp FROM brand_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='lo'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.place_id AS brid , br.comp_id AS brcomp FROM place_relation AS br WHERE br.frag='".$frst."'");
  }

  $tablea = $frst;
  $tableb = $scnd;
  return view('front.viewrelation')->
  with([
    'modelb'=>$modelb,
    'modela'=>$modela,
    'modelar'=>$modelar,
    'modelbr'=>$modelbr,
    'tablea'=>$tablea,
    'tableb'=>$tableb
    ]);
}
public function viewBusType($type){
   $lv1 = DB::table('business_layer_lv1')->get();

   
if($type=="excel"){
 
            $count = 0;
            $data = array();
            $asd = array();
            $a = "" ;
            $buss = DB::table('business_layer')
            ->leftJoin('type_process', 'type_process.id', '=', 'business_layer.type')
            ->leftJoin('business_layer_lv3','business_layer_lv3.id', '=', 'business_layer.lv3_id')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->select('business_layer.id','business_layer.ids','business_layer.name','type_process.name as type1','type_process.remark as remark'
           ,'business_layer_lv1.short as lv1' ,'business_layer_lv2.short as lv2','business_layer_lv3.short as lv3')
            ->get()
            ->toArray();
            $des = DB::table('business_layer')
            ->leftJoin('business_relation','business_relation.business_layer_id', '=', 'business_layer.id')
            ->leftJoin('department','department.id', '=', 'business_relation.comp_id')
            ->select('business_layer.id','department.name as department_id')
            ->where('frag', 'dp')
            ->get();
                     
            foreach($buss as $bus){
              
              foreach($des as $de){
                        if($bus->id == $de->id ){
                           $a .= $de->department_id." ";
                        }
                      }
              array_push($data, array(
                  "รหัส" => $bus->lv1."".$bus->lv2."".$bus->lv3."".$bus->id, 
                  "ชื่อกระบวนการ" => $bus->name, 
                  "หน่วยงาน" => $a

              ));
              $a = "" ;
              $count++;
            }

           // ddd($data);
		return Excel::create('ข้อมูลกระบวนการ', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download('xlsx');
}else{
 $model = DB::select("
  SELECT
  bl.* ,  
  bl.id AS blid , 
  bl.ids AS blids ,
  bl.name AS blname ,  
  bl.type AS bltype , 
  typee.name AS typee , 
  typee.remark AS pfix
  FROM 
  business_layer AS bl ,
  type_process AS typee 
  WHERE
  typee.id = bl.type AND
  bl.type = ".$type);

    $model = DB::table('business_layer')
            ->leftJoin('type_process', 'type_process.id', '=', 'business_layer.type')
            ->leftJoin('business_layer_lv3','business_layer_lv3.id', '=', 'business_layer.lv3_id')
            ->leftJoin('business_layer_lv2','business_layer_lv2.id', '=', 'business_layer_lv3.lv2_id')
            ->leftJoin('business_layer_lv1','business_layer_lv1.id', '=', 'business_layer_lv2.lv1_id')
            ->select('business_layer.*','business_layer.type as bltype','business_layer.remark as blremark','business_layer.name as blname','business_layer.id as blid','business_layer.id as blids',
            'type_process.name as typee','type_process.remark as pfix'
            ,'business_layer_lv2.short as lv2','business_layer_lv2.name as n2','business_layer_lv2.id as id2'
            ,'business_layer_lv1.short as lv1','business_layer_lv1.name as n1','business_layer_lv1.id as id1'
            ,'business_layer_lv3.short as lv3','business_layer_lv3.name as n3','business_layer_lv2.id as id3')
            ->where('business_layer_lv1.id',$type)
            ->get();

 $model2 = DB::select("
  SELECT
  bl.* , 
  al.* ,
  br.* , 
  bl.id AS blid ,   
  al.name AS alname ,
  br.business_layer_id AS compblid
  FROM 
  business_layer AS bl ,  
  application_layer AS al ,
  business_relation AS br
  WHERE
  al.id = br.comp_id AND
  bl.id = br.business_layer_id AND
  br.frag = 'a'
  ");
 $model3 = DB::select("
  SELECT 
  dp.name AS dpname , 
  dp.id AS dpid , 
  dr.id_bus AS drbusid , 
  dr.department_id AS drdpid
  FROM
  department AS dp , 
  bus_depart AS dr
  WHERE
  dp.id = dr.department_id
  ");
}
 if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.Bustype')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'lv1'=>$lv1]);

}

}
public function viewDatType($type){

    $lv1 = DB::table('business_layer_lv1')->get();

 $model = DB::select("
  SELECT
  dl.* , 
  dl.id AS datid , 
  dl.name AS datname ,
  dl.type AS dattype ,
  dl.remark AS datremark ,
  pfix.initial AS pfix , 
  typee.name AS typee
  FROM 
  data_layer AS dl ,
  initial AS pfix ,
  type_collection AS typee
  WHERE
  pfix.name = 'data' AND
  dl.type = typee.id AND
  dl.type = ".$type);
 if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.Dattype')->with(['model'=>$model,'lv1'=>$lv1]);
}
}

public function viewTecType($type){

    $lv1 = DB::table('business_layer_lv1')->get();

 $model = DB::select("
  SELECT
  tl.* , 
  tl.id AS tecid ,
  tl.name AS tecname ,
  tl.brand AS tecbrand ,
  tl.model AS tecmodel ,
  tl.tech_spec AS tecspec ,
  tl.amount AS tecamount ,
  tl.tech_location AS teclocation ,
  tl.ma_cost AS tecma_cost ,
  tl.remark AS tecremark 
  FROM 
  technology_layer AS tl
  WHERE
  tl.type = ".$type
  );
 $model2 = Brand::all();
 $model3 = Place::all();

 if($type=="excel"){
 
            $count = 0;
            $data = array();
            $a = "" ;
            $a1 = "" ;
            $a2 = "" ;
            $a3 = "" ;
            $a4 = "" ;

                     
            foreach($model as $model){

              foreach($model3 as $modell3){
                if($model->teclocation==$modell3->id)
                            {
                              $a .= $modell3->name." ";
                            }
              }
              foreach($model2 as $modell2){
                if($model->tecbrand==$modell2->id){
                      $a1 .= $modell2->name." ";
                }
              }
              switch ($model->type) {
                            case '1':
                            $a2 = 'เครื่องแม่ข่าย ';
                            break;
                            case '2':
                            $a2 = 'อุปกรณ์';
                            break;
                          }
              
              array_push($data, array(
                  "ชื่อ" => $model->tecname, 
                  "ยี่ห้อ" => $a1,
                  "รุ่น" => $model->tecmodel , 
                  "สเปค" =>$model->tecspec,
                  "จำนวน" =>$model->tecamount,
                  "สถานที่ตั้ง" =>  $a,
                  "ค่าอมบารุงต่อปี" =>  $model->tecma_cost,
                  "รายละเอียด" =>  $model->tecremark,
                  "ประเภท" => $a2

              ));
              $a = "" ;
              $a1 = "" ;
              $a2 = "" ;
              $a3 = "" ;
              $a4 = "" ;
              $count++;
            }

         //   ddd($data);
    return Excel::create('ข้อมูลเทคโนโลยี', function($excel) use ($data) {
      $excel->sheet('mySheet', function($sheet) use ($data)
          {
        $sheet->fromArray($data);
          });
    })->download('xlsx');
}
 if($model==NULL){
  return view('front.Nothing');
}else{
  return view('front.Tectype')->with(['model'=>$model,'model2'=>$model2,'model3'=>$model3,'lv1'=>$lv1]);
}
}

public function exportexcel(){

    $lv1 = DB::table('business_layer_lv1')->get();

  // $st = 'b';
  // $nd = 'a';
  $st = $_POST['frst'];
  $nd = $_POST['scnd'];
  return $this->convertrelationexport($st,$nd);
}
public function convertrelationexport($frst , $scnd)
{
  switch ($frst) {
    case 'b':
    $modela = Business_layer::all();
    $tablea = "กระบวนการ";
    break;
    case 'a':
    $modela = Application_layer::all();
    $tablea = "ระบบสารสนเทศ";
    break;
    case 'd':
    $modela = Data_layer::all();
    $tablea = "ข้อมูล";
    break;
    case 't':
    $modela = Technology_layer::all();
    $tablea = "เทคโนโลยี";
    break;
    case 'dp':
    $modela = Department::all();
    $tablea = "หน่วยงาน";
    break;
    case 'lo':
    $modela = Place::all();
    $tablea = "สถานที่ตั้ง";
    break;
    case 'db':
    $modela = Use_data::all();
    $tablea = "ฐานข้อมูล";
    break;
    case 'la':
    $modela = Develop_language::all();
    $tablea = "ภาษาที่พัฒนา";
    break;
    case 'c':
    $modela = Devlopment_group::all();
    $tablea = "บริษัทที่พัฒนา";
    break;
  }
  switch ($scnd) {
    case 'b':
    $modelb = Business_layer::all();
    $tableb = "กระบวนการ";
    break;
    case 'a':
    $modelb = Application_layer::all();
    $tableb = "ระบบสารสนเทศ";
    break;
    case 'd':
    $modelb = Data_layer::all();
    $tableb = "ข้อมูล";
    break;
    case 't':
    $modelb = Technology_layer::all();
    $tableb = "เทคโนโลยี";
    break;
    case 'dp':
    $modelb = Department::all();
    $tableb = "หน่วยงานที่เกี่ยวข้อง";
    break;
    case 'lo':
    $modelb = Place::all();
    $tableb = "สถานที่ตั้ง";
    break;
    case 'db':
    $modelb = Use_data::all();
    $tableb = "ฐานข้อมูล";
    break;
    case 'la':
    $modelb = Develop_language::all();
    $tableb = "ภาษาที่พัฒนา";
    break;
    case 'c':
    $modelb = Devlopment_group::all();
    $tableb = "บริษัทที่พัฒนา";
    break;
    case 'ser';
    $modelb = DB::select("SELECT * FROM technology_layer WHERE type='1'");
    $tableb = "เครื่องแม่ข่าย";
    break;
    case 'st';
    $modelb = Type_collection::all();
    $tableb = "การจัดเก็บ";
    break;
    case 'br';
    $modelb = Brand::all();
    $tableb = "ยี่ห้อ";
    break;
  }
  if($frst=='b' && $scnd=='d'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.data_layer_id AS brid , br.comp_id AS brcomp FROM data_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='b' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='b' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.business_layer_id AS arid , ar.comp_id AS arcomp FROM business_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='b'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.business_layer_id AS brid , br.comp_id AS brcomp FROM business_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='d'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.data_layer_id AS brid , br.comp_id AS brcomp FROM data_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='la'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.develop_language_id AS brid , br.comp_id AS brcomp FROM develop_language_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='db'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='ser'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='t'");
    $modelbr = DB::select("SELECT br.*,br.technology_layer_id AS brid , br.comp_id AS brcomp FROM technology_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='c'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.devlopment_group_id AS brid , br.comp_id AS brcomp FROM devlopment_group_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='a' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='b'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.business_layer_id AS brid , br.comp_id AS brcomp FROM business_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='st'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.type_collection_id AS brid , br.comp_id AS brcomp FROM type_collection_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='d' && $scnd=='dp'){
    $modelar = DB::select("SELECT ar.*,ar.data_layer_id AS arid , ar.comp_id AS arcomp FROM data_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.department_id AS brid , br.comp_id AS brcomp FROM department_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='a'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.application_layer_id AS brid , br.comp_id AS brcomp FROM application_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='br'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.brand_id AS brid , br.comp_id AS brcomp FROM brand_relation AS br WHERE br.frag='".$frst."'");
  }
  if($frst=='t' && $scnd=='lo'){
    $modelar = DB::select("SELECT ar.*,ar.technology_layer_id AS arid , ar.comp_id AS arcomp FROM technology_relation AS ar WHERE ar.frag='".$scnd."'");
    $modelbr = DB::select("SELECT br.*,br.place_id AS brid , br.comp_id AS brcomp FROM place_relation AS br WHERE br.frag='".$frst."'");
  }


    // $modela = Application_layer::all();
    // $modelar = DB::select("SELECT ar.*,ar.application_layer_id AS arid , ar.comp_id AS arcomp FROM application_relation AS ar WHERE ar.frag='b'");
    // $modelb = Application_layer::all();
    // $modelbr = DB::select("SELECT br.*,br.business_layer_id AS brid , br.comp_id AS brcomp FROM business_relation AS br WHERE br.frag='a'");
    $layerid[0][0]=0;
    $f = 0;
    $n = 0;
    foreach ($modelb as $modellb) {
      foreach ($modela as $modella) {

        foreach ($modelbr as $modellbr) {
          if( $modellbr->brid == $modellb->id){
            if( $modellbr->brcomp == $modella->id){
              $f=1;
            }
          }
        }

        foreach ($modelar as $modellar) {
          if( $modellar->arid == $modella->id){
            if( $modellar->arcomp == $modellb->id){
              $n=1;
            }
          }
        }
        if ($f == 1 || $n == 1) {
          $layerid[$modellb->id][$modella->id] = "true";
          $f = 0;
          $n = 0;
        }else{
          $layerid[$modellb->id][$modella->id] = "false";
          $f = 0;
          $n = 0;
        }

      }
    }
    Excel::create("ตารางความสัมพันธ์ของ".$tablea." - ".$tableb, function($excel)use($layerid,$modela,$modelb,$modelar,$modelbr){
      $excel->sheet('ตารางความสัมพันธ์', function($sheet)use($layerid,$modela,$modelb,$modelar,$modelbr){
  //Content
          $colum = 'A';
          $ro = 1;
          //$sheet->cell("A"."2", function($cell)use($layerid){$cell->setValue($layerid[1][2]); });
          foreach ($modela as $modella) {
            $ro++;
            foreach ($modelb as $modellb) {
              $colum++;
              if ($layerid[$modellb->id][$modella->id]=="true") {
                       $sheet->cell($colum.$ro, function($cell)use($layerid,$modella,$modellb){$cell->setValue("✔")->setAlignment('center'); });
              }
              //$sheet->cell($colum.$ro, function($cell)use($layerid,$modella,$modellb){$cell->setValue($modella->id."/".$modellb->id); });


            }
            $colum = 'A';
          }
  //Content
  //Header
          $colum = 'B';
          $ro = 2;
          foreach ($modelb as $modellb) {
            //$sheet->cell($colum."1",  function($cell)use($modellb){$cell->setValue($modellb->id.$modellb->name); });
            $sheet->cell($colum."1",  function($cell)use($modellb){$cell->setValue($modellb->name); });
            $colum++;
          }
          foreach ($modela as $modella) {
            //$sheet->cell("A".$ro, function($cell)use($modella){$cell->setValue($modella->id.$modella->name); });
            $sheet->cell("A".$ro, function($cell)use($modella){$cell->setValue($modella->name); });
            $ro++;
          }
  //Header
        });
      })->download('xls');
    }
}/*
    //start th row
foreach($modela as $modella){
  {{$modella->name}}
}
    //end th row

    //start th column
foreach($modelb as $modellb){
  {{$modellb->name}}
  foreach($modela as $modella){

    $f=0; $n=0;
      //start comp a
    foreach($modelar as $modellar){
      if($modellar->arid==$modella->id){ 
        if($modellb->id==$modellar->arcomp){
          $f=1;
        }
      }
    }
      //end comp a

      //start comp b
    foreach($modelbr as $modellbr){
      if($modellbr->brid==$modellb->id){
        if($modella->id==$modellbr->brcomp){
          $n=1;
        }
      }
    }
      //end comp b

      //start print
    if($f==1||$n==1){
      echo '✔';
    }
      //end print

  }
}
*/
