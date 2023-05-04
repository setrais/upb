<?php

namespace backend\controllers;

use Yii;
use backend\models\Files;
use backend\models\Iblocks;
use backend\models\IblocksMany;
use backend\models\IblocksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\icxp\helpers\Ri;
use yii\icxp\helpers\RiImage;
use yii\icxp\helpers\HRu;
use yii\icxp\helpers\HCommon;

/**
 * IblocksController implements the CRUD actions for Iblocks model.
 */
class IblocksController extends Controller
{
    public $layout = "main-x";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param int $type_inp
     * Lists all Iblocks models.
     * @return mixed
     */
    public function actionIndex( $type_inp = 0 )
    {
        $searchModel = new IblocksSearch();

        if ( $type_inp ) {
            $searchModel->types_iblocks_id = $type_inp;
        } else {
            $request = Yii::$app->request;
            $type = $request->get('types');
            if ( $type <> 'default') {
                $searchModel->types_iblocks_id = $type;
            }
        }

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /** Вывод списка управлееия инфоблоками
     * @return mixed
     */
    public function actionIblocks() {
        return $this->actionIndex(0);
    }

    /** Вывод списка управлееия верхним меню
     * @return mixed
     */
    public function actionHeaderMenus() {
        return $this->actionIndex(1);
    }

    /** Вывод списка управлееия статьями
     * @return mixed
     */
    public function actionArticles() {
        return $this->actionIndex(2);
    }

    /** Вывод списка управлееия верхним меню
     * @return mixed
     */
    public function actionFooterMenus() {
        return $this->actionIndex(3);
    }

    /** Вывод списка управления страницами
     * @return mixed
     */
    public function actionPages() {
        return $this->actionIndex(4);
    }

    /** Вывод списка управления новостями
     * @return mixed
     */
    public function actionNews() {
        return $this->actionIndex(5);
    }

    /** Вывод списка управления блогами
     * @return mixed
     */
    public function actionBlogs() {
        return $this->actionIndex(6);
    }

    /** Вывод списка управления предложениями
     * @return mixed
     */
    public function actionRealestates() {
        return $this->actionIndex(7);
    }

    /** Вывод списка управления предложениями
     * @return mixed
     */
    public function actionGroups() {
        return $this->actionIndex(8);
    }

    /** Вывод списка управления разделами
     * @return mixed
     */
    public function actionSections() {
        return $this->actionIndex(9);
    }

    /** Вывод списка управления меню
     * @return mixed
     */
    public function actionMenus() {
        return $this->actionIndex(10);
    }

    /** Вывод списка управления уделами
     * @return mixed
     */
    public function actionPortions() {
        return $this->actionIndex(11);
    }

    /** Вывод списка управления блоками
     * @return mixed
     */
    public function actionBlocks() {
        return $this->actionIndex(12);
    }

    /** Вывод списка управления сообщениями
     * @return mixed
     */
    public function actionMessages() {
        return $this->actionIndex(13);
    }

    /** Вывод списка управления предложениями
     * @return mixed
     */
    public function actionSchedules() {
        return $this->actionIndex(14);
    }

    /**
     * Displays a single Iblocks model.
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Iblocks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Iblocks();
        // Генерация ID
        $model = $this->genIds($model);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Iblocks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // Генерация ID в случае если нет параметров
        $model = $this->genIds($model);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if ( !empty(Yii::$app->request->post()) ) {

            /* Перегенерация sid;
            !TODO в дальнейшем нужно пересмотреть генерацию с формы*/
            $model->sid = HRu::translit($model->name);

            if (trim($model->createdate) <> '') $model->createdate = date('Y-m-d', strtotime($model->createdate));
            else $model->createdate = date('Y-m-d');
            if (trim($model->updatedate) <> '') $model->updatedate = date('Y-m-d', strtotime($model->updatedate));
            else $model->updatedate = date('Y-m-d');
            if (!trim($model->createusers) <> '') $model->createdate = Yii::app()->user->id;
            if (!trim($model->updateusers) <> '') $model->updateusers = Yii::app()->user->id;
        }

        if ( $model->load( Yii::$app->request->post() ) && $model->save()) {

            $this->SavePropsIblocks($model);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Iblocks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function SavePropsIblocks($model, $copid="") {

        // Запись списка свойств недвижемости
        $model_properties = new IblocksMany();
        $properties = $this->SetManies($model->id, 'type_iblock_id', $model_properties);

        // Запись фото орегинала недвижемости
        $file_picOreginal=$this->SetPicOreginal($model->id, $model, $copid);
        if ( $file_picOreginal && $file_picOreginal->id ) {
            $attributes["pic_oreginal_id"]= $file_picOreginal->id ;
            $attributes["pic_detile_id"]= $file_picOreginal->id ;
            $attributes["pic_anons_id"]= $file_picOreginal->id ;
            $attributes["pic_scr_id"]= $file_picOreginal->id ;
        }
        else if ($file_picOreginal===null) $attributes["pic_oreginal_id"]= null ;

        // Запись фото скриншота недвижемости
        $file_picScr=$this->SetPicScr($model->id, $model, $copid);
        if ( $file_picScr && $file_picScr->id) $attributes["pic_scr_id"]= $file_picScr->id ;
        else if ($file_picScr===null) $attributes["pic_scr_id"]=null; //

        // Запись фото анонса недвижемости
        $file_picAnons=$this->SetPicAnons($model->id, $model, $copid);
        if ( $file_picAnons && $file_picAnons->id) $attributes["pic_anons_id"]= $file_picAnons->id ;
        else if ($file_picAnons===null) $attributes["pic_anons_id"]=null;

        // Запись детального фото недвижемости
        $file_picDetile=$this->SetPicDetile($model->id, $model, $copid);
        if ( $file_picDetile && $file_picDetile->id) $attributes["pic_detile_id"]= $file_picDetile->id ;
        else if ($file_picDetile===null) $attributes["pic_detile_id"]= null ;

        // Обновление модели
        if ( isset( $attributes ) ) {
            $model->attributes = $attributes;
            $model->update();
        }
        // Запись
        $errors = array();
        if ( $model && is_array( $model->errors ) && !empty($model->errors))
            $errors = array_merge($errors,$model->errors);

        if ( $properties && is_array($properties->errors))
            $errors = array_merge($errors,$properties->errors);
        if ( $file_picOreginal && is_array($file_picOreginal->errors && !empty($file_picOreginal->errors)))
            $errors = array_merge($errors,$file_picOreginal->errors);
        if ( $file_picScr && is_array($file_picScr->errors && !empty($file_picScr->errors)))
            $errors = array_merge($errors,$file_picScr->errors);
        if ( $file_picAnons && is_array($file_picAnons->errors && !empty($file_picAnons->errors)))
            $errors = array_merge($errors,$file_picAnons->errors);
        if ( $file_picDetile && is_array($file_picDetile->errors && !empty($file_picDetile->errors)))
            $errors = array_merge($errors,$file_picDetile->errors);

        // !@TODO Cобрать все ошибки Переход при удачной записи
        if ( empty($errors)) $this->redirect(array('view','id'=>$model->id));

    }

    protected function SetPicDetile($id, $model, $copid="") {
        return $this->SetPic($id, $model, 'pic_detile_id','Картинка детально '. Yii::t('all','iblock'), $copid);
    }

    protected function SetPicAnons($id, $model, $copid="" ) {
        return $this->SetPic($id, $model, 'pic_anons_id','Анонс картинки '. Yii::t('all','iblock'), $copid);
    }

    protected function SetPicOreginal($id, $model, $copid="" ) {
        return $this->SetPic($id, $model, 'pic_oreginal_id','Орегинал '. Yii::t('all','iblock'), $copid);
    }

    protected function SetPicScr($id, $model, $copid="" ) {
        return $this->SetPic($id, $model, 'pic_scr_id','Скриншот '. Yii::t('all','iblock'),$copid);
    }

    protected function SetPic($id, $model, $field_imp,$file_title, $copid="") {

        if ( !(isset( $exts )) ) {
            $exts=array('jpg','jpeg','png');
        }

        $field = str_replace("_", "", $field_imp);
        $field = str_replace("id", "", $field);
        $field = str_replace("pic", "", $field);
        $field = "pic".ucfirst($field);

        //Yii::app()->end();
        //print_r($_FILES);
        //echo "<br/>".trim($_FILES['Iblocks']["name"][$field]);
        //exit;

        $file = $this->SaveFile($id, $model, $field, $file_title, true );

        if ( is_object($file) ) {

            if (isset($_POST['Iblocks'][$field_imp]) && trim($_POST['Iblocks'][$field_imp])<>"" && trim($copid)==="" )
            {

               /* $file_record = Files::findOne($_POST['Iblocks'][$field_imp]);

                //echo $_POST['Iblocks'][$field_imp];
                //echo "<pre>"; print_r($file_record); echo "<pre/>";

                // Save upload files Many Field

                if ($file_record) {

                    $attributes = array(
                        "status"          => "refused",
                        "height"          => $file->height,
                        "width"           => $file->width,
                        "file_size"       => $file->file_size,
                        "ext"             => $file->ext,
                        "subdir"          => $file->subdir,
                        "file_name"       => $file->file_name,
                        "original_name"   => $file->original_name,
                        "content_type"    => $file->content_type,
                        "updated_user"    => Yii::$app->user->id,
                        "updated"         => date('Y-m-d'),
                        "controller"      => $file->controller,
                        "action"          => $file->action
                    );

                    $file_record->attributes=$attributes;

                    if ( $file->id <> intval($_POST['Iblocks'][$field_imp]) ) {
                        $file_record->id = $file->id;
                    }*/
                    // Зачистка файлов
                    //$file_old=Files::findOne($file_record->id);
                    $file_old=Files::findOne($_POST['Iblocks'][$field_imp]);

                    if( $file_old && is_file(Yii::$app->basePath."/../".$file_old->original_name)) {
                        if ( $field == 'picOreginal') {
                            unlink(Yii::$app->basePath . "/../" . $file_old->original_name);
                            if ( !(strpos($file_old->original_name,"original") === false) &&
                                is_file(Yii::$app->basePath."/../". str_replace("original", "scr", $file_old->original_name))) {
                               unlink(Yii::$app->basePath . "/../" . str_replace("original", "scr", $file_old->original_name));
                            }
                            if ( !(strpos($file_old->original_name,"original") === false) &&
                                is_file(Yii::$app->basePath."/../". str_replace("original", "small", $file_old->original_name))) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original", "small", $file_old->original_name));
                            }
                            if ( !(strpos($file_old->original_name,"original") === false) &&
                                is_file(Yii::$app->basePath."/../". str_replace("original", "big", $file_old->original_name))) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original", "big", $file_old->original_name));
                            }
                        }else if( $field == 'picScr' ) {
                            if ( is_file(Yii::$app->basePath."/../". str_replace("original", "scr", $file_old->original_name)) ) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original", "scr", $file_old->original_name));
                            }
                            if ( !(strpos($file_old->original_name,"original_scr") === false) &&
                                 is_file(Yii::$app->basePath."/../". str_replace("original_scr", "scr", $file_old->original_name)) ) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original_scr", "scr", $file_old->original_name));
                            }
                        }else if( $field == 'picAnons' ) {
                            if ( is_file(Yii::$app->basePath."/../". str_replace("original", "small", $file_old->original_name)) ) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original", "small", $file_old->original_name));
                            }
                            if ( !(strpos($file_old->original_name,"original_anons") === false) &&
                                is_file(Yii::$app->basePath."/../". str_replace("original_small", "small", $file_old->original_name))) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original_small", "small", $file_old->original_name));
                            }
                        }else if( $field == 'picDetile' ) {
                            if ( is_file(Yii::$app->basePath."/../". str_replace("original", "big", $file_old->original_name)) ) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original", "big", $file_old->original_name));
                            }
                            if ( !(strpos($file_old->original_name,"original_detile") === false) &&
                                is_file(Yii::$app->basePath."/../". str_replace("original_big", "big", $file_old->original_name))) {
                                unlink(Yii::$app->basePath . "/../" . str_replace("original_big", "big", $file_old->original_name));
                            }
                        }
                    }

                //}else $file_record = $file;
            }/*else $file_record = $file;

            if ( $file_record->save() ) {
                return $file_record; /* echo "Файл орегинала записан" ;
            }*/
            return $file;
        }

        // Удаление если не существует
        if ( !isset($_POST['Iblocks'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)==="" )
        {
            /*!@TODO Проверить */
            // Зачистка файлов
            $file_old=Files::findOne($model->$field_imp);

            if( $file_old && is_file(Yii::$app->basePath."/../".$file_old->original_name)) {
                if ( $field == 'picOreginal') {
                    unlink(Yii::$app->basePath . "/../" . $file_old->original_name);
                    if ( !(strpos($file_old->original_name,"original") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original", "scr", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "scr", $file_old->original_name));
                    }
                    if ( !(strpos($file_old->original_name,"original") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original", "small", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "small", $file_old->original_name));
                    }
                    if ( !(strpos($file_old->original_name,"original") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original", "big", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "big", $file_old->original_name));
                    }
                }else if( $field == 'picScr' ) {
                    if ( is_file(Yii::$app->basePath."/../". str_replace("original", "scr", $file_old->original_name)) ) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "scr", $file_old->original_name));
                    }
                    if ( !(strpos($file_old->original_name,"original_scr") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original_scr", "scr", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original_scr", "scr", $file_old->original_name));
                    }
                }else if( $field == 'picAnons' ) {
                    if ( is_file(Yii::$app->basePath."/../". str_replace("original", "small", $file_old->original_name)) ) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "small", $file_old->original_name));
                    }
                    if ( !(strpos($file_old->original_name,"original_small") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original_small", "small", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original_small", "small", $file_old->original_name));
                    }
                }else if( $field == 'picDetile' ) {
                    if ( is_file(Yii::$app->basePath."/../". str_replace("original", "big", $file_old->original_name)) ) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original", "big", $file_old->original_name));
                    }
                    if ( !(strpos($file_old->original_name,"original_big") === false) &&
                        is_file(Yii::$app->basePath."/../". str_replace("original_big", "big", $file_old->original_name))) {
                        unlink(Yii::$app->basePath . "/../" . str_replace("original_big", "big", $file_old->original_name));
                    }
                }
            }


            Files::deleteAll('id='.$model->$field_imp);
            return null;

            // Копирование файлов изображения
        } else if ( isset($_POST['Iblocks'][$field_imp]) && trim($model->$field_imp)<>"" && trim($copid)<>"" ) {

            $file_copy=Files::findOne($model->$field_imp);

            /*if ($field_imp == "pic_oreginal_id") {
               echo "<pre>"; print_r($file_copy->attributes); echo "</pre>";
               exit;
            }*/

            $file_record = new Files();  $id=$file_record->id;
            $file_record->attributes = $file_copy->attributes;
            $file_record->id = $id;

            if ( $file_record->save() ) {
                return $file_record;
            }else{
                return false;
            }
        } else {
            return false;
        }

    }

    // Save files
    protected function SaveFile($id, $model, $field, $file_title, $save_model=false, $key=null, $is_image=true) {

        //echo "<pre>"; print_r($_FILES["Iblocks"]); "</pre>";
        $is_upfile = ( $key!==null ? $_FILES["Iblocks"]["name"][$field][$key]<>""
            : $_FILES["Iblocks"]["name"][$field]<>"" );
        if ( isset($_FILES["Iblocks"]["name"][$field]) && $is_upfile )
        {
            if ( $key!==null ) {
                //echo "model:[$key]".$field;
                $upfile=UploadedFile::getInstancesByName("Iblocks[".$field."]");
                $upfile=$upfile[$key];
            }
            else
            {
                $upfile=UploadedFile::getInstance($model,$field);
                //print_r($upfile);
                //exit;
            }

            if (!empty($upfile)) {

                $pathto = Yii::$app->basePath."/../";
                $pathto_tmp = "uploads/tmp";
                $pathfull_tmp_file = $pathto.$pathto_tmp."/".$upfile->name;

                $Ri = new Ri;
                $uid=$Ri->genid();

                $pathto_original = "uploads/files";

                if ( $field == 'picScr' ) {
                    $file_name = $model->tableName() . "_" . $uid . "_original_scr." . $upfile->getExtension();
                } else if ( $field == 'picAnons' ) {
                    $file_name = $model->tableName() . "_" . $uid . "_original_small." . $upfile->getExtension();
                } else if ( $field == 'picDetile' ) {
                    $file_name = $model->tableName() . "_" . $uid . "_original_big." . $upfile->getExtension();
                } else {
                    $file_name = $model->tableName() . "_" . $uid . "_original." . $upfile->getExtension();
                }

                $path_original_file = $pathto_original."/".$file_name;
                $pathfull_original_file = $pathto.$path_original_file;

                // Запись орегинальной картинки
                if ( $upfile->saveAs($pathfull_original_file) ) {

                    // Ресайз картинок
                    if ($is_image)
                    {
                        if ( $field == 'picOreginal') {
                            $pathto_src_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_scr." . $upfile->getExtension();
                            $pathto_big_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_big." . $upfile->getExtension();
                            $pathto_small_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_small." . $upfile->getExtension();

                            $images = new RiImage();
                            $images->scr_photo->width=null;
                            $images->scr_photo->max_width=60;
                            $images->scr_photo->height=40;
                            $images->small_photo->width=null;//120;
                            $images->small_photo->height=80;
                            $images->big_photo->width=null;//800;
                            $images->big_photo->height=600;

                            // Ресайз картинок в выводом ошибок в буфер

                            $resize_src   = $images->resize( $pathfull_original_file, $pathto_src_file, $images->scr_photo);
                            $resize_small = $images->resize( $pathfull_original_file, $pathto_small_file, $images->small_photo);
                            $resize_big   = $images->resize( $pathfull_original_file, $pathto_big_file, $images->big_photo);

                        } else if ($field == 'picScr') {
                            $pathto_src_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_scr." . $upfile->getExtension();
                            $images = new RiImage();
                            $images->scr_photo->width=null;
                            $images->scr_photo->max_width=60;
                            $images->scr_photo->height=40;
                            // Ресайз картинок в выводом ошибок в буфер
                            $resize_src   = $images->resize( $pathfull_original_file, $pathto_src_file, $images->scr_photo);

                        } else if ($field == 'picDetile') {
                            $pathto_big_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_big." . $upfile->getExtension();
                            $images = new RiImage();
                            $images->big_photo->width=null;//800;
                            $images->big_photo->height=600;
                            $resize_big   = $images->resize( $pathfull_original_file, $pathto_big_file, $images->big_photo);

                        } else if ($field == 'picAnons') {
                            $pathto_small_file = $pathto . $pathto_original . "/" . $model->tableName() . "_" . $uid . "_small." . $upfile->getExtension();
                            $images = new RiImage();
                            $images->small_photo->width=null;//120;
                            $images->small_photo->height=80;
                            $resize_small = $images->resize( $pathfull_original_file, $pathto_small_file, $images->small_photo);

                        }

                        // Получаем размеры в масив
                        $imgwh = getimagesize($pathfull_original_file);
                        $img_height = $imgwh[1];
                        $img_width = $imgwh[0];

                    }else{
                        $img_height = null;
                        $img_width = null;
                    }

                    // Запись картинки орегинала
                    $file = new Files();

                    $attributes = array( "uid"                => $uid,
                        "status"          => "created",
                        "name"            => $file_title." №".$id,
                        "order"           => 500,
                        "height"          => $img_height,
                        "width"           => $img_width,
                        "file_size"       => $upfile->size,
                        "ext"             => $upfile->getExtension(),
                        "subdir"          => $pathto_original,
                        "file_name"       => $file_name,
                        "original_name"   => $path_original_file,
                        "content_type"    => $upfile->type,
                        "created_user"    => Yii::$app->user->id,
                        "created"         => date('Y-m-d'),
                        "controller"      => $this->id,
                        "action"          => $this->action->id);

                    $file->attributes=$attributes;

                    if ( $save_model ) {
                        if ( !($file->save()) ) $errors = $file->errors; /* echo "Файл орегинала записан" */
                    }
                    return $file;
                }
                else return false;
            }
            else return false;
        }
    }

    protected function SetManies ( $id, $field_id, $model ) {

        // Save Representatives
        if (isset($_POST['Iblocks']['manies']))
        {
            $errors = array();
            $model->deleteAll('iblock_id='.$id);

            //print_r($_POST['Realestates'][$field]);

            foreach ($_POST['Iblocks']['manies'] as $key=>$many )
            {
                $attributes = array( "iblock_id" => $id, $field_id => $many,);

                $model->attributes = $attributes;

                if ( !($model->save()) ) {
                    if (is_array($model->errors))
                        $errors=array_merge($errors,$model->errors);
                }
                $model = new $model;

            }
            return $errors;
        } else {

            $model->deleteAll('iblock_id='.$id);
            return false;
        }
    }

    public function actionGetajaxsection() {

        if( Yii::$app->request->getIsAjax() && Yii::$app->request->getIsPost() ) { // Если ajax запрос
            if ( isset($_POST['types_iblocks_id']) )
            {
                $render = '_section';

                $model =  new Iblocks();
                $model->types_iblocks_id = $_POST['types_iblocks_id'];
                $model->grid = $_POST['grid'];

                if (empty($model->action)) $model->action = $model->type->action;
                if (empty($model->url)) $model->url = $model->type->url_elem.'#id';
                if (empty($model->url_detile)) $model->url_detile = $model->type->url_elem.'#id';
                if (empty($model->url_list)) $model->url_list = $model->type->url_sect;

                return $this->renderPartial($render,array(
                    'model'=>$model
                ));
            }
            //Yii::$app->end();
        }
    }

    /**
     * Finds the Iblocks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Iblocks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Iblocks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Генерация заголовка
     * @param null $id
     */
    public function actionGenTitle($id=null) {

        if( Yii::app()->request->isAjaxRequest ) {
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Iblocks']))
            {
                $model = new Iblocks();
                $model->attributes = $_POST['Iblocks'];

                $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field title for iblock').($id ? " №".$id : ""), "content"=>$model->createTitle());
            }else{
                $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field title for iblock').($id ? " №".$id : ""), "content"=>null);
            }

            echo json_encode($data);

            Yii::app()->end();
        }

    }

    /**
     * Генерация описания
     * @param null $id
     */
    public function actionGenDescription($id=null) {

        if( Yii::app()->request->isAjaxRequest ) {
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Iblocks']))
            {
                $model = new Iblocks();
                $model->attributes = $_POST['Iblocks'];

                $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field description for iblock').($id ? " №".$id : ""), "content"=>$model->createDescription());
            }else{
                $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field description for iblock').($id ? " №".$id : ""), "content"=>null);
            }

            echo json_encode($data);

            Yii::app()->end();
        }

    }

    /**
     * Генерация ключевых слов
     *
     * @param null $id
     */
    public function actionGenKeywords($id=null) {

        if( Yii::app()->request->isAjaxRequest ) {
            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['Iblocks']))
            {
                $model = new Iblocks();
                $model->attributes = $_POST['Iblocks'];

                $data = array( "error"=>false, "mess"=>Yii::t('all','Gen field keywords for iblock').($id ? " №".$id : ""), "content"=>$model->createKeywords());
            }else{
                $data = array( "error"=>true, "mess"=>Yii::t('all','No gen field keywords for iblock').($id ? " №".$id : ""), "content"=>null);
            }

            echo json_encode($data);

            Yii::app()->end();
        }

    }

    // Генерация Id в случае если нет параметров
    protected function genIds($model, $is_gen=false)
    {
        if (trim($model->uid)=='' || $is_gen ) $model->uid = Ri::genid();
        if ( ( trim($model->sid)=='' || $is_gen ) && trim($model->name)<>'' ) $model->sid = HRu::translit($model->name);
        //if (trim($model->nid)=='') $model->nid = strtoupper(HCommon::genRandomString());
        if (trim($model->nid)=='' || $is_gen ) $model->nid = rand(1,99999).strtoupper(HCommon::genRandomString(2,'',array('num'=>false)));

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='ri-iblocks-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
