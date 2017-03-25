<?php

namespace service\controllers;

use Yii;
use yii\filters\AccessControl;
use service\base\ServiceController;
use yii\filters\VerbFilter;
use service\models\LoginForm;
use service\models\ContactForm;
use Hprose\Http\Server;
use service\models\RoomInfo;
use service\models\RoomUser;
use service\models\Room;

use yii\web\Response;
use service\models\IdAlloc;


Yii::$app->response->format=Response::FORMAT_JSON;
/**
 * 服务层对外服务 控制器层（HTTP协议）
 * 请继承 ServiceController
 * Class SiteController
 * @package service\controllers
 */
class RoomController extends ServiceController
{

    public $enableCsrfValidation = false;

    public static $defaultIntValue = 1;
    public $defaultAction = 'index';
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     *
     * 看这里！！！！！！
     *
     * 这个是服务层service对外提供的用户接口
     *
     * 可以开启某个方法，也可以开启整个类
     *
     * https://github.com/hprose/hprose-yii/wiki/%E4%BD%BF%E7%94%A8%E6%96%B9%E6%B3%95
     *
     * 《注意：测试可以直接调用，需要配置》
     * 访问：http://service.com/user
     * 输出：Fa3{u#s5"hello"s6"getAll"}z
     * @return string
     */
    public function actionIndex()
    {
        // $server = new Server();
        // $anObject = new User();

        // $server->addInstanceMethods($anObject);
        // return $server->start();
    }

    public function actionUpdateRoomUser(){
        $arrParam = [
            'room_id' => 31,
            'user_id' => 215,
        ];
        Room::updateRoomUserInfo($arrParam);
    }

    public function actionRoomUserExit(){
        $arrParam = [
            'room_id' => 31,
            'user_id' => 215,
            'exit_status' => 1,
        ];
        Room::updateRoomUserInfo($arrParam);
    }

    /**
     * @brif 创建房间
     * @return string
     */
    public function actionGetRoomById($id)
    {
        var_dump($id);
        $arrRoomInfo = RoomInfo::find()->orderBy('id')->all();
        Yii::$app->response->format=Response::FORMAT_JSON;
        return [
            'errno'=> 0 ,
            'errmsg'=>'success',
            'data' => $arrRoomInfo
        ];
    }


    /**
     * @brif 查看房间
     * @return string
     */
    public function actionGetRooms()
    {
        $arrRoomInfo = RoomInfo::find()->orderBy('id')->all();
        Yii::$app->response->format=Response::FORMAT_JSON;
        return [
            'errno'=> 0 ,
            'errmsg'=>'success',
            'data' => $arrRoomInfo
        ];
    }

    
   
}
