<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use Zend\Feed\Writer\Feed;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionDownload()
    {
        return \Yii::$app->response->sendFile('/README.md');
    }

    public function actionOld() {
        return $this->redirect('/','301')->send();
    }

    public function actionInfo() {
        return Yii::createObject([
            'class' => 'yii\web\Response',
            'format' => \yii\web\Response::FORMAT_XML,
            'data' => [
                'message' => 'hello world',
                'code' => 100,
            ],
        ]);
    }

    public function actionBiblioteka() {
        return $this->render('biblioteka');
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function actionJson()
    {
        $something = true; // or you can set for test -> false;
        $return_json = ['status' => 'error'];
        if ($something == true)
        {
            $return_json = ['status' => 'success', 'message' => ' is successfully saved'];
        }
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;

        return $return_json;
    }

    public function actionXml()
    {
        $something = true;
        $return_xml = ['status' => 'error'];
        if ($something == true)
        {
            $return_xml = ['status' => 'success', 'message' => ' is successfully saved'];
        }
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_XML;
        return $return_xml;
    }

    /**
     * Building Rss News.
     * @param mixed $id
     * @param null $type
     * @param string $vid
     */
    public function actionRss( $id=null,$type=null,$vid='ATOM') {

        Yii::import('@app.vendor.extensions.feed.*');

        if ($id<>null) {

        }else{
            // RSS 2.0 is the default type
            if ($vid=="RSS1") :
                $feed = new EFeed(EFeed::RSS1);
                $feed->link = 'http://pegasrealty.ru';
                $feed->RSS1ChannelAbout = 'http://pegasrealty.ru/site/rss';
            elseif ($vid=="ATOM") :
                $feed = new EFeed(EFeed::ATOM);
                $feed->addChannelTag('updated', date(DATE_ATOM, time()));
                $feed->addChannelTag('author', array('name'=>Yii::app()->params['infoEmail'].'(Vlad Ladogsky)'));
            //$feed->addChannelTag('author', array('name'=>Yii::app()->params['adminEmail'].'(Vlad Ladogsky)'));
            else :
                $feed = new EFeed();
                $feed->setImage('Новости и предложения от Агентства Коммерческой Недвижимости "Pegas Realty"','http://pegasrealty.ru/ru/site/rss',
                    'http://pegasrealty.ru/images/logo.png');
                $feed->addChannelTag('language', 'ru-ru');
                $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
                $feed->addChannelTag('link', 'http://pegasrealty.ru/ru/site/rss' );
                // * self reference
                $feed->addChannelTag('atom:link','http://pegasrealty.ru/ru/site/rss');
            endif;

            $feed->title= 'Новости и предложения от Агентства Коммерческой Недвижимости "Pegas Realty"';
            $feed->description = 'Лучшые предложения коммерческой недвижимости | Аренде офисов, зданий и прочих нежелых помещений в Москве';

            if (is_array($type) && in_array('news',$type)) {
                $news = Iblocks::model()->findAll(array('condition'=>'types_iblocks_id=2','sort'=>'updatedate DESC, createdate DESC','limit'=>'10'));
                foreach ($news as $key=>$new) {
                    $item = $feed->createNewItem();
                    $item->title = $new->title;
                    $item->link = "http://pegasrealty.ru/ru/site/index/".$new->id.".html";
                    $item->description = $new->anons;
                    if ($vid=="RSS1") :
                        $item->date = strtotime($new->updatedate);
                        $item->addTag('dc:subject', $new->title);
                    elseif ($vid=="ATOM") :
                        $item->date = strtotime($new->updatedate==null ? $new->createdate : $new->updatedate);
                    else :
                        $item->date = strtotime($new->updatedate);
                        $item->setEncloser('http://pegasrealty.ru', 'n'.$new->id, 'audio/mpeg');
                        //$item->addTag('author', Yii::app()->params['adminEmail'].'(Vlad Ladogsky)');
                        $item->addTag('author', Yii::app()->params['infoEmail'].'(Vlad Ladogsky)');
                        $item->addTag('guid', 'http://pegasrealty.ru/',array('isPermaLink'=>'true'));
                    endif;
                    $feed->addItem($item);
                }
            }

           if ( $type===null || (is_array($type) and in_array('releastate',$type)))
            {
                $realestates = Realestates::model()->findAll( array('condition'=>/*'(create_date <= NOW())and'.'(in_stock=1)'*/'((t.act=1)OR(t.act is NULL))AND((t.del=0)OR(t.del is NULL))', 'order'=>'update_date DESC, create_date DESC', 'limit'=>'10'));
                foreach ($realestates as $key=>$realestate)
                {
                    $item = $feed->createNewItem();
                    $item->title = ' Пегас Недвижимость | '.$realestate->seo_title;
                    $item->link = "http://pegasrealty.ru/ru/realestates/".$realestate->id.".html";
                    $item->description = $realestate->anons;//$realestate->anons;
                    if ($vid=="RSS1") :
                        $item->date = strtotime($realestate->update_date);
                        //$item->addTag('dc:subject', ' Пегас Недвижимость | Аренда '.mb_strtolower($realestate->realestateVid->namewhat,'UTF-8').' в Москве - '.$realestate->seo_title);
                        $item->addTag('dc:subject', ' Пегас Недвижимость | '.$realestate->seo_title);
                    elseif ($vid=="ATOM") :
                        $item->date = strtotime(($realestate->update_date) ? $realestate->update_date : $realestate->create_date);
                    else :
                        $item->date = strtotime($realestate->update_date);
                        $item->setEncloser('http://pegasrealty.ru', 'n'.$new->id, 'audio/mpeg');
                        //$item->addTag('author', Yii::app()->params['adminEmail'].'(Vlad Ladogsky)');
                        $item->addTag('author', Yii::app()->params['infoEmail'].'(Vlad Ladogsky)');
                        $item->addTag('guid', 'http://pegasrealty.ru/',array('isPermaLink'=>'true'));
                    endif;
                    $feed->addItem($item);
                }
            }

            $feed->generateFeed();
            Yii::app()->end();
        }
    }

    public function actionFeed()
    {
        //Yii::setPathOfAlias('Zend',Yii::getPathOfAlias('application.vendors.zend'));

        // retrieve the latest 20 posts
        /*$posts=Post::model()->findAll(array(
            'order'=>'createTime DESC',
            'limit'=>20,
        ));

        // convert to the format needed by Zend_Feed
        $entries=array();
        foreach($posts as $post)
        {
            $entries[]=array(
                'title'=>$post->title,
                'link'=>$this->createUrl('post/show',array('id'=>$post->id)),
                'description'=>$post->content,
                'lastUpdate'=>$post->createTime,
            );
        }*/

        /**
         * Create the parent feed
         */
        $feed = new Feed;
        $feed->setTitle("Paddy's Blog");
        $feed->setLink('http://www.example.com');
        $feed->setFeedLink('http://www.example.com/atom', 'atom');
        $feed->addAuthor([
            'name'  => 'Paddy',
            'email' => 'paddy@example.com',
            'uri'   => 'http://www.example.com',
        ]);
        $feed->setDateModified(time());
        $feed->addHub('http://pubsubhubbub.appspot.com/');

        /**
         * Add one or more entries. Note that entries must
         * be manually added once created.
         */
        $entry = $feed->createEntry();
        $entry->setTitle('All Your Base Are Belong To Us');
        $entry->setLink('http://www.example.com/all-your-base-are-belong-to-us');
        $entry->addAuthor([
            'name'  => 'Paddy',
            'email' => 'paddy@example.com',
            'uri'   => 'http://www.example.com',
        ]);
        $entry->setDateModified(time());
        $entry->setDateCreated(time());
        $entry->setDescription('Exposing the difficulty of porting games to English.');
        $entry->setContent(
            'I am not writing the article. The example is long enough as is ;).'
        );
        $feed->addEntry($entry);

        /**
         * Render the resulting feed to Atom 1.0 and assign to $out.
         * You can substitute "atom" with "rss" to generate an RSS 2.0 feed.
         */


        $out = $feed->export('atom');


        $response = Yii::$app->response;
        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        //Yii::$app->end();
        return $this->renderPartial( 'xml-view', array('content'=>$out));

    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays personal cabinet page.
     *
     * @return mixed
     */
    public function actionPersonal()
    {
        return $this->render('personal');
    }

    /**
     * Displays shops page.
     *
     * @return mixed
     */
    public function actionShops()
    {
        return $this->render('shops');
    }

    /**
     * Displays shops page.
     *
     * @return mixed
     */
    public function actionTransactions()
    {
        return $this->render('transactions');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
